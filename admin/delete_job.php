<?php
include('../includes/db.php');
session_start();

if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
  $id = intval($_GET['id']);

  $stmt = $conn->prepare("DELETE FROM jobs WHERE id = ?");
  $stmt->bind_param("i", $id);

  if ($stmt->execute()) {
    echo "<script>
            alert('✅ Job deleted successfully.');
            window.location.href = 'dashboard.php';
          </script>";
  } else {
    echo "<script>
            alert('❌ Error deleting job.');
            window.location.href = 'dashboard.php';
          </script>";
  }

  $stmt->close();
} else {
  echo "<script>
          alert('Invalid Job ID.');
          window.location.href = 'dashboard.php';
        </script>";
}
?>
