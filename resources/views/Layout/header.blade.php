<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark d-flex justify-content-between align-items-center px-5"
        style="background-color: #240090; color: white; height:80px; font-weight:600; font-size:20px">
        <!-- Container wrapper -->
        <div class="container-fluid">
            <svg id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1027.5 256.61"
                style="width: auto; height: 50px">
                <defs>
                    <style>
                        .cls-1 {
                            fill: #5a479d;
                        }

                        .cls-2 {
                            font-size: 160px;
                        }

                        .cls-2,
                        .cls-4,
                        .cls-6 {
                            fill: white;
                        }

                        .cls-2,
                        .cls-6 {
                            font-family: Helvetica;
                        }

                        .cls-3 {
                            fill: none;
                        }

                        .cls-3,
                        .cls-4,
                        .cls-5 {
                            stroke: white;
                            stroke-miterlimit: 10;
                            stroke-width: 3px;
                        }

                        .cls-5 {
                            fill: black;
                        }

                        .cls-6 {
                            font-size: 14px;
                        }

                        .cls-7 {
                            letter-spacing: -0.07em;
                        }
                    </style>
                </defs>
                <path class="cls-1" d="M-342,99" transform="translate(-70.5 -342.07)" /><text class="cls-2"
                    transform="translate(235.5 179.66)">Bitmagery</text>
                <rect class="cls-3" x="1.5" y="1.5" width="216" height="246.86" rx="16.57" />
                <rect class="cls-3" x="32.36" y="186.64" width="154.29" height="30.86" rx="6.86" />
                <rect class="cls-4" x="32.36" y="32.36" width="154.29" height="123.43" rx="7.29" />
                <path class="cls-5"
                    d="M107.49,487.3l21.22-42.44A6.41,6.41,0,0,1,139,443.2l17.26,17.26a6.41,6.41,0,0,0,10.26-1.67L187.41,417a6.41,6.41,0,0,1,11.06-.69l46.89,70.34a6.4,6.4,0,0,1-5.33,10H113.22A6.41,6.41,0,0,1,107.49,487.3Z"
                    transform="translate(-70.5 -342.07)" /><text class="cls-6" transform="translate(46.5 208)">0<tspan
                        class="cls-7" x="7.79" y="0">1</tspan>
                    <tspan x="14.54" y="0">101000 0</tspan>
                    <tspan class="cls-7" x="72.93" y="0">1</tspan>
                    <tspan x="79.69" y="0">101001</tspan>
                </text>
            </svg>
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>
            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <!-- Left links -->
                <ul class="navbar-nav mb-2 mb-lg-0" style="margin-right: 200px">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/collection') }}">Collections</a>
                    </li>
                    @if (Auth::check())
                        @if (Auth::user()->role->name == 'Super Admin')
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Admin Dropdown
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"href="{{ url('/nft') }}" style="color: black">NFT
                                            List</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('/users') }}" style="color: black">User
                                            List</a>
                                    </li>
                                    <li><a class="dropdown-item" href="{{ url('/balance') }}" style="color: black">User
                                        Topup List</a>
                                </li>
                                </ul>
                            </li>
                        @endif
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Guest
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item"href="{{ route('login') }}" style="color: black"> Login</a>
                                </li>
                                <li><a class="dropdown-item" href="{{ route('register') }}" style="color: black">
                                        Register</a>
                                </li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <!-- Left links -->
            </div>
            <!-- Collapsible wrapper -->
            @if (Auth::check())
                <div class="dropdown text-end">
                    <a href="#" class="d-block text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        @if (Auth::user()->image == 'no-image')
                            <img src="{{ asset('./assets/img/' . Auth::user()->image . '.jpg') }}"
                                alt="{{ Auth::user()->name }}" width="32" height="32" class="rounded-circle">
                        @else
                            <img src="{{ asset(Auth::user()->image) }}" alt="{{ Auth::user()->name }}" width="32"
                                height="32" class="rounded-circle" style="margin-right: 8px">
                        @endif
                        <span>{{ Auth::user()->name }}</span>
                    </a>
                    @if (Auth::check())
                        <ul class="dropdown-menu text-small mt-2">
                            <li>
                                <p class="text-center">{{ Auth::user()->name }}</p>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ url('users/detail/' . Auth::user()->id) }}"
                                    style="color: black">Profile</a></li>
                            <li><a class="dropdown-item"
                                    href="{{ url('users/detail/' . Auth::user()->id . '/collection') }}"
                                    style="color: black">My NFT</a></li>
                            <li><a class="dropdown-item" href="{{ route('create-nft') }}"
                                    style="color: black">Create
                                    NFT</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="{{ url('/balance/topup/') }}"
                                    style="color: black">{{ Auth::user()->balance }} ETH</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ url('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    @endif
                </div>
            @endif
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</body>

</html>
