@extends('layouts.master')
@section('content')
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
        <div class="full-log-options">
            <a href='{{url("/dailylog/".$log->id)}}'>View Full Log</a> 
        </div>
    </div>
    @endforeach
</div>
@endsection