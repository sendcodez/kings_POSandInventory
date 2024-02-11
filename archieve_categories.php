<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php include('db_connect.php');?>
<style>
	input[type=checkbox]
{
  /* Double-sized Checkboxes */
  -ms-transform: scale(1.3); /* IE */
  -moz-transform: scale(1.3); /* FF */
  -webkit-transform: scale(1.3); /* Safari and Chrome */
  -o-transform: scale(1.3); /* Opera */
  transform: scale(1.3);
  padding: 10px;
  cursor:pointer;

}

</style>


			<!-- Table Panel -->
			<div class="col-lg-16" style="margin-left:-210px;">

    <div class="card" style="width:100%;">
		<div class="card-header">
		<span><h5 style="color:	#36454F"><b>Archive Categories </b> </h5></span>
						
					</div>
					<div class="card-body">
			<div class="table-responsive">
			<table class="table">
				<script src="../javascript/jquery-3.6.0.min.js"></script>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">CATEGORY INFO.</th>
                                    <th class="text-center">DESCRIPTION</th>
									<th class="text-center">ACTION</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$order = $conn->query("SELECT * FROM archieve_categories order by id asc ");
								while($row=$order->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><b><?php echo $i++ ?></b></td>

										<td >
										<p class="text-left"> <?php echo $row['name']?></p>
									</td>
										<td >
										<p class="text-left"> <?php echo $row['description'] ?></p>
									</td>
									
									<td class="text-center">
										<button class="btn btn-sm btn-success restore_categories" type="button" data-id="<?php echo $row['id'] ?>">Restore</button>
										<button class="btn btn-sm btn-danger delete_permanently_categories" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>
<br>
<br>
	
<div class="col-lg-16" style="margin-left:-210px;">

    <div class="card" style="width:100%;">
		<div class="card-header">
		<span><h5 style="color:	#36454F"><b>Archive Products </b> </h5></span>
						
					</div>
					<div class="card-body">
			<div class="table-responsive">
			<table class="table">
				<script src="../javascript/jquery-3.6.0.min.js"></script>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">CATEGORY ID</th>
                                    <th class="text-center">NAME</th>
                                    <th class="text-center">DESCRIPTION</th>
                                    <th class="text-center">PRICE</th>
									<th class="text-center">ACTION</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$order = $conn->query("SELECT * FROM archieve_products order by id asc ");
								while($row=$order->fetch_assoc()):
								?>
								<tr>
									<td class="text-center"><b><?php echo $i++ ?></b></td>

									<td>
										<p class="text-center" > <?php echo $row['category_id']?></p>
									</td>
                                    <td>
										<p class="text-left"> <?php echo $row['name']?></p>
									</td>
									<td>
										<p  class="text-left"> <?php echo $row['description'] ?></p>
									</td>
                                    <td>
										<p class="text-center"> <?php echo number_format($row['price'],2)?></p>
									</td>
									
									<td class="text-center">
										<button class="btn btn-sm btn-success restore_products" type="button" data-id="<?php echo $row['id'] ?>">Restore</button>
										<button class="btn btn-sm btn-danger delete_permanently_products" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- Table Panel -->
		</div>
	</div>	

</div>


<br><br>

<div class="col-lg-16" style="margin-left:-210px;">

    <div class="card" style="width:100%;">
		<div class="card-header">
        <span><h5 style="color:	#36454F"><b>Archive Users</b> </h5></span>
        
		</div>
			<div class="card-body">
			<div class="table-responsive">
				<table class="table">
				<script src="../javascript/jquery-3.6.0.min.js"></script>
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">NAME</th>
					<th class="text-center">USERNAME</th>
					<th class="text-center">TYPE</th>
					<th class="text-center">ACTION</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$type = array("","Admin","Staff","Alumnus/Alumna");
 					$users = $conn->query("SELECT * FROM archieve_users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td class="text-center"><b>
				 		<?php echo $i++ ?></b>
				 	</td>
				 	<td class="text-left">
				 		<?php echo ucwords($row['name']) ?>
				 	</td>
				 	
				 	<td class="text-left">
				 		<?php echo $row['username'] ?>
				 	</td>
				 	<td class="text-left">
				 		<?php echo $type[$row['type']] ?>
				 	</td>
				 	
                     <td class="text-center">
					    <button class="btn btn-sm btn-success restore_users" type="button" data-id="<?php echo $row['id'] ?>">Restore</button>
						<button class="btn btn-sm btn-danger delete_permanently_users" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
					</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<style>
	
	td{
		vertical-align: middle !important;
		
	}
	td p{
		margin: unset
	}
	img{
		max-width:100px;
		max-height:150px;
	}

	table {
  font-size: 20px; /* Adjust the font size value as needed */
}

th, td, p {
  font-size: 15px; /* Adjust the font size value as needed */
}

.text-center{
		font-size:18px;
	}

	.text-left{
		font-size:18px;
	}



   .card-body{
        box-shadow: 0 .4rem .8rem #0005;
        overflow: hidden;
        border-radius:  ;
		background: #fff;
        
   }
   .dataTables_filter input {
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 6.75rem;
    background-color: #fefbf1;
    border-color:#532D01;
    font-size: 18px;
    outline: none;
    transition: background-color 0.3s, border-color 0.3s;
}

.dataTables_filter input:focus {
    background-color: #fff;
    border-color:#D78C15;
    box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
}

select {
    word-wrap: normal;
    border-radius: 8rem;
    padding: 5px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #fefbf1;
    border-color:#532D01;
    font-size: 18px;
    outline: none;
    transition: background-color 0.3s, border-color 0.3s;
}
.dataTables_wrapper .dataTables_length {
    border-radius: 2rem;
    float: left;
}

.dataTables_wrapper{
	width: 99%;
}
.text-center, .btn{
		font-size:18px;
	}
</style>
<script>
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_order').click(function(){
		uni_modal("New order ","manage_order.php","mid-large")
		
	})
	$('.view_order').click(function(){
		uni_modal("Order  Details","view_order.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.delete_permanently_categories').click(function(){
		_conf("Are you sure to delete this order ?","delete_permanently_categories",[$(this).attr('data-id')])
	})
	function delete_permanently_categories($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_permanently_categories',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})

	}
    $('.restore_categories').click(function(){
		_conf("Are you sure to restore this order ?","restore_categories",[$(this).attr('data-id')])
	})
    function restore_categories($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=restore_categories',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully Restored",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
    }
</script>

<script>
    //products//
    $('.delete_permanently_products').click(function(){
		_conf("Are you sure to delete this order ?","delete_permanently_products",[$(this).attr('data-id')])
	})
	function delete_permanently_products($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_permanently_products',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})

	}
    $('.restore_products').click(function(){
		_conf("Are you sure to restore this order ?","restore_products",[$(this).attr('data-id')])
	})
    function restore_products($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=restore_products',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully Restored",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
    }
</script>

<!--users-->
<script>
 $('.delete_permanently_users').click(function(){
		_conf("Are you sure to delete this order ?","delete_permanently_users",[$(this).attr('data-id')])
	})
	function delete_permanently_users($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_permanently_users',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})

	}
    $('.restore_users').click(function(){
		_conf("Are you sure to restore this order ?","restore_users",[$(this).attr('data-id')])
	})
    function restore_users($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=restore_users',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully Restored",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
    }

</script>
