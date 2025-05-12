<?php
include 'db.php';

$start = $_POST['startDateTime'];
$end = $_POST['endDateTime'];

$sql = "UPDATE settings SET start_date=?, end_date=? WHERE id=1";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start, $end);

if ($stmt->execute()) {
    echo "Start and End date/time saved successfully.";
} else {
    echo "Error: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
