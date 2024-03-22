<?php
session_start();

if (!isset($_SESSION['email']) || $_SESSION['user_type'] != 'green_captain') {
    header('Location: login.php');
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtthSN2Els6pPjf0czvfyOyGbMVe4RnjE"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        #map {
            height: 50%;
            width: 50%;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary  navbar-custom">
        <div class="container">
          <a class="navbar-brand" href="#">Green Captain Dashboard</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
           
             
              <li class="nav-item">
                <a class="nav-link" href="index.php">Dashboard</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="manage_incidents.php">Manage Incidents</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php">Logout</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>

    <div class = "container">
    <h1>Green Captain Dashboard</h1>
    <div id="map" style="height: 600px; width: 100%;"></div>
    </div>

    <script>
  function getMarkerIcon(importance) {
    if (importance === "low") {
        return "https://maps.google.com/mapfiles/ms/icons/yellow-dot.png";
    } else {
        return "https://maps.google.com/mapfiles/ms/icons/red-dot.png";
    }
}

function initMap() {
    const map = new google.maps.Map(document.getElementById("map"), {
        zoom: 12,
        center: { lat: 6.9271, lng: 79.8612 }, // Coordinates for Colombo
    });

    fetch("get_incidents.php")
        .then((response) => response.json())
        .then((incidents) => {
            incidents.forEach((incident) => {
                const position = {
                    lat: parseFloat(incident.latitude),
                    lng: parseFloat(incident.longitude),
                };
                const marker = new google.maps.Marker({
                    position: position,
                    map: map,
                    icon: getMarkerIcon(incident.importance),
                });

                const contentString = `
                    <div>
                        <h4>Incident ${incident.id}</h4>
                        <img src="../${incident.image_path}" alt="Incident Image" style="width: 200px;">
                        <p><strong>Description:</strong> ${incident.description}</p>
                        <p><strong>Status:</strong> ${incident.status}</p>
                    </div>
                `;

                const infoWindow = new google.maps.InfoWindow({
                    content: contentString,
                });

                marker.addListener("click", () => {
                    infoWindow.open(map, marker);
                });
            });
        })
        .catch((error) => console.error("Error fetching incidents:", error));
}

initMap();

    </script>
    
    <footer class="bg-dark text-white mt-5">
        <div class="container py-4">
            <div class="row">
                <div class="col-md-6">
                    <h5>Green Captain Dashboard</h5>
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
</body>
</html>
