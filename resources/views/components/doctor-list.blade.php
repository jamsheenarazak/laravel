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
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline"
                       href="{{route('make_appointment')}}">
                        Appointment
                    </a>
                </div>
            @endforeach
        </div>
    </div></div>
