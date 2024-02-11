<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php include('db_connect.php');?>

<?php
$user = $_SESSION['login_name'];
?>
								
			<!-- FORM Panel -->
	<!-- Table Panel -->
	<div class="col-lg-16" style="margin-left:-210px;">
		<div class="card" style="width:100%;">
		<div class="card-header">
             <span><h5 style="color:	#36454F"><b>Inventory Report</b></h5></span> 	<button class="btn btn-success btn-sm " style="font-size: 1rem;border-radius:15px; height:35px; width: 110px;float:right;" type="button" id="print" style="font-size: 1.3rem;border-radius:20px; float:right;"><i class="fa fa-print"></i> Print</button>
						 
            		</div>
            	
						
				<div class="card-body">
					<div class="table-responsive">

						<table class="table table-hover" id="table1">


						<div class="text-right">
							
            		</div>
					<div class="filter-container">
    <label for="start-date" style="margin-left: -31px; ">Start Date:</label>
    <input type="date" id="start-date" name="start-date" style="border-radius:10px; font-size: 0.90rem;">

    <label for="end-date" style="margin-left: 15px;">End Date:</label>
    <input type="date" id="end-date" name="end-date" style="border-radius:10px;font-size: 0.90rem;">

    <button class="btn btn-primary btn-sm" style="background-color:#FDD89D; font-size: 1rem; color:black; border-radius:15px; height:35px; width: 150px; border-color:#FDD89D; margin-left: 15px;" id="date-filter-btn">Apply Filter</button>
</div>
						<div>
</br>
    <label for="status-filter">Select Status:</label>
    <select id="status-filter" name="status-filter">
        <option value="all">All</option>
        <option value="Normal">Normal</option>
        <option value="Low">Low</option>
        <option value="Critical">Critical</option>
        <option value="Out of Stock">Out of Stock</option>
        <option value="Expires soon">Expires soon</option>
        <option value="Expired">Expired</option>
        <!-- Add options for the other statuses -->
    </select>
</div>
   

							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">NAME</th>
									<th class="text-center">STOCKS</th>
									<th class="text-center">UNIT</th>
                                    <th class="text-center">TOTAL USAGE</th>
									<th class="text-center">AVAILABLE</th>
									<th class="text-center">DATE ADDED</th>
									<th class="text-center">EXPIRATION DATE</th>
									<th class="text-center">STATUS</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							$i = 1;
                            $date = date('Y-m-d');
							$startDate = isset($_GET['start-date']) ? $_GET['start-date'] : '';
$endDate = isset($_GET['end-date']) ? $_GET['end-date'] : '';
							$product = $conn->query("
							SELECT pi.ingredients_id, i.date_created,i.unit, i.name, i.category_id, i.stocks, i.expiration_date, SUM(pi.measurement * oi.qty) AS total_usage
							FROM product_ingredients AS pi
							JOIN ingredients AS i ON pi.ingredients_id = i.id
							JOIN order_items AS oi ON pi.product_id = oi.product_id
							GROUP BY pi.ingredients_id, i.name;
");
							while($row = $product->fetch_assoc()):
								$available = $row['stocks'] - $row['total_usage']; // Calculate available stock
							?>
    					<tr>
        					<td class="text-center"><?php echo $i++ ?></td>
        					<td class="text-left"><?php echo $row['name'] ?></td>                       
                            
                        </td>
        					<td class="text-right"><?php echo $row['stocks'] ?></td>
							<td class="text-left"><?php echo $row['unit'] ?></td>
        					<td class="text-right"><?php echo $row['total_usage'] ?></td>
        					<td class="text-right"><?php echo max(0, $available); ?></td>
							<td class="text-center"><?php echo $row['date_created']?></b>
							<td class="text-center"><?php echo $row['expiration_date']?></b>
							<td class="text-center">
							<?php
								$availability_percentage = ($available / $row['stocks']) * 100;

								// Check if the product is expired
									if ($date >= $row['expiration_date']) {
										echo '<span class=" badge bg-danger">Expired</span>';
								} elseif ($availability_percentage >= 30 && $availability_percentage <= 50) {
										echo '<span class=" badge bg-warning">Low</span>';
								}elseif ($available <= 0) {
									echo '<span class=" badge bg-secondary">Out of Stock</span>';
								} elseif ($availability_percentage < 20) {
										echo '<span class=" badge bg-danger">Critical</span>';
								} elseif (strtotime($row['expiration_date']) - strtotime($date) <= 604800) { // One week (60 seconds * 60 minutes * 24 hours * 7 days)
										echo '<span class=" badge bg-warning">Expires soon</span>';
								} else {
										echo '<span class=" badge badge-lightgreen">Normal</span>';
								}
								?>
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
		@media print {
        body * {
            visibility: hidden;
        }
        #table-container, #table-container * {
            visibility: visible;
        }
        #table-container {
            position: absolute;
            left: 0;
            top: 0;
        }
    }
	table {
  font-size: 20px; /* Adjust the font size value as needed */
}

th, td, p {
  font-size: 14px; /* Adjust the font size value as needed */
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
	.position-filter{
        width: 230px; /* Adjust the width as needed */
    }
    .filter-container {
    display: flex;
	margin-left: 30px; 
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
	.badge-lightgreen {
    background-color: #00ff00; /* Light green color */
    color: #000000; /* Text color */
}
</style>
<script>
var phpUser = '<?php echo $user; ?>';
</script>
<script>	
	$(document).ready(function() {

    var table = $('#table1').DataTable();
	$('#date-filter-btn').on('click', function() {
        var startDate = $('#start-date').val();
        var endDate = $('#end-date').val();

        // Perform date filtering via AJAX
        $.ajax({
            url: 'stocks_filter.php', // Replace with the actual server-side script URL
            method: 'GET',
            data: {
                'start-date': startDate,
                'end-date': endDate
            },
            success: function(response) {
                // Assuming your server-side script returns the updated HTML for the table
                $('#table1').html(response);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
    $('#status-filter').change(function() {
        var status = $(this).val();

        if (status === 'all') {
			table.search('').columns().search('').draw();
        } else {
            table.column(7).search(status).draw(); 
        }
    });

	$('#print').on('click', function () {
            // Clone the table and remove unwanted elements
            var printableTable = $('#table1').clone();
            printableTable.find('tfoot').remove(); // Remove the table footer if exists
            printableTable.find('button').remove(); // Remove any buttons inside the table
            printableTable.find('.dataTables_filter').remove(); // Remove the search input

            // Style the cloned table for printing
            printableTable.addClass('printable-table');
            printableTable.find('th, td').css('border', '1px solid #ddd'); // Add border to cells
			var startDate = document.getElementById("start-date").value;
    		var endDate = document.getElementById("end-date").value;
            // Get the current date
            var currentDate = new Date();
            var formattedDate = currentDate.toLocaleString();

            // Create a new window and append the cloned table
			var printWindow = window.open('', '_blank');
			printWindow.document.write('<html><head><title>Stock Report</title>');
			printWindow.document.write('<style>');
			printWindow.document.write('.printable-table { border-collapse: collapse; width: 100%; }');
			printWindow.document.write('.printable-table th, .printable-table td { padding: 8px; text-align: left; }');
			printWindow.document.write('.center { text-align: center; }');
			printWindow.document.write('.header { display: flex; justify-content: space-between; align-items: center; }');
			printWindow.document.write('</style></head><body>');

			// Header with "Kings Coffee Shop" and logo
			printWindow.document.write('<div class="header" style="background-color: #FFEFD5">');
			printWindow.document.write('<div>');
			printWindow.document.write('<h1 style=" margin-bottom: 0px; padding: 0;">Kings Coffee Shop PH</h1>');
			// Additional paragraph under h1
			printWindow.document.write('<p style=" margin-top: 0px; margin-bottom: 0px; padding: 0;">3rd floor B2 L24, San Sebastián St. Brgy. San Gabriel</p>');
			printWindow.document.write('<p style=" margin-top: 0px; padding: 0;">G.M.A. 4117, General Mariano Alvarez, Philippines, 4117</p>');
			printWindow.document.write('</div>');
			printWindow.document.write('<div><img src="../kingscoffee/kingcoffee.jpg" alt="Logo" style="width: 120px; height:100px; auto; margin-right:50px;"></div>');
			printWindow.document.write('</div>');

			printWindow.document.write('<hr>');
			
			printWindow.document.write('<h1 style=" margin-bottom: 0px; padding: 0; text-align: center; font-size:25px;">Inventory Report</h1>');

			printWindow.document.write('<div class="center" style="text-align: left;">');
    printWindow.document.write('<label for="startDate">Start Date: </label>');
    printWindow.document.write('<span>' + startDate + '</span><br>');
    printWindow.document.write('<label for="endDate">End Date: </label>');
    printWindow.document.write('<span>' + endDate + '</span>');
    printWindow.document.write('</div>');
		
			printWindow.document.write(printableTable.prop('outerHTML'));
			printWindow.document.write('<div class="center" style="text-align: left;"><h4><i>Prepared by: ' + phpUser + ' / Administrator<i></h4></div>');
			printWindow.document.write('<div class="center" style="text-align: left;"><p>Date:' + formattedDate + '</p></div>');
			printWindow.document.write('</body></html>');
			




            // Close the new window after printing
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        });
});
</script>

<script>
// Function to refresh the page after a specified interval (e.g., every 5 minutes)
function autoRefresh() {
    location.reload();
}

// Set the auto-refresh interval (in milliseconds) - 300,000 milliseconds = 5 minutes
setInterval(autoRefresh, 30000); 
</script>
<?php
?>		