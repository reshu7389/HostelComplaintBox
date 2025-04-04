<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$passwd = "";
$dbname = "revisedhostelcomplaint";

$conn = new mysqli($servername, $username, $passwd, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the original table
$sql = "SELECT * FROM complaints";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Table and Copy Rows</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<table border="1">
    <thead>
        <tr>
            <?php
            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                foreach ($row as $column => $value) {
                    echo "<th>$column</th>";
                }
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='100%'>No results found</td></tr>";
        }
        ?>
    </tbody>
</table>

</body>
</html>