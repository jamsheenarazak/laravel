<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<div class="container pt-5">
    <form action="{{ route('teacher.store') }}" method="POST">
        @csrf
        <label class="form-group">Name</label>
        <input type="text" class="form-control" name="name" >
        @error('name')
        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <label>Subject</label>
        <input type="text" class="form-control" name="subject">
        @error('subject')
        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <label>Phone Number</label>
        <input type="number" class="form-control" name="phone">
        @error('phone')
        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <label>Email</label>
        <input type="email" class="form-control" name="email" class="@error('email') is-invalid @enderror form-control">
        @error('email')
        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
        @enderror
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
