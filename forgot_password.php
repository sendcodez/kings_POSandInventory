<?php
session_start();
include('./db_connect.php');
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['forgot_password'])) {
    $email = $_POST['email']; // You may use email or email, depending on your system

    // Validate the email (you might also check if the email exists in your database)
    // If valid, generate a unique token and store it in the database
    $reset_token = generateUniqueToken();
    $timezone = new DateTimeZone('Asia/Manila');
$now = new DateTime('now', $timezone);

// Calculate token_expiry with a 1-hour interval
$token_expiry = $now->add(new DateInterval('PT1H'))->format('Y-m-d H:i:s');
// Example: Token expires in 1 hour

    // Update the user's record with the generated token and expiry time
    $update_query = "UPDATE users SET reset_token = '$reset_token', token_expiry = '$token_expiry' WHERE email = '$email'";
    $conn->query($update_query);

    // Send a recovery email with a link containing the generated token
    sendRecoveryEmail($email, $reset_token);
}
?>

<!-- Your HTML code for the forgot password form -->
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
                  <form id="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <div class="form-group">
        <label for="email" class="control-label" style="font-size:20px;">Enter your email</label>
        <input type="text" id="email" name="email" class="form-control" style="font-size:20px;">
    </div>
    <center>
        <button class="button btn-sm btn-block btn-wave col-md-5" name="forgot_password" style="font-size:20px;">Submit</button>
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
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
function generateUniqueToken() {
    // You can use various methods to generate a unique token
    // For example, using a combination of random characters and timestamp
    return bin2hex(random_bytes(16)); // 16 bytes will give you a 32-character hex string
}

function sendRecoveryEmail($email, $reset_token) {
    

    try {
        $mail = new PHPMailer(true);
        //Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = ''; // Replace with your SMTP username
        $mail->Password   = ''; // Replace with your SMTP password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        //Recipients
        $mail->setFrom('sendm3codes@gmail.com', 'Kingscoffee'); // Replace with your email and name
        $mail->addAddress($email); // Assuming $username is the user's email

        //Content
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset';
        $mail->Body = 'Click the following link to reset your password: <a href="http://localhost/kingscoffee/reset_password.php?email=' . urlencode($email) . '&token_reset=' . urlencode($reset_token) . '">Reset Password</a>';
        
        $mail->send();
        echo 'Email has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
