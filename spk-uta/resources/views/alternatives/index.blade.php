<!DOCTYPE html>
<html>
<head>
    <title>Alternatives</title>
</head>
<body>
    <h1>Alternatives</h1>
    <table border="1">
        <tr>
            <th>Name</th>
            <th>Utility</th>
        </tr>
        @foreach($alternatives as $alternative)
            <tr>
                <td>{{ $alternative['name'] }}</td>
                <td>{{ $alternative['utility'] }}</td>
            </tr>
        @endforeach
    </table>
    <a href="{{ route('alternatives.create') }}">Add New Alternative</a>
</body>
</html>
