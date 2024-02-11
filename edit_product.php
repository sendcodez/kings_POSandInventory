<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php
// Include your database connection script (db_connect.php) here
include('db_connect.php');

if (isset($_POST['id'])) {
    $product_id = $_POST['id'];

    // Fetch the product data based on the provided product_id
    $query = "SELECT * FROM products WHERE id = $product_id";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $product_data = $result->fetch_assoc();

        // Convert the product data to JSON format
        echo json_encode($product_data);
    } else {
        // Product not found
        echo json_encode(array('error' => 'Product not found'));
    }
} else {
    // Handle the case where 'id' parameter is not provided
    echo json_encode(array('error' => 'Invalid request'));
}



?>