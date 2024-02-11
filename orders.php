<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php include 'db_connect.php'?>
<style>

    </style>


			<!-- Table Panel -->
			<div class="col-lg-16" style="margin-left:-210px;">

   				 <div class="card" style="width:100%;">
					<div class="card-header">
             			<span><h5 style="color:	#36454F"><b>List of Orders</b></h5></span>
					</div>
            
						
				<div class="card-body">
					<div class="table-responsive">
						<table class="table  table-hover" id="table1">
						<script src="../javascript/jquery-3.6.0.min.js"></script>
	<thead>
		<tr>
			<th class="text-center">#</th>
			<th class="text-center">DATE</th>
			<th class="text-center">INVOICE</th>
			<th class="text-center">CUSTOMER NAME</th>
			<th class="text-center">AMOUNT</th>
			<th class="text-center">MODE OF PAYMENT</th>
			
			<th class="text-center">ACTION</th>
		</tr>
	</thead>
		<tbody>
			<?php 
			$i = 1;
			$order = $conn->query("SELECT * FROM orders order by unix_timestamp(date_created) desc ");
			while($row=$order->fetch_assoc()):
			?>
				<tr>
					<td class="text-center"><b><?php echo $i++ ?></td>
					<td class="">
						<p class="text-center"> <?php echo date("M d,Y",strtotime($row['date_created'])) ?></p>
					</td>
					<td class="text-center">
						<p class="text-right" > <?php echo $row['amount_tendered'] > 0 ? $row['ref_no'] : 'N/A' ?></p>
					</td>
					<td >
						<p  class="text-left"><?php echo $row['customer_name'] ?></p>
					</td>
					<td>
						<p class="text-right">&#8369;   <?php echo number_format($row['total_amount'],2) ?></p>
					</td>
					<td class="text-center">
					<?php if($row['payment_mode'] == 'cash'): ?>
					<span class="badge badge-success">Cash</span>
					<?php else: ?>
					<span class="badge badge-primary">Gcash</span>
					<?php endif; ?>
					</td>
						<td class="text-center">
						<button class="btn btn-sm btn-outline-primary view_order" type="button" data-id="<?php echo $row['id'] ?>">View</button>
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
  font-size: 15px; /* Adjust the font size value as needed */
}
	td{
		vertical-align: middle !important;
	}
	td p{
		margin: unset
	}
	.text-left{
		font-size:18px;
	}
	.text-right{
		font-size:18px;
	}
	img{
		max-width:100px;
		max-height:150px;
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
  .text-center, .btn , .badge{
		font-size:18px;
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
	$(document).ready(function(){
		$('table').dataTable()
	})
	$('#new_order').click(function(){
		uni_modal("New order ","manage_order.php","mid-large")
		
	})
	$('.view_order').click(function(){
		uni_modal("Order  Details","view_order.php?id="+$(this).attr('data-id'),"mid-large")
		
	})
	$('.delete_order').click(function(){
		_conf("Are you sure to delete this order ?","delete_order",[$(this).attr('data-id')])
	})
	function delete_order($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_order',
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