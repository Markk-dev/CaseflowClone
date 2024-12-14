<!-- app/Views/completed.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Cases</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link rel="stylesheet" href="<?= base_url('styles/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('styles/root.css') ?>">
    <link rel="stylesheet" href="<?= base_url('styles/Dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('styles/main.css') ?>">
</head>
<body>
    <section class="page-transition" id="main-content">
    <?php  $navbar = new \App\Libraries\navbar();
        $navbar->render('complete'); 
    ?>
    <div class="container mt-4">
    <h1 style="font-weight: 290;">Completed <span style="font-weight: 650;">Case</span></h1>
    <p>Initial Set of Completed Case Records</p>


        <table class="table" style="margin: 50px 0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Case Type</th>
                    <th>Description</th>
                    <th>Location</th>
                    <th style="padding-left: 30px;">Priority</th>
                </tr>
            </thead>
            <tbody>
                <?= $caseRows ?>
            </tbody>
        </table>

        <div class="side-panel">
            <button class="close-btn" id="closePanelBtn">✖</button>
            <div id="accountSettingsSection" class="fade-section"></div>
        </div>

    </div>
    </section>
    <script src="<?= base_url('scripts/global.js') ?>"></script>
    <script src="<?= base_url('scripts/sidepanel.js') ?>"></script> 
    <script src="<?= base_url('scripts/AccountSettings.js') ?>"></script>
</body>
</html>
