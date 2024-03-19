@extends('layouts.master')
@section('content')

    @if (session('success_msg'))
        <div class="alert alert-success">
            {{ session('success_msg') }}
        </div>
        <script>
        setTimeout(function() {
            document.getElementById('success-alert').style.display = 'none';
            }, 3000); // 3000 milliseconds = 3 seconds
        </script>
    @endif

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
            <a href='{{url("/dailylog/create")}}'>Do your daily log!</a>
            <a href="#">View Log History</a>
        </div>

        <h1>Welcome {{Auth::user()->name}}</h1>
        <p>Your current streak is * </p>
        
        
        <div class="goal-display">
            <h1>Your Goals</h1>
            @foreach($goals as $g)
            <div class="goal-box">
                <div class="goal-info">
                    <h3>{{$g->name}}</h3>
                    <p>{{$g->description}}</p>
                </div>
                <div class="goal-metrics">
                    <!-- visual showing progress / total -->
                    <p>Total: {{$g->total}}</p>
                    <!-- create countdown -->
                    <p>{{$g->due_date}}</p>
                </div>
               
            </div>
            <form class="delete-btn" method="POST" action='{{url("goal/$g->id")}}'>
            {{csrf_field()}}
            {{method_field('DELETE')}}
            <input name="goal_id" type="hidden" value="{{$g->id}}" />
            <button type="submit">
                DELETE
            </button>
        </form>
            @endforeach
        </div>
        @endauth
    </div>


@endsection