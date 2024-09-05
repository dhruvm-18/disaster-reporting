<?php
@include 'config.php'; // Include the PDO connection setup

// Enable error reporting for debugging


session_start();

$message = '';

if (isset($_POST['submit_report'])) {
   // Debugging line to check form data
    try {
        // Sanitize input data
        $disaster_type = htmlspecialchars($_POST['disaster-type'], ENT_QUOTES, 'UTF-8');
        $severity = htmlspecialchars($_POST['severity'], ENT_QUOTES, 'UTF-8');
        $description = htmlspecialchars($_POST['description'], ENT_QUOTES, 'UTF-8');
        $location = htmlspecialchars($_POST['location'], ENT_QUOTES, 'UTF-8');

        // Prepare and execute the SQL query
        $stmt = $conn->prepare("INSERT INTO reportt (disaster_type, severity, description, location) VALUES (?, ?, ?, ?)");
        $success = $stmt->execute([$disaster_type, $severity, $description, $location]);

        if ($success) {
            $message = 'Report submitted successfully!';
        } else {
            $message = 'Failed to submit report. Please try again.';
        }
    } catch (PDOException $e) {
        $message = 'Error: ' . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Form</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Add custom styles here */
        .form-group {
            position: relative;
        }

        .location-icon {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            cursor: pointer;
            font-size: 20px;
        }

        .form-actions {
            text-align: center;
        }

        .message {
            color: green;
            text-align: center;
            margin-top: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1>Report a Disaster</h1>
            <a href="index.php" class="btn-primary">Back to Home</a>
        </div>
    </header>

    <div class="container">
        <section class="form-section">
            <form action="" method="POST" id="report-form">
                <div class="form-group">
                    <label for="disaster-type">Disaster Type:</label>
                    <select id="disaster-type" name="disaster-type" required>
                        <option value="" disabled selected>Select a disaster type</option>
                        <option value="earthquake">Earthquake</option>
                        <option value="flood">Flood</option>
                        <option value="wildfire">Wildfire</option>
                        <option value="hurricane">Hurricane</option>
                        <option value="tornado">Tornado</option>
                        <option value="storm">Storm</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="severity">Severity Level:</label>
                    <select id="severity" name="severity" required>
                        <option value="" disabled selected>Select severity level</option>
                        <option value="minor">Minor</option>
                        <option value="moderate">Moderate</option>
                        <option value="severe">Severe</option>
                        <option value="critical">Critical</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="5" placeholder="Provide a detailed description of the disaster" required></textarea>
                </div>
                
                <div class="form-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" placeholder="Enter location" required>
                    <button type="button" id="get-location" class="location-icon">
                        📍
                    </button>
                </div>

                <div class="form-actions">
                    <input type="submit" class="btn-primary" value="Submit Report" name="submit_report">
                </div>
            </form>

            <?php
            if (!empty($message)) {
                echo "<p class='message'>$message</p>";
            }
            ?>
        </section>
    </div>

    <script>
        document.getElementById('get-location').addEventListener('click', function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                alert('Geolocation is not supported by this browser.');
            }
        });

        function showPosition(position) {
            const lat = position.coords.latitude;
            const lon = position.coords.longitude;
            const locationInput = document.getElementById('location');

            const reverseGeocodeUrl = `https://nominatim.openstreetmap.org/reverse?lat=${lat}&lon=${lon}&format=json&addressdetails=1`;

            fetch(reverseGeocodeUrl)
                .then(response => response.json())
                .then(data => {
                    if (data && data.address) {
                        const address = data.display_name;
                        locationInput.value = address;
                    } else {
                        alert('Unable to retrieve address from coordinates.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while fetching the address.');
                });
        }

        function showError(error) {
            switch(error.code) {
                case error.PERMISSION_DENIED:
                    alert('User denied the request for Geolocation.');
                    break;
                case error.POSITION_UNAVAILABLE:
                    alert('Location information is unavailable.');
                    break;
                case error.TIMEOUT:
                    alert('The request to get user location timed out.');
                    break;
                case error.UNKNOWN_ERROR:
                    alert('An unknown error occurred.');
                    break;
            }
        }
    </script>
</body>
</html>
