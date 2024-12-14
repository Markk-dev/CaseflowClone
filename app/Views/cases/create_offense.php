<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Offense</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('styles/main.css') ?>">
</head>

<body>
    <div class="container mt-4">
        <h2>Create Offense</h2>
        <form id="createOffenseForm" method="POST" action="<?= base_url('/cases/create') ?>">
            <div class="form-group">
                <label for="offense_type">Offense Type</label>
                <input type="text" class="form-control" name="offense_type" required>
            </div>
            <div class="form-group">
                <label for="name">Offense Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="severity">Severity</label>
                <select class="form-control" name="severity" required>
                    <option value="1st">1st</option>
                    <option value="2nd">2nd</option>
                    <option value="3rd">3rd</option>
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary">Create Offense</button>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>

    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>

</html>
