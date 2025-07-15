<?php
session_start();

// Hardcoded credentials
$admin_user = "admin";
$admin_pass = "admin123";

$error = "";

// Handle form submission
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username === $admin_user && $password === $admin_pass) {
    $_SESSION['admin'] = $username;
    header("Location: dashboard.php");
    exit;
  } else {
    $error = "Invalid username or password!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light d-flex align-items-center justify-content-center" style="min-height: 100vh;">

  <div class="card shadow p-4" style="width: 100%; max-width: 400px;">
    <h3 class="text-center mb-4">Admin Login</h3>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" required>
      </div>

      <button type="submit" name="login" class="btn btn-dark w-100">Login</button>
    </form>
  </div>

</body>
</html>
