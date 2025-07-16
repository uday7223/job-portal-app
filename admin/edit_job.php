<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include('../includes/db.php');

// Fetch job data
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = $_GET['id'];
  $stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  $job = $stmt->get_result()->fetch_assoc();
  $stmt->close();
}

// Update job
$success = "";
$error = "";
if (isset($_POST['update'])) {
  $title = $_POST['title'];
  $desc = $_POST['description'];
  $location = $_POST['location'];
  $skills = $_POST['skills'];
  $salary = $_POST['salary'];
  $deadline = $_POST['deadline'];
  $status = $_POST['status'];

  $stmt = $conn->prepare("UPDATE jobs SET title=?, description=?, location=?, skills=?, salary=?, deadline=?, status=? WHERE id=?");
  $stmt->bind_param("ssssissi", $title, $desc, $location, $skills, $salary, $deadline, $status, $id);

  if ($stmt->execute()) {
    $success = "Job updated successfully.";
  } else {
    $error = "Error: " . $stmt->error;
  }

  $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Edit Job</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" type="text/css" href="../styles/styles.css">
  <link rel="stylesheet" type="text/css" href="../styles/mediaQueries.css">
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="dashboard.php">Admin Panel</a>
    </div>
  </nav>

  <div class="container">
    <h2 class="mb-4 text-center">Edit Job</h2>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-4 rounded shadow-sm">
      <div class="mb-3">
        <label class="form-label">Job Title</label>
        <input type="text" name="title" value="<?= $job['title'] ?>" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Job Description</label>
        <textarea name="description" class="form-control" rows="4" required><?= $job['description'] ?></textarea>
      </div>

      <div class="mb-3">
        <label class="form-label">Location</label>
        <input type="text" name="location" value="<?= $job['location'] ?>" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Skills (comma separated)</label>
        <input type="text" name="skills" value="<?= $job['skills'] ?>" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Salary</label>
        <input type="number" name="salary" value="<?= $job['salary'] ?>" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Deadline</label>
        <input type="date" name="deadline" value="<?= $job['deadline'] ?>" class="form-control" required>
      </div>

      <div class="mb-3">
        <label class="form-label">Status</label>
        <select name="status" class="form-select">
          <option value="Open" <?= $job['status'] == 'Open' ? 'selected' : '' ?>>Open</option>
          <option value="Closed" <?= $job['status'] == 'Closed' ? 'selected' : '' ?>>Closed</option>
        </select>
      </div>

      <button type="submit" name="update" class="btn btn-primary">Update Job</button>
      <a href="dashboard.php" class="btn btn-secondary ms-2">← Back to Dashboard</a>
    </form>
  </div>

</body>
</html>
