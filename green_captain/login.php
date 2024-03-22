<?php
session_start();
include '../db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];       
            $_SESSION['user_type'] = 'green_captain'; 
            header("Location: index.php");
        } else {
            $error_message = "Incorrect email or password.";
        }
    } else {
        $error_message = "No user found with this email.";
    }

    $stmt->close();
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="css/login.css">


</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary navbar-custom">
        <div class="container">
          <a class="navbar-brand" href="#">CMC Garbage Collection</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link" href="../index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
             
            </ul>
          </div>
        </div>
    </nav>
    <div class="container">
        <div class="login-card">
            <h2 class="text-center mb-4">Green Captain  login</h2>
            <?php
            if (isset($error_message)) {
                echo "<div class='alert alert-danger' role='alert'>$error_message</div>";
            }
            ?>
            <form action="login.php" method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>
            
        </div>
    </div>
    <footer class="footer py-4">
  <div class="container">
    <div class="row">
      <div class="col-lg-6">
        <p class="text-white mb-1">© 2023 CMC Garbage Collection. All rights reserved.</p>
        <p class="text-white mb-1">123 Main Street</p>
        <p class="text-white mb-1">Colombo, Sri Lanka</p>
        <p class="text-white">Phone: <a href="tel:+94123456789" class="text-white">+94 123 456789</a></p>
      </div>
      <div class="col-lg-6">
        <ul class="list-inline text-lg-end">
          <li class="list-inline-item"><a href="#">Home</a></li>
          <li class="list-inline-item"><a href="#">About</a></li>
          <li class="list-inline-item"><a href="#">Services</a></li>
          <li class="list-inline-item"><a href="#">Contact</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>
</body>
</html>
