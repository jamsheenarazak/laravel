@extends('layouts.registration')
@section('content')
    <div class="container pt-5">
        <h6>Add Consultation Details for 4 weeks:</h6>
        <form action="{{route('store-consultation')}}" method="POST">
            @csrf
            <label class="form-group">Select Doctor</label>
            <select class="form-control" name="first_name" >
                @foreach($doctors as $doctor)
                    <option value="{{$doctor}}">
                        {{$doctor}}
                    </option>
                @endforeach
            </select>
            <label class="form-label select-label" >select days</label>
            <select class="form-control" name="day[]" multiple>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
            <label class="form-group">Consultation time duration</label>
            <input type="text" name="duration" class="form-control">
            @error('duration')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-group">Start Date</label>
            <input type="date" name="startDate" class="form-control" >
            @error('startDate')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-group">Start Time</label>
            <input type="time" name="start_time" class="form-control" >
            @error('start_time')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-group">End Time</label>
            <input type="time" name="end_time" class="form-control">
            @error('end_time')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
