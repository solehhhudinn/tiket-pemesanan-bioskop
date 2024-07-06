@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Iklans') }}</h1>
    <a href="{{ route('admin.iklans.create') }}" class="btn btn-primary mb-3">{{ __('Add Iklan') }}</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Iklan') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($iklans as $iklan)
                    <tr>
                        <td>{{ $iklan->title }}</td>
                        <td><img src="{{ asset('storage/' . $iklan->iklan) }}" alt="{{ $iklan->title }}" height="50"></td>
                        <td>
                            <a href="{{ route('admin.iklans.edit', $iklan->id) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                            <button class="btn btn-danger" onclick="confirmDelete({{ $iklan->id }})">{{ __('Delete') }}</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">{{ __('Confirm Deletion') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ __('Are you sure you want to delete this iklan? This action cannot be undone.') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(iklanId) {
        var url = '{{ route("admin.iklans.destroy", ":id") }}';
        url = url.replace(':id', iklanId);
        document.getElementById('deleteForm').action = url;
        $('#deleteModal').modal('show');
    }
</script>
@endsection