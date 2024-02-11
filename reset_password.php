<?php
session_start();
include('./db_connect.php');
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['email']) && isset($_GET['token_reset'])) {
    $email = $_GET['email'];
    $token_reset = $_GET['token_reset'];

    // Validate email and token_reset values

    // Check if the provided email and token match a user in the database
    $check_query = "SELECT * FROM users WHERE email = ? AND reset_token = ? AND token_expiry > NOW()";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $email, $token_reset);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();

    if ($result->num_rows > 0) {
        // Valid reset link, allow the user to reset the password
        // Display the password reset form
        ?>
        <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
 	

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");

?>

</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    position: fixed;
	    top:0;
	    left: 0
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		display: flex;
	}
	.navbar{
		background-color: black;
	}

	.button{
		background-color: #D78C15;
		border:none;
		color: white;
		padding: 5px 10px;
	}
	@media screen and (max-width: 767px) {
		.card-body{
			margin-top:35px;
		}
		.fixed-bottom{
			height: 35%;
		}
		.kings{
			width: 100%;
		}
}

@media screen and (max-width: 1246px) {
		.card-body{
			margin-top:35px;
			
		}
		.fixed-bottom{
			height: 35%;
		}
		.logo{
			width: 100%;
			margin-bottom: 10px;
		}
		
}



</style>

<body>

<nav class="navbar navbar-light fixed-top" style="padding:0">
  <div class="container-fluid mt-2 mb-2 ">
	<!--LOGO PIC-->
  		  <img src ="kingcoffee.jpg" class="kings rounded mx-auto d-block" style="height:8rem; width:">
</div>
</nav>
  <main id="main" >
  		<div class="align-self-center w-100">
  		<div id="login-center" class="bg-white row justify-content-center">
          
  			<div class=" col-md-4">
  				<div class="card-body">
                  <form method="post" action="process_reset_password.php">
                  <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
          <input type="hidden" name="token_reset" value="<?php echo htmlspecialchars($token_reset); ?>">
                  <div class="form-group">
        <label for="email" class="control-label" style="font-size:20px;">New Password</label>
        <input type="password" id="new_password" name="new_password" class="form-control" style="font-size:20px;">
    </div>
    <div class="form-group">
        <label for="email" class="control-label" style="font-size:20px;">Confirm Password</label>
        <input type="password" id="confirm_password" name="confirm_password" class="form-control" style="font-size:20px;">
    </div>
    <center>
        <button class="button btn-sm btn-block btn-wave col-md-5" name="reset_password" style="font-size:20px;">Reset Password</button>
    </center>
</form>

  				</div>
  			</div>
  		</div>
  		</div>
  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

<!--BOTTOM PIC-->

  <div class="fixed-bottom">
  		  <img src ="bottom.png" style="height:12rem; width:100%;">
  </div>


</body>

</html>
        <?php
    } else {
        // Invalid or expired reset link
        echo "Invalid or expired reset link. Please try again.";
    }
} else {
    // Missing required parameters
    echo "Invalid request. Please provide email and token_reset parameters.";
}
?>
