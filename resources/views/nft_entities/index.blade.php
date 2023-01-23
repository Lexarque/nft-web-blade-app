@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'NFT List')
</head>

<body>
    @section('content')
        @if ($datas->count() > 0)
            <div class="mt-5 text-end">
                <button type="button" class="btn btn-success w-25"><a href="{{ route('create-nft') }}"
                        style="color: white">Add Data</a></button>
            </div>
            <table class="table table-dark table-striped mt-3 text-center">
                <thead>
                    <tr>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">NFT ID</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created By</th>
                        <th scope="col">Owned By</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr class="text-center justify-content-center align-items-center">
                            <td><a href="{{ url("nft/detail/$data->id") }}"><img src="{{ $data->image }}" alt="nft-image"
                                        class="p-3" style="width: 200px; height: 200px;"></a></td>
                            <td>{{ $data->name }}</td>
                            <td>{{ $data->nft_number }}</td>
                            <td>{{ $data->description }}</td>
                            <td>{{ $data->price }} ETH</td>
                            <td>{{ $data->status }}</td>
                            <td>{{ $data->creator->name }}</td>
                            @if ($data->owner == null)
                                <td>-</td>
                            @else
                                <td>{{ $data->owner->name }}</td>
                            @endif
                            <td>
                                @if ($data->status !== 'Approved')
                                <button class="btn btn-warning"><a href="{{ url("/nft/edit/$data->id") }}" >Edit</a></button>
                                <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this data?')"><a href="{{ url("/nft/delete/$data->id") }}">Delete</a></button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="my-5 text-center">
                <button type="button" class="btn btn-success w-75"><a href="{{ route('create-nft') }}"
                        style="color: white">Add Data</a></button>
                <h1 class="mt-5">Data is Empty, please input a data</h1>
            </div>
        @endif
    @endsection
</body>

</html>
