@extends('layouts.master')
@section('content')
<div class="create-form">
    <h3>Do your daily log for {{date('jS \of F');}}</h3>
    <form id="form" method="POST" action='{{url("goal")}}'>
                {{csrf_field()}}
        <div class="create-input">
            <label class="form-label"> Hours Worked: </label>
            <input type="number" name="hours_worked" placeholder="How many hours worked?" min=0 step=0.5>
            @error('hours_worked')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>

        <p class="form-label"> Quality Score: </p>
        <div class="create-input-radio">
            <input type="radio" id="very-sad" name="quality" value="-2" class="quality-radio">
            <label for="very-sad" class="quality-label">😢</label>

            <input type="radio" id="sad" name="quality" value="-1" class="quality-radio">
            <label for="sad" class="quality-label">☹️</label>

            <input type="radio" id="neutral" name="quality" value="0" class="quality-radio">
            <label for="neutral" class="quality-label">😐</label>

            <input type="radio" id="happy" name="quality" value="1" class="quality-radio">
            <label for="happy" class="quality-label">🙂</label>

            <input type="radio" id="very-happy" name="quality" value="2" class="quality-radio">
            <label for="very-happy" class="quality-label">😁</label>
            @error('quality')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="create-input">
            <label class="form-label"> Note: </label>
            <input type="text" name="note" placeholder="Short note of your work">
            @error('note')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        
        <h3 style="border-bottom:1px solid orange; margin-top:50px; ">Goal Logger</h3>
        @foreach($goals as $g)
            <div class="create-input">
                <label class="form-label"> {{$g->name}}: </label>
                <input type="number" name="amount{{$g->id}}" placeholder="How many hours contributed?">
                @error('note')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
        @endforeach

        <button class="submit-btn" type="submit">
            LOG WORK
        </button>
    </form>
</div>
@endsection