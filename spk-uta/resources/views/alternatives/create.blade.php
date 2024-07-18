<!DOCTYPE html>
<html>
<head>
    <title>Create Alternatives</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            let criteriaCount = 3; // Jumlah awal kriteria

            $('#add-criterion').click(function(){
                criteriaCount++;
                $('#criteria').append(`
                    <div class="criterion">
                        <label for="scores[]">Criterion ` + criteriaCount + ` Score:</label>
                        <input type="number" name="scores[]" required>
                        <label for="weights[]">Criterion ` + criteriaCount + ` Weight:</label>
                        <input type="number" name="weights[]" step="0.01" required>
                        <button type="button" class="remove-criterion">Remove</button>
                    </div>
                `);
            });

            $(document).on('click', '.remove-criterion', function(){
                $(this).parent('.criterion').remove();
            });
        });
    </script>
</head>
<body>
    <h1>Create Alternatives</h1>
    <form action="{{ route('alternatives.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">Alternative Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div id="criteria">
            <div class="criterion">
                <label for="scores[]">Criterion 1 Score:</label>
                <input type="number" id="scores1" name="scores[]" required>
                <label for="weights[]">Criterion 1 Weight:</label>
                <input type="number" id="weights1" name="weights[]" step="0.01" required>
            </div>
            <div class="criterion">
                <label for="scores[]">Criterion 2 Score:</label>
                <input type="number" id="scores2" name="scores[]" required>
                <label for="weights[]">Criterion 2 Weight:</label>
                <input type="number" id="weights2" name="weights[]" step="0.01" required>
            </div>
            <div class="criterion">
                <label for="scores[]">Criterion 3 Score:</label>
                <input type="number" id="scores3" name="scores[]" required>
                <label for="weights[]">Criterion 3 Weight:</label>
                <input type="number" id="weights3" name="weights[]" step="0.01" required>
            </div>
        </div>
        <button type="button" id="add-criterion">Add Criterion</button>
        <button type="submit">Add Alternative</button>
    </form>
    <a href="{{ route('alternatives.index') }}">Back to Alternatives</a>
</body>
</html>
