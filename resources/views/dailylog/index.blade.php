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
<div class="full-log-cont">
    <p class="log-cont-title">Full Log History</p>
    <a href='{{url("/user")}}'>BACK</a>

    @foreach($logs as $log)
    
    <div class="full-log-box">
        <div class="full-log-info">
            <h5><i> {{$log->created_at->format('jS \of F')}}</i></h5>
            <h3>{{$log->name}}</h3>
            <p>{{$log->note}}</p>
            <p>Hours :  <span class="goal-progress"> +{{$log->hours_worked}}</span> </p>
        </div>
        <p class="quality-score">{{ $emojis[$log->quality] ?? '😶'}}</p>
        <div class="full-log-options">
            <a href='{{url("/dailylog/".$log->id)}}'>View Full Log</a> 
        </div>
    </div>
    @endforeach
</div>

<script>
const logBoxes = document.querySelectorAll('.full-log-box');

// General observer callback function
function observerCallback(entries, observer) {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            const target = entry.target;
            // Check if the target has the 'full-log-box' class
            if ($(target).hasClass('full-log-box')) {
                $(target).animate({
                    opacity: 1,
                    bottom: '0px'
                }, 500);
                observer.unobserve(target);
            }
        }
    });
}

// Setup observer
const options = { threshold: 0.1 };
const observer = new IntersectionObserver(observerCallback, options);

// Observe each .full-log-box element
logBoxes.forEach((box, index) => {
    setTimeout(() => {
        observer.observe(box);
    }, index * 300); // Delay of 0.3s between each observation setup
});
</script>
@endsection