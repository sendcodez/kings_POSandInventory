<?php include('db_connect.php');?>				

<style>
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
.text-center, .btn{
		font-size:18px;
	}

  .text-left{
		font-size:18px;
	}

  .text-right{
    font-size:18px;
  }


</style>
<!-- Table Panel -->
<div class="col-lg-16" style="margin-left:-210px;">

<div class="card" style="width:100%;">
		<div class="card-header">
			<b style= "font-size: 20px;">Ingredients List</b><button class="btn float-right btn-sm" style=" background-color:#F48F00; color:white;" id="new_inv_ing"><i class="fa fa-plus"></i> New Ingredients</button>
		</div>
			<div class="card-body">
			<div class="table-responsive">
				<table class="table " id="table1" >
				<script src="../javascript/jquery-3.6.0.min.js"></script>
				<div class="filter-container">
				<div class="filter">
   				<label for="category-filter" style="margin-left: -30px; margin-bottom: 20px;"> <b>FILTER BY: </label>
        			<select id="category-filter" class="form-select" style="width:200px">
						<option value="">All Categories</option>
						<?php
   						 $categories = array(); // Array to store distinct categories
						$query = "SELECT DISTINCT category_name FROM ingredients "; // Query to fetch distinct categories
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
    <div class="filter">
        <label for="status-filter"> </label>
        <select id="status-filter" class="form-select" style="width:200px">
            <option value="">All Units</option>
            <?php
            $positions = array(); // Array to store distinct positions
            $query = "SELECT DISTINCT unit FROM ingredients "; // Query to fetch distinct positions
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_array($result)) {
                $positions[] = $row['unit'];
            }

            // Output options for each position
            foreach ($positions as $position) {
                echo "<option value='" . $position . "'>" . $position . "</option>";
            }

            ?>
        </select>
    </div>
	</div>
		<thead>
			<tr>
			<!--	<th class="text-left">#</th>-->
				<th class="text-left">CATEGORY</th>
				<th class="text-left">NAME</th>
				<th class="text-left">QUANTITY</th>
        <th class="text-left">PACKAGING</th>
				<th class="text-left">STOCKS</th>
				<th class="text-left">UNIT</th>
				<th class="text-left">EXPIRATION DATE</th>
				<th class="text-left">ACTION</th>
				</tr>
		</thead>
	<tbody>
  <?php
$ingredients = $conn->query("
SELECT MIN(i.id) AS id, i.name, i.category_id, c.name AS category_name, MIN(i.pkg) AS pkg, SUM(i.qty) AS total_qty, SUM(i.stocks) AS total_stocks, MIN(i.unit) AS unit, MIN(i.expiration_date) AS expiration_date, COALESCE(SUM(pi.measurement * oi.qty), 0) AS total_usage
FROM ingredients AS i
LEFT JOIN categories_inventory AS c ON i.category_id = c.id
LEFT JOIN product_ingredients AS pi ON i.id = pi.ingredients_id
LEFT JOIN order_items AS oi ON pi.product_id = oi.product_id
GROUP BY i.name, i.category_id;
");

$i = 1;
$currentCategory = "";  // Variable to keep track of the current category

while ($row = $ingredients->fetch_assoc()):
$available = $row['total_stocks'] - $row['total_usage']; // Calculate available stock

// Check if the category has changed, if yes, reset the category-specific variables
if ($currentCategory != $row['category_name']):
    $currentCategory = $row['category_name'];
    $totalQty = 0;
    $totalStocks = 0;
endif;

// Sum up the quantity and stocks for the current category
$totalQty += $row['total_qty'];
$totalStocks += $row['total_stocks'];
?>

<tr>
    <!--<td class="text-right"><b><#?php echo $i++ ?></b></td>-->
    <td class="text-left"><?php echo $row['category_name'] ?></td>
    <td class="text-left"><?php echo $row['name'] ?></td>
    <td class="text-right"><?php echo $totalQty ?></td>
    <td class="text-left"><?php echo $row['pkg'] ?></td>
    <td class="text-right"><?php echo $totalStocks ?></td>
    <td class="text-left"><?php echo $row['unit'] ?></td>
    <td class="text-right"><?php echo $row['expiration_date'] ?></td>
    <td>
        <center>
            <div class="btn btn-group" style="border-color: #d06f00; border-radius: 8px; color: white;">

                <button type="button" class="btn btn-sm" style=" color:black;">Action</button>
                <button type="button" class="btn btn-sm dropdown-toggle dropdown-toggle-split"
                        style="background: linear-gradient(to top, #FEFEFE, #d06f00)" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <div class="dropdown-menu">

                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item edit_ing_form" href="javascript:void(0)"
                       data-id='<?php echo $row['id'] ?>'>Edit Ingredients</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item delete_ingredients" href="javascript:void(0)"
                       data-id='<?php echo $row['id'] ?>'>Delete</a>
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
    font-size: 20px;

  }

  th, td, p {
    font-size: 14px;
    padding: 8px; /* Add padding for better readability on small screens */
  }

  td {
    vertical-align: middle !important;
    word-wrap: break-word; /* Ensure that long words don't break the layout */
  }

  td p {
    margin: unset;
  }
  


  .custom-switch {
    cursor: pointer;
  }

  .custom-switch * {
    cursor: pointer;
  }

  .iform {
    width: 330px;
    margin-left: -350px;
    margin-right: 20px;
    margin-top: 350px;
  }

  .catingform {
    width: 330px;
    margin-left: 60px;
    margin-right: 20px;
    margin-top: 5px;
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

</style>

<script>

	$('#new_cat_ing').click(function(){
		uni_modal('New Category Form','inventory_cat_for_ing_form.php')
	})
	$('#new_inv_ing').click(function(){
		uni_modal('New Ingredients Form','inv_ing_form.php')
	})

$('.edit_ing_form').click(function(){
	uni_modal('Edit Ingredients','inv_ing_form.php?id='+$(this).attr('data-id')) /* Only category can edit, IDK paano yung buong table ma edit hahaha taena  */
})

$('.delete_ingredients').click(function(){
		_conf("Are you sure to delete this ingredients?","delete_ingredients",[$(this).attr('data-id')])
	})
function delete_ingredients($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_ingredients',
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
    $('table').dataTable();
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
                var rowcategory = $(this).find("td:eq(0)").text();
                if (rowcategory !== filters.category) {
                    $(this).hide();
                }
            });
        }

        // Apply the status filter if a value is selected
        if (filters.status) {
            rows.each(function () {
                var rowStatus = $(this).find("td:eq(5)").text();
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

