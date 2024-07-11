@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Edit Schedule') }}</h1>
    <form method="POST" action="{{ route('admin.schedules.update', $schedule->id) }}">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="movie_id">{{ __('Movie') }}</label>
            <select class="form-control" id="movie_id" name="movie_id" required>
                <option value="">{{ __('Select Movie') }}</option>
                @foreach($movies as $movie)
                    <option value="{{ $movie->id }}" {{ old('movie_id', $schedule->movie_id) == $movie->id ? 'selected' : '' }}>
                        {{ $movie->title }}
                    </option>
                @endforeach
            </select>
            @error('movie_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="theater_id">{{ __('Theater') }}</label>
            <select class="form-control" id="theater_id" name="theater_id" required>
                <option value="">{{ __('Select Theater') }}</option>
                @foreach($theaters as $theater)
                    <option value="{{ $theater->id }}" {{ old('theater_id', $schedule->theater_id) == $theater->id ? 'selected' : '' }}>
                        {{ $theater->name }}
                    </option>
                @endforeach
            </select>
            @error('theater_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="date">{{ __('Date') }}</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $schedule->date) }}" required>
            @error('date')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label>{{ __('Times') }}</label>
            <div id="time-inputs">
                @foreach (old('times', $schedule->times) as $time)
                <div class="input-group mb-2">
                    <input type="time" class="form-control" name="times[]" value="{{ \Carbon\Carbon::parse($time['time'])->format('H:i') }}" required>
                    <button type="button" class="btn btn-danger btn-remove-time">Remove</button>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-success btn-add-time">Add Time</button>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('Update Schedule') }}</button>
    </form>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const timeInputsContainer = document.getElementById('time-inputs');
    const addTimeButton = document.querySelector('.btn-add-time');

    addTimeButton.addEventListener('click', function () {
        const timeInputGroup = document.createElement('div');
        timeInputGroup.classList.add('input-group', 'mb-2');

        const timeInput = document.createElement('input');
        timeInput.type = 'time';
        timeInput.name = 'times[]';
        timeInput.classList.add('form-control');
        timeInput.required = true;

        const removeButton = document.createElement('button');
        removeButton.type = 'button';
        removeButton.classList.add('btn', 'btn-danger', 'btn-remove-time');
        removeButton.textContent = 'Remove';

        timeInputGroup.appendChild(timeInput);
        timeInputGroup.appendChild(removeButton);
        timeInputsContainer.appendChild(timeInputGroup);

        removeButton.addEventListener('click', function () {
            timeInputsContainer.removeChild(timeInputGroup);
        });
    });

    document.querySelectorAll('.btn-remove-time').forEach(button => {
        button.addEventListener('click', function () {
            timeInputsContainer.removeChild(button.parentElement);
        });
    });
});
</script>
@endsection