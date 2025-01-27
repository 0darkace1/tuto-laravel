<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title")</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    @php
        $route = request()->route()->getName();
    @endphp

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container-fluid">

            <a class="navbar-brand" href="/">Blog</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item active">
                        <a @class(['nav-link', 'active' => str_starts_with($route, "blog")]) href="{{ route("blog.index") }}">Blog</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="/blog/new">Nouveau</a>
                        </li>
                    @endauth
                </ul>

                <div class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @auth
                        <div class="navbar-text me-3">
                            <span class="navbar-text">
                                {{ Auth::user()->name }}
                            </span>
                            <span class="navbar-text">
                                <strong>{{ Auth::user()->role }}</strong>
                            </span>
                        </div>
                        <form class="nav-item" action="{{ route("auth.logout") }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="submit" class="nav-link">Déconnexion</button>
                        </form>
                    @endauth
                    @guest
                        <div class="nav-item">
                            <a class="btn btn-outline-light" href="{{ route("auth.register") }}">S'inscrire</a>
                            <a class="btn btn-outline-light" href="{{ route("auth.login") }}">Se connecter</a>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    <div class="container ">
        @if(session("success"))
            <div class="alert alert-success">{{ session("success") }}</div>
        @endif

        @yield("content")
    </div>

    <div class="footer mt-auto text-center">
        <span id="bottom">
            <hr>
            <p>
                &copy; {{ date("Y") }} - Mon Blog Laravel - Tous droits réservés
           </p>
        </span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

