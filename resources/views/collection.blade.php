@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Collections')
</head>

<body>
    @section('content')
        @if (!$data->isEmpty())
            <h1 class="text-center my-5">Our NFT Collections : </h1>
        @endif
        <div class="row height d-flex justify-content-center align-items-center my-5">
            <form action="{{ route('collection') }}" method="GET" class="row">
                <div class="search col-10">
                    <input type="text" class="form-control" placeholder="Search for NFTs..." name="search"
                        value="{{ request('search') }}">
                </div>
                <button class="btn col-2" style="background-color:#240090; color:white" type="submit">Search</button>
            </form>
        </div>
        @if (!$data->isEmpty())
            <div class="grid row gy-4">
                @foreach ($data as $value)
                    <div class="col-md-3">
                        <a href="{{ url('nft/detail/' . $value->id) }}">
                            <div class="card shadow" style="width: 18rem; background-color: #282828; min-height: 400px">
                                <img src="{{ asset($value->image) }}" class="card-img-top" alt="nft-image"
                                    style="width: 286px; height: 300px">
                                <div class="card-body overflow-auto" style="height: 120px; max-height: 120px">
                                    <h5 class="card-title">{{ $value->name }} {{ $value->nft_number }}</h5>
                                    <p class="card-text">{{ $value->description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="d-flex justify-content-center">
                {{ $data->links() }}
            </div>
        @else
            <h1 class="my-5 text-center">No NFT data found</h1>
        @endif
    @endsection
</body>

</html>
