@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Edit Theater') }}</h1>
    <form method="POST" action="{{ route('admin.theaters.update', $theater->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $theater->name) }}" required>
        </div>
        <div class="form-group">
            <label for="location">{{ __('Location') }}</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ old('location', $theater->location) }}" required>
        </div>
        <div class="form-group">
            <label for="price">{{ __('Price') }}</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price', $theater->price) }}">
        </div>
        <div class="form-group">
            <label for="image">{{ __('Image') }}</label>
            <input type="file" class="form-control" id="image" name="image">
            @if($theater->image)
                <img src="{{ asset('storage/' . $theater->image) }}" alt="{{ $theater->name }}" height="100" class="mt-2">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Update Theater') }}</button>
    </form>
</div>
@endsection