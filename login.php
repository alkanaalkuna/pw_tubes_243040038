<?php
session_start();
require_once 'functions.php';

if (isset($_SESSION["login"])) {
    header("Location: /pw_tubes_243040038/admin/admin.php");
    exit;
}

$error = false;

if (isset($_POST["login"])) { // ganti dari "Login" ke "login" (huruf kecil)
    $username = $_POST["username"];
    $password = $_POST["password"];

    $user = login($username, $password);
    if ($user) {
        $_SESSION['login'] = true;
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: /pw_tubes_243040038/admin/admin.php");
        } else {
            header("Location: /pw_tubes_243040038/index.php");
        }
        exit;
    } else {
        $error = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Halaman Login</h1>

                        <?php if ($error) : ?>
                            <div class="alert alert-danger" role="alert">
                                Username / Password salah!
                            </div>
                        <?php endif; ?>

                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" name="login" class="btn btn-primary">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional, for interactivity) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>