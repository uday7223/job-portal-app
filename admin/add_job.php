<?php 
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include('../includes/db.php'); 
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add New Job</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
  <link rel="stylesheet" type="text/css" href="../styles/mediaQueries.css">
  <!-- Bootstrap CSS -->
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
    <h2 class="text-center mb-4">Add New Job</h2>

    <?php
      if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $desc = $_POST['description'];
        $location = $_POST['location'];
        $skills = $_POST['skills'];
        $salary = $_POST['salary'];
        $deadline = $_POST['deadline'];

        $sql = "INSERT INTO jobs (title, description, location, skills, salary, deadline)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssss", $title, $desc, $location, $skills, $salary, $deadline);

        if ($stmt->execute()) {
          echo "<div class='alert alert-success'>Job added successfully!</div>";
        } else {
          echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }

        $stmt->close();
      }
    ?>

    <form method="POST" action="add_job.php" class="bg-white p-4 rounded shadow-sm">
      <div class="mb-3">
        <label for="title" class="form-label">Job Title</label>
        <input type="text" name="title" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">Job Description</label>
        <textarea name="description" class="form-control" rows="4" required></textarea>
      </div>

      <div class="mb-3">
        <label for="location" class="form-label">Location</label>
        <input type="text" name="location" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="skills" class="form-label">Skills (comma separated)</label>
        <input type="text" name="skills" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="salary" class="form-label">Salary</label>
        <input type="number" name="salary" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="deadline" class="form-label">Deadline</label>
        <input type="date" name="deadline" class="form-control" required>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Add Job</button>
      <a href="dashboard.php" class="btn btn-secondary ms-2">← Back to Dashboard</a>
    </form>
  </div>

</body>
</html>
