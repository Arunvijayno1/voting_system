<?php
$servername = "localhost";
$username = "root";  // default for XAMPP
$password = "";      // leave blank for XAMPP
$dbname = "evoting_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
