<?php
// Check if the user is logged in and has the plumber role
if ($_SESSION['role'] == 'plumber') {
    // Display assigned and pending orders for the logged-in plumber
    // Query the database for orders assigned to this plumber
    // Display the orders with details and status
} else {
    // Redirect to the client dashboard or login page
    header("Location: client_dashboard.php");
    exit();
}
?>
