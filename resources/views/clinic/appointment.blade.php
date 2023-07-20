@extends('clinic_welcome')
{{--@section('title',$title)--}}
@section('content')
    <style>

    </style>
    <div style="height: 600px;" >

<div class="container" style="text-align: left">
{{--    <div class="row col-lg-3">--}}

        <form id="frm_date">
        <div class="form-group" >
            <label for="date">Date</label>
            <input type="date" required id="date" style="width: 500px" name="date" class="form-control datepicker" data-provide="datepicker">
            <span class="validity" style="color: red;"></span>

        </div>
        <div class="form-group">

            <button type="button" id="request" class="btn btn-primary" >Check</button>
        </div>
        </form>

    <div id="parent">

    </div>
    <div class="container" id="slot">
    </div>
    <div id="success">
    </div>
</div>
    </div>

<script>


    $(document).ready(function($) {

        $('#request').click(function () {
           var date= $("#date").val();

             $.post("http://127.0.0.1:8000/appointment/make"  ,{date:date},function (data){
                     $("#parent").html(data.html);
             });
        });
        $(document).on("click", "#appointmentbtn", function(){
            var id= $(this).val();
            var date=$(this).attr("data-value");
            $.post("http://127.0.0.1:8000/appointment/slot"  ,{id:id,date:date},function (data){
                $("#parent").hide();
                $("#slot").html(data);
            });
        });
        $(document).on("click", ".slot", function(){
            var id=$(this).attr("data-value");
            var date=$(this).attr("data-value1");
            $.post("http://127.0.0.1:8000/appointment/book_slot"  ,{id:id,date:date},function (data){
                    confirm(data);
            }).done(function () {
                window.location.reload(true);
            });
        });
    });

</script>
@endsection
