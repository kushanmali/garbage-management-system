function initMap() {
    const map = new google.maps.Map(document.getElementById('map'), {
      zoom: 12,
      center: { lat: 6.9271, lng: 79.8612 },
    });
  
    fetch('get_incidents.php')
      .then((response) => response.json())
      .then((incidents) => {
        incidents.forEach((incident) => {
          const marker = new google.maps.Marker({
            position: { lat: parseFloat(incident.latitude), lng: parseFloat(incident.longitude) },
            map: map,
          });
        });
      })
      .catch((error) => console.error('Error fetching incidents:', error));
  }
  