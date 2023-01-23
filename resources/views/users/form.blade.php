@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if (Route::is('create-user'))
        @section('title', 'Create User')
    @elseif (Route::is('update-user'))
        @section('title', 'Update User')
    @endif
    <style>
        .form-control {
            background-color: #bebebe !important;
        }
    </style>
</head>

<body>
    @section('content')
        <nav aria-label="breadcrumb" class="mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('index-user') }}" style="font-size: 24px">Go to Index</a>
                </li>
            </ol>
        </nav>
        <div class="mt-5">
            @if (last(request()->segments()) == 'create')
                <form action="{{ route('save-user') }}" method="POST" enctype="multipart/form-data"
                    style="font-size: 24px">
                @else
                    <form action="{{ url("/users/update/$data->id") }}" method="POST" enctype="multipart/form-data" style="font-size: 24px">
            @endif
            @csrf
            @if (last(request()->segments()) == 'create')
                <h1 class="my-5">Create user</h1>
            @else
                <h1 class="my-5">Edit user</h1>
            @endif
            @if (last(request()->segments()) == 'create')
                <div class="mb-3">
                    <label for="user-name">Name:</label>
                    <input type="text" class="form-control" id="user-name" placeholder="Enter the user name"
                        name="name">
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="user-email">Email:</label>
                        <input type="email" class="form-control" id="user-email" name="email" placeholder="example@gmail.com">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="user-password">Password:</label>
                        <input type="password" class="form-control" id="user-password" name="password">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description">Description:</label>
                    <textarea type="text" class="form-control" id="description" placeholder="Enter the user description"
                        name="description" rows="5"></textarea>
                </div>
            @else
            <p>{{$data->name}}</p>
                <div class="mb-3">
                    <label for="user-name">Name:</label>
                    <input type="text" class="form-control" id="user-name" placeholder="Enter the user name"
                        name="name" value="{{ $data->name }}">
                </div>
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="user-email">Email:</label>
                        <input type="email" class="form-control" id="user-email" name="email"
                            value="{{ $data->email }}">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="user-password">Password:</label>
                        <input type="password" class="form-control" id="user-password" name="password"
                            value="{{ $data->password }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description">Description:</label>
                    <textarea type="text" class="form-control" id="description" placeholder="Enter your user description"
                        name="description" rows="5">{{ $data->description }}</textarea>
                </div>
            @endif
            @if (last(request()->segments()) == 'create')
                <div class="mb-3">
                    <label for="file-input">Upload your user Image:</label>
                    <input class="form-control" type="file" name="image" id="file-input">
                </div>
            @else
                <div class="mb-3">
                    <label for="file-input">Upload your user Image:</label>
                    <input class="form-control" type="file" name="image" id="file-input" value="{{ $data->image }}">
                </div>
            @endif
            <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    @endsection
</body>

</html>
