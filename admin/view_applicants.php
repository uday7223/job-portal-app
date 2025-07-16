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
  <title>View Applicants</title>
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
      <a class="navbar-brand" href="dashboard.php">← Back to Dashboard</a>
      <span class="navbar-text text-white">View Applicants</span>
    </div>
  </nav>

  <div class="container mb-5">
    <?php
      $jobs = $conn->query("SELECT * FROM jobs ORDER BY created_at DESC");

      while ($job = $jobs->fetch_assoc()) {
        echo "<h4 class='mb-3'>📌 {$job['title']} <span class='text-muted fw-light'>({$job['location']})</span></h4>";

        $stmt = $conn->prepare("SELECT * FROM applications WHERE job_id = ? ORDER BY created_at DESC");
        $stmt->bind_param("i", $job['id']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          echo "<div class='table-responsive mb-4'>";
          echo "<table class='table table-bordered table-striped align-middle'>";
          echo "<thead class='table-dark'>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Resume</th>
                    <th>Applied At</th>
                  </tr>
                </thead><tbody>";
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['phone']}</td>";
            echo "<td><a href='../uploads/{$row['resume_path']}' target='_blank' class='btn btn-sm btn-primary'>Download</a></td>";
            echo "<td>{$row['created_at']}</td>";
            echo "</tr>";
          }
          echo "</tbody></table></div>";
        } else {
          echo "<p class='text-muted'>No applicants yet.</p>";
        }

        $stmt->close();
      }
    ?>
  </div>

</body>
</html>
