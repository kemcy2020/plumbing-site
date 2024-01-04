<?php
// Database connection parameters
$host = 'localhost';
$usernameDB = 'root';
$passwordDB = '';
$dbname = 'project'; // Change this to your actual database name
$contactTable = 'contact'; // Change this to your actual contact table name
$ordersTable = 'orders'; // Change this to your actual orders table name

// Create a database connection
$conn = new mysqli($host, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize filter variables
$nameFilter = "";
$serviceFilter = "";
$locationFilterOrders = "";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nameFilter = isset($_POST["name_filter"]) ? $_POST["name_filter"] : "";
    $serviceFilter = isset($_POST["service_filter"]) ? $_POST["service_filter"] : "";
    $locationFilterOrders = isset($_POST["location_filter_orders"]) ? $_POST["location_filter_orders"] : "";
}

// Retrieve data from the "contact" table with filters
$contactSql = "SELECT * FROM $contactTable WHERE full_name LIKE '%$nameFilter%'";
$contactResult = $conn->query($contactSql);

// Retrieve data from the "orders" table with filters
$ordersSql = "SELECT * FROM $ordersTable WHERE name LIKE '%$nameFilter%' AND service LIKE '%$serviceFilter%' AND location LIKE '%$locationFilterOrders%'";
$ordersResult = $conn->query($ordersSql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data</title>
    <link rel="stylesheet" type="text/css" href="dash.css"> <!-- You may need to adjust the path -->
</head>
<body>

    <h2>Contact Information</h2>
    
    <!-- Filter Form for Contact Information -->
    <form method="post" action="">
        <label for="name_filter">Filter by Name:</label>
        <input type="text" name="name_filter" value="<?php echo $nameFilter; ?>">
        
        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $contactResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['full_name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['message'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>

    <h2>Orders Information</h2>
    
    <!-- Filter Form for Orders Information -->
    <form method="post" action="">
        <label for="name_filter">Filter by Name:</label>
        <input type="text" name="name_filter" value="<?php echo $nameFilter; ?>">
        
        <label for="service_filter">Filter by Service:</label>
        <input type="text" name="service_filter" value="<?php echo $serviceFilter; ?>">

        <label for="location_filter_orders">Filter by Location:</label>
        <input type="text" name="location_filter_orders" value="<?php echo $locationFilterOrders; ?>">
        
        <button type="submit">Filter</button>
    </form>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Location</th>
                <th>File</th>
                <th>Service</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $ordersResult->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['location'] . "</td>";
                echo "<td>" . $row['file'] . "</td>";
                echo "<td>" . $row['service'] . "</td>";
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
