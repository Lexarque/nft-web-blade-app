@extends('users.detail')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'User Liked NFT')
</head>

<body>
    @section('user-tab-content')
        @if ($like != null)
            <div class="grid row gy-4">
                @foreach ($like as $value)
                    <div class="col-md-3">
                        <a href="{{ url("/nft/detail/".$value->nft->id) }}">
                            <div class="card shadow" style="width: 18rem; background-color: #282828; min-height: 400px">
                                <img src="{{ asset($value->nft->image) }}" class="card-img-top" alt="nft-image"
                                    style="width: 286px; height: 300px">
                                <div class="card-body overflow-auto" style="height: 120px; max-height: 120px">
                                    <h5 class="card-title">{{ $value->nft->name }} {{ $value->nft->nft_number }}</h5>
                                    <p class="card-text">{{ $value->nft->description }}</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        @else
        <h1 class="py-5 text-center">This user has not liked a single NFT yet</h1>
        @endif
        @endsection
</body>

</html>
