<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }} - @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body class="d-flex flex-column min-vh-100">
    @php $locale = session()->get('locale') @endphp
    <header class="bg-light py-4 mb-4 shadow-sm">
        <ul class="nav justify-content-center fs-4">

            <li class="nav-item">
                <a class="nav-link pb-2 {{ request()->routeIs('etudiant.index') ? 'active text-decoration-underline link-offset-2' : '' }}"
                    href="{{ route('etudiant.index') }}">
                    Etudiants
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link pb-2 {{ request()->routeIs('etudiant.create') ? 'active text-decoration-underline link-offset-2' : '' }}"
                    href="{{ route('etudiant.create') }}">
                    Nouveau </a>
            </li>
            <li class="nav-item">
                @guest
                <a class="nav-link pb-2 {{ request()->routeIs('login') ? 'active text-decoration-underline link-offset-2' : '' }}" href="{{route('login')}}">Se connecter</a>
                @else
                <a class="nav-link pb-2 {{ request()->routeIs('logout') ? 'active text-decoration-underline link-offset-2' : '' }}" href="{{route('logout')}}">Se déconnecter</a>
                @endguest
            </li>
            <li class="nav-item">
                @auth
                <a class="nav-link pb-2 {{ request()->routeIs('forum.index') ? 'active text-decoration-underline link-offset-2' : '' }}" href="{{route('forum.index')}}">Forum</a>
                @endauth
            </li>
            <li class="nav-item">
                @auth
                <a class="nav-link pb-2 {{ request()->routeIs('repertoire.index') ? 'active text-decoration-underline link-offset-2' : '' }}"
                    href="{{ route('repertoire.index') }}">
                    Répertoire
                </a>
                @endauth
            </li>
            <li class="nav-item">
                @auth
                <a class="nav-link pb-2 {{ request()->routeIs('user.index') ? 'active text-decoration-underline link-offset-2' : '' }}" href="{{route('user.index')}}">Mon espace</a>
                @endauth
            </li>
        </ul>
    </header>
    <div class="container grow">
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-5" role="alert">
            {{ session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        @yield('content')
    </div>
    <footer class="bg-light text-center py-3 mt-auto border-top">
        <div class="container">
            <small class="text-muted">
                © 2026 Maisonneuve — Tous droits réservés
            </small>
        </div>
    </footer>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

</html>