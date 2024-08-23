<!DOCTYPE html>
<html>
<head>
    <title>Upload Photo</title>
</head>
<body>
<h1>Upload Photo</h1>
@if(session('success'))
    <div>
        <strong>{{ session('success') }}</strong>
        <br>
        <img src="{{ asset('storage/' . session('path')) }}" alt="Uploaded Photo" width="300">
    </div>
@endif
<form action="{{ route('addplace') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="photo">Select Photo:</label>
        <input type="file" name="photo" id="photo" required>
    </div>
    <button type="submit">Upload</button>
</form>
</body>
</html>
