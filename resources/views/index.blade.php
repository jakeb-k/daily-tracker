@extends('layouts.master')
@section('content')


    <div class="body-container">
        @guest
            <h1>LOGIN/REGISTER TO START ACHIEVING YOUR GOALS!</h1>
            <a href="{{ route('login') }}">
                <button>LOGIN</button>
            </a>
            <a href="{{ route('register') }}">
                <button>REGISTER</button>
            </a>
        @endguest
    </div>


@endsection