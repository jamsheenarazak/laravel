@extends('layouts.registration')

@section('content')
    <div class="container pt-5">
        <form action="{{ route('doctor.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="form-group">First Name</label>
            <input type="text" class="form-control" name="first_name" >
            @error('first_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-group">Last Name</label>
            <input type="text" class="form-control" name="last_name" >
            @error('last_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-group">Department</label>
            <select name="department_name" class="form-control" >

                @foreach ($departments as $department)
                    <option value="{{ $department}}">
                        {{ $department }}
                    </option>
                @endforeach
            </select>
            <label class="form-group">Qualification</label>
            <textarea name="qualification" class="form-control" rows="4" cols="15">
            </textarea>
            @error('qualification')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-group">Designation</label>
            <input type="text" class="form-control" name="designation">
            @error('designation')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <label class="form-label">Image:</label>
            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">

            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

@endsection
