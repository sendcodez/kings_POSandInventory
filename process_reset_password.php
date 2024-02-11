<?php
include('./db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['reset_password'])) {
    // Validate the form data
    $email = $_POST['email'];
    $token_reset = $_POST['token_reset'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    

    // Validate email, token_reset, and password values

    // Check if the provided email and token match a user in the database
    $check_query = "SELECT * FROM users WHERE email = ? AND reset_token = ? AND token_expiry > NOW()";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $email, $token_reset);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Valid reset link, update the user's password
        if ($new_password == $confirm_password) {
            // Hash the new password using MD5 before storing it in the database
            $hashed_password = md5($new_password);
        
            // Update the user's password in the database
            $update_query = "UPDATE users SET password = ?, reset_token = NULL, token_expiry = NULL WHERE email = ?";
            $stmt = $conn->prepare($update_query);
            $stmt->bind_param("ss", $hashed_password, $email);
            $stmt->execute();
            $stmt->close();

            echo "Password reset successfully. You can now <a href='login.php'>login</a> with your new password.";
        } else {
            echo "New password and confirm password do not match. Please try again.";
        }
    } else {
        // Invalid or expired reset link
        echo "Invalid or expired reset link. Please try again.";
    }
} else {
    // Invalid request
    echo "Invalid request. Please submit the password reset form.";
}
?>
