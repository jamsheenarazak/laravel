@extends('welcome')
@section('content')
    <div style="height: 600px;">
    <div class="grid-container" id="department" >
        @foreach($departments as $department)
            <div >
                 <h1>{{$department->department_name}}</h1>
                    <button type="button" id="appointment" data-value={{$department->department_name}} class="btn">
                        Appointment
                    </button>
            </div>
        @endforeach

    </div>
        <div id="parent">
        </div>

</div>


    <script>
        $(document).ready(function ($){
            $(document).on("click", "#appointment", function(){
                // $("#appointment").click(function () {
                var departmentName=$(this).attr("data-value");
                $.post( "{{ route('department-doctor') }}",{departmentName:departmentName},function (data){
                    $("#department").hide();
                    $("#parent").html(data.html);

                });
            });


        });
    </script>
@endsection

