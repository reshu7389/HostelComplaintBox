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

// Fetch data from the complaints table
$sql = "SELECT * FROM complaints";
$result = $conn->query($sql);

$complaints = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $complaints[] = $row;
    }
}

// Fetch open complaints count
$openComplaintsSql = "SELECT COUNT(*) as open_count FROM complaints; 
$openComplaintsResult = $conn->query($openComplaintsSql);
$openComplaintsRow = $openComplaintsResult->fetch_assoc();
$openComplaintsCount = $openComplaintsRow['open_count'];

// Fetch resolved complaints count

$resolvedComplaintsSql = "SELECT COUNT(*) as resolved_count FROM resolvedcomplaints";
$resolvedComplaintsResult = $conn->query($resolvedComplaintsSql);
$resolvedComplaintsRow = $resolvedComplaintsResult->fetch_assoc();
$resolvedComplaintsCount = $resolvedComplaintsRow['resolved_count'];

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hostel Complaint Dashboard</title>
    <style>
        .statistics-section {
            display: flex;
            justify-content: space-around;
        }

        .stat-card {
            border: 1px solid #ccc;
            padding: 20px;
            text-align: center;
            cursor: pointer;
        }

        .complaints-table {
            margin-top: 20px;
        }

        #total-complaints-section {
            display: none;
        }
    </style>
</head>
<body>
    <header class="main-header">
        <h1>Complaint Dashboard</h1>
    </header>
    <div class="dashboard-container">
        <nav class="home-link">
            <a href="home.html">Home</a>
        </nav>
        <nav class="logout-link">
            <a href="index.html">Logout</a>
        </nav>

        <section class="statistics-section">
            <div class="stat-card" id="open-complaints-card">
                <h3>Open Complaints</h3>
                <p><?php echo $openComplaintsCount; ?></p>
            </div>
            <div class="stat-card" id="total-complaints-card">
                <h3>Total Complaints</h3>
                <p><?php echo count($complaints); ?></p>
            </div>
            <div class="stat-card" id="resolved-complaints-card">
                <h3>Resolved Complaints</h3>
                <p><?php echo $resolvedComplaintsCount; ?></p>
            </div>
        </section>

        <section class="complaints-table" id="open-complaints-section">
            <h2>Open Complaints</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Room Number</th>
                        <th>Issue</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($complaints as $complaint) : ?>
                        <?php if ($complaint['status'] === 'open') : ?>
                            <tr>
                                <td><?php echo $complaint['name']; ?></td>
                                <td><?php echo $complaint['room_number']; ?></td>
                                <td><?php echo $complaint['issue']; ?></td>
                                <td><?php echo $complaint['status']; ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>

        <section class="complaints-table" id="total-complaints-section">
            <h2>Total Complaints</h2>
            <table>
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Room Number</th>
                        <th>Issue</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($complaints as $complaint) : ?>
                        <tr>
                            <td><?php echo $complaint['name']; ?></td>
                            <td><?php echo $complaint['room_number']; ?></td>
                            <td><?php echo $complaint['issue']; ?></td>
                            <td><?php echo $complaint['status']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
    </div>

<script>
    document.getElementById('total-complaints-card').addEventListener('click', function(){
        document.getElementById('total-complaints-section').style.display = 'block';
        document.getElementById('open-complaints-section').style.display = 'none';
    });

    document.getElementById('open-complaints-card').addEventListener('click', function(){
        document.getElementById('total-complaints-section').style.display = 'none';
        document.getElementById('open-complaints-section').style.display = 'block';
    });

</script>
</body>
</html>