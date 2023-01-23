@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Dashboard')
</head>
<style>
    .carousel-item>img {
        width: 750px;
        height: 500px;
    }

    .card::-webkit-scrollbar {
        display: none;
    }
</style>

<body>
    @section('content')
        <div id="carouselExampleCaptions" class="carousel slide mt-5" data-bs-ride="false">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('./img/carousel-1.webp') }}" class="d-block w-100" alt="carousel-1">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>First slide label</h5>
                        <p>Some representative placeholder content for the first slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('./img/carousel-2.webp') }}" class="d-block w-100" alt="carousel-2">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Second slide label</h5>
                        <p>Some representative placeholder content for the second slide.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('./img/carousel-3.jpg') }}" class="d-block w-100" alt="carousel-3">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Third slide label</h5>
                        <p>Some representative placeholder content for the third slide.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <section name="most-bought">
            <div class="mt-5">
                <h3>Most wanted NFTs: </h3>
                <p>Don't miss out on these huge NFT's with a huge amount of bidders !</p>
                <div class="grid row g-3 justify-content-center align-item-center">
                    @foreach ($popularNft as $data)
                        <div class="col-md-4">
                            <a href="{{ route('nft-detail', $data->id) }}">
                            <div class="card shadow overflow-auto"
                                style="width: 400px; height: 700px; max-width: 400px; max-height: 700px; background-color: #282828">
                                <div class="card-body">
                                    <img src="{{ asset($data->image) }}" alt="something" class="card-img-top" style="width: 370px; height: 400px">
                                    <div class="card-body">
                                        <div class="card-title">
                                            <h3>{{$data->name}} {{$data->nft_number}}</h3>
                                        </div>
                                        <div class="card-text">
                                            <p>{{$data->description}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section name="most-bought">
            <div class="my-5">
                <h3 class="">Newly Minted NFTs: </h3>
                <p class="">Checkout these newly minted NFT's collections below !</p>
                <div class="grid row g-3">
                    @foreach ($newNft as $data)
                        <div class="col-md-3">
                            <a href="{{ url("/nft/detail/$data->id") }}">
                                <div class="card shadow" style="width: 18rem; background-color: #282828; min-height: 400px">
                                    <img src="{{ asset($data->image) }}" class="card-img-top" alt="nft-image"
                                        style="width: 286px; height: 300px">
                                    <div class="card-body overflow-auto" style="height: 120px; max-height: 120px">
                                        <h5 class="card-title">{{ $data->name }} {{ $data->nft_number }}</h5>
                                        <p class="card-text">{{ $data->description }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-center mt-5">
                    {{ $newNft->links() }}
                </div>
            </div>
        </section>
    @endsection
</body>

</html>
