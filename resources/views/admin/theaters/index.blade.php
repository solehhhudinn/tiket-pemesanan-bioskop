@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>{{ __('Theaters') }}</h1>
    <a href="{{ route('admin.theaters.create') }}" class="btn btn-primary mb-3">{{ __('Add Theater') }}</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Location') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($theaters as $theater)
            <tr>
                <td>{{ $theater->name }}</td>
                <td>{{ $theater->location }}</td>
                <td>Rp. {{ number_format($theater->price, 0, '', '.') }}</td>
                <td>
                    @if($theater->image)
                        <img src="{{ asset('storage/' . $theater->image) }}" alt="{{ $theater->name }}" height="50">
                    @else
                        {{ __('No Image') }}
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.theaters.show', $theater->id) }}" class="btn btn-info btn-sm">{{ __('View') }}</a>
                    <a href="{{ route('admin.theaters.edit', $theater->id) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                    <form action="{{ route('admin.theaters.destroy', $theater->id) }}" method="POST" style="display:inline-block;">
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