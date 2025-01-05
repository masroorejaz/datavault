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
    <title>Table Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    
    <?php include('menu.php') ?>

    <!-- Main Content -->
    <div class="main-content">
        <h3>Table of Random Names</h3>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    
                    // Fetch data from the userlist table
                    $sql = "SELECT name FROM userlist";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        $index = 1;
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>$index</td>
                                    <td>{$row['name']}</td>
                                  </tr>";
                            $index++;
                        }
                    } else {
                        echo "<tr><td colspan='2'>No data found</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
