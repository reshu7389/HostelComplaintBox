


<?php
$servername = "localhost";
$username = "root";
$password = "";
$databasename = "revisedhostelcomplaint";

$conn = mysqli_connect($servername , $username , $password , $databasename);

if($conn)
{ 
   // echo "Connnection Ok" ;
}
else { 
    echo "Connection Failed" .mysqli_connect_error();
}
error_reporting(0);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $cpass = $_POST['confirm-password'];
    $pnum = $_POST['pnum'];
    $wnum = $_POST['wnum'];
    $admin = $_POST['admin'];

          //  // Check if passwords match
          //  if ($password !== $confirmPassword) {
          //    echo "Passwords do not match!";
          //    exit();
          //}
      
          // Hash the password
          $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert query with column names
    $query = "INSERT INTO adminsignup (First_Name, Last_Name, Gender, Email, Password, Confirm_Password, Phone_Number, Whatsapp_Number, Admin_ID) 
              VALUES ('$fname', '$lname', '$gender', '$email', '$hashedPassword', '$cpass', '$pnum', '$wnum', '$admin')";

    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "Data inserted into the database successfully!";
    } else {
        echo "Failed to insert data: " . mysqli_error($conn);
    }
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
      
      <form id="signupForm" action="adminsignup.php" method="POST">
        <div class="input-group">
          <label for="firstname">First Name</label>
          <input type="text" id="firstname" name="firstname" required>
        </div>
        <div class="input-group">
          <label for="lastname">Last Name</label>
          <input type="text" id="lastname" name="lastname" required>
        </div>
        <div class="input-group">
          <label for="gender">Gender</label>
          <select id="gender" name="gender" required>
            <option value="">Select Gender</option>
            <option value="male">Male</option>
            <option value="female">Female</option>
          </select>
        </div>
        <div class="input-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email"  required>
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
          <label for="adminid">Admin ID</label>
          <input type="text" id="admin" name="admin" required>
        </div>
        <button type="submit" class="login-btn" name = "submit">Sign Up</button>
      </form>
      <div class="signup-link">
        <p>Already have an account? <a href="index.html">Login</a></p>
      </div>
      <?php if (isset($signup_error)) { ?>
          <p style="color: red;"><?php echo $signup_error; ?></p>
      <?php } ?>
    </div>
  </div>

 <!-- <script src="https://kit.fontawesome.com/a076d05399.js"></script>-->
</body>
</html>
