<?php
include 'db.php';

$partyName = $_POST['partyName'];
$target_dir = "uploads/";
$filename = basename($_FILES["flagImage"]["name"]);
$target_file = $target_dir . $filename;

if (!file_exists($target_dir)) {
    mkdir($target_dir, 0777, true); // create folder if not exist
}

if (move_uploaded_file($_FILES["flagImage"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO parties (party_name, flag_image) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $partyName, $target_file);
    
    if ($stmt->execute()) {
        echo "Image uploaded and party added!";
    } else {
        echo "DB Error: " . $conn->error;
    }
    $stmt->close();
} else {
    echo "Upload failed.";
}

$conn->close();
?>
