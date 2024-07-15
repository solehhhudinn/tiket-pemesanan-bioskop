@extends('layouts.app')

@section('title', 'Now Playing')

@section('content')
<div class="container">
    <h1 class="my-4">Now Playing</h1>
    <div class="row">
        @foreach($nowPlayingMovies as $movie)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $movie->poster) }}" class="card-img-top img-fluid" alt="{{ $movie->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        <div class="mt-auto">
                            <a href="{{ route('movies.tickets', $movie->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
