<style>
	  .navbar{
    background-color:#000000;
    padding: auto;
    height: 55px;
  }
</style>

<nav class="navbar navbar-light fixed-top" style="padding:0">
  <div class="container-fluid mt-1 mb-1">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  		  <img src ="king.png" style="height:33px";>
  		</div>
      
      <div class="float-right">
      <span><a class="btn btn-dark btn-sm col-md-12 float-right" href="../index.php" id="">
                    <i class="fa fa-home "></i></a></span>
      </div>
  </div>
  
</nav>

<script>
  $('#manage_my_account').click(function(){
    uni_modal("Manage Account","manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
</script>