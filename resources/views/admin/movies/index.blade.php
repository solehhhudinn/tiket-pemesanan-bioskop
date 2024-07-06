@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Movies') }}</h1>
    <a href="{{ route('admin.movies.create') }}" class="btn btn-primary mb-3">{{ __('Add Movie') }}</a>
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
                    <th>{{ __('Status') }}</th> <!-- Tambahan kolom status -->
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
                        <td>{{ $movie->status == 1 ? 'Now Playing' : 'Upcoming' }}</td> <!-- Tambahan kolom status -->
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
                {{ __('Are you sure you want to delete this movie? This action cannot be undone.') }}
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
    function confirmDelete(movieId) {
        var url = '{{ route("admin.movies.destroy", ":id") }}';
        url = url.replace(':id', movieId);
        document.getElementById('deleteForm').action = url;
        $('#deleteModal').modal('show');
    }
</script>
@endsection
