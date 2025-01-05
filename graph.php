<?php require('database.php'); 

session_start();

// Check if the user is not logged in (session is not set)
if (!isset($_SESSION['user'])) {
    // If the user is not logged in, redirect them to the index page
    header("Location: index.php");
    exit();
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graph Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include('menu.php') ?>

    <!-- Main Content -->
    <div class="main-content">
        <h3>Pie Chart of Country Population Percentages</h3>
        <canvas id="pieChart"></canvas>
    </div>

    <?php
    // Fetch data from the `reports` table
    $query = "SELECT country_name, country_percentage FROM reports";
    $result = $conn->query($query);

    $labels = [];
    $values = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $labels[] = $row['country_name'];
            $values[] = (float)$row['country_percentage'];
        }
    }

    // Convert PHP data to JavaScript
    echo "
        <script>
            const labels = " . json_encode($labels) . ";
            const dataValues = " . json_encode($values) . ";
        </script>
    ";
    ?>

    <!-- Chart.js Script -->
    <script>
        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: dataValues,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(201, 203, 207, 0.7)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(201, 203, 207, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Country Percentages'
                    }
                }
            }
        });
    </script>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
