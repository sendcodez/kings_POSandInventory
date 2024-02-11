<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php include('db_connect.php');?>

		
									<?php
									$qry = $conn->query("SELECT * FROM categories order by name asc");
									while($row=$qry->fetch_assoc()):
										$cname[$row['id']] = ucwords($row['name']);
									?>
									<?php endwhile; ?>
							
			<!-- FORM Panel -->

			<!-- Table Panel -->
			<div class="col-lg-16" style="margin-left:-210px;">

<div class="card" style="width:100%;">
	<div class="card-header">
	<span><h5 style="color:	#36454F"><b>User List</b></h5></span>
		 <button class="btn float-right btn-md" style="background-color: #D78C15; color:white" id="new_user"><i class="fa fa-plus"></i> New User</button>
	</div> 
						
						 <div class="card-body">
					<div class="table-responsive">
						<table class="table  table-hover">
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">NAME</th>
									<th class="text-center">USERNAME</th>
									<th class="text-center">TYPE</th>
									<th class="text-center">STATUS</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
 					include 'db_connect.php';
 					$type = array("","Admin","Staff","Alumnus/Alumna");
 					$users = $conn->query("SELECT * FROM users order by name asc");
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
					 <td class="text-left">
				 		<?php echo $row['status'] ?>
				 	</td>
 
    <td>
				 		<center>
							<div class="btn btn-group" style ="border-color: #d06f00;  border-radius: 8px; color: white;">
							  <button type="button" class="btn  btn-sm" style=" background-color:#; color:black;">Action</button>
							  <button type="button" class="btn  btn-sm dropdown-toggle dropdown-toggle-split" style=" background: linear-gradient(to top, #FEFEFE, #d06f00"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <div class="dropdown-menu">
								
							    <a class="dropdown-item edit_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
							    <div class="dropdown-divider"></div>
							    <a class="dropdown-item delete_user" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
								<div class="dropdown-divider"></div>
								<script>
							 $(document).ready(function () {
        $(".status-toggle").on("click", function () {
            var button = $(this);
            var newStatus = button.data("status") === "active" ? "inactive" : "active";
            
            // Send an AJAX request to update the status
            $.ajax({
                url: "update_status.php", // Replace with the actual URL for updating the status
                method: "POST",
                data: { id: button.data("id"), newStatus: newStatus }, // Send the user's ID and the new status to the server
                success: function (response) {
                    if (response === "success") {
                        // Update the button text and data-status attribute
                        button.data("status", newStatus);
                        button.text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));
                        
                        // Update the button class based on the new status
                        if (newStatus === "active") {
                            button.removeClass("btn-danger").addClass("btn-success");
                        } else {
                            button.removeClass("btn-success").addClass("btn-danger");
                        }
                    } 
					location.reload()
                },
                error: function () {
                    // Handle AJAX error if needed
                    alert("An error occurred while sending the request.");
                }
            });
        });
    });	
						</script>
						
    <?php
    $currentStatus = $row['status'];
    if ($currentStatus == 'active') {
        echo '<button class="btn btn-success status-toggle" data-status="active" data-id="' . $row['id'] . '">Active</button>';
    } else {
        echo '<button class="btn btn-danger status-toggle" data-status="inactive" data-id="' . $row['id'] . '">Inactive</button>';
    }
    ?>
							  </div>
							</div>
						</center>
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



<style>
		
		table {
  font-size: 20px; /* Adjust the font size value as needed */
}

th, td, p {
  font-size: 14px; /* Adjust the font size value as needed */
  word-wrap: break-word; /* Ensure that long words don't break the layout */
}
	td{
		vertical-align: middle !important;
	}
	td p {
		margin:unset;
	}
	.custom-switch{
		cursor: pointer;
	}
	.custom-switch *{
		cursor: pointer;
	}
	.text-left{
		font-size:18px;
	}

 /* Media query for smaller screens */
 @media screen and (max-width: 750px) {
    table {
      font-size: 16px;
	 width: 1000px;
	 margin-left: 100px;
    }

    th, td, p {
      font-size: 12px;
    }

    .iform, .catingform {
      width: auto;
      margin-left: 0;
      margin-right: 0;
      margin-top: 10px; /* Adjust as needed */
    }
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
	$(document).ready(function () {
    $('table').dataTable();
});
$('#new_user').click(function(){
	uni_modal('NEW USER','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('EDIT USER','manage_user.php?id='+$(this).attr('data-id'))
})
$('.delete_user').click(function(){
		_conf("Are you sure to delete this product?","delete_user",[$(this).attr('data-id')])
	})
function delete_user($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_user',
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

</script>


<?php
?>