<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <style>
            .auth-bar{
                width: 50vw;
                border: 1px solid purple;
                padding: 15px;
                margin: 20px auto;
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: space-between;
            }
            .auth-bar__actions a{
                display: block;
            }
        </style>
    </head>
    <body class="antialiased">
        <h1>Home</h1>

        
        <div class="auth-bar">
            @guest
            <h2>No logado, que haces con tu vida??</h2>
            <a href="{{ route('login') }}">Log in</a>
            @endguest
            @auth
            <h2>Logado, que quieres mas??</h2>
            <div class="auth-bar__actions">
                 <a href="{{ route('logout') }}">Logout</a>
                 <a href="{{ route('landing-cdn') }}">Landing Vue CDN</a>
                  <a href="{{ route('landing-vue') }}">Landing Vue</a>
            </div>
            @endauth
        </div>
        @auth
        <p>
            {{ json_encode(auth()->user()) }}
        </p>
        @endauth
    </body>
</html>
