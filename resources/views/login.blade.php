<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    
    <body class="antialiased">
        <h1>Login</h1>
        @guest
        <h2>No logado, que haces con tu vida??</h2>
        <a href="{{ route('login-google') }}">Log in Google</a>
        @endguest

        @auth
            <h2>Logado, que quieres mas??</h2>
        @endauth
    </body>
</html>
