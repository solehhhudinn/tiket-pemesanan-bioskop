@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Seats') }}</h1>
    <a href="{{ route('admin.seats.create') }}" class="btn btn-primary mb-3">{{ __('Add Seat') }}</a>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>{{ __('Theater') }}</th>
                    <th>{{ __('Seat Number') }}</th>
                    <th>{{ __('Type') }}</th>
                    <th>{{ __('Is Available') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($seats as $seat)
                    <tr>
                        <td>{{ $seat->theater->name }}</td>
                        <td>{{ $seat->seat_number }}</td>
                        <td>{{ $seat->type }}</td>
                        <td>{{ $seat->is_available ? __('Belum di isi') : __('Sudah di isi') }}</td>
                        <td>
                            <a href="{{ route('admin.seats.edit', $seat->id) }}" class="btn btn-warning">{{ __('Edit') }}</a>
                            <form action="{{ route('admin.seats.destroy', $seat->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection