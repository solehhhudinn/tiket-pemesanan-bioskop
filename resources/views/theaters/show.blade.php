@extends('layouts.app')

@section('title', $theater->name)

@section('content')
<div class="container">
    <h1 class="my-4">{{ $theater->name }}</h1>
    <div class="row">
        <div class="col-md-8">
            <img src="{{ asset('storage/' . $theater->image) }}" class="img-fluid" alt="{{ $theater->name }}">
        </div>
        <div class="col-md-4">
            <h3>Lokasi</h3>
            <p>{{ $theater->location }}</p>
        </div>
    </div>
</div>
@endsection
