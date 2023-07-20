@extends('layouts.registration')

@section('content')
    <div class="container pt-5">

        <form action="{{ route('export') }}" method="POST" name="exportform"
              enctype="multipart/form-data">
    <div class="form-group">
        <a class="btn btn-info" href="{{ route('export') }}">Export File</a>
    </div>

</form>
    </div>
@endsection

