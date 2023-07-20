
<table>
    <tr>
        <th>Patient Name :
        <td>{{$userName}}</td>
        </th>
        <th>Email :
        <td>{{$userEmail}}</td>
        </th>
    </tr>
    @if($slots->count())
    <tr>
        <th>Doctor Name</th>
        <th>Booking Time</th>
        <th>Date</th>
        <th>Day</th>
    </tr>
    @foreach ($slots as $slot)

    <tr>

        <td>{{$doctor[$slot->doctor_id]}}</td>
        <td>{{$slot->start_time}}</td>
        <td>{{$slot->date}}</td>
        <td>{{$slot->day}}</td>
        <td>
            @if($flag[$slot->id]===1)

            <button  type='button' id='cancel' class='btn btn-primary'
                    data-value={{$slot->id}}>Cancel</button>
            @else
                <button  type='button' disabled  id='cancel' class='btn btn-primary'
                         data-value={{$slot->id}}>Cancel</button>
            @endif

        </td>
    </tr>

    @endforeach
    @endif
</table>

