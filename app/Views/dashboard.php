<?php
use App\Libraries\DataTableComponent;

$dataTableComponent = new DataTableComponent();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('styles/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('styles/Dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('styles/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('styles/root.css') ?>">

    <title>Dashboard</title>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body class="Mode">
    <section class="page-transition" id="main-content">
        <?php $navbar->render('dashboard'); ?>

        <div class="container">
            <div class="d-flex justify-content-between align-items-center mt-4">
                <h1>
                    <span style="font-weight: 290;">Welcome,</span>
                    <span id="userName" style="font-weight: 650;">
                        <?= session()->get('fname') ? esc(session()->get('fname')) : 'User'; ?>
                    </span>
                </h1>

                <div class="addbtn">
                    <a href="<?= base_url('cases/create') ?>" class="addCaseBtn">
                        <span class="material-symbols-outlined" id="addCircle">add_circle</span>Create</a>
                </div>
            </div>

            <p class="subHeader">It’s a pleasure to have you back on the team.</p>

            <div class="Cases" id="Dashboard" style="margin-top: 3rem;">
                <div class="row my-4">
                    <div class="col-md-4">
                        <div class="cardBody1">
                            <div class="cardBodyHolder" style="padding: .5rem;">
                                <span class="material-symbols-outlined" style="font-size: 3.4rem;color: var(--blue);">cases</span>
                                <h1 style="font-weight: 650; color: var(--blue); font-size: 3rem;"><?= esc($totalOffenses) ?></h1>
                            </div>
                            <p class="cardTextBlue">Total number of Offenses</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="cardBody2">
                            <div class="cardBodyHolder" style="padding: .5rem;">
                                <span class="material-symbols-outlined" style="font-size: 3.4rem;color: var(--red);">warning</span>
                                <h1 style="font-weight: 650; color: var(--red); font-size: 3rem;"><?= esc($highPriorityOffenses) ?></h1>
                            </div>
                            <p class="cardTextRed">Total number of High Offenses</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="cardBody3">
                            <div class="cardBodyHolder" style="padding: .5rem;">
                                <span class="material-symbols-outlined" style="font-size: 3.4rem;color: var(--green);">task</span>
                                <h1 style="font-weight: 650; color: var(--green); font-size: 3rem;"><?= esc($completedCases) ?></h1>
                            </div>
                            <p class="cardTextGreen">Total number of Recorded Offenses</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="SearchFieldContainer">
                <input type="text" id="searchField" class="form-control" placeholder="Search Case" />

                <div class="SearchFieldSelect">
                    <select id="filterPriority" class="form-control">
                        <option value="">Filter</option>
                        <option value="1st">High</option>
                        <option value="2nd">Medium</option>
                        <option value="3rd">Low</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Offense Type</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Severity</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($offenses as $offense): ?>
                            <tr>
                                <td><?= esc($offense['id']) ?></td>
                                <td><?= esc($offense['offense_type']) ?></td>
                                <td><?= esc($offense['name']) ?></td>
                                <td><?= esc($offense['description']) ?></td>
                                <td><?= esc($offense['severity']) ?></td>
                                <td>
                                    <a href="<?= base_url('offenses/edit/' . $offense['id']) ?>">Edit</a>
                                    <form action="<?= site_url('offenses/delete/' . $offense['id']) ?>" method="POST" style="display:inline;">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this offense?');" class="btn btn-danger">Delete</button>
                                    </form>

                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="side-panel">
            <button class="close-btn" id="closePanelBtn">✖</button>
            <div id="accountSettingsSection" class="fade-section"></div>
        </div>
    </section>

    <script src="<?= base_url('scripts/global.js') ?>"></script>
    <script src="<?= base_url('scripts/dashboard.js') ?>"></script>
    <script src="<?= base_url('scripts/sidepanel.js') ?>"></script>
    <script src="<?= base_url('scripts/AccountSettings.js') ?>"></script>
</body>

</html>
