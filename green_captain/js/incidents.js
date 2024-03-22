fetch("get.php")
  .then((response) => response.json())
  .then((incidents) => {
    let incidentCards = "";
    incidents.forEach((incident) => {
      incidentCards += `
          <div class="col-md-4">
              <div class="card mb-4">
                  <div class="card-body">
                      <h5 class="card-title">Incident ID: ${incident.id}</h5>
                      <p class="card-text">Description: ${incident.description}</p>
                      <p class="card-text">Status: ${incident.status}</p>
                      <img src="../${incident.image_path}" alt="Incident Image" class="img-fluid mb-3" width="200">
                  </div>
                  <div class="card-footer">
                      <select id="statusSelect-${incident.id}" class="form-select">
                          <option value="Pending" ${incident.status === "pending" ? "selected" : ""}>Pending</option>
                          <option value="Reported" ${incident.status === "reported" ? "selected" : ""}>Reported</option>
                          <option value="Approved" ${incident.status === "approved" ? "selected" : ""}>Approved</option>
                          <option value="Rejected" ${incident.status === "rejected" ? "selected" : ""}>Rejected</option>
                      </select>
                      <button id="updateBtn-${incident.id}" class="btn btn-primary mt-2">Update</button>
                  </div>
              </div>
          </div>
      `;
    });

    document.getElementById("incidentList").innerHTML = incidentCards;

    incidents.forEach((incident) => {
      document.getElementById(`updateBtn-${incident.id}`).addEventListener("click", () => {
        updateIncidentStatus(incident.id, document.getElementById(`statusSelect-${incident.id}`).value);
      });
    });
  })
  .catch((error) => console.error("Error fetching incidents:", error));
  function updateIncidentStatus(incidentId, newStatus) {
    const formData = new FormData();
    formData.append("incident_id", incidentId);
    formData.append("new_status", newStatus);
  
    fetch("update_incident_status.php", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((result) => {
        if (result.success) {
          alert("Incident status updated successfully!");
        } else {
          console.error("Error updating incident status:", result.error);
        }
      })
      .catch((error) => console.error("Error updating incident status:", error));
  }
  
  // ... Existing code for fetching and displaying incidents
  