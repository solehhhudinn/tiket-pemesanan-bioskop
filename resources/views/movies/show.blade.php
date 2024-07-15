@extends('layouts.app')

@section('title', $movie->title)

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-4 shadow-sm">
                <img src="{{ asset('storage/' . $movie->poster) }}" class="card-img-top" alt="{{ $movie->title }}">
                <div class="card-body">
                    <h3 class="card-title">{{ $movie->title }}</h3>
                    <p class="card-text">{{ $movie->description }}</p>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
