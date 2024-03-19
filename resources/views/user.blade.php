@extends('layouts.master')
@section('content')
@php
$emojis = [
    -2 => '😢', // Really Sad
    -1 => '☹️', // Sad
    0 => '😐',  // Neutral
    1 => '🙂',  // Happy
    2 => '😁',  // Really Happy
];
@endphp

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
        @auth
        <div class="user-options">
            <a href='{{url("goal")}}'>Create a new Goal</a>
            <a href='{{url("/dailylog/create")}}'> Do your daily log!</a>
            <a href="#">View Log History</a>
        </div>

        <h1>Welcome {{Auth::user()->name}}</h1>
        <p>Your current streak is * </p>
        <div class="log-cont"> 
        @if($logs)
        @foreach($logs as $log)
        <div class="log-display">
            <h5><i> {{$log->created_at->format('jS \of F')}}</i></h5>
            <div class="log-info">
                <p class="log-note">{{$log->note}}</p>
                <p class="quality-score">{{ $emojis[$log->quality] ?? '😶'}}</p>
            </div>
            
            <p>Hours: <span class="goal-progress"> {{$log->hours_worked}}</span></p>
            <a href='{{url("/dailylog/".$log->id)}}'>View Full Log</a>

            </div>
        @endforeach
        @endif
        </div>
        <div class="goal-display">
            <h3>Your Goals</h3>
            @foreach($goals as $g)
            <div class="goal-box">
                <div class="goal-info">
                    <h3>{{$g->name}}</h3>
                    <p>{{$g->description}}</p>
                </div>
                <div class="goal-metrics">
                    <!-- visual showing progress / total -->
                    <p>{{$g->progress}} / {{$g->total}}</p>
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