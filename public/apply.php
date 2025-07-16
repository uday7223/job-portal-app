<?php
include('../includes/db.php');

if (!isset($_GET['job_id'])) {
  echo "Invalid job ID";
  exit;
}

$job_id = $_GET['job_id'];
$success = "";
$error = "";

// Handle form submission
if (isset($_POST['submit'])) {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $resume = $_FILES['resume'];

  $check = $conn->prepare("SELECT * FROM applications WHERE email = ? AND job_id = ?");
  $check->bind_param("si", $email, $job_id);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    $error = "You have already applied for this job.";
  } elseif ($resume['type'] !== 'application/pdf') {
    $error = "Only PDF resumes are allowed.";
  } else {
    $target_dir = "../uploads/";
    $filename = uniqid() . "-" . basename($resume["name"]);
    $target_file = $target_dir . $filename;

    if (move_uploaded_file($resume["tmp_name"], $target_file)) {
      $stmt = $conn->prepare("INSERT INTO applications (job_id, name, email, phone, resume_path) VALUES (?, ?, ?, ?, ?)");
      $stmt->bind_param("issss", $job_id, $name, $email, $phone, $filename);
      if ($stmt->execute()) {
        $success = "Application submitted successfully!";
      } else {
        $error = "Database error: " . $stmt->error;
      }
    } else {
      $error = "Failed to upload resume.";
    }
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Apply for Job</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" type="text/css" href="../styles/styles.css">
  <link rel="stylesheet" type="text/css" href="../styles/mediaQueries.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">

  <nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Job Portal</a>
    </div>
  </nav>

  <div class="container">
    <h2 class="mb-4 text-center">Apply for Job</h2>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php elseif ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="p-4 bg-white rounded shadow-sm">
      <div class="mb-3">
        <label for="name" class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control" required>
      </div>

      <div class="mb-3">
        <label for="phone" class="form-label">Phone Number</label>
        <input type="text" name="phone" class="form-control" maxlength="10" required>
      </div>

      <div class="mb-3">
        <label for="resume" class="form-label">Resume (PDF only)</label>
        <input type="file" name="resume" accept="application/pdf" class="form-control" required>
      </div>

      <button type="submit" name="submit" class="btn btn-success">Submit Application</button>
      <a href="index.php" class="btn btn-secondary ms-2">← Back to Jobs</a>
    </form>
  </div>

</body>
</html>
