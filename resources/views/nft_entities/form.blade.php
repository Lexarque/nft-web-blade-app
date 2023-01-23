@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @if (Route::is('create-nft'))
        @section('title', 'Create NFT')
    @elseif (Route::is('update-nft'))
        @section('title', 'Update NFT')
    @endif
    <style>
        .form-control {
            background-color: #bebebe!important;
        }
    </style>
</head>

<body>
    @section('content')
        <nav aria-label="breadcrumb" class="mt-5">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('nft-index') }}" style="font-size: 24px">Go to Index</a></li>
            </ol>
        </nav>
        <div class="mt-5">
            @if (last(request()->segments()) == 'create')
                <form action="{{ route('save-nft') }}" method="POST" enctype="multipart/form-data" style="font-size: 24px">
                @else
                    <form action="{{ url("/nft/update/$data->id") }}" method="POST" style="font-size: 24px">
            @endif
            @csrf
            @if (last(request()->segments()) == 'create')
                <h1 class="my-5">Create NFT</h1>
            @else
                <h1 class="my-5">Edit NFT</h1>
            @endif
            @if (last(request()->segments()) == 'create')
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="nft-name">NFT Name:</label>
                        <input type="text" class="form-control" id="nft-name" placeholder="Enter NFT name"
                            name="name">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="nft-id">NFT ID:</label>
                        <input type="text" class="form-control text-muted" id="nft-id" name="nft_number"
                            value="#{{ $dataCount }}" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description">Description:</label>
                    <textarea type="text" class="form-control" id="descrption" placeholder="Enter your NFT description"
                        name="description" rows="5"></textarea>
                </div>
                <div class="mb-3">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" placeholder="Enter NFT price" name="price" step="any">
                </div>
            @else
                <div class="row">
                    <div class="mb-3 col-6">
                        <label for="nft-name">NFT Name:</label>
                        <input type="text" class="form-control" id="nft-name" placeholder="Enter NFT name"
                            name="name" value="{{ $data->name }}">
                    </div>
                    <div class="mb-3 col-6">
                        <label for="nft-id">NFT ID:</label>
                        <input type="text" class="form-control text-muted" id="nft-id" name="nft_number"
                            value="#{{ $dataCount }}" disabled>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="description">Description:</label>
                    <textarea type="text" class="form-control" id="descrption" placeholder="Enter your NFT description"
                        name="description" rows="5">{{ $data->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="price">Price:</label>
                    <input type="number" class="form-control" id="price" placeholder="Enter NFT price" name="price"
                        value="{{ $data->price }}" step="any">
                </div>
            @endif
            @if (last(request()->segments()) == 'create')
                <div class="mb-3">
                    <label for="file-input">Upload your NFT Image:</label>
                    <input class="form-control" type="file" name="image" id="file-input">
                </div>
            @endif
            <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>
    @endsection
</body>

</html>
