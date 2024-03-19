<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="{{asset('css/app.scss')}}" type="text/css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title> Daily Goals</title>
          
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

        <script src="https://kit.fontawesome.com/0abaa836ef.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="header">
            <div class="header-title">
                <h1>DAILY GOALS</h1>
            </div>
            <div class="header-options">
                @guest
                    <a href="{{ route('login') }}">
                        <button>LOGIN</button>
                    </a>
                    <a href="{{ route('register') }}">
                        <button>REGISTER</button>
                    </a>
                @endguest

                @auth
                    <form id="logout" method="POST"action ="{{url('/logout')}}">
                        {{csrf_field()}}
                        <button type="submit">LOGOUT</button>
                    </form>
                @endauth
            </div>
        </div>
        
        <div class="container">
            @yield('content')
        </div>
    </body>
</html>