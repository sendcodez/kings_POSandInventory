<?php
include '../db_connect.php';

if(isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // Perform your database query to check ingredient availability
    $query = $conn->prepare("
        SELECT SUM(i.stocks - (pi.measurement * oi.qty)) AS available
        FROM product_ingredients AS pi
        JOIN ingredients AS i ON pi.ingredients_id = i.id
        JOIN order_items AS oi ON pi.product_id = oi.product_id
        WHERE pi.product_id = ?
        GROUP BY pi.product_id;
    ");
    $query->bind_param('i', $productId);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        // Fetch available quantity from the result
        $row = $result->fetch_assoc();
        $available = $row['available'];

        // Return the available quantity as the response
        echo $available;
    } else {
        // Handle if no result is found
        echo "0"; // or any appropriate value
    }

    // Close the database connection
    $query->close();
    $conn->close();
} else {
    // Handle if productId is not set in the POST request
    echo "0"; // or any appropriate value
}

?>
