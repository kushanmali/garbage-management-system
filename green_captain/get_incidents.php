<?php
header("Content-Type: application/json");

include "../db_connection.php";

$sql = "SELECT id, latitude, longitude, image_path, description, status, importance FROM incidents";
$result = $conn->query($sql);

$incidents = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $incidents[] = $row;
    }
}

echo json_encode($incidents, JSON_UNESCAPED_SLASHES);

$conn->close();
?>
