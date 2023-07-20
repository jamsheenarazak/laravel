<div>
    <div style="height: 600px;">
        <div class="grid-container">
            @foreach($doctors as $doctor)
                <div>
                    @if($doctor->image)
                        <img src="{{ asset('/images/'.$doctor->image) }}" style="height: 100px;width:100px;
                        display: block;
                        margin-left: auto;
                        margin-right: auto;" >
                    @else
                        <img src="" style="height: 100px;width:100px;display: block;
                        margin-left: auto;
                        margin-right: auto;" >
                    @endif
                    Dr {{$doctor->first_name}}<br>
                    <h5>{{$doctor->department}}</h5>
                        <button type='button' id='appointmentbtn' data-value={{$date}} value={{$doctor->id}}><h6>  Appointment</h6></button>
                </div>
            @endforeach
        </div>
    </div></div>
