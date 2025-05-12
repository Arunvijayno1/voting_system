<?php
session_start();
$conn = new mysqli("localhost", "root", "", "evoting");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$user_id = $_POST['user_id'];
$password = $_POST['password'];

$sql = "SELECT * FROM candidates WHERE user_id = '$user_id' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $_SESSION['user_id'] = $user_id;
  header("Location: candidate_dashboard.php"); // or main admin panel
} else {
  echo "<script>alert('Invalid credentials'); window.location.href='candidate_login.html';</script>";
}

$conn->close();
?>
