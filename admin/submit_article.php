<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'admin') {
    header('Location: login.php');
    exit();
}

include '../db_connection.php';


$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get data from the form
$title = $_POST['title'];
$content = $_POST['content'];

// Insert the data into the database
$sql = "INSERT INTO articles (title, content) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $title, $content);

if ($stmt->execute()) {
    $_SESSION['message'] = "Article created successfully";
    header('Location: create_article.php');
} else {
    $_SESSION['message'] = "Error: " . $sql . "<br>" . $conn->error;
    header('Location: create_article.php');
}

$stmt->close();
$conn->close();
?>
