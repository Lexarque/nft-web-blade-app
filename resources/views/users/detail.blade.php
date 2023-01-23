@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'User Detail')
    <style>
        .navbar-nav .nav-item .nav-link:focus {
            text-decoration: underline;
            background-color: black;
        }
    </style>
</head>

<body>
    @section('content')
        <div class="row" style="margin-top: 175px;">
            <div class="col-2">
                @if ($data->image == 'no-image')
                    <img src="{{ asset('./assets/img/' . $data->image . '.jpg') }}" alt="user-profile-picture"
                        class="rounded-circle" style="width: 150px; height: 150px;">
                @else
                    <img src="{{ asset($data->image) }}" alt="user-profile-picture" class="rounded-circle"
                        style="width: 150px; height: 150px;">
                @endif
            </div>
            <div class="col-10">
                <h2 class="mt-3">{{ $data->name }}</h2>
                <span style="font-size: 16px" class="text-muted">Joined {{ date_format($data->created_at, 'F Y') }}</span>
                @if (Auth::check())
                    @if ($data->name == Auth::user()->name || Auth::user()->role->name == 'Super Admin')
                        <br><button class="btn btn-success mt-4"><a href="{{ url("/users/edit/$data->id") }}">Edit
                                Profile</a></button>
                    @endif
                @endif
            </div>
        </div>
        <p class="mt-5" style="font-size: 20px">{{ $data->description }}</p>
        <nav class="navbar navbar-expand navbar-dark justify-content-center align-items-center my-5 "
            style="background-color: #0C0032; font-size: 20px">
            <ul class="navbar-nav">
                <li class="nav-item" selected="selected">
                    <a class="nav-link active" aria-current="page"
                        href="{{ url("/users/detail/$data->id/collection") }}">Collections</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                        href="{{ url("/users/detail/$data->id/creation") }}">Created</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page"
                        href="{{ url("/users/detail/$data->id/liked") }}">Liked</a>
                </li>
            </ul>

        </nav>
        @yield('user-tab-content')
    @endsection
</body>

</html>
