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
        @auth
        <div class="user-options">
            <a href='{{url("goal")}}'>Create a new Goal</a>
            <a href="#">Do your daily log!</a>
            <a href="#">View Log History</a>
        </div>

        <h1>Welcome {{Auth::user()->name}}</h1>
        <p>Your current streak is * </p>
        
        
        <div class="goal-display">
            <h1>Your Goals</h1>
            <!-- loop through goals here -->
        </div>
        @endauth
    </div>


@endsection