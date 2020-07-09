<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top border-secondary border-bottom shadow-sm">
        <a class="navbar-brand" href="{{route('landing-page')}}">Certifett</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navExpdand"
            aria-controls="navExpdand" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navExpdand">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item mr-4">
                    <a class="nav-link" href="{{route('landing-page')}}">What is it</a>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link" href="{{route('landing-page')}}">Get Startet</a>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link" href="{{route('landing-page')}}">Pricing</a>
                </li>
                <li class="nav-item mr-4">
                    <a class="nav-link" href="{{route('landing-page')}}">Developer Documentation</a>
                </li>
                @if(Auth::check())
                <li class="nav-item mr-4 {{request()->is('acara*') || request()->is('home*') ? "active":""}}">
                    <a class="nav-link " href="{{route('agencyHome-page')}}">Acara Saya</a>
                </li>
                <li class="nav-item {{request()->is('sertifikat*') ? "active":""}}">
                    <a class="nav-link" href="{{route('myCertificates-page')}}">Sertifikat Saya</a>
                </li>
                <div id="user-info-sm">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('manageAccount-page')}}">Akun Saya</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('logout')}}">Logout</a>
                    </li>
                </div>
                @endif
            </ul>
            @if(Auth::check())
            <form class="form-inline my-2 my-md-0" id="user-info-lg">
                <div class="dropdown open dropleft">
                    <button role="button" type="button" class="btn" data-toggle="dropdown">
                        {{Auth::user()->name}}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                        <a class="dropdown-item" href="{{route('manageAccount-page')}}">Akun Saya</a>
                        <a class="dropdown-item" href="{{route('logout-c')}}">Logout</a>
                    </div>
                </div>
            </form>
            @endif
        </div>
    </nav>
</header>
