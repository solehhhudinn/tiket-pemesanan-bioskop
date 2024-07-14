@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Add Seat') }}</h1>
    <form method="POST" action="{{ route('admin.seats.store') }}">
        @csrf
        <div class="form-group">
            <label for="theater_id">{{ __('Theater') }}</label>
            <select class="form-control" id="theater_id" name="theater_id" required>
                <option value="">{{ __('Select Theater') }}</option>
                @foreach($theaters as $theater)
                    <option value="{{ $theater->id }}">{{ $theater->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="seat_number">{{ __('Seat Number') }}</label>
            <input type="text" class="form-control" id="seat_number" name="seat_number" value="{{ old('seat_number') }}" required>
        </div>
        <div class="form-group">
            <label for="type">{{ __('Type') }}</label>
            <select class="form-control" id="type" name="type" required>
                <option value="regular">{{ __('Regular') }}</option>
                <option value="sweetbox">{{ __('Sweetbox') }}</option>
            </select>
        </div>
        <div class="form-group">
            <label for="is_available">{{ __('Is Available') }}</label>
            <select class="form-control" id="is_available" name="is_available" required>
                <option value="1">{{ __('Kosong') }}</option>
                <option value="0">{{ __('Isi') }}</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Add Seat') }}</button>
    </form>
</div>
@endsection