<?php
require 'functions.php';
$conn = koneksi();

if (isset($_POST["register"])) {

    if (registrasi($_POST) > 0) {
        echo "<script>
        alert('User baru berhasil ditambahkan!');
        </script>";
    } else {
        echo "<script>
        alert('User gagal ditambahkan!');
        </script>";
        echo mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-5">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Register</h3>
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password2" class="form-label">Konfirmasi Password</label>
                                <input type="password" name="password2" id="password2" class="form-control" required>
                            </div>
                            <button type="submit" name="register" class="btn btn-primary w-100">Sign In</button>
                            <div class="text-center mt-3">
                                <small>Sudah punya akun?<a href="login.php.php">Login di sini</a></small>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>