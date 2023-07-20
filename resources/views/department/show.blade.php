@extends('home')
@section('content1')
<div class="center">
<table>

    <tr>
        <th>Id</th>
        <th>
           <span> Department<form action="{{route('add_department')}}" method="get">
                @csrf
                <button type="submit">Add New</button>

            </form></span>
        </th>
    @foreach($departments as $department)
        <tr>
            <td> {{$department->id}} </td>
            <td> {{$department->department_name}}
            </td>
            <td>
                <botton type="submit"> <a href="{{route('edit_department',['department_id'=>$department->id])}}">Edit</a></botton>
                <form action="{{route('delete_department',['department_id'=>$department->id])}}" method="get">
                    @csrf
                    <button type="submit">Delete</button>

                </form>
            </td>
        </tr>
    @endforeach

</table>
</div>
@endsection
