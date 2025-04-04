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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['selected_rows'])) {
    $selectedRows = $_POST['selected_rows'];

    foreach ($selectedRows as $rowId) {
        // Fetch the row data based on the ID
        $selectRowSql = "SELECT * FROM complaints WHERE id = ?";
        $stmt = $conn->prepare($selectRowSql);
        $stmt->bind_param("i", $rowId);
        $stmt->execute();
        $rowResult = $stmt->get_result();
        $rowData = $rowResult->fetch_assoc();
      

       if ($rowData) {
           // Prepare and execute the INSERT query to the new table
           $columns = implode(", ", array_keys($rowData));
           $values = implode("', '", array_values($rowData));
           $insertSql = "INSERT INTO resolvedcomplaints ($columns) VALUES ('$values')";

           if ($conn->query($insertSql) === TRUE) {
               echo "Row with ID $rowId copied successfully.<br>";
           } else {
               echo "Error copying row with ID $rowId: " . $conn->error . "<br>";
           }
       }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Table and Copy Rows</title>
</head>
<body>

<form method="post">
    <table border="1">
        <thead>
            <tr>
                <th>Select</th>
                <?php
                if ($result && $result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    foreach ($row as $column => $value) {
                        echo "<th>$column</th>";
                    }
                    $result->data_seek(0); // Reset the result pointer
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td><input type='checkbox' name='selected_rows[]' value='" . $row['id'] . "'></td>"; // Assuming 'id' is your primary key
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
    <br>
    <input type="submit" value="Copy Selected Rows">
</form>

</body>
</html>