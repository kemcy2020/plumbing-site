<?php
// Database connection parameters
$host = 'localhost';
$usernameDB = 'root';
$passwordDB = '';
$dbname = 'project';
$table = 'orders';

// Create a database connection
$conn = new mysqli($host, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $file = $_POST['file']; // Note: This should be modified if you are uploading files
    $service = $_POST['service'];

    // Insert data into the "orders" table
    $stmt = $conn->prepare("INSERT INTO $table (name, email, location, file, service) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $location, $file, $service);

    if ($stmt->execute()) {
        echo "Order submitted successfully!";
          header("Location: home.html");
    } else {
        echo "Error submitting order: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
