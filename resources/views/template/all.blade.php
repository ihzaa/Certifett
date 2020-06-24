<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('JudulHalaman')</title>
    @yield('CssTambahanBefore')
    {{-- css umum --}}
    <link rel="stylesheet" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/font-awesome-all.min.css")}}">
    {{-- css umum --}}
    @yield(' CssTambahanAfter')
    <style>
        .text-primary-c {
            color: #263238;
        }

        .text-secondary-c {
            color: #26a69a;
        }

        .text-accent-c {
            color: #64d8cb;
        }

        .text-danger-c {
            color: #e91e63;
        }

        .bg-primary-c {
            background-color: #263238;
        }

        .bg-secondary-c {
            background-color: #26a69a;
        }

        .bg-accent-c {
            background-color: #64d8cb;
        }

        .bg-danger-c {
            background-color: #e91e63;
        }
        footer {
            padding: 0px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <header>
            <!-- Fixed navbar -->
            <nav
                class="navbar navbar-expand-lg navbar-light bg-white fixed-top border-secondary border-bottom shadow-sm">
                <a class="navbar-brand" href="#">Certifett</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navExpdand"
                    aria-controls="navExpdand" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navExpdand">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="#">What is it</a>
                        </li>
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="#">Get Startet</a>
                        </li>
                        <li class="nav-item mr-4">
                            <a class="nav-link" href="#">Pricing</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Developer Documentation</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-md-0">
                        <button type="button" class="btn btn-outline-dark mr-3 px-4">Daftar</button>
                        <button type="button" class="btn btn-outline-dark ml-3 px-4">Masuk</button>
                    </form>
                </div>
            </nav>
        </header>
        @yield('konten')
        <footer class="border-top border-dark">
            <div class="row ">
                <div class="col col-md-5 bg-primary-c text-light py-4">
                    <div class="ml-4">
                        <h1>certifett</h1>
                        <p>by proximity-labs</p>
                        <p>All Amazing illustrations used on this website is taken from</p>
                        <p>ada gambarr stories</p>
                    </div>
                </div>
                <div class="col col-md-7 text-primary-c py-4">
                    <div class="ml-4">
                        <ul class="list-inline">
                            <li class="list-inline-item mr-4">
                                <a class="text-primary-c" href="#">How it works</a>
                            </li>
                            <li class="list-inline-item mr-4">
                                <a class="text-primary-c" href="#">Get Startet</a>
                            </li>
                            <li class="list-inline-item mr-4">
                                <a class="text-primary-c" href="#">Pricing</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-primary-c" href="#">Developer Documentation</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="text-primary-c" href="#">Sitemap</a>
                            </li>
                        </ul>
                        <h3>Contact Us</h3>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    @yield('JsTambahanBefore')
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    @yield('JsTambahanAfter')
</body>

</html>
