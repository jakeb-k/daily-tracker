@extends('layouts.master')
@section('content')
<div class="create-form">
<form id="form" method="POST" action='{{url("goal")}}'>
            {{csrf_field()}}

            <div class="create-input">
                <label class="form-label"> Name: </label>
                <input type="text" name="name" placeholder="Enter a Name for the New Goal!">
                @error('name')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="create-input">
                <label class="form-label"> Due Date: </label>
                <input type="text" name="due_date" placeholder="Enter the completion date">
                @error('due_date')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="create-input">
                <label class="form-label"> Goal Total: </label>
                <input type="text" name="total" placeholder="Enter measurement to track:">
                @error('total')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>

            <div class="create-input">
                <label class="form-label"> Description: </label>
                <input type="text" name="name" placeholder="Short description of your goal">
                @error('name')
                    <div class="alert">{{ $message }}</div>
                @enderror
            </div>
           
                <button type="submit">
                    Create
                </button>
            
        </form>
</div>
@endsection