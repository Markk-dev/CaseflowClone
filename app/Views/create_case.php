<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Case</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        #locationSearch {
            font-size: 1rem;
        }

        #locationSuggestions {
            max-height: 200px;
            overflow-y: auto;
            position: absolute;
            z-index: 1050;
            width: 100%;
        }

        .dropdown-item {
            font-size: 1rem;
            cursor: pointer;
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>

<body>
    <div class="container mt-4">
        <h2>Create Case</h2>
        <form id="createCaseForm" method="POST" action="<?= base_url('/cases/create') ?>">
            <div class="form-group">
                <label for="case_type">Case Type</label>
                <input type="text" class="form-control" name="case_type" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="case_priority">Priority</label>
                <select class="form-control" name="case_priority" required>
                    <option value="High">High</option>
                    <option value="Medium">Medium</option>
                    <option value="Low">Low</option>
                </select>
            </div>
            
            <div class="form-group position-relative">
                <label for="location">Location</label>
                <input type="text" id="locationSearch" name="location" class="form-control" placeholder="Search for a location" required>
                <div id="locationSuggestions" class="dropdown-menu"></div>
            </div>


            <button type="submit" class="btn btn-primary">Create Case</button>
            <a href="<?= base_url('dashboard') ?>" class="btn btn-secondary">Back to Dashboard</a>
        </form>
    </div>

    <!-- Load external JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="<?= base_url('scripts/maps.js') ?>"></script>
</body>

</html>
