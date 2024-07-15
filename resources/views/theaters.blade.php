@extends('layouts.app')

@section('title', 'Theaters')

@section('content')
<div class="container">
    <h1 class="my-4">Theaters</h1>

    <div class="mb-4">
        <form action="{{ route('theaters.index') }}" method="GET">
            <div class="form-group">
                <label for="location">Select Location:</label>
                <select name="location" id="location" class="form-control" onchange="this.form.submit()">
                    <option value="">All Locations</option>
                    @foreach($locations as $loc)
                        <option value="{{ $loc->location }}" {{ $loc->location == $location ? 'selected' : '' }}>
                            {{ $loc->location }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>
    </div>

    <div class="row">
        @foreach($theaters as $theater)
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $theater->image) }}" class="card-img-top img-fluid" alt="{{ $theater->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $theater->name }}</h5>
                        <p class="card-text">{{ $theater->lokasi }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
