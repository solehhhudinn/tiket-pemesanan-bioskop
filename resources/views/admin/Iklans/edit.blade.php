@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Edit Iklan') }}</h1>
    <form method="POST" action="{{ route('admin.iklans.update', $iklan->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $iklan->title) }}" required>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="iklan">{{ __('Iklan') }}</label>
            <input type="file" class="form-control @error('iklan') is-invalid @enderror" id="iklan" name="iklan">
            @error('iklan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            @if($iklan->iklan)
                <img src="{{ asset('storage/' . $iklan->iklan) }}" alt="{{ $iklan->title }}" height="100" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Update Iklan') }}</button>
    </form>
</div>
@endsection