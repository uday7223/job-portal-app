<?php include('../includes/db.php'); ?>

<!DOCTYPE html>
<html>
<head>
  <title>Job Listings</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Job Portal</a>
    </div>
  </nav>

  <div class="container">
    <h2 class="mb-4 text-center">Available Jobs</h2>

    <?php
      $result = $conn->query("SELECT * FROM jobs WHERE status = 'Open' ORDER BY created_at DESC");
      if ($result->num_rows > 0) {
        while ($job = $result->fetch_assoc()) {
          echo "<div class='card mb-3 shadow-sm'>";
          echo "  <div class='card-body'>";
          echo "    <h5 class='card-title'>{$job['title']}</h5>";
          echo "    <p class='card-text'><strong>Location:</strong> {$job['location']}</p>";
          echo "    <p class='card-text'><strong>Skills:</strong> {$job['skills']}</p>";
          echo "    <p class='card-text'><strong>Salary:</strong> ₹{$job['salary']}</p>";
          echo "    <a href='job_detail.php?id={$job['id']}' class='btn btn-primary'>View Details</a>";
          echo "  </div>";
          echo "</div>";
        }
      } else {
        echo "<div class='alert alert-warning'>No open jobs at the moment.</div>";
      }
    ?>
  </div>

</body>
</html>
