@extends('home')
@section('content1')
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <div class="center">
        <table>

            <tr>
                <th>Id</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Qualification</th>
                <th>Designation</th>
                <th>Department</th>
                <th>Image</th>
                <th>Action</th>
            @foreach($doctors as $doctor)

                <tr>
                    <td> {{$doctor->id}} </td>
                    <td> {{$doctor->first_name}} </td>
                    <td> {{$doctor->last_name}} </td>
                    <td> {{$doctor->qualification}} </td>
                    <td> {{$doctor->designation}} </td>
                    <td>{{$doctor->department}}</td>
                    <td>
                        @if($doctor->image)
                            <img src="{{ asset('/images/'.$doctor->image) }}" style="height: 70px;width:70px;" >
                        @else
                            <span>No image found!</span>
                        @endif
                    </td>
                    <td>
                        <botton type="submit"> <a href="{{route('doctor.edit',$doctor->id)}}">Edit</a></botton>
                        <form action="{{route('doctor.destroy',$doctor)}}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" value="submit">Delete</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{route('time_slot',['doctor_id'=>$doctor->id])}}" >slots</a>
                    </td>
                </tr>
            @endforeach

        </table>
    </div>
@endsection
