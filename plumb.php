<?php
$servername = "localhost";
$username = "root";
$password = ""; // Leave it empty for a null password
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $location = $_POST["location"];
    $quote = $_POST["quote"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Using prepared statement to prevent SQL injection
    $sql = "INSERT INTO plumber (name, email, phone, location, quote, password) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameters
    $stmt->bind_param("ssssss", $name, $email, $phone, $location, $quote, $password);

    // Execute the statement
    $result = $stmt->execute();

    // Check if the query was successful
    if ($result) {
        // Redirect to home after successful registration
        header("Location: plumberlogin.html");
        exit();
    } else {
        echo "Error in registration: " . $conn->error;
    }
}

// Close the connection
$conn->close();
?>
