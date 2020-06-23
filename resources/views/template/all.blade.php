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
    {{-- css umum --}}
    @yield(' CssTambahanAfter')
</head>

<body>
    @yield('konten')
    @yield('JsTambahanBefore')
    <script src="{{asset('js/jquery-3.5.1.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    @yield('JsTambahanAfter')
</body>

</html>
