<nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top border-secondary border-bottom shadow-sm"
    id="nav-landing">
    <a class="navbar-brand" href="#">Certifett</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navExpdand"
        aria-controls="navExpdand" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navExpdand">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item mr-4">
                <a class="nav-link" href="#WhatIsIt">What is it</a>
            </li>
            <li class="nav-item mr-4">
                <a class="nav-link" href="#GettingStarted">Get Startet</a>
            </li>
            <li class="nav-item mr-4">
                <a class="nav-link" href="#pricing">Pricing</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#a">Developer Documentation</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-md-0">
            <a class="btn btn-outline-dark mr-3 px-4" href="{{route('registration-page')}}">Daftar</a>
            <a class="btn btn-outline-dark ml-3 px-4" href="{{route('login-page')}}">Masuk</a>
        </form>
    </div>
</nav>
