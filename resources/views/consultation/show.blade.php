@extends('home')
@section('content1')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
        <div id="select">
        <label class="form-group">Select Doctor </label>
        <select name="doctor_name" id="doctor_id" class="form-control"  >

            @foreach ($doctors as $doctor)
                <option value="{{ $doctor->id}}">
                    {{ $doctor->first_name}}
                </option>
            @endforeach
        </select>
            <button type="button" id="request" class="btn btn-primary" >Check</button>
        </div>

    <div class="center" id="details"></div>
    <div class="center" id="edit_consultation"></div>

<script>
    $(document).ready(function($) {

        //list doctors
        $('#request').click(function () {
            var id = $("#doctor_id").val();

            $.post("http://127.0.0.1:8000/consultation/details", {id: id}, function (data) {
                $("#select").hide();
                $("#details").html(data.html);
            });
        });
        $(document).on("click", "#delete", function(){
            var id= $(this).val();
            $.post("http://127.0.0.1:8000/consultation/delete"  ,{consultation_id:id},function (data){
                $("#details").hide();
                confirm(data);
                location.reload();
            });
        });


    });

</script>


@endsection
