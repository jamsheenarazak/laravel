@extends('layouts.registration')

@section('content')

    <div class="container pt-5">
        <form action="{{ route('store_department') }}" method="POST">
            @csrf
            <label class="form-group">Department Name</label>
            <input type="text" class="form-control" name="department_name" >
            @error('department_name')
            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
            @enderror
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
