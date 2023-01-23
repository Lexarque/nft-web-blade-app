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
                        <th scope="col">User Name</th>
                        <th scope="col">Total</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $data)
                        <tr class="text-center justify-content-center align-items-center">
                            <td>{{ $data->user->name }}</td>
                            <td>{{ $data->total }}</td>
                            <td>{{ $data->status }}</td>
                            <td class="justify-content-center">
                                @if ($data->status == 'Pending')
                                    <div class="d-flex row">
                                        <form action=" {{ url('/balance/approval/' . $data->id) }}" method="POST"
                                            class="col-6">
                                            @csrf
                                            <input type="hidden" id="fname" name="status" value="Approved">
                                            <button class="btn btn-success btn-block text-center w-100 h-100"
                                                type="submit">Approve</button>
                                        </form>

                                        <form action=" {{ url('/balance/approval/' . $data->id) }}" method="POST"
                                            class="col-6">
                                            @csrf
                                            <input type="hidden" id="fname" name="status" value="Rejected">
                                            <button class="btn btn-danger btn-block text-center w-100 h-100"
                                                type="submit">Reject</ button>
                                        </form>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="my-5 text-center">
                <h1 class="mt-5">Data is Empty</h1>
            </div>
        @endif
    @endsection
</body>

</html>
