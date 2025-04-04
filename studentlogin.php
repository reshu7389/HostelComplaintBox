<?php
session_start(); // Start the session

// Database connection details (replace with your actual credentials)
$servername = "localhost";
$username = "root";
$passwd = "";
$dbname = "revisedhostelcomplaint";

// Function to sanitize user input (prevent SQL injection)
function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user input
    //$username = sanitizeInput($_POST["firstname"]);
    $enroll = sanitizeInput($_POST["enroll"]);
    $password = sanitizeInput($_POST["password"]);

    // Create a database connection
    $conn = new mysqli($servername, $username, $passwd, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the SQL query (using prepared statements for security)
    $stmt = $conn->prepare("SELECT enroll, password FROM studentsignup WHERE enroll = ?");
    $stmt->bind_param("s", $enroll);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($user_id, $hashed_password);
        $stmt->fetch();

        // Verify the password using password_verify()
        if (password_verify($password, $hashed_password)) {
            // Login successful
            $_SESSION["user_id"] = $user_id; // Store user ID in session
            $_SESSION["username"] = $enroll; // store username in session
            $_SESSION["loggedin"] = true; // store login status in session.
            header("Location: home.html"); // Redirect to welcome page
            exit();
        } else {
            // Incorrect password
            $login_error = "Incorrect username or password.";
        }
    } else {
        // User not found
        $login_error = "Incorrect username or password.";
    }

    $stmt->close();
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
  <div class="login-container">
    <div class="login-box">
      <h2>Welcome Back</h2>
      <p>Please login to your account</p>

      <form id="loginForm" action="studentlogin.php" method="POST">
        <div class="input-group">
          <label for="enroll">Enrollment Number</label>
          <input type="text" id="enroll" name="enroll" required>
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
      <?php if (isset($login_error)) { ?>
          <p style="color: red;"><?php echo $login_error; ?></p>
      <?php } ?>
    </div>
  </div>
</body>
</html>