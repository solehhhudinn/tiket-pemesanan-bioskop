@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Theaters') }}</h1>
    <a href="{{ route('admin.theaters.create') }}" class="btn btn-primary mb-3">{{ __('Add Theater') }}</a>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-4">
            <form action="{{ route('admin.theaters.index') }}" method="GET" id="perPageForm">
                <div class="input-group">
                    <label class="input-group-text" for="per_page">{{ __('Show') }}</label>
                    <select class="form-select" id="per_page" name="per_page" onchange="updatePerPage()">
                        <option value="5"{{ request('per_page') == 5 ? ' selected' : '' }}>5</option>
                        <option value="10"{{ request('per_page') == 10 ? ' selected' : '' }}>10</option>
                        <option value="25"{{ request('per_page') == 25 ? ' selected' : '' }}>25</option>
                        <option value="50"{{ request('per_page') == 50 ? ' selected' : '' }}>50</option>
                        <option value="100"{{ request('per_page') == 100 ? ' selected' : '' }}>100</option>
                    </select>
                </div>
            </form>
        </div>
        <div class="col-md-8">
            <form action="{{ route('admin.theaters.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search theaters" value="{{ request('search') }}">
                    <input type="hidden" name="per_page" value="{{ request('per_page', 5) }}">
                    <button class="btn btn-outline-secondary" type="submit">{{ __('Search') }}</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Location') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($theaters as $theater)
            <tr>
                <td>{{ $theater->name }}</td>
                <td>{{ $theater->location }}</td>
                <td>{{ formatRupiah($theater->price) }}</td>
                <td>
                    @if($theater->image)
                        <img src="{{ asset('storage/' . $theater->image) }}" alt="{{ $theater->name }}" height="50">
                    @else
                        {{ __('No Image') }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.theaters.show', $theater->id) }}" class="btn btn-info btn-sm">{{ __('View') }}</a>
                    <a href="{{ route('admin.theaters.edit', $theater->id) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete({{ $theater->id }})">{{ __('Delete') }}</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div class="d-flex justify-content-end">
        {{ $theaters->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">{{ __('Konfirmasi penghapusan') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                {{ __('Apakah Anda yakin ingin menghapus Theater ini? Tindakan ini tidak bisa dibatalkan.') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Batal') }}</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Hapus') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    function updatePerPage() {
        var form = document.getElementById('perPageForm');
        var searchInput = document.createElement('input');
        searchInput.type = 'hidden';
        searchInput.name = 'search';
        searchInput.value = '{{ request('search') }}';
        form.appendChild(searchInput);
        form.submit();
    }
    
    function confirmDelete(theaterId) {
        var url = '{{ route("admin.theaters.destroy", ":id") }}';
        url = url.replace(':id', theaterId);
        document.getElementById('deleteForm').action = url;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>
@endsection
