<?php
$conn = new mysqli("localhost", "root", "root", "job_portal", 3306);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>