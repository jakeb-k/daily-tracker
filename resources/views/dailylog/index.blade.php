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
            <p>Hours : <span class="goal-progress"> +{{$log->hours_worked}}</span> </p>
        </div>
        <p class="quality-score">{{ $emojis[$log->quality] ?? '😶'}}</p>
        <div class="full-log-options">
            <a href='{{url("/dailylog/".$log->id)}}'>View Full Log</a> 
        </div>
    </div>
    @endforeach
</div>
@endsection