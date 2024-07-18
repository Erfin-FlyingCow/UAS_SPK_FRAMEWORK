<!DOCTYPE html>
<html>
<head>
    <title>Create Criteria</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function(){
            let criteriaCount = 2; // Jumlah awal kriteria

            $('#add-criterion').click(function(){
                criteriaCount++;
                $('#criteria').append(`
                    <div class="criterion">
                        <label for="criteria[]">Criterion ` + criteriaCount + `:</label>
                        <input type="text" name="criteria[]" required>
                        <label for="weights[]">Weight:</label>
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
    <h1>Create Criteria</h1>
    <form action="{{ route('criteria.store') }}" method="POST">
        @csrf
        <div id="criteria">
            <div class="criterion">
                <label for="criteria[]">Criterion 1:</label>
                <input type="text" name="criteria[]" required>
                <label for="weights[]">Weight:</label>
                <input type="number" name="weights[]" step="0.01" required>
            </div>
            <div class="criterion">
                <label for="criteria[]">Criterion 2:</label>
                <input type="text" name="criteria[]" required>
                <label for="weights[]">Weight:</label>
                <input type="number" name="weights[]" step="0.01" required>
            </div>
        </div>
        <button type="button" id="add-criterion">Add Criterion</button>
        <button type="submit">Save Criteria</button>
    </form>
    <a href="{{ route('alternatives.index') }}">Back to Alternatives</a>
</body>
</html>
