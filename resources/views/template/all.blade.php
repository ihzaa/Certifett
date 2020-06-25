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
    @yield('CssTambahanAfter')
    <link rel="stylesheet" href="{{asset('css/all.blade.css')}}">
</head>

<body class="d-flex flex-column">
    <!-- <main> -->
    <div id="content" class="mb-2">
        @yield('konten')
    </div>
    <!-- </main> -->
    <footer>
        <div class="container-fluid">
            <div class="row border-top border-dark">
                <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 bg-primary-c text-light py-4">
                    <div class="ml-4">
                        <h1 class="display-2"><strong>certifett</strong></h1>
                        <p class="text-center">by proximity-labs</p>
                        <p class="mb-0">All Amazing illustrations used on this website is taken from</p>
                        <img class="img-fluid" src="{{asset('images/Artboard-footer.png')}}" alt="" width="380">
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-7 col-lg-7 col-xl-7 text-primary-c pt-4 ">
                    <div class="ml-4 mr-4 d-flex flex-column">
                        <ul class="list-inline">
                            <li class="list-inline-item mr-4 d-xl-inline d-lg-inline d-md-block d-sm-block d-block">
                                <a class="text-primary-c" href="#">How it works</a>
                            </li>
                            <li class="list-inline-item mr-4 d-xl-inline d-lg-inline d-md-block d-sm-block d-block">
                                <a class="text-primary-c" href="#">Get Startet</a>
                            </li>
                            <li class="list-inline-item mr-4 d-xl-inline d-lg-inline d-md-block d-sm-block d-block">
                                <a class="text-primary-c" href="#">Pricing</a>
                            </li>
                            <li class="list-inline-item mr-4 d-xl-inline d-lg-inline d-md-block d-sm-block d-block">
                                <a class="text-primary-c" href="#">Developer Documentation</a>
                            </li>
                            <li class="list-inline-item d-xl-inline d-lg-inline d-md-block d-sm-block d-block">
                                <a class="text-primary-c" href="#">Sitemap</a>
                            </li>
                        </ul>
                        <h3 class="mt-4">Contact Us</h3>
                        <p class="mt-3"><img src="{{asset("icons/email-24px.png")}}" class="img-fluid mr-2" alt="">
                            email@gmail.com
                        </p>
                        <p><img src="{{asset("icons/call-24px.png")}}" class="img-fluid mr-2" alt=""> 0123456789</p>
                        <br>
                        <p class="text-right mt-auto"><img src="{{asset("icons/copyright-24px.png")}}"
                                class="img-fluid mr-2" alt="">2020 cerifett.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    @yield('JsTambahanBefore')
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    @yield('JsTambahanAfter')
</body>

</html>
