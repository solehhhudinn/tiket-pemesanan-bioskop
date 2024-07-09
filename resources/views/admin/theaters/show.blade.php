@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Theater Details') }}</h1>
    <div class="card">
        <div class="card-header">{{ $theater->name }}</div>
        <div class="card-body">
            <p><strong>{{ __('Location:') }}</strong> {{ $theater->location }}</p>
            <p><strong>{{ __('Price:') }}</strong> {{ $theater->price }}</p>
            <p><strong>{{ __('Type:') }}</strong> {{ ucfirst($theater->type) }}</p>
            @if($theater->image)
                <img src="{{ asset('storage/' . $theater->image) }}" alt="{{ $theater->name }}" height="200">
            @endif
        </div>
    </div>
    <a href="{{ route('admin.theaters.index') }}" class="btn btn-secondary mt-3">{{ __('Back to Theaters') }}</a>
</div>
@endsection