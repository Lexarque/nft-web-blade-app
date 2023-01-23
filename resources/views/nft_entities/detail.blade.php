@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'NFT Detail')
    <style>
        .card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-bottom-right-radius: 0px;
        }

        .card::-webkit-scrollbar {
            display: none;
        }

        .profile-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    @section('content')
        @if ($errors->any())
            <h4 class="text-center my-5 text-danger">{{ $errors->first() }}</h4>
        @endif
        <div>
            <div class="container">
                @if (Auth::check())
                    @if (auth()->user()->name == 'Super Admin')
                        <nav aria-label="breadcrumb" class="mt-5">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('nft-index') }}" style="font-size: 24px">Back
                                        to
                                        Index</a>
                                </li>
                            </ol>
                        </nav>
                    @endif
                @endif
                <div class="row mt-5 justify-content-center align-items-center">
                    <div class="col-md-6">
                        <div class="card shadow" style="background-color: #282828">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <img src="{{ asset($data->image) }}" class="card-img image-fluid w-100" alt="img">
                                </div>
                                <div class="col-md-7">
                                    <div class="card-body d-flex flex-column overflow-auto">
                                        <div class="h-100">
                                            <h3 class="card-title">{{ $data->name }} {{ $data->nft_number }}</h3>
                                            <p class="card-text">{{ $data->description }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 md-mt-3">
                        <div class="row">
                            <div class="col-6">
                                <p class="text-muted">Contract Address:</p>
                                <p style="margin-top: -16px">{{ $data->contract_id }}</p>
                            </div>
                            <div class="col-6">
                                <p class="text-muted">Token ID:</p>
                                <p style="margin-top: -16px">1002582922</p>
                            </div>
                        </div>
                        <div class="row">
                            <a href="{{ url('users/detail/' . $data->creator->id) }}" class="col-6 d-flex row">
                                <div class="col-2">
                                    @if ($data->creator->image == 'no-image')
                                        <img src="{{ asset('./assets/img/' . $data->creator->image . '.jpg') }}"
                                            class="profile-image rounded-circle" alt="creator-image">
                                    @else
                                        <img src="{{ asset($data->creator->image) }}" class="profile-image rounded-circle"
                                            alt="creator-image">
                                    @endif
                                </div>
                                <div class="col-10">
                                    <div class="mx-3">
                                        <h6 class="text-mute">Creator</h6>
                                        <p>{{ $data->creator->name }}</p>
                                    </div>
                                </div>
                            </a>
                            @if ($data->owner)
                                <a href="{{ url('users/detail/' . $data->owner->id) }}" class="col-6 d-flex row">
                                    <div class="col-2">
                                        @if ($data->owner->image == 'no-image')
                                            <img src="{{ asset('./assets/img/' . $data->owner->image . '.jpg') }}"
                                                class="profile-image rounded-circle" alt="owner-image">
                                        @else
                                            <img src="{{ asset($data->owner->image) }}"
                                                class="profile-image rounded-circle" alt="owner-image">
                                        @endif
                                    </div>
                                    <div class="col-10">
                                        <div class="mx-3">
                                            <h6 class="text-mute">Owner</h6>
                                            <p>{{ $data->owner->name }}</p>
                                        </div>
                                    </div>
                                </a>
                            @else
                                <div class="row d-flex col-6">
                                    <div class="col-2">
                                        <img src="{{ asset('./assets/img/no-image.jpg') }}"
                                            class="profile-image rounded-circle" alt="owner-image">
                                    </div>
                                    <div class="col-10">
                                        <div class="mx-3">
                                            <h6 class="text-mute">Owner</h6>
                                            <p>-</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <p>Current Bid</p>
                                <div class="d-flex flex-wrap align-items-center">
                                    <img src="{{ asset('./img/eth-logo.png') }}" alt="eth-logo"
                                        style="width: 40px; height: 40px">
                                    <h3>{{ $data->price }} <span class="text-muted" style="font-size: 16px;">=
                                            ${{ number_format((float) $data->price * 1215, 2, '.', '') }}</span>
                                    </h3>
                                </div>
                            </div>
                            <div class="col-6">
                                <p>Buyout Price</p>
                                <div class="d-flex flex-wrap align-items-center">
                                    <img src="{{ asset('./img/eth-logo.png') }}" alt="eth-logo"
                                        style="width: 40px; height: 40px">
                                    <h3>{{ $data->price + ($data->price * 10) / 100 }} <span class="text-muted"
                                            style="font-size: 16px;">=
                                            ${{ number_format((float) ($data->price * 1215 + ($data->price * 1215 * 10) / 100), 2, '.', '') }}</span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            @if (Auth::check())
                                @if (Auth::user()->role->name == 'Super Admin' && $data->status == 'Pending')
                                    <div class="col-3">
                                        <form action=" {{ url('/nft/update/' . $data->id . '/status') }}" method="POST">
                                            @csrf
                                            <input type="hidden" id="fname" name="status" value="Approved">
                                            <button class="btn btn-success btn-block text-center w-100 h-100"
                                                type="submit">Approve</button>
                                        </form>
                                    </div>
                                    <div class="col-3">
                                        <form action=" {{ url('/nft/update/' . $data->id . '/status') }}" method="POST">
                                            @csrf
                                            <input type="hidden" id="fname" name="status" value="Blacklisted">
                                            <button class="btn btn-danger btn-block text-center w-100 h-100"
                                                type="submit">Blacklist</button>
                                        </form>
                                    </div>
                                @elseif (Auth::user()->name !== $data->creator->name && Auth::user()->role->name !== 'Super Admin')
                                    @if (!$data->owner)
                                        <div class="col-3">
                                            <form action=" {{ url('/nft/bid/' . $data->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" id="total" name="total"
                                                    value="{{ $data->price }}">
                                                <button
                                                    class="btn btn-success btn-block text-center w-100 h-100">Bid</button>
                                            </form>
                                        </div>
                                        <div class="col-3">
                                            <form action=" {{ url('/nft/buyout/' . $data->id) }}" method="POST">
                                                @csrf
                                                <input type="hidden" id="total" name="total"
                                                    value="{{ $data->price + ($data->price * 10) / 100 }}">
                                                <button
                                                    class="btn btn-danger btn-block text-center w-100 h-100">Buyout</button>
                                            </form>
                                        </div>
                                    @endif
                                @endif
                                <div class="col-6">
                                    @if (Auth::user()->name == $data->creator->name && $data->status == 'Pending')
                                        <div class="col-12">
                                            <button class="btn btn-warning btn-block text-center w-100 h-100"><a
                                                    href="{{ url('/nft/edit/' . $data->id) }}">Edit</a> </button>
                                        </div>
                                    @elseif (Auth::user()->name !== $data->creator->name)
                                        @if ($like == null)
                                            <a href=" {{ url('/nft/like/' . $data->id) }} " style="color: white;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                    fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 20">
                                                    <path
                                                        d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z" />
                                                </svg>
                                                <span style="font-size: 32px" style="margin-left: 20px">Like</span>
                                            </a>
                                        @else
                                            <a href="{{ url('/nft/unlike/' . $data->id) }}" style="color: white">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                                                    fill="currentColor" class="bi bi-suit-heart-fill"
                                                    viewBox="0 0 16 20">
                                                    <path
                                                        d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z" />
                                                </svg>
                                                <span style="font-size: 32px" style="margin-left: 20px">Unlike</span>
                                            </a>
                                        @endif
                                    @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <h2>Bid History</h2>
                @if (!$data->bidHistory->isEmpty())
                    <table class="table table-dark table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Bidder</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                                <th scope="col">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data->bidHistory as $value)
                                <tr>
                                    <td>{{ $value->user->name }}</td>
                                    <td>{{ $value->total }}</td>
                                    <td>{{ $value->created_at }}</td>
                                    <td>{{ $value->type }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center">
                        <h1 class="py-5 text-center">Bid history is empty</h1>
                        <p style="margin-top: -28px">Be the first to bid on this NFT</p>
                    </div>
                @endif
            </div>
        </div>
        </div>
    @endsection
</body>

</html>
