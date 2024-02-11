<?php
include '../db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input data
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $cashierName = isset($_POST['cashierName']) ? trim($_POST['cashierName']) : '';
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;

    // Check the entered password
    if ($password === 'test') {
        // Password is correct, proceed to void the item
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        // Validate and sanitize data before inserting into the database
        $cashierName = mysqli_real_escape_string($conn, $cashierName);
        $price = mysqli_real_escape_string($conn, $price);

        // Insert data into the database
        $sql = "INSERT INTO void (cashier_name, price, date) VALUES ('$cashierName', $price, '$date')";

        if ($conn->query($sql)) {
            echo 'Success';  // Return a success message to the JavaScript
        } else {
            echo 'Error: ' . $conn->error;  // Return an error message if the SQL query fails
        }
    } else {
        echo 'Failed';  // Return a message indicating an incorrect password
    }

    // Close the database connection
    $conn->close();
}
?>
