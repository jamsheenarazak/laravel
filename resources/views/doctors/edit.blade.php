@extends('layouts.registration')

@section('content')
    <div class="container pt-5">
        <form action="{{ route('doctor.update',$doctor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{$doctor->id}}">
            <label class="form-group">First Name</label>
            <input type="text" class="form-control" name="first_name" value="{{$doctor->first_name}}" >
            @error('first_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-group">Last Name</label>
            <input type="text" class="form-control" name="last_name" value="{{$doctor->last_name}}">
            @error('last_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-group">Department</label>
            <select name="department_name" class="form-control" >
                    <option value="{{$department_name}}">{{$department_name}}</option>
            @foreach ($departments as $department)
                    <option value="{{ $department->department_name}}">
                        {{ $department->department_name }}
                    </option>
                @endforeach
            </select>
            <label class="form-group">Qualification</label>
            <input type="text" name="qualification" class="form-control" value="{{$doctor->qualification}}">
            @error('qualification')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-group">Designation</label>
            <input type="text" class="form-control" name="designation" value="{{$doctor->designation}}">
            @error('designation')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-label">Image:</label>
            <img src="{{ asset('/images/'.$doctor->image) }}" style="height: 70px;width:70px;" >
            <input type="file" name="image"  class="form-control @error('image') is-invalid @enderror">
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

@endsection
