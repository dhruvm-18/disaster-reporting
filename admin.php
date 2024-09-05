<?php
@include 'config.php'; // Ensure this file contains the correct PDO connection setup

session_start();

// Define static mapping for demonstration purposes
$villageMapping = [
    ['lat_min' => 26.00, 'lat_max' => 27.00, 'long_min' => 75.00, 'long_max' => 76.00, 'village' => 'Jaipur'],
    ['lat_min' => 24.00, 'lat_max' => 25.00, 'long_min' => 73.00, 'long_max' => 74.00, 'village' => 'Udaipur'],
    ['lat_min' => 26.00, 'lat_max' => 27.00, 'long_min' => 70.00, 'long_max' => 71.00, 'village' => 'Jaisalmer'],
    ['lat_min' => 28.00, 'lat_max' => 29.00, 'long_min' => 73.00, 'long_max' => 74.00, 'village' => 'Bikaner']
];

function getVillageName($latitude, $longitude, $mapping) {
    foreach ($mapping as $entry) {
        if ($latitude >= $entry['lat_min'] && $latitude <= $entry['lat_max'] &&
            $longitude >= $entry['long_min'] && $longitude <= $entry['long_max']) {
            return $entry['village'];
        }
    }
    return 'Unknown';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
        .alert-button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }
        .alert-button:hover {
            background-color: #0056b3;
        }
        .alert-sent {
            color: green;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1>Admin Dashboard</h1>
        </div>
    </header>

    <div class="container">
        <section class="form-section">
            <h2>Reports</h2>
            <table>
                <thead>
                    <tr>
                        <th>Disaster Type</th>
                        <th>Severity</th>
                        <th>Description</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="report-table-body">
                    <?php
                    // Fetch data from the reportt table
                    try {
                        $sql = "SELECT id, disaster_type, severity, description, location FROM reportt ORDER BY FIELD(severity, 'Critical', 'Severe', 'Moderate', 'Minor'), location";
                        $stmt = $conn->prepare($sql);
                        $stmt->execute();

                        // Check if rows exist
                        if ($stmt->rowCount() > 0) {
                            // Fetch each row as an associative array
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                // Get village name (if needed)
                                // For the current case, you can just display the location as-is
                                $villageName = 'Unknown'; // If you want to show the village name, adjust this part

                                // Output row
                                echo "<tr data-id='{$row['id']}'>";
                                echo "<td>{$row['disaster_type']}</td>";
                                echo "<td>{$row['severity']}</td>";
                                echo "<td>{$row['description']}</td>";
                                echo "<td>{$row['location']}</td>"; // Directly show the full location
                                echo "<td><button class='alert-button' onclick=\"sendAlert('{$row['severity']}', '{$row['disaster_type']}', '{$row['location']}')\">Send Alert</button></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='5'>No reports found</td></tr>";
                        }
                    } catch (PDOException $e) {
                        echo "Error: " . $e->getMessage();
                    }

                    // Close connection
                    $conn = null;
                    ?>
                </tbody>
            </table>
            <div id="alert-status"></div>
        </section>
    </div>

    <script>
        const volunteers = {
            'Jaisalmer': 'Rajesh Kumar',
            'Udaipur': 'Sita Devi',
            'Jaipur': 'Ravi Sharma',
            'Bikaner': 'Amit Singh'
        };

        const processedReports = new Set();

        function sendAlert(severity, disasterType, location) {
            const reportId = `${severity}-${disasterType}-${location}`;
            if (processedReports.has(reportId)) {
                console.log(`Alert already sent for report: ${reportId}`);
                return;
            }

            let message = `Alert! There is a ${disasterType} in ${location}. Severity: ${severity}. Volunteer ${volunteers[location] || 'assigned volunteer'}, please respond accordingly.\n\n`;

            switch (severity) {
                case 'Critical':
                    message += "Urgent: Immediate evacuation and emergency response needed. Ensure all safety protocols are followed.";
                    break;
                case 'Severe':
                    message += "High: Prepare for potential evacuations and ensure all safety measures are in place.";
                    break;
                case 'Moderate':
                    message += "Medium: Monitor the situation closely and prepare for possible escalation.";
                    break;
                case 'Minor':
                    message += "Low: Keep an eye on the situation and be prepared to assist if necessary.";
                    break;
            }

            alert(`Alert Sent!\n\n${message}`);
            processedReports.add(reportId);

            const alertStatus = document.getElementById('alert-status');
            alertStatus.innerHTML = `<p class="alert-sent">Alert sent for report: ${message}</p>`;
        }
    </script>
</body>
</html>
