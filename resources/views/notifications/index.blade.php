@extends('layouts.app')

@section('content')
    <h1>Notifications</h1>
    @if($notifications->isEmpty())
        <p>No notifications.</p>
    @else
        <ul>
            @foreach($notifications as $notification)
                @if($notification->data['message'] == 'Tiket bioskop telah berhasil')
                    <li>
                        <a href="{{ route('notifications.show', $notification->id) }}">
                            {{ $notification->data['message'] }}
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    @endif
@endsection
