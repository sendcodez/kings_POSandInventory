<?php
include('db_connect.php');

// Get the current date
$currentDate = date('Y-m-d');

// Query the database to count expired products from both tables
$sql = "SELECT COUNT(*) as expired_count FROM (
    SELECT expiration_date FROM products WHERE expiration_date <= '$currentDate'
    UNION ALL
    SELECT expiration_date FROM ingredients WHERE expiration_date <= '$currentDate'
) AS combined_expired";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch the count
    $row = $result->fetch_assoc();
    $expiredCount = $row['expired_count'];
} else {
    $expiredCount = 0; // Default to 0 if no expired products found
}

// Return the count as plain text
echo $expiredCount;
?>
    