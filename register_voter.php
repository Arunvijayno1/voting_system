<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "evoting";

// DB connection
$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$voter_name = $_POST['voter_name'];
$voter_id = $_POST['voter_id'];
$password = password_hash($_POST['password'], PASSWORD_BCRYPT);

$photo = "";
if (!empty($_FILES['profile_photo']['name'])) {
    $photo = $_FILES['profile_photo']['name'];
    $target = "uploads/voters/" . basename($photo);
    move_uploaded_file($_FILES['profile_photo']['tmp_name'], $target);
}

$sql = "INSERT INTO voters (voter_name, voter_id, password, photo) 
        VALUES ('$voter_name', '$voter_id', '$password', '$photo')";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Voter Registered Successfully'); window.location.href='login.html';</script>";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>
