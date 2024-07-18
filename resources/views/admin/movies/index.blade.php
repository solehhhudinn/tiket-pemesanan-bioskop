@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Movies') }}</h1>
    <a href="{{ route('admin.movies.create') }}" class="btn btn-primary mb-3">{{ __('Add Movie') }}</a>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-4">
            <form action="{{ route('admin.movies.index') }}" method="GET" id="perPageForm">
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
            <form action="{{ route('admin.movies.index') }}" method="GET">
                <div class="input-group mb-3">
                    <input type="text" name="search" class="form-control" placeholder="Search movies" value="{{ request('search') }}">
                    <input type="hidden" name="per_page" value="{{ request('per_page', 5) }}">
                    <button class="btn btn-outline-secondary" type="submit">{{ __('Search') }}</button>
                </div>
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Poster') }}</th>
                    <th>{{ __('Description') }}</th>
                    <th>{{ __('Trailer') }}</th>
                    <th>{{ __('Director') }}</th>
                    <th>{{ __('Starring') }}</th>
                    <th>{{ __('Censor Rating') }}</th>
                    <th>{{ __('Genre') }}</th>
                    <th>{{ __('Language') }}</th>
                    <th>{{ __('Subtitle') }}</th>
                    <th>{{ __('Duration') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                    <tr>
                        <td>{{ $movie->title }}</td>
                        <td><img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" height="50"></td>
                        <td>{!! Str::limit($movie->description, 50) !!}</td>
                        <td>{{ $movie->trailer_url }}</td>
                        <td>{{ $movie->director }}</td>
                        <td>{{ $movie->starring }}</td>
                        <td>{{ $movie->censor_rating }}</td>
                        <td>{{ $movie->genre }}</td>
                        <td>{{ $movie->language }}</td>
                        <td>{{ $movie->subtitle }}</td>
                        <td>{{ $movie->duration }}</td>
                        <td>{{ $movie->status == 1 ? 'Now Playing' : 'Upcoming' }}</td>
                        <td>
                            <a href="{{ route('admin.movies.show', $movie->id) }}" class="btn btn-info">{{ __('View') }}</a>
                            <a href="{{ route('admin.movies.edit', $movie->id) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                            <button class="btn btn-danger" onclick="confirmDelete({{ $movie->id }})">{{ __('Delete') }}</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
<br>
    <!-- Pagination -->
    <div class="d-flex justify-content-end">
        {{ $movies->appends(['search' => request('search'), 'per_page' => request('per_page')])->links('vendor.pagination.bootstrap-4') }}
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">{{ __('Konfirmasi penghapusan') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('Close') }}"></button>
            </div>
            <div class="modal-body">
                {{ __('Apakah Anda yakin ingin menghapus Film ini? Tindakan ini tidak bisa dibatalkan.') }}
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

    function confirmDelete(movieId) {
        var url = '{{ route("admin.movies.destroy", ":id") }}';
        url = url.replace(':id', movieId);
        document.getElementById('deleteForm').action = url;
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>
@endsection
