<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Offense</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <section class="page-transition" id="main-content">  
        <div class="container mt-4">
            <h2>Edit Offense</h2>
            <form method="POST" action="<?= base_url('/offenses/edit/' . $offense['id']) ?>">
                <div class="form-group">
                    <label for="offense_type">Offense Type</label>
                    <input type="text" class="form-control" name="offense_type" value="<?= $offense['offense_type'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="name">Student Name</label>
                    <input type="text" class="form-control" name="name" value="<?= $offense['name'] ?>" required>
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" required><?= $offense['description'] ?></textarea>
                </div>
                <div class="form-group">
                    <label for="severity">Severity</label>
                    <select class="form-control" name="severity" required>
                        <option value="1st" <?= $offense['severity'] == '1st' ? 'selected' : '' ?>>1st Offense</option>
                        <option value="2nd" <?= $offense['severity'] == '2nd' ? 'selected' : '' ?>>2nd Offense</option>
                        <option value="3rd" <?= $offense['severity'] == '3rd' ? 'selected' : '' ?>>3rd Offense</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="progress">Progress</label>
                    <select class="form-control" name="progress" required>
                        <option value="Incomplete" <?= $offense['progress'] == 'Incomplete' ? 'selected' : '' ?>>Incomplete</option>
                        <option value="Complete" <?= $offense['progress'] == 'Complete' ? 'selected' : '' ?>>Complete</option>
                    </select>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Update Offense</button>
                    <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Back to Dashboard</a>
                </div>
            </form>
                <form action="<?= site_url('offenses/delete/' . $offense['id']) ?>" method="POST" style="display:inline;">
                    <?= csrf_field() ?>
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this offense?');" class="btn btn-danger">Delete</button>
                </form>
        </div>
    </section>
</body>

</html>
