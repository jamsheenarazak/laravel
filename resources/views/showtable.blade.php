<html>
<head>
    <style>
        table, th, td {
            border: 1px solid black;
        }
        table{
            border-collapse: collapse;
            width: 100%;
        }
        th {
            height: 70px;
        }
        td,th {
            text-align: left;
            padding: 10px;
        }
    </style>
</head>
<body>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<table>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Subject</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Action</th>
    </tr>
    @foreach($teacher as $select)
        <tr>
            <td> {{$select->id}} </td>
            <td> {{$select->name}} </td>
            <td> {{$select->subject}} </td>
            <td> {{$select->phone}} </td>
            <td> {{$select->email}} </td>
            <td>
                <botton><a href="{{route('teacher.edit',$select->id)}}">Edit</a> </botton>
            <form action="{{ route('teacher.destroy',$select->id) }}" method="post">
                @csrf
                @method('DELETE')
            <button type="submit">Delete</button>
            </form>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
