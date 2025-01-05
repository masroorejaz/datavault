<?php 
require('database.php'); 
session_start();
// Check if the user is not logged in (session is not set)
if (isset($_SESSION['user'])) {
    // If the user is not logged in, redirect them to the index page
    header("Location: table.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <h3 class="text-center mb-4">Login</h3>
            <?php
            // Initialize variables
            $message = "";
            $errors = [];
            $username = $password = "";

            // Form submission handling
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $username = trim($_POST['username']);
                $password = trim($_POST['password']);

                // Validation
                if (empty($username)) {
                    $errors['username'] = "Username is required.";
                }

                if (empty($password)) {
                    $errors['password'] = "Password is required.";
                }

                // If no errors, process login
                if (empty($errors)) {
                    // Encrypt password using MD5
                    $encryptedPassword = md5($password);

                    // Check the database
                    $query = "SELECT * FROM admin WHERE username = ? AND password = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("ss", $username, $encryptedPassword);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Login successful
                        $user = $result->fetch_assoc();
                        $_SESSION['user'] = $user['username']; // Store username in session
                        header("Location: table.php");
                        exit();
                    } else {
                        $message = "<div class='alert alert-danger'>Invalid username or password.</div>";
                    }
                }
            }
            ?>

            <!-- Display validation or login messages -->
            <?php if ($message) echo $message; ?>

            <form method="post" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        class="form-control <?php echo isset($errors['username']) ? 'is-invalid' : ''; ?>" 
                        value="<?php echo htmlspecialchars($username); ?>" 
                        placeholder="Enter username" 
                        required>
                    <?php if (isset($errors['username'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['username']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        class="form-control <?php echo isset($errors['password']) ? 'is-invalid' : ''; ?>" 
                        placeholder="Enter password" 
                        required>
                    <?php if (isset($errors['password'])): ?>
                        <div class="invalid-feedback">
                            <?php echo $errors['password']; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
