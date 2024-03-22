
<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'user') {
    header('Location: login.php');
    exit();
}
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'db_connection.php';




        $id = "";
        // Make sure the user is logged in
        if (isset($_SESSION['email']) ) {
            $id = $_SESSION['gtf_member_id'];
          
         
           
        } else {
            echo "You are not logged in. Please log in first.";
        }




    // Generate a random incident ID
    $incident_id = mt_rand(9999, 99999);

    // Save the uploaded image file to the "images" folder with the incident ID as the filename
    $image_path = "images/" . $incident_id . ".jpg";
    move_uploaded_file($_FILES["image"]["tmp_name"], $image_path);

    $gtf_member_id = 1; // replace with the actual GTF member ID
    $description = $_POST["description"];
    $image_url = $image_path;
    $latitude = $_POST["latitude"];
    $longitude = $_POST["longitude"];
    $impact = $_POST["impact"];
    $importance = $_POST["importance"];
    $status = "reported";

    // Insert the data into the "incidents" table
    $sql = "INSERT INTO incidents (id, gtf_member_id, description, img_url, image_path, latitude, longitude, impact, importance, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisssddsss", $incident_id,  $id, $description, $image_url, $image_path, $latitude, $longitude, $impact, $importance, $status);

    if (!$stmt->execute()) {
        echo "Error: " . $stmt->error; // Check for errors during statement execution
    } else {
        echo "Incident saved successfully.";
    }

    $conn->close();
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Incident</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5XmYKA7Rkf+joDz9I2Ao0UtrtGcTxlRm1M6egfEh" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?AIzaSyCqrBc9JO3Ox3pkkdo2L_XEtQoB_FblC18"></script>

    <link rel="stylesheet" href="css/footer.css">

</head>
<script>
  let map;
  let marker;

  function initMap() {
    const defaultCenter = { lat: 6.9271, lng: 79.8612 };
    map = new google.maps.Map(document.getElementById("map"), {
      center: defaultCenter,
      zoom: 12,
    });

    map.addListener("click", (e) => {
      placeMarkerAndPanTo(e.latLng, map);
      document.getElementById("latitude").value = e.latLng.lat();
      document.getElementById("longitude").value = e.latLng.lng();
    });
  }

  function placeMarkerAndPanTo(latLng, map) {
    if (marker) {
      marker.setMap(null);
    }
    marker = new google.maps.Marker({
      position: latLng,
      map: map,
    });
    map.panTo(latLng);
  }

  google.maps.event.addDomListener(window, "load", initMap);
</script>

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
        <h1 class="my-4">Create Incident</h1>
        <form action="incident.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" rows="3" name = "description"></textarea>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <input class="form-control" type="file" id="image" name = "image">
            </div>
            <div class="mb-3">
                <label for="latitude" class="form-label">Latitude</label>
                <input type="text" class="form-control" id="latitude" placeholder="Click on the map to set the location" name = "latitude">
            </div>
            <div class="mb-3">
                <label for="longitude" class="form-label">Longitude</label>
                <input type="text" class="form-control" id="longitude" placeholder="Click on the map to set the location" name = "longitude">
            </div>
            <div class="mb-3">
                <label for="impact" class="form-label">Impact</label>
                <textarea class="form-control" id="impact" rows="3"  name = "impact"></textarea>
            </div>
            <div class="mb-3">
                <label for="importance" class="form-label">Importance</label>
                <select class="form-select" id="importance"  name = "importance">
                    <option selected>Choose...</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div id="map" style="width: 100%; height: 400px; margin-bottom: 20px;"></div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
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