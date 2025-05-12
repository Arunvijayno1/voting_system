<?php
// Database config
$servername = "localhost";
$username = "root";   // Default for XAMPP
$password = "";       // Default for XAMPP
$dbname = "evoting";

// Connect to DB
$conn = new mysqli($servername, $username, $password, $dbname);

// Check DB connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$name = $_POST['name'];
$party_name = $_POST['party_name'];
$user_id = $_POST['user_id'];
$raw_password = $_POST['password'];
$hashed_password = password_hash($raw_password, PASSWORD_DEFAULT);

// Upload image
$target_dir = "uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0755, true);
}
$flag_name = basename($_FILES["flag"]["name"]);
$target_file = $target_dir . time() . "_" . $flag_name;

$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$allowed = ["jpg", "jpeg", "png", "gif"];

if (!in_array($imageFileType, $allowed)) {
    die("Only JPG, JPEG, PNG, and GIF files are allowed.");
}

if (move_uploaded_file($_FILES["flag"]["tmp_name"], $target_file)) {
    // Insert into DB
    $stmt = $conn->prepare("INSERT INTO candidates (name, party_name, user_id, password, flag_path) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $party_name, $user_id, $hashed_password, $target_file);

    if ($stmt->execute()) {
        echo "Candidate registered successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Failed to upload image.";
}

$conn->close();
?>
