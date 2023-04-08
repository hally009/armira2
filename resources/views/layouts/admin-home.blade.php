<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARMIRA</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style-home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/armira.css') }}" rel="stylesheet">
    <style>
        .bdg {
            padding: 10px;
            right: -20px;
            top: -15px;
            font-size: 15px;
            border-radius: 50%;
            height: 30px;
            width: 30px;
            justify-content: center;
            text-align: center;
            display: flex;
            align-items: center;
            position: absolute;
        }
        
        @media (max-width:768px) {
            .bdg {
                right: 20px;
                top: 90px;

            }
        }
    </style>
</head>

<body class="body-admin">
    <div class="container-fluid g-0">
        <div class="container">

            <div class="d-flex justify-content-center mt-5">
                <img src="{{ asset('images/logoArmira2.png') }}" alt="" class="img-fluid position-relative respon">
            </div>

            <div class="row position-absolute top-50 m-auto">
                @isset($link['profil'])
                <div
                    class="col-3 col-md-1 offset-md-3 me-md-5 card align-items-center utama p-3 pt-md-2 pb-md-2 ps-md-2 pe-md-2">
                    <a href="{{ $link['profil']['parent'] }}" class="text-center text-white">
                        <span class="ms-3 text-center">PROFIL</span>
                        @if($notif > 0)
                        <span class="badge bg-danger text-white bdg">{{ $notif }}</span>
                        @endif
                        <div class="pt-1">
                            <img src="{{ asset('images/profil.png') }}" alt="" class="img-fluid">
                        </div>
                    </a>
                </div>
                @endisset

                @isset($link['master'])
                <div class="col-3 col-md-1 me-md-5 card align-items-center utama p-3 pt-md-2 pb-md-2 ps-md-2 pe-md-2">
                    <a href="{{ $link['master']['parent'] }}" class="text-center text-white">
                        <span>MASTER ASET</span>
                        <div class="pt-1">
                            <img src="{{ asset('images/masterAset.png') }}" alt="" class="img-fluid">
                        </div>
                    </a>
                </div>
                @endisset

                @isset($link['perencanaan'])
                <div class="col-3 col-md-1 me-md-5 card align-items-center utama p-3 pt-md-2 pb-md-2 ps-md-2 pe-md-2">
                    <a href="{{ $link['perencanaan']['parent'] }}" class="text-center text-white">
                        <span>PERENCANAAN</span>
                        <div class="pt-1">
                            <img src="{{ asset('images/perencanaan.png') }}" alt="" class="img-fluid">
                        </div>
                    </a>
                </div>
                @endisset

                @isset($link['pengelolaan'])
                <div class="col-3 col-md-1 card align-items-center utama p-3 pt-md-2 pb-md-2 ps-md-2 pe-md-2">
                    <a href="{{ $link['pengelolaan']['parent'] }}" class="text-center text-white">
                        <span>PENGELOLAAN</span>
                        <div class="pt-1">
                            <img src="{{ asset('images/pengelolaan.png') }}" alt="" class="img-fluid">
                        </div>
                    </a>
                </div>
                @endisset
            </div>
        </div>

        <div class="cr container-fluid position-fixed bottom-0 p-2">
            <div class="text-center">
                BIRO KEUANGAN DAN PENGELOLAAN BADAN MILIK NEGARA @2022 VERSI 2.0
            </div>
        </div>
    </div>

    <!-- Template Main JS File -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>

</html>