<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'admin') {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                <a class="nav-link" href="index.php">Create account</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="create_article.php">Create Article</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

      <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include '../db_connection.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user_type = $_POST['user_type'];

    $stmt = $conn->prepare("INSERT INTO users (name, email, password, user_type) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $password, $user_type);

    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error; // Check for errors during statement execution
    } else {
        echo " <div class='alert alert-success' role='alert'>
        Account created successfully.
      </div>      ";
    }

    $stmt->close();
    $conn->close();
}
?>
    <div class="container">
        <h1 class="mt-5">Create Account for Captains and Collecting Staff</h1>
        <form action="index.php" method="post" class="mt-4">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label for="user_type">User Type:</label>
                <select name="user_type" id="user_type" class="form-control" required>
                    <option value="green_captain">Green Captain</option>
                    <option value="collecting_staff">Collecting Staff</option>
                </select>
            </div>
            
            <input type="submit" value="Create Account" class="btn btn-primary">
        </form>
    </div>
    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <h5>Admin Dashboard</h5>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Home</a></li>
                        <li><a href="#" class="text-white">About</a></li>
                        <li><a href="#" class="text-white">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <p>Colombo</p>
                    <p>Email: info@example.com</p>
                    <p>Phone: 0114589875</p>
                </div>
            </div>
        </div>
        <div class="text-center py-3" style="background-color: rgba(0, 0, 0, 0.2);">
            &copy; 2023 CMC Garbage Collection. All rights reserved.
        </div>
    </footer>
    <!-- Add Bootstrap and jQuery JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
