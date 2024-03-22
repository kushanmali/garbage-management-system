
<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'user') {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GTF Member Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?AIzaSyCqrBc9JO3Ox3pkkdo2L_XEtQoB_FblC18"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5XmYKA7Rkf+joDz9I2Ao0UtrtGcTxlRm1M6egfEh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/footer.css">

</head>
<body><nav class="navbar navbar-expand-lg navbar-dark bg-primary  navbar-custom">
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
        <h1 class="my-4">GTF Member Dashboard</h1>
        
        <?php
        include 'db_connection.php';



        $id = "";
        // Make sure the user is logged in
        if (isset($_SESSION['email']) ) {
            $id = $_SESSION['gtf_member_id'];
          
         
           
        } else {
            echo "You are not logged in. Please log in first.";
        }




        $sql = "SELECT * FROM incidents WHERE gtf_member_id =  $id";
        $result = $conn->query($sql);

        $latitude = 0;
        $longitude = 0;

        if ($result->num_rows > 0) {
          echo '<div class="row">'; // Add the row container
          while($row = $result->fetch_assoc()) {
              $latitude = $row["latitude"];
              $longitude = $row["longitude"];
      
              echo '<div class="col-md-4 mb-4">'; // Add the column container with the specified width
              echo '  <div class="card" style="width: 100%;">'; // Set the card width to 100%
              echo '    <div class="card-body">';
              echo '      <div class="card-footer">';
              echo '        <a href="update_incident.php?id=' . $row["id"] . '" class="btn btn-warning">Update</a>';
              echo '        <a href="delete_incident.php?id=' . $row["id"] . '" class="btn btn-danger">Delete</a>';
              echo '      </div>';
      
              echo '      <h5 class="card-title"><i class="fas fa-map-marker-alt"></i> Report ID: ' . $row["id"] . '</h5>'; // Add icon before Report ID
              echo '      <p class="card-text"><i class="fas fa-info-circle"></i> Description: ' . $row["description"] . '</p>'; // Add icon before Description
              echo '      <img src="' . $row["image_path"] . '" alt="Incident Image" class="img-fluid mb-3" width ="300">';
              echo '      <p class="card-text"><i class="fas fa-exclamation-triangle"></i> Impact: ' . $row["impact"] . '</p>'; // Add icon before Impact
              echo '      <p class="card-text"><i class="fas fa-tasks"></i> Status: ' . $row["status"] . '</p>'; // Add icon before Status
              echo '    </div>';
      
              echo '    <div id="map" style="width: 100%; height: 400px;"></div>';
              echo '  </div>';
              echo '</div>'; // Close the column container
          }
          echo '</div>'; // Close the row container
      } else {
          echo "0 results";
      }
      
      

        $conn->close();
        ?>
    </div>
</body>
<script>
    function initMap() {
        const mapOptions = {
            zoom: 15,
            center: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
        };

        const map = new google.maps.Map(document.getElementById("map"), mapOptions);

        const marker = new google.maps.Marker({
            position: new google.maps.LatLng(<?php echo $latitude; ?>, <?php echo $longitude; ?>),
            map: map,
        });
    }

    initMap();
</script>
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
