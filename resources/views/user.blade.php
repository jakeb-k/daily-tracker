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

use Carbon\Carbon; 
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
            <a href='{{url("/dailylog/create")}}'> Do a daily log!</a>
            <a href='{{url("/dailylog")}}'>View Log History</a>
        </div>

        <h1>Welcome {{Auth::user()->name}}</h1>
        <p>Your current streak is * </p>
        <h3>Recent Logs</h3>
        <div class="log-cont"> 
        @if($logs)
        @foreach($logs as $log)
        <div class="log-display">
            <h5><i> {{$log->created_at->format('jS \of F')}}</i></h5>
            <div class="log-info">
                <p class="log-note">{{$log->note}}</p>
                <p class="quality-score">{{ $emojis[$log->quality] ?? '😶'}}</p>
            </div>
            
            <p>Hours: <span class="goal-progress">+{{$log->hours_worked}}</span></p>
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
                    <form method="POST" action='{{url("goal/$g->id")}}'>
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                        <input name="goal_id" type="hidden" value="{{$g->id}}" />
                        <button class="submit-btn" type="submit">
                            DELETE
                        </button>
                    </form>
                </div>
                <div class="goal-metrics">
                    <?php $percentage = ($g->progress / $g->total) * 100 ?> 
                <div role="progressbar" aria-valuenow="67" aria-valuemin="0" 
                aria-valuemax="100" style="--value: {{$percentage}}"></div>
                    <!-- visual showing progress / total -->
                    <p class="percent">{{floor($percentage)}}%</p>
                    <!-- create countdown -->
                    <p>{{$g->progress}} / {{$g->total}}</p>
                    <?php 
                        $today = Carbon::today(); 
                        $daysBetween = $today->diffInDays($g->due_date); 
                    ?> 
                    <p>{{floor($daysBetween)}} Days Left</p>
                </div>
               
            </div>

            
            @endforeach
        </div>
        @endauth
    </div>
    <script>
$(document).ready(function() {

    $('.log-display').each(function(index) {
        $(this).delay(index * 500).animate({
            opacity: 1,
            left: '0px'
        }, 500);
    });

    
    const goalBoxes = document.querySelectorAll('.goal-box'); 

    // General observer callback function
    function observerCallback(entries, observer) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                const target = entry.target;
                // Check if the target has the 'goal-box' class
                if ($(target).hasClass('goal-box')) {
                    $(target).animate({
                        opacity: 1,
                        bottom: '0px'
                    }, 700);
                    observer.unobserve(target);
                }
            }
        });
    }

    // Setup observer
    const options = { threshold: 0.1 };
    const observer = new IntersectionObserver(observerCallback, options);

    // Observe each .goal-box element
    goalBoxes.forEach((box, index) => {
        setTimeout(() => {
            observer.observe(box);
        }, index * 300); // Delay of 0.3s between each observation setup
    });

});

    </script>

@endsection