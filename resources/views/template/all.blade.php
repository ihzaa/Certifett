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
    @yield('header')
    <!-- <main> -->
    <div id="content" class="mb-2">
        @yield('konten')
    </div>
    <!-- </main> -->
    @yield('footer')
    @yield('JsTambahanBefore')
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    @yield('JsTambahanAfter')
</body>

</html>
