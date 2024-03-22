<?php
include 'db_connection.php';

$sql = "SELECT * FROM articles";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CMC Garbage Collection</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/login.css">
  <link rel="stylesheet" href="css/nav.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/home.css">


</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand" href="#">CMC Garbage Collection</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="login.php">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="register.php">Register</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <main class="container">
    <section class="my-5">
      <h1 class="mb-4">Welcome to CMC Garbage Collection</h1>
<p>Our mission is to optimize garbage collection in the Colombo Municipal Council area. By joining our Green Task Force (GTF), you become an essential part of our efforts to create a cleaner and healthier city. As a member of the GTF, you can actively contribute to our collective mission by reporting any instances of thrown away garbage that you come across. Your reports play a crucial role in identifying areas that require immediate attention and facilitating prompt clean-up actions.</p>    </section>

    <section class="my-5">
      <h2>Latest articles</h2>
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card mb-3">
          <div class="card-body">
            <h3 class="card-title"><?php echo $row["title"]; ?></h3>
            <p class="card-text"><?php echo $row["content"]; ?></p>
          </div>
        </div>
      <?php endwhile; ?>
    </section>
  </main>


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
</html>
