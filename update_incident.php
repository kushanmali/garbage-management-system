
<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'user') {
    header('Location: login.php');
    exit();
}
?>


<?php
include 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_GET["id"];
    $description = $_POST["description"];
    $impact = $_POST["impact"];
    $importance = $_POST["importance"];

    $sql = "UPDATE incidents SET description=?, impact=?, importance=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $description, $impact, $importance, $id);

    if ($stmt->execute()) {
        header("Location: gtf-dashboard.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
}

$id = $_GET["id"];
$sql = "SELECT * FROM incidents WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Incident</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary  navbar-custom">
        <div class="container">
          <a class="navbar-brand" href="#">CMC Garbage Collection</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="gtf-dashboard.php">Home</a>
              </li>
             
              <li class="nav-item">
                <a class="nav-link" href="incident.php">Create Incident</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    <div class="container">
        <h1>Update Incident</h1>
        <form method="POST">
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3" required><?= $row['description'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="impact" class="form-label">Impact</label>
                <input type="text" name="impact" class="form-control" value="<?= $row['impact'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="importance" class="form-label">Importance</label>
                <select name="importance" class="form-select" required>
                    <option value="low" <?= $row['importance'] == 'low' ? 'selected' : '' ?>>Low</option>
                    <option value="medium" <?= $row['importance'] == 'medium' ? 'selected' : '' ?>>Medium</option>
                    <option value="high" <?= $row['importance'] == 'high' ? 'selected' : '' ?>>High</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Incident</button>
        </form>
    </div>
</body>
</html>
