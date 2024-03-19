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
<div class="daily-log-display">
    <h5><i> {{$log->created_at->format('jS \of F')}}</i></h5>
    <div class="log-info">
        <p class="log-note">{{$log->note}}</p>
        <p class="quality-score">{{ $emojis[$log->quality] ?? '😶'}}</p>
    </div>

    <h5>Hours: <span class="goal-progress">+{{$log->hours_worked}}</span></h5>
    
    @isset($goalProgress[0])
    @foreach($goalProgress as $g)
    <div class="log-goal-progress">
        <h5>{{$g->name}} : <span class="goal-progress"> +{{$g->amount}}</span> </h5>
    </div>
    @endforeach
    @else
        <p>No goal progress for this log 😢</p>
    @endisset
    <a href='{{url("/dailylog")}}'>Back</a>
</div>
@endsection