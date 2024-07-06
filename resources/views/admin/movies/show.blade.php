@extends('layouts.admin.app')

@section('content')
<div class="container">
    <!-- Bagian Detail Film -->
    <div class="row mb-2 d-flex align-items-center">
        <!-- Bagian Poster -->
        <div class="col-md-4 text-center">
            <img src="{{ asset('storage/' . $movie->poster) }}" class="img-fluid movie-poster" alt="{{ $movie->title }}" style="width: 100%; max-width: 300px;">
        </div>
        <!-- Bagian Trailer -->
        <div class="col-md-8">
            <div class="movie-trailer mt-2">
                <iframe src="{{ $movie->trailer_url }}" class="w-100" style="height: 440px; border-radius:10px" allowfullscreen></iframe>
            </div>
        </div>
    </div>
    
    <!-- Bagian Informasi Film -->
    <div class="row">
        <div class="col-md-12">
            <hr>
            <h3 class="text-uppercase font-weight-bold">{{ $movie->title }}</h3>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <p><strong>{{ __('Director') }}:</strong> {{ $movie->director ?? 'N/A' }}</p>
                    <p><strong>{{ __('Starring') }}:</strong> {{ $movie->starring ?? 'N/A' }}</p>
                    <p><strong>{{ __('Censor Rating') }}:</strong> {{ $movie->censor_rating ?? 'N/A' }}</p>
                    <p><strong>{{ __('Genre') }}:</strong> {{ $movie->genre ?? 'N/A' }}</p>
                    <p><strong>{{ __('Language') }}:</strong> {{ $movie->language ?? 'N/A' }}</p>
                    <p><strong>{{ __('Subtitle') }}:</strong> {{ $movie->subtitle ?? 'N/A' }}</p>
                    <p><strong>{{ __('Duration') }}:</strong> {{ $movie->duration ?? 'N/A' }} {{ __('Minutes') }}</p>
                </div>
                <div class="col-md-8">
                    <p>{{ $movie->description }}</p>
                </div>
            </div>
            <a href="{{ route('admin.movies.index') }}" class="btn btn-primary mt-3">{{ __('Back to Movies') }}</a>
        </div>
    </div>
</div>
@endsection
