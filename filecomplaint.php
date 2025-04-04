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
    $name = $_POST['name'];
    $rn = $_POST['room'];
    $type = $_POST['issue-type'];
    $desc = $_POST['description'];
    


    // Insert query with column names
    $query = "INSERT INTO complaints (student_name,room,type, description) 
              VALUES ('$name','$rn','$type', '$desc')";

    $data = mysqli_query($conn, $query);

    if ($data) {
        echo "complaint registered successfully";
        //header("Location: home.html"); // Replace home.php with your actual home page file
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
  <title>Report Room Issues</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }
    h1 {
      text-align: center;
      color: #333;
      margin-top: 20px;
    }
    form {
      max-width: 600px;
      margin: 20px auto;
      padding: 20px;
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    label {
      display: block;
      margin-bottom: 8px;
      font-weight: bold;
      color: #555;
    }
    input[type="text"],
    input[type="email"],
    input[type="number"],
    select,
    textarea,
    input[type="file"] {
      width: 100%;
      padding: 10px;
      margin-bottom: 20px;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 16px;
    }
    textarea {
      resize: vertical;
      height: 100px;
    }
    input[type="submit"] {
      background-color: #ff6f61;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      font-size: 16px;
    }
    input[type="submit"]:hover {
      background-color: #ff4a3d;
    }
    .form-group {
      margin-bottom: 20px;
    }
  </style>
  <script>
    function showAlert() {
      alert("Your report has been submitted successfully!");
    }
  </script>
</head>
<body>

  <h1>Report Room Issues</h1>

  <form action="filecomplaint.php" method="POST" enctype="multipart/form-data" onsubmit="showAlert()">
    
   
    <div class="form-group">
      <label for="name">Student Name:</label>
      <input type="text" id="name" name="name" placeholder="Enter your Name" required>

    </div>

    <div class="form-group">
      <label for="room">Room Number:</label>
      <input type="number" id="room" name="room" placeholder="Enter your room number" required>
    </div>

    <!-- Issue Type -->
    <div class="form-group">
      <label for="issue-type">Issue Type:</label>
      <select id="issue-type" name="issue-type" required>
        <option value="">Select an issue type</option>
        <option value="electrical">Electrical Issue</option>
        <option value="plumbing">Plumbing Issue</option>
        <option value="furniture">Furniture Damage</option>
        <option value="cleaning">Cleaning Required</option>
        <option value="other">Other</option>
      </select>
    </div>

    <!-- Issue Description -->
    <div class="form-group">
      <label for="description">Issue Description:</label>
      <textarea id="description" name="description" placeholder="Describe the issue in detail" required></textarea>
    </div>


    <!-- Submit Button -->
    <div class="form-group">
      <input type="submit" value="Submit Report">
    </div>
  </form>

</body>
</html>
