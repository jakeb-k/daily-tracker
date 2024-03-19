@extends('layouts.master')
@section('content')
<div class="create-form">
    <h3>Create your new goal!</h3>
    <form id="form" method="POST" action='{{url("goal")}}'>
                {{csrf_field()}}
        <div class="create-input">
            <label class="form-label"> Name: </label>
            <input type="text" name="name" placeholder="Fortnightly anger tracker">
            @error('name')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="create-input">
            <label class="form-label"> Goal Total: </label>
            <em style="margin-bottom:10px;"> E.g. I don't to be angry more than<b> 10 </b>times</em>
            <em style="margin-bottom:10px;"> E.g. I want to do<b> 10 </b>hours on my art</em>

            <input type="number" name="total" placeholder="10">
            @error('total')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="create-input">
            <label class="form-label"> Due Date: </label>
            <input type="date" name="due_date">
            @error('due_date')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="create-input">
            <label class="form-label"> Description: </label>
            <input type="text" name="description" placeholder="I want to be less angry">
            @error('description')
                <div class="alert">{{ $message }}</div>
            @enderror
        </div>
        
        <button class="submit-btn" type="submit">
            CREATE
        </button>
    </form>
</div>
@endsection