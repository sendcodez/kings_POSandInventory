<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php include('db_connect.php');?>

		
								
			<!-- FORM Panel -->
	<!-- Table Panel -->
	<div class="col-lg-16" style="margin-left:-210px;">
		<div class="card" style="width:100%;">
		<div class="card-header ">
		<span><h5 style="color:	#36454F"><b>PRODUCT LIST</b> </h5></span> <button class="btn  float-right  btn-md" style=" background-color: #D78C15; color:white" id="new_prod"><i class="fa fa-plus"></i> New Product  </button>
            		</div>
						
						 <div class="card-body">
					<div class="table-responsive">
						<table class="table table-hover" id="table1">
			<!-- Table Panel -->
	
<script src="../javascript/jquery-3.6.0.min.js"></script>
	<div class="filter-container">
	<div class="filter">
        <label for="category-filter" style="margin-left: -30px; margin-bottom: 20px;"> <b>FILTER BY: </label>
        <select id="category-filter" class="form-select" style="width:200px">
    <option value="">All Categories</option>
    <?php
    $categories = array(); // Array to store distinct categories
    $query = "SELECT DISTINCT category_name FROM products "; // Query to fetch distinct categories
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_array($result)) {
        $categories[] = $row['category_name'];
    }

    // Output options for each category
    foreach ($categories as $category) {
        echo "<option value='" . $category . "'>" . $category . "</option>";
    }

    ?>
</select>

    </div>
</div>
							<!-- Add this code just above the table -->


							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Category</th>
									<th class="text-center">Name</th>
									<th class="text-center">Description</th>
									<th class="text-center">Price</th>
                                    <th class="text-center">Expiration Date</th>
    
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php 
$i = 1;
$product = $conn->query("SELECT * FROM products");
while($row = $product->fetch_assoc()):
?>
<tr>
    <td class="text-center"><b><?php echo $i++ ?></b></td>

	<td class="text-left"><?php echo $row['category_name'] ?></td>
    
    <td class="text-left"><?php echo $row['name'] ?></td>
    <td class="text-left"><?php echo $row['description'] ?></td>
    <td class="text-right"><?php echo number_format($row['price'], 2) ?></td>
	<td class="text-center"><?php echo $row['expiration_date'] ?></td>

    <td>
				 		<center>
							<div class="btn btn-group" style ="border-color: #d06f00;  border-radius: 8px; color: white;">
							  <button type="button" class="btn  btn-sm" style=" background-color:#; color:black;">Action</button>
							  <button type="button" class="btn  btn-sm dropdown-toggle dropdown-toggle-split" style=" background: linear-gradient(to top, #FEFEFE, #d06f00" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							    <span class="sr-only">Toggle Dropdown</span>
							  </button>
							  <div class="dropdown-menu">
							    <a class="dropdown-item edit_product" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Edit</a>
							    <div class="dropdown-divider"></div>
							    <a class="dropdown-item delete_product" href="javascript:void(0)" data-id = '<?php echo $row['id'] ?>'>Delete</a>
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
  padding: 8px; /* Add padding for better readability on small screens */
}
	td{
		vertical-align: middle !important;
		word-wrap: break-word; /* Ensure that long words don't break the layout */
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

	.text-right{
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
	.position-filter{
        width: 230px; /* Adjust the width as needed */
    }
    .filter-container {
    display: flex;
	margin-left: 30px; 
}
.filter {
    margin-right: 10px; /* Adjust the margin as needed to separate the filters */
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
	$('#new_prod').click(function(){
	uni_modal('NEW PRODUCT','new_prod.php')
})
$('.edit_product').click(function(){
	uni_modal('EDIT PRODUCT','new_prod.php?id='+$(this).attr('data-id'))
})
$('.delete_product').click(function(){
		_conf("Are you sure to delete this product?","delete_product",[$(this).attr('data-id')])
	})
function delete_product($id){
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

	$(document).ready(function () {
    // Initialize an object to store the selected filters
    var filters = {
        category: null,
        status: null
    };

    // Define a generic filter function
    function filterTable() {
        var rows = $("#table1 tbody tr");

        // Show all rows initially
        rows.show();

        // Apply the category filter if a value is selected
        if (filters.category) {
            rows.each(function () {
                var rowcategory = $(this).find("td:eq(1)").text();
                if (rowcategory !== filters.category) {
                    $(this).hide();
                }
            });
        }

        // Apply the status filter if a value is selected
        if (filters.status) {
            rows.each(function () {
                var rowStatus = $(this).find("td:eq(7)").text();
                if (rowStatus !== filters.status) {
                    $(this).hide();
                }
            });
        }
    }

    // Listen for changes in the category filter dropdown
    $("#category-filter").on("change", function () {
        filters.category = $(this).val();
        filterTable();
    });

    // Listen for changes in the status filter dropdown
    $("#status-filter").on("change", function () {
        filters.status = $(this).val();
        filterTable();
    });
});

</script>

<?php
?>