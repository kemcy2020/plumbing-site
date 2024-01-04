<?php
// Database connection parameters
$host = 'localhost';
$usernameDB = 'root';
$passwordDB = '';
$dbname = 'project'; // Change this to your actual database name
$plumbersTable = 'plumber'; // Change this to your actual plumbers table name

// Create a database connection
$conn = new mysqli($host, $usernameDB, $passwordDB, $dbname);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve data from the "plumbers" table
$plumbersSql = "SELECT * FROM $plumbersTable";
$plumbersResult = $conn->query($plumbersSql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Plumbers</title>
    <style>
        /* Add your styles here */
    </style>
</head>
<body>

    <h2>Plumbers Information</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Location</th>
                <th>Quotation</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $plumbersResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "<td>" . $row['quote'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
