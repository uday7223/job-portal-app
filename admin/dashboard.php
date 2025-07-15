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
  <title>Admin Dashboard - Job List</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Admin Dashboard</a>
      <div class="d-flex align-items-center me-3">

      <a href="view_applicants.php" class="btn me-3 btn-primary btn-sm">View Applicants</a>
      <a href="add_job.php" class="btn btn-success btn-sm">➕ Add New Job</a>

      </div>
      
    </div>
  </nav>

  <div class="container">
    <h2 class="mb-4">All Job Listings</h2>

    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped align-middle">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Location</th>
            <th>Skills</th>
            <th>Salary</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $result = $conn->query("SELECT * FROM jobs ORDER BY created_at DESC");
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['id']}</td>";
                echo "<td>{$row['title']}</td>";
                echo "<td>{$row['location']}</td>";
                echo "<td>{$row['skills']}</td>";
                echo "<td>₹{$row['salary']}</td>";
                echo "<td>{$row['deadline']}</td>";
                echo "<td>
                        <form method='GET' action='toggle_status.php' class='d-inline'>
                          <input type='hidden' name='id' value='{$row['id']}'>
                          <input type='hidden' name='status' value='{$row['status']}'>
                          <button type='submit' class='btn btn-sm " . ($row['status'] === 'Open' ? 'btn-success' : 'btn-secondary') . "'>
                            " . ($row['status'] === 'Open' ? '✅ Open' : '❌ Closed') . "
                          </button>
                        </form>
                      </td>";
                echo "<td>
                        <a href='edit_job.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='delete_job.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                      </td>";
                echo "</tr>";
              }
            } else {
              echo "<tr><td colspan='8' class='text-center'>No jobs found</td></tr>";
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
