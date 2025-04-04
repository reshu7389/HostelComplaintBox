<?php
session_start();

// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "revisedhostelcomplaint";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Verification logic
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $admin = $_POST['admin'];
    $password = $_POST['password']; // IMPORTANT: Hash this password during signup.

    // Prepared statement to prevent SQL injection
    $sql = "SELECT Admin_ID, First_Name, password FROM adminsignup WHERE Admin_ID = ?"; // Changed table name to adminlogin
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $admin);

    if ($stmt->execute()) {
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $firstname, $hashed_password); // Bind results including password
            $stmt->fetch();

            // Verify the password using password_verify()
            if (password_verify($password, $hashed_password)) { // Very Important.
                $_SESSION['admin_id'] = $id; // Changed session variable to admin_id
                $_SESSION['admin_firstname'] = $firstname; // Changed session variable
                $_SESSION['admin_email'] = $email;  // Changed session variable

                header("Location: home.html"); // Redirect to admin dashboard
                exit();
            } else {
                echo "Invalid email or password"; // Wrong password.
            }
        } else {
            echo "Invalid email or password"; // Email not found.
        }
    } else {
        echo "Error: " . $stmt->error; // Database error.
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="styles.css">
  <!--<script src="script.js" defer></script>-->
</head>
<body>
  <!-- Splash Screen -->
  <div id="splash-screen">
    <div class="splash-content"></div>
      <div class="splash-loader"></div>
    </div>
  </div>

  <!-- Login Container -->
  <div class="login-container">
    <div class="login-box">
      <h2>Welcome Back</h2>
      <p>Please login to your account</p>

      <form id="loginForm" action="adminlogin.php" method="POST">
        <div class="input-group">
          <label for="admin">Admin ID</label>
          <input type="text" id="admin" name="admin" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <button type="submit" class="login-btn">Login</button>
      </form>
      <div class="signup-link">
        <p>Don't have an account? <a href="index.html">Sign Up</a></p>
      </div>
    </div>
  </div>

  <!--<script src="https://kit.fontawesome.com/a076d05399.js"></script>-->
</body>
</html>