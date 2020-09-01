<header class="header mb-4">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ml-auto">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a href="{{ route('auth.signout') }}" class="nav-link">Выйти</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>