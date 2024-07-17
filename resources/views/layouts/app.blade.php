<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Cinema')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="shortcut icon" href="{{ asset('img/logo-tittle.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .custom-carousel-control-prev-icon {
            background-image: url('img/prev.png');
            background-size: 50px;
        }

        .custom-carousel-control-next-icon {
            background-image: url('img/next.png');
            background-size: 50px;
        }
        .notification-icon {
            position: relative;
            display: inline-block;
        }
        .notification-icon .badge {
            position: absolute;
            top: -5px;
            right: -10px;
            padding: 5px 10px;
            border-radius: 50%;
            background-color: red;
            color: white;
        }
        .fas {
            color: black; /* Adjust color as needed */
        }

        .notification-dropdown {
            max-height: 300px; /* Adjust the height as needed */
            overflow-y: auto;
        }

        .notification-item.unread {
            font-weight: bold;
        }

        .notification-item.read {
            font-weight: normal;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('img/logo2.png') }}" alt="Logo" style="height: 60px;">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('movies.nowPlaying') }}">Now Playing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/theaters') }}">Theaters</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('movies.upcoming') }}">Upcoming</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                        {{-- <li class="nav-item dropdown notification-icon">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-bell-fill"></i>
                                <span class="badge">{{ Auth::user()->unreadNotifications->count() }}</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right notification-dropdown" aria-labelledby="navbarDropdown">
                                @forelse(Auth::user()->notifications as $notification)
                                    @if(isset($notification->data['status']) && $notification->data['status'] != 'Rejected')
                                        <a class="dropdown-item notification-item {{ $notification->read_at ? 'read' : 'unread' }}" href="{{ route('notifications.show', $notification->id) }}" data-id="{{ $notification->id }}">
                                            {{ $notification->data['message'] ?? 'No message available' }}
                                            <br>
                                            <small>{{ $notification->created_at->format('d M Y, H:i') }}</small>
                                        </a>
                                    @endif
                                @empty
                                    <a class="dropdown-item" href="#">No notifications</a>
                                @endforelse
                            </div>
                        </li>                                                                            --}}
                        
                            @if(Auth::user()->is_admin)
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
                                </li>
                            @else
                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

        <main class="">
            @yield('capung')
        </main>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('.notification-item').forEach(function (item) {
                item.addEventListener('click', function (event) {
                    event.preventDefault();
                    const notificationId = this.getAttribute('data-id');
                    const url = this.getAttribute('href');

                    fetch(`/notifications/mark-as-read/${notificationId}`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }).then(response => {
                        if (response.ok) {
                            window.location.href = url;
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>
