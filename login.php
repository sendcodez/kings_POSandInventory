<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
// if(!isset($_SESSION['system'])){
	$system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
	foreach($system as $k => $v){
		$_SESSION['system'][$k] = $v;
	}
// }
ob_end_flush();
?>
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
  					<form id="login-form" >
  						<div class="form-group">
  							<label for="username" class="control-label" style="font-size:20px;">Username</label>
  							<input type="text" id="username" name="username" class="form-control" style="font-size:20px;">
  						</div>
  						<div class="form-group">
  							<label for="password" class="control-label" style="font-size:20px;">Password</label>
  							<input type="password" id="password" name="password" class="form-control" style="font-size:20px;">
  						</div>
						  <a href="forgot_password.php">Forgot Password?</a>
  						<center><button class="button btn-sm btn-block btn-wave col-md-5" style="font-size:20px;">Login</button>

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
<script>
	$('#login-form').submit(function(e){
		e.preventDefault()
		$('#login-form button[type="button"]').attr('disabled',true).html('Logging in...');
		if($(this).find('.alert-danger').length > 0 )
			$(this).find('.alert-danger').remove();
		$.ajax({
			url:'ajax.php?action=login',
			method:'POST',
			data:$(this).serialize(),
			error:err=>{
				console.log(err)
		$('#login-form button[type="button"]').removeAttr('disabled').html('Login');

			},
			success:function(resp){
				if(resp == 1){
					location.href ='index.php?page=home';
				}else{
					$('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
					$('#login-form button[type="button"]').removeAttr('disabled').html('Login');
				}
			}
		})
	})
</script>	
</html>