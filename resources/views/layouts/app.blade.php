<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ARMIRA</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/armira.css') }}" rel="stylesheet">
</head>

<body class="main">
    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="ml-0">
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div>

        <div class="col-2">
            <a href="{{ route('landing') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('images/logoArmira1.png') }}" alt="">
            </a>
        </div>

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">

                <form action="{{ route('set-tahun') }}" id="form-set-tahun" method="POST">
                    @method('POST')
                    @csrf
                    <select class="form-select form-select-sm nav-item me-2" name="set_tahun" id="tahun-periode">
                        <option value="" selected>PERIODE</option>
                        @foreach(\App\Models\RefPeriode::orderBy('tahun', 'DESC')->get() as $itemPeriode)
                            <option value="{{ $itemPeriode->tahun }}">{{ $itemPeriode->tahun }}</option>    
                        @endforeach
                    </select>
                </form>

                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img src="{{ asset('images/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                        <span class="d-none d-md-block dropdown-toggle ps-2">{{ session('user_login.name') }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{ session('user_login.satker') }}</h6>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <button class="dropdown-item d-flex align-items-center" href="" id="button-user" >
                                <i class="bi bi-gear"></i>
                                <span>Pengaturan</span>
                            </button>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Sign Out</span>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>

    @include('layouts._app-sidebar')

    <main id="main">
        @yield('body')
    </main>

    <footer id="footer" class="footer fixed-bottom">
        <div class="kaki">
            BIRO KEUANGAN DAN PENGELOLAAN BADAN MILIK NEGARA @2022 VERSI 2.0
        </div>
    </footer>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>


    <div class="modal fade" id="modal-user" tabindex="-1">
        <div class="modal-dialog modal-fullscreen modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pengaturan User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="body-user"></div>
            </div>
        </div>
    </div>
    
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main-admin.js') }}"></script>
    <script>
        $("#button-user").click(function() {
            $.ajax({
                url: "{{ route('user.show', auth()->user()) }}",
                success: function(data) {
                    $("#body-user").html(data)
                    $("#modal-user").modal('show')
                }
            });
        })

        $("#tahun-periode").change(function() {
            $("#form-set-tahun").submit()
        })
    </script>
    @stack('script')
</body>

</html>
