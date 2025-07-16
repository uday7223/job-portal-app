<?php
include('../includes/db.php');

if (!isset($_GET['id'])) {
  echo "Invalid Job ID";
  exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM jobs WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$job = $stmt->get_result()->fetch_assoc();
$stmt->close();

if (!$job) {
  echo "Job not found.";
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title><?= $job['title'] ?> - Job Details</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">


    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
  <link rel="stylesheet" type="text/css" href="../styles/mediaQueries.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Job Portal</a>
    </div>
  </nav>

  <div class="container">
    <div class="card shadow-sm mb-4">
      <div class="card-body">
        <h3 class="card-title mb-3"><?= $job['title'] ?></h3>
        <p class="card-text"><strong>Description:</strong> <?= $job['description'] ?></p>
        <p class="card-text"><strong>Location:</strong> <?= $job['location'] ?></p>
        <p class="card-text"><strong>Skills:</strong> <?= $job['skills'] ?></p>
        <p class="card-text"><strong>Salary:</strong> ₹<?= $job['salary'] ?></p>
        <p class="card-text"><strong>Deadline:</strong> <?= $job['deadline'] ?></p>
        
        <a href="apply.php?job_id=<?= $job['id'] ?>" class="btn btn-success mt-3">Apply Now</a>
        <a href="index.php" class="btn btn-secondary mt-3 ms-2">← Back to Jobs</a>
      </div>
    </div>
  </div>

</body>
</html>
