<?php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['id'];
    $new_status = $_POST['newStatus'];
    
    // Validate and sanitize input here, and perform the database update
    // Example code (you should customize this to fit your database structure):
     $new_status = mysqli_real_escape_string($conn, $new_status);
     $user_id = intval($user_id);
    $query = "UPDATE users SET status = '$new_status' WHERE id = $user_id";
    
    // Execute the query
    $result = mysqli_query($conn, $query);
    
    // Check if the update was successful
    if ($result) {
        echo "success";
    } else {
         echo "error";
     }
}
?>
