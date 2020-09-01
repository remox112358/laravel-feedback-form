<header class="header mb-4">
    <nav class="navbar navbar-expand navbar-dark text-white bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">{{ config('app.name') }}</a>
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                    <li class="nav-item">
                        <div class="social-links">
                            <a href="https://github.com/remox112358/laravel-feedback-form" class="link" target="_blank"><i class="fab fa-github"></i></a>
                        </div>
                    </li>
                </div>
                <ul class="navbar-nav ml-auto">
                    @if (Auth::check())
                        <li class="nav-item">
                            <a class="reset" href="{{ route('auth.signout') }}" class="nav-link">Выйти</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>
</header>