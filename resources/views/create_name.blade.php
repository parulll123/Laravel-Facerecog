<!DOCTYPE html>
<html>
<head>
    <title>Upload Name</title>
</head>
<body>
    @if(session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('names.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <button type="submit">Upload Name</button>
    </form>
</body>
</html>
