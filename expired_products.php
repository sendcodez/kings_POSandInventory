<?php
include('db_connect.php');

// Initialize an empty array to store the list of expired products
$expiredProducts = array();

// Query the database to get a list of expired products
$currentDate = date('Y-m-d'); // Get the current date
$sql = "SELECT name, expiration_date FROM products WHERE expiration_date <= '$currentDate'
UNION
SELECT name, expiration_date FROM ingredients WHERE expiration_date <= '$currentDate'";
$result = $conn->query($sql);

// Check if there are expired products
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $expiredProducts[] = array(
            'name' => $row['name'],
            'expiration_date' => $row['expiration_date']
        );
    }
}


echo json_encode($expiredProducts);
?>
