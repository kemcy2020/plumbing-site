<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Using prepared statement to prevent SQL injection
    $sql = "SELECT * FROM plumber WHERE email = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameter
    $stmt->bind_param("s", $email);

    // Execute the statement
    $stmt->execute();

    // Get result
    $result = $stmt->get_result();

    // Check if the user exists
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            // Redirect to home after successful login
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Incorrect password";
        }
    } else {
        echo "Plumber not found";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="log.css">
  <title>Login Form</title>
</head>
<body>

  <form action="" method="POST">
    <h1>Plumber Login</h1>
    <label for="loginEmail">Email:</label>
    <input type="email" id="loginEmail" name="email" required>
    <label for="loginPassword">Password:</label>
    <input type="password" id="loginPassword" name="password" required>
    <button type="submit">Login</button>

    <p>Don't have an account? <a href="plumber.html">Register here</a></p>
  </form>

</body>
</html>
