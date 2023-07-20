@extends('layouts.registration')

@section('content')

    <div class="container pt-5">
        <form action="{{route('update_department')}}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$department->id}}">
            <label class="form-group">Department Name</label>
            <input type="text" class="form-control" name="department_name" value="{{$department->department_name}}" >
            @error('department_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <button type="submit" name="submit" class="btn btn-primary">update</button>
        </form>
    </div>
@endsection
