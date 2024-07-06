@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Add Movie') }}</h1>
    <form method="POST" action="{{ route('admin.movies.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">{{ __('Title') }}</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            @error('title')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="poster">{{ __('Poster') }}</label>
            <input type="file" class="form-control" id="poster" name="poster" required>
            @error('poster')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="description">{{ __('Description') }}</label>
            <textarea class="form-control" id="description" name="description" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="trailer_url">{{ __('Trailer URL') }}</label>
            <input type="url" class="form-control" id="trailer_url" name="trailer_url" value="{{ old('trailer_url') }}" required>
            @error('trailer_url')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="director">{{ __('Director') }}</label>
            <input type="text" class="form-control" id="director" name="director" value="{{ old('director') }}" required>
            @error('director')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="starring">{{ __('Starring') }}</label>
            <input type="text" class="form-control" id="starring" name="starring" value="{{ old('starring') }}" required>
            @error('starring')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="censor_rating">{{ __('Censor Rating') }}</label>
            <input type="text" class="form-control" id="censor_rating" name="censor_rating" value="{{ old('censor_rating') }}" required>
            @error('censor_rating')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="genre">{{ __('Genre') }}</label>
            <input type="text" class="form-control" id="genre" name="genre" value="{{ old('genre') }}" required>
            @error('genre')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="language">{{ __('Language') }}</label>
            <input type="text" class="form-control" id="language" name="language" value="{{ old('language') }}" required>
            @error('language')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="subtitle">{{ __('Subtitle') }}</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" value="{{ old('subtitle') }}" required>
            @error('subtitle')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="duration">{{ __('Duration') }}</label>
            <input type="text" class="form-control" id="duration" name="duration" value="{{ old('duration') }}" required>
            @error('duration')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="status">{{ __('Status') }}</label>
            <select class="form-control" id="status" name="status" required>
                <option value="">{{ __('Select Status') }}</option>
                <option value="{{ \App\Models\Movie::STATUS_NOW_PLAYING }}" {{ old('status') == \App\Models\Movie::STATUS_NOW_PLAYING ? 'selected' : '' }}>{{ __('Now Playing') }}</option>
                <option value="{{ \App\Models\Movie::STATUS_UPCOMING }}" {{ old('status') == \App\Models\Movie::STATUS_UPCOMING ? 'selected' : '' }}>{{ __('Upcoming') }}</option>
            </select>
            @error('status')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Add Movie') }}</button>
    </form>
</div>
@endsection