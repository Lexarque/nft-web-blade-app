@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Users List')
</head>

<body>
    @section('content')
        @if ($data->count() > 0)
            <div class="mt-5 text-end">
                <button type="button" class="btn btn-success w-25"><a href="{{ route('create-user') }}"
                        style="color: white">Add Data</a></button>
            </div>
            <table class="table table-dark table-striped mt-3 text-center">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Description</th>
                        <th scope="col">Balance</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $value)
                        <tr>
                            @if ($value->image == 'no-image')
                                <th><a href="{{ url("/users/detail/$value->id") }}"><img
                                            src="{{ asset('./assets/img/' . $value->image . '.jpg') }}" alt=""
                                            class="p-3" style="width: 200px; height: 200px;"></a></th>
                            @else
                                <th><a href="{{ url("/users/detail/$value->id") }}"><img src="{{ asset($value->image) }}"
                                            alt="" class="p-3" style="width: 200px; height: 200px;"></a></th>
                            @endif
                            <th>{{ $value->name }}</th>
                            <th>{{ $value->email }}</th>
                            <th>{{ $value->description }}</th>
                            <th>{{ $value->balance }}</th>
                            <th>{{ $value->status }}</th>
                            <td>
                                <button class="btn btn-warning"><a
                                        href="{{ url("/users/edit/$value->id") }}">Edit</a></button>
                                @if ($value->status == 'Blacklisted')
                                    <button class="btn btn-danger"
                                        onclick="return confirm('Are you sure you want to delete this data?')"><a
                                            href="{{ url("/users/delete/$value->id") }}">Delete</a></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="my-5 text-center">
                <button class="btn btn-success w-75">Add Data</button>
                <h1 class="mt-5">Data is Empty, please input a data</h1>
            </div>
        @endif
    @endsection
</body>

</html>
