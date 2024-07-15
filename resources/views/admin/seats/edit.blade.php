@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Edit Seat') }}</h1>
    <form method="POST" action="{{ route('admin.seats.update', $seat->id) }}">
        @csrf
        @method('PUT')
        
        <div class="form-group mb-3">
            <label for="theater_id">{{ __('Theater') }}</label>
            <select class="form-control" id="theater_id" name="theater_id" required>
                <option value="">{{ __('Select Theater') }}</option>
                @foreach($theaters as $theater)
                    <option value="{{ $theater->id }}" {{ old('theater_id', $seat->theater_id) == $theater->id ? 'selected' : '' }}>
                        {{ $theater->name }}
                    </option>
                @endforeach
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label for="seat_number">{{ __('Seat Number') }}</label>
            <input type="text" class="form-control" id="seat_number" name="seat_number" value="{{ old('seat_number', $seat->seat_number) }}" required>
        </div>
        
        <div class="form-group mb-3">
            <label for="type">{{ __('Type') }}</label>
            <select class="form-control" id="type" name="type" required>
                <option value="regular" {{ old('type', $seat->type) == 'regular' ? 'selected' : '' }}>
                    {{ __('Regular') }}
                </option>
                <option value="sweetbox" {{ old('type', $seat->type) == 'sweetbox' ? 'selected' : '' }}>
                    {{ __('Sweetbox') }}
                </option>
            </select>
        </div>
        
        <div class="form-group mb-3">
            <label for="is_available">{{ __('Is Available') }}</label>
            <select class="form-control" id="is_available" name="is_available" required>
                <option value="1" {{ old('is_available', $seat->is_available) == 1 ? 'selected' : '' }}>
                    {{ __('Available') }}
                </option>
                <option value="0" {{ old('is_available', $seat->is_available) == 0 ? 'selected' : '' }}>
                    {{ __('Occupied') }}
                </option>
            </select>
        </div>
        
        <button type="submit" class="btn btn-primary">{{ __('Update Seat') }}</button>
    </form>
</div>
@endsection