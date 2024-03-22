<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(["error" => "Method not allowed"]);
    exit();
}

include "../db_connection.php";

$incident_id = $_POST["incident_id"];
$new_status = $_POST["new_status"];

$sql = "UPDATE incidents SET status = ? WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $new_status, $incident_id);
$result = $stmt->execute();

if ($result) {
    echo json_encode(["success" => true]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Failed to update incident status"]);
}

$stmt->close();
$conn->close();
?>
