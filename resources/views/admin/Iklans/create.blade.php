@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Add Iklan') }}</h1>
    <form method="POST" action="{{ route('admin.iklans.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="iklan">{{ __('Iklan') }}</label>
            <input type="file" class="form-control @error('iklan') is-invalid @enderror" id="iklan" name="iklan" required>
            @error('iklan')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Add Iklan') }}</button>
    </form>
</div>
@endsection