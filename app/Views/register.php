<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('styles/register.css') ?>">
    <link rel="stylesheet" href="<?= base_url('styles/root.css') ?>">

    <title>Register</title>
</head>
<body>
    <div class="container">
        <h2>Register</h2>

        <hr>

        <form action="/register" method="post">
            <div class="form-group" id="heroName">
                <label class="tags" for="fname">First Name</label>
                <input type="text" class="form-control" name="fname" required>

                <label class="tags" id="tg2" for="lname">Last Name</label>
                <input type="text" class="form-control" name="lname" required>
            </div>


            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_password" required>
                <p class="require">Minimum length of 8 characters</p>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>

        <?php if (session()->getFlashdata('errors')): ?>
            <div class="alert alert-danger">
                <?= implode('<br>', session()->getFlashdata('errors')) ?>
            </div>
        <?php endif; ?>
        <p class="terms">By creating an account, you agree to the Terms of Service. We'll occasionally send you account-related emails.</p>

        <p class="login">Already have an account?<span style="margin-left: 5px;"><a href="/login">Login</a></span></p>
    </div>

</body>
</html>
