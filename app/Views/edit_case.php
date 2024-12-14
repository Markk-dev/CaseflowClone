<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Case</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <section class="page-transition" id="main-content">  
        <div class="container mt-4">
            <h2>Edit Case</h2>
            <form method="POST" action="<?= base_url('/cases/edit/' . $case['id']) ?>">
                <div class="form-group">
                    <label for="case_type">Case Type</label>
                    <input type="text" class="form-control" name="case_type" value="<?= $case['case_type'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" required><?= $case['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="case_priority">Priority</label>
                    <select class="form-control" name="case_priority" required>
                        <option value="High" <?= $case['case_priority'] == 'High' ? 'selected' : '' ?>>High</option>
                        <option value="Medium" <?= $case['case_priority'] == 'Medium' ? 'selected' : '' ?>>Medium</option>
                        <option value="Low" <?= $case['case_priority'] == 'Low' ? 'selected' : '' ?>>Low</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="progress">Progress</label>
                    <select class="form-control" name="progress" required>
                        <option value="Incomplete" <?= $case['progress'] == 'Incomplete' ? 'selected' : '' ?>>Incomplete</option>
                        <option value="Complete" <?= $case['progress'] == 'Complete' ? 'selected' : '' ?>>Complete</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Case</button>
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Back to Dashboard</a>
                </div>
            </form>

            <form action="<?= base_url('/cases/delete/' . $case['id']) ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this case?')">
                <button type="submit" class="btn btn-danger">Delete Case</button>
            </form>
        </div>
    </section>
</body>

</html>
