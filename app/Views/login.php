<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('styles/global.css') ?>">
    <link rel="stylesheet" href="<?= base_url('styles/root.css') ?>">
    <link rel="stylesheet" href="<?= base_url('styles/login.css') ?>">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <div class="card">
            <h2>Login</h2>

            <hr>

            <form action="/login" method="post">
                <div class="form-group">
                    <label class="tags" for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
                </div>
                <div class="form-group">
                    <label class="tags" for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Login</button>

            </form>
             <p class="signup">Dont have an account?<span style="margin-left: 5px;"><a href="/register">Register</a></span></p>
        </div>
    </div>

   
</body>
</html>
