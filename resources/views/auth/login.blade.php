@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @section('title', 'Login')
</head>

<body>
    @section('content')
        <section>
            @if ($errors->any())
                <h4 class="text-center my-5">{{ $errors->first() }}</h4>
            @endif
            @if (session('message'))
                <h4 class="text-center my-5">{{ session('message') }}</h4>
            @endif
            <div class="container py-5 h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col col-xl-10">
                        <div class="card" style="border-radius: 1rem;">
                            <div class="row g-0">
                                <div class="col-md-6 col-lg-5 d-none d-md-block">
                                    <img src="{{ asset('./img/login-image.png') }}" alt="login form"
                                        class="img-fluid w-100 h-100" style="border-radius: 1rem 0 0 1rem;" />
                                </div>
                                <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                    <div class="card-body p-4 p-lg-5 text-black">
                                        <form action="{{ route('authenticate') }}" method="POST">
                                            @csrf
                                            <div class="d-flex align-items-center mb-3 pb-1">
                                                <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                                <span class="h1 fw-bold mb-0">Bitmagery</span>
                                            </div>

                                            <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                                account</h5>

                                            <div class="form-outline mb-4">
                                                <input type="email" id="email-form" class="form-control form-control-lg"
                                                    name="email" />
                                                <label class="form-label" for="email-form">Email address</label>
                                            </div>
                                            <div class="form-outline mb-4">
                                                <input type="password" id="password-form"
                                                    class="form-control form-control-lg" name="password" />
                                                <label class="form-label" for="password-form">Password</label>
                                            </div>
                                            <div class="pt-1 mb-4">
                                                <button class="btn btn-dark btn-lg btn-block" type="submit">Login</button>
                                            </div>
                                            <p class="mb-5 pb-lg-2" style="color: #393f81;">Don't have an account? <a
                                                    href="{{ url('/register') }}" style="color: #393f81;">Register here</a>
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endsection
</body>

</html>
