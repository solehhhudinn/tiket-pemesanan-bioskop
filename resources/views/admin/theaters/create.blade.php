@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Add Theater') }}</h1>
    <form method="POST" action="{{ route('admin.theaters.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">{{ __('Name') }}</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>
        <div class="form-group">
            <label for="location">{{ __('Location') }}</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
        </div>
        <div class="form-group">
            <label for="price">{{ __('Price') }}</label>
            <input type="text" class="form-control" id="price" name="price" value="{{ old('price') }}">
        </div>
        <div class="form-group">
            <label for="image">{{ __('Image') }}</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Add Theater') }}</button>
    </form>
</div>
@endsection