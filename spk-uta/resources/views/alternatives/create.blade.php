<!DOCTYPE html>
<html>
<head>
    <title>Create Alternative</title>
</head>
<body>
    <h1>Create Alternative</h1>
    <form action="{{ route('alternatives.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Alternative Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        @foreach(session('criteria', []) as $index => $criterion)
            <div>
                <label for="scores[]">{{ $criterion['name'] }} Score:</label>
                <input type="number" name="scores[]" step="0.01" required>
            </div>
        @endforeach
        <button type="submit">Add Alternative</button>
    </form>
    <a href="{{ route('alternatives.index') }}">Back to Alternatives</a>
</body>
</html>
