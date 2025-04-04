<?php
if(isset($_POST['firstname'])){
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
else {
    //echo "Connected successfully";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword=$_POST['confirm-password'];
    $phoneno=$_POST['pnum'];
    $whatsappno=$_POST['wnum'];
    $enroll=$_POST['enum1'];

        // Check if passwords match
        if ($password !== $confirmPassword) {
          echo "Passwords do not match!";
          exit();
      }
  
      // Hash the password
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO studentsignup (firstname,lastname, email, password,confirmpassword,phonenumber,whatsappnumber,enroll) VALUES ('$firstname','$lastname', '$email', '$hashedPassword','$confirmPassword','$phoneno','$whatsappno','$enroll');";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
        header("Location: home.html"); // Replace home.php with your actual home page file
    exit(); 
    } else {
        echo "Error: $sql <br> $conn->error";  }
}

$conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Signup Page</title>
  <link rel="stylesheet" href="styles.css">
  <script src="scriptt.js" defer></script>
</head>
<body>
  <!-- Signup Container -->
  <div class="login-container">
    <div class="login-box">
      <h2>Create an Account</h2>
      <p>Join us to get started</p>
      <form id="signupForm" action="studentsignup.php" method="POST">
        <div class="input-group">
          <label for="firstname">First Name</label>
          <input type="text" id="firstname" name="firstname" required>
        </div>
        <div class="input-group">
          <label for="lastname">Last Name</label>
          <input type="text" id="lastname" name="lastname" required>
        </div>
        <div class="input-group">
          <label for="email">Email</label>
          <input  id="email" name="email" required>
        </div>
        <div class="input-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>
        <div class="input-group">
          <label for="confirm-password">Confirm Password</label>
          <input type="password" id="confirm-password" name="confirm-password" required>
        </div>
        <div class="input-group">
          <label for="phone number">Phone Number</label>
          <input type="tel" id="pnum" name="pnum" required>
        </div>
        <div class="input-group">
          <label for="whatsapp number">WhatsApp Number</label>
          <input type="tel" id="wnum" name="wnum" required>
        </div>
        <div class="input-group">
          <label for="enrollment">Enrollment Number</label>
          <input type="text" id="enum1" name="enum1" required>
        </div>
        <button type="submit" class="login-btn">Sign Up</button>
      </form>
      <div class="signup-link">
        <p>Already have an account? <a href="complain.html">Login</a></p>
      </div>
    </div>
  </div>

  <!--<script src="https://kit.fontawesome.com/a076d05399.js"></script>-->
</body>
</html>