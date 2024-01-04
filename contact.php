<?php
// Database connection parameters
$host = 'localhost';
$usernameDB = 'root';
$passwordDB = '';
$dbname = 'project'; // Change this to your actual database name
$table = 'contact'; // Change this to your actual table name

// Create a database connection
$conn = new mysqli($host, $usernameDB, $passwordDB, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $fullName = $_POST['full_name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert data into the "contact" table
    $stmt = $conn->prepare("INSERT INTO $table (full_name, email, message) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $fullName, $email, $message);

    if ($stmt->execute()) {
        echo "Data inserted successfully!";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
