<label for="Doctors" class="form-label">Choose your browser from the list:</label>
<input class="form-control" list="browsers" name="browser" id="browser">
<datalist id="browsers">
    <option value="Edge">

        <div class="grid-container">
            @foreach($doctors as $doctor)
                <div>
                    Dr {{$doctor->first_name}}<br>
                    <a class="px-4 py-2 mt-2 text-sm font-semibold bg-transparent rounded-lg dark-mode:bg-transparent dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 md:mt-0 md:ml-4 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200 focus:bg-gray-200 focus:outline-none focus:shadow-outline" href="{{route('home',['id'=>$doctor->id])}}">
                        Appointment
                    </a>
                </div>
            @endforeach
        </div>
