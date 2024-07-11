@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Schedules') }}</h1>
    <a href="{{ route('admin.schedules.create') }}" class="btn btn-primary mb-3">{{ __('Add Schedule') }}</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('Movie') }}</th>
                <th>{{ __('Theater') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Times') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($schedules as $schedule)
            <tr>
                <td>{{ $schedule->movie->title }}</td>
                <td>{{ $schedule->theater->name }}</td>
                <td>{{ \Carbon\Carbon::parse($schedule->date)->format('d M Y') }}</td>
                <td>
                    @foreach($schedule->times as $time)
                        <div>{{ \Carbon\Carbon::parse($time['time'])->format('H:i') }}</div>
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('admin.schedules.edit', $schedule->id) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                    <form action="{{ route('admin.schedules.destroy', $schedule->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection