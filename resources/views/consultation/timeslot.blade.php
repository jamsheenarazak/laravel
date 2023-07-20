@extends('home')

@section('content1')
    <div class="center">
      <input type="hidden" id="doctor_id" value="{{$doctor_id}}">
        <table>
            <tr>
            <th>doctor id</th>
            <th>Doctor Name</th>
            <th class="form-group">Available Days</th>
            <th>Duration</th>
                <th>Start Date</th>
            <th>Start Time</th>
            <th>End Time</th>
            <tr>

        @foreach ($consultations as $consultation)
                <tr>
                    <td >{{$consultation->doctor_id}}></td>
                <td>{{$doctor_name}}</td>
            <td>
                @foreach($days as $day)
                    {{ $day }},
                @endforeach
            </td>
                    <td>{{$consultation->duration}}</td>
                    <td>{{$consultation->date}}</td>
                    <td>{{$consultation->start_time}}</td>
                    <td>{{$consultation->end_time}}</td>
                    <td><a class="btn btn-info" href="{{ route('export-timeslot',['doctorId'=>$consultation->doctor_id]) }}">Export Booked Slots</a></td>

                </tr>
            @endforeach
        </table>
        <table>
            <tr>
            <th>Available Slots</th>
            </tr>

            <tr>
                @foreach($days as $day)
                    <tr>
                        <td>{{$day}}</td>
                @foreach($available_slots[$day] as $available_slot[$day])
                    <td>{{$available_slot[$day]->date}}<br>
                       {{$available_slot[$day]->start_time}}
                    </td>
                @endforeach

                    </tr>
                @endforeach
            </tr>

        </table>
        <table>
            <tr>
                <th>Booked Slots</th>

            </tr>
            <tr>
                @foreach($days as $day)
            <tr>
                <td>{{$day}}</td>
                @foreach($booked_slots[$day] as $booked_slot[$day])

                    <td>Booking Date :{{$booked_slot[$day]->date}}<br>
                        Patient name :{{$booked_slot[$day]->user_id}}<br>
                        Booking time :{{$booked_slot[$day]->start_time}}</td>
                @endforeach
            </tr>
                @endforeach
            </tr>

        </table>
@endsection
