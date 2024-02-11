<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php include('db_connect.php');?>

		
									<?php
									$qry = $conn->query("SELECT * FROM categories_inventory order by name asc");
									while($row=$qry->fetch_assoc()):
										$cname[$row['id']] = ucwords($row['name']);
									?>
									<?php endwhile; ?>
							
			<!-- FORM Panel -->

					<!-- Table Panel -->
			<div class="col-lg-16" style="margin-left:-210px;">
			<div class="card" style="width:100%;">
			<div class="card-header">
			<span><h5 style="color:	#36454F"> <b>Ingredients Category</b> </h5></span>
			  <button class="btn float-right btn-md"  style=" background-color: #D78C15; color:white " id=new_ing><i class="fa fa-plus"></i> New Category</button>
            		</div>
          
						
						 <div class="card-body">
						 <div class="table-responsive">

						 <table class="table  table-hover" id="table1" >
							<script src="../javascript/jquery-3.6.0.min.js"></script>
							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">NAME</th>
									<th class="text-center">DESCRIPTION</th>
    
									<th class="text-center">ACTION</th>
								</tr>
							</thead>
							<tbody>
							<?php 

$product = $conn->query("SELECT * FROM categories_inventory");
while($row = $product->fetch_assoc()):
?>
<tr>

	<td class="text-center"><?php echo $row['id'] ?></td>
    
    <td class="text-left"><?php echo $row['name'] ?></td>
    <td class="text-left"><?php echo $row['description'] ?></td>
 
    <td>
				 		<center>
							<div class="btn btn-group" style ="border-color: #d06f00;  border-radius: 8px; color: white;">
							  <button type="button" class="btn  btn-sm" style=" background-color:#; color:black;"> Action</button>
							  <button type="button" class="btn  btn-sm dropdown-toggle dropdown-toggle-split" style=" background: linear-gradient(to top, #FEFEFE, #d06f00"data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <div class="dropdown-menu">
							    <a class="dropdown-item edit_ing" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
							    <div class="dropdown-divider"></div>
							    <a class="dropdown-item delete_ing" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
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
	.text-center, .btn{
		font-size:18px;
	}
	.text-left{
		font-size:18px;
	}
	
	.custom-switch{
		cursor: pointer;
	}
	.custom-switch *{
		cursor: pointer;
	}
	.iform{
		width: 330px;
		margin-left: -350px;
		margin-right: 20px;
		margin-top:350px;
	}
	.catingform{
		width: 330px;
		margin-left: 60px;
		margin-right: 20px;
		margin-top:5px;
	}
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
	
</style>
<script>	
$(document).ready(function () {
    $('table').dataTable();
});
$('#new_ing').click(function(){
	uni_modal('NEW CATEGORY','new_ing.php')
})
$('.edit_ing').click(function(){
	uni_modal('EDIT CATEGORY','new_ing.php?id='+$(this).attr('data-id'))
})
$('.delete_ing').click(function(){
		_conf("Are you sure to delete this product?","delete_ing",[$(this).attr('data-id')])
	})
function delete_ing($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_product',
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
	$('table').dataTable()


	var total;
    cat_func();
   $('#prod-list .prod-item').click(function(){
        var data = $(this).attr('data-json')
            data = JSON.parse(data)
        if($('#o-list tr[data-id="'+data.id+'"]').length > 0){
            var tr = $('#o-list tr[data-id="'+data.id+'"]')
            var ingredients = tr.find('[name="ingredients[]"]').val();
                ingredients = parseInt(ingredients) + 1;
                ingredients = tr.find('[name="ingredients[]"]').val(ingredients).trigger('change')
                calc()
            return false;
        }
   })
</script>

<?php
?>