<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
$category = $conn->query("SELECT * FROM categories where id =".$_GET['id']);
foreach($category->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	<div id="msg"></div>

	<form action="" id="manage-category">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">Name</label> 
			<input type="text"  name="name"  id="name" class="form-control"  value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<input type="text" name="description" id="description" class="form-control" value="<?php echo isset($meta['description']) ? $meta['description']: '' ?>" required  autocomplete="off">
		</div>
		
	</form>
</div>

<script>
	
	$('#manage-category').submit(function(e){
		e.preventDefault();
		start_load()
		$.ajax({
			url:'ajax.php?action=save_category',
			method:'POST',
			data:$(this).serialize(),
			success:function(resp){
				if(resp ==1){
					alert_toast("Data successfully saved",'success')
					setTimeout(function(){
						location.reload()
					},1500)
				}else{
					$('#msg').html('<div class="alert alert-danger">Category already exist</div>')
					end_load()
				}
			}
		})
	})

</script>