<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disaster Alerts</title>
    <link rel="stylesheet" href="disaster-alerts.css">
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1>Disaster Alerts</h1>
            <a href="index.php" class="btn-primary">Back to Home</a>
        </div>
    </header>

    <main class="container">
        <section class="alert-friends-section">
            <div class="section-header">
                <h2><i class="fas fa-user-friends"></i> Alert Your Family or Friends</h2>
            </div>
            <form id="alert-form" class="form">
                <div class="form-group">
                    <label for="phone">Contact Phone Number:</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter phone number" pattern="[0-9]{10}" required>
                </div>
                <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" name="message" rows="4" placeholder="Enter your alert message" required></textarea>
                </div>
                <button type="submit" class="btn-primary">Send Alert</button>
            </form>
        </section>
        
        <section class="alerts-section">
            <div class="section-header">
                <h2><i class="fas fa-exclamation-triangle"></i> Current Disaster Warnings</h2>
            </div>
            <div id="map" class="map"></div>
            <p>Stay updated with real-time alerts based on your current location.</p>
        </section>

        <section class="hazard-alerts-section">
            <div class="section-header">
                <h2><i class="fas fa-map-marker-alt"></i> Location Monitoring & Hazard Alerts</h2>
            </div>
            <p>Monitor hazards in your area to stay safe and prepared.</p>
            <button class="btn-secondary" onclick="monitorHazards()">Locate Hazards</button>
            <div id="hazard-alerts-list" class="alerts-list"></div>
        </section>
    </main>

    <script>
        var map = L.map('map').setView([26.9124, 75.7873], 6);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        document.getElementById('alert-form').addEventListener('submit', function(event) {
            event.preventDefault();
            const phone = document.getElementById('phone').value;
            const message = document.getElementById('message').value;
            sendSMS(phone, message);
        });

        function sendSMS(phone, message) {
            alert(`SMS sent to ${phone} with message: "${message}"`);
            document.getElementById('alert-form').reset();
        }

        function monitorHazards() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            map.setView([lat, lon], 6);

            const hazardData = [
                { type: 'Flood', severity: 'High', location: 'Jaipur', coordinates: [26.9124, 75.7873] },
                { type: 'Drought', severity: 'Moderate', location: 'Jodhpur', coordinates: [26.2913, 73.0169] },
                { type: 'Heatwave', severity: 'High', location: 'Udaipur', coordinates: [24.5797, 73.6960] },
                { type: 'Earthquake', severity: 'Low', location: 'Bikaner', coordinates: [28.0174, 73.3114] },
                { type: 'Flood', severity: 'Moderate', location: 'Ajmer', coordinates: [26.4516, 74.6399] }
            ];

            displayHazards(hazardData);
        }

        function displayHazards(hazards) {
            const alertsList = document.getElementById('hazard-alerts-list');
            alertsList.innerHTML = '';

            hazards.forEach(hazard => {
                L.marker(hazard.coordinates, { icon: getMarkerIcon(hazard.severity) }).addTo(map)
                    .bindPopup(`<b>${hazard.type}</b><br>Severity: ${hazard.severity}<br>Location: ${hazard.location}`)
                    .openPopup();

                const alertItem = document.createElement('div');
                alertItem.classList.add('alert-item');
                alertItem.innerHTML = `
                    <h3>${hazard.type}</h3>
                    <p><strong>Severity:</strong> ${hazard.severity}</p>
                    <p><strong>Location:</strong> ${hazard.location}</p>
                    <p><strong>Advice:</strong> ${getAdvice(hazard)}</p>
                `;
                alertsList.appendChild(alertItem);
            });
        }

        function getMarkerIcon(severity) {
            let color;
            switch (severity) {
                case 'High': color = 'red'; break;
                case 'Moderate': color = 'orange'; break;
                case 'Low': color = 'yellow'; break;
                default: color = 'gray';
            }

            return L.divIcon({
                className: 'custom-icon',
                html: `<div style="background-color: ${color}; width: 20px; height: 20px; border-radius: 50%;"></div>`
            });
        }

        function getAdvice(hazard) {
            switch (hazard.severity) {
                case 'High':
                    return `Immediate action required. Seek shelter, avoid affected areas, and follow local authorities' instructions.`;
                case 'Moderate':
                    return `Stay informed and be prepared. Consider evacuating if advised by local authorities.`;
                case 'Low':
                    return `Monitor the situation and be ready to act if conditions worsen. Stay alert for updates.`;
                default:
                    return `Keep an eye on local news and updates for any changes in the situation.`;
            }
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    alert("User denied the request for Geolocation.");
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert("Location information is unavailable.");
                    break;
                case error.TIMEOUT:
                    alert("The request to get user location timed out.");
                    break;
                case error.UNKNOWN_ERROR:
                    alert("An unknown error occurred.");
                    break;
            }
        }
    </script>
</body>
</html>
