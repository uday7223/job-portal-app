<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

include('../includes/db.php');

if (isset($_GET['id'], $_GET['status']) && is_numeric($_GET['id'])) {
  $id = intval($_GET['id']);
  $currentStatus = $_GET['status'];
  $newStatus = $currentStatus === 'Open' ? 'Closed' : 'Open';

  $stmt = $conn->prepare("UPDATE jobs SET status = ? WHERE id = ?");
  $stmt->bind_param("si", $newStatus, $id);

  if ($stmt->execute()) {
    header("Location: dashboard.php");
    exit;
  } else {
    echo "<script>alert('Error toggling status.'); window.location.href='dashboard.php';</script>";
  }

  $stmt->close();
} else {
  echo "<script>alert('Invalid request.'); window.location.href='dashboard.php';</script>";
}
?>
