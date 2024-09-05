<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disaster Reporting Tool</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* Add your CSS here or include it in styles.css */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Montserrat', sans-serif;
        }

        body {
            background-color: #f0f8ff;
            color: #333;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            position: relative;
        }

        .hero {
            background: url('natural.jpg') no-repeat center center/cover;
            height: 60vh;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff;
            text-align: center;
        }

        .hero-content h1, .hero-content p {
            text-shadow: 2px 2px 4px #000000;
        }

        .hero h1 {
            font-size: 3rem;
            margin-bottom: 10px;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 20px;
        }

        .container {
            flex: 1;
            padding: 40px 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        section.features {
            text-align: center;
        }

        .features h2 {
            font-size: 2rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #0056b3;
        }

        .feature-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            justify-content: center;
        }

        .feature-card {
            background: #e6f2ff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .feature-image-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .feature-card img {
            max-width: 80px;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #003366;
        }

        .feature-card p {
            color: #666;
            margin-bottom: 20px;
        }

        .btn-primary {
            background-color: #004080;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            font-size: 1rem;
            align-self: center;
        }

        .btn-primary:hover {
            background-color: #003366;
            transform: scale(1.05);
        }

        .btn-secondary {
            background-color: #0099cc;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            align-self: center;
        }

        .btn-secondary:hover {
            background-color: #007acc;
            transform: scale(1.05);
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.4);
        }

        .modal-content {
            background-color: #ffffff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close-btn {
            background-color: #004080;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        .close-btn:hover {
            background-color: #003366;
        }

        footer {
            background-color: #003366;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .footer-logo {
            width: 120px;
            margin-bottom: 15px;
        }

        footer p {
            margin-bottom: 5px;
        }

        footer a {
            color: #66ccff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <header>
        <div class="hero">
            <div class="hero-content">
                <h1>Disaster Reporting Tool</h1>
                <p>Manage and report disasters efficiently with ease.</p>
            </div>
        </div>
    </header>

    <div class="container">
        <section class="features">
            <h2>Our Features</h2>
            <div class="feature-grid">
                <div class="feature-card reveal">
                    <div class="feature-image-wrapper">
                        <img src="alert.jpg" alt="Disaster Alerts Page">
                    </div>
                    <h3>Disaster Alerts Page</h3>
                    <p>View current disaster warnings and receive push notifications.</p>
                    <a href="disaster-alerts.php" class="btn-secondary">Know More</a>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-image-wrapper">
                        <img src="error.png" alt="Report a Disaster">
                    </div>
                    <h3>Report a Disaster</h3>
                    <p>Provide detailed information about disasters and help us respond faster.</p>
                    <a href="report-form.php
                    " class="btn-secondary">Go to Report Form</a>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-image-wrapper">
                        <img src="stats.png" alt="Disaster Statistics">
                    </div>
                    <h3>Disaster Statistics</h3>
                    <p>Visualize real-time disaster data with graphs and heat maps.</p>
                    <a href="disaster-stats.html" class="btn-secondary">Know More</a>
                </div>

                <div class="feature-card reveal">
                    <div class="feature-image-wrapper">
                        <img src="relief.png" alt="Relief Fund">
                    </div>
                    <h3>Relief Fund</h3>
                    <p>Learn about ongoing relief efforts and how you can contribute to the disaster response.</p>
                    <a href="reliefefforts.html" class="btn-secondary">Know More</a>
                </div>
            </div>
        </section>
    </div>

    <div id="reportModal" class="modal">
        <div class="modal-content">
            <h2>Report a Disaster</h2>
            <p>Please provide detailed information about the disaster in your area.</p>
            <a href="report-form.html" class="btn-primary">Go to Report Form</a>
            <button class="close-btn" onclick="closeModal()">Close</button>
        </div>
    </div>

    <footer>
        <p>&copy; 2024 Disaster Reporting Tool. All rights reserved.</p>
        <p>Contact us at: <a href="mailto:support@disasterreportingtool.com">support@disasterreportingtool.com</a></p>
    </footer>

    <script src="scripts.js"></script>
</body>
</html>
