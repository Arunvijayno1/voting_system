<?php
include 'db.php';

$sql = "SELECT party_name, flag_image FROM parties";
$result = $conn->query($sql);

$candidates = [];

while ($row = $result->fetch_assoc()) {
    $candidates[] = $row;
}

echo json_encode($candidates);

$conn->close();
?>
