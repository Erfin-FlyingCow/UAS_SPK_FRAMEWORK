<!DOCTYPE html>
<html>
<head>
    <title>Alternatives List</title>
</head>
<body>
    <h1>List of Alternatives</h1>

    <h2>Criteria and Weights</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Criteria</th>
                <th>Weight</th>
            </tr>
        </thead>
        <tbody>
            @foreach($criteria as $criterion)
                <tr>
                    <td>{{ $criterion['name'] }}</td>
                    <td>{{ $criterion['weight'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2>Alternatives</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                @foreach($criteria as $criterion)
                    <th>{{ $criterion['name'] }} Score</th>
                @endforeach
                <th>Utility</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alternatives as $alternative)
                <tr>
                    <td>{{ $alternative['rank'] }}</td>
                    <td>{{ $alternative['name'] }}</td>
                    @foreach($alternative['scores'] as $score)
                        <td>{{ $score }}</td>
                    @endforeach
                    <td>{{ $alternative['utility'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('alternatives.create') }}">Add New Alternative</a>
    <br>
    <a href="{{ route('criteria.create') }}">Add New Criteria</a>
</body>
</html>
