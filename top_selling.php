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
             <span><h5 style="color:	#36454F"><b>Top Selling Report</b></h5></span> 	<button class="btn btn-success btn-sm " style="font-size: 1rem;border-radius:15px; height:35px; width: 110px;float:right;"type="button" id="print" style="font-size: 1.3rem;border-radius:20px;"><i class="fa fa-print"></i> Print</button>
						 
            		</div>
						
						 <div class="card-body">
					<div class="table-responsive">

						<table class="table table-hover" id="table1">
					<div class="text-right">
					
    				</div>
                        </div>

							<thead>
								<tr>
									<th class="text-center">#</th>
									<th class="text-center"> PRODUCT NAME</th>
									<th class="text-center">SOLD</th>
								</tr>
							</thead>
							<tbody>
                            <?php
// Assuming you have established a database connection earlier

// Execute the SQL query to get most sold items with product names
$query = "SELECT oi.product_id, p.name, COUNT(DISTINCT o.ref_no) AS total_customers
          FROM order_items oi
          JOIN orders o ON oi.order_id = o.id
          JOIN products p ON oi.product_id = p.id
          GROUP BY oi.product_id, p.name
          ORDER BY total_customers DESC";

$result = mysqli_query($conn, $query);

if ($result) {
    $counter = 1;

    // Fetch and display the results
    while ($row = mysqli_fetch_assoc($result)) {
        $product_id = $row['product_id'];
        $product_name = $row['name'];
        $total_customers = $row['total_customers'];

        echo '<tr>';
        echo '<td class="text-center">' . $counter . '</td>';
        
        // Apply increased font size only for the top 3 best-selling products
        $fontStyle = ($counter <= 3) ? 'style="font-size: 20px;color:red;"' : '';

        echo '<td class="text-left" ' . $fontStyle . '>' . $product_name . '</td>';
        echo '<td class="text-right">' . $total_customers . '</td>';
        echo '</tr>';

        // Highlight the top 3 best-selling products
        if ($counter <= 3) {
            echo '<script>document.querySelectorAll("td")[document.querySelectorAll("td").length - 3].style.color = "red";</script>';
        }

        $counter++;
    }

    // Free the result set
    mysqli_free_result($result);
} else {
    // Handle query error
    echo 'Error executing query: ' . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>



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

</style>
<script>
var phpUser = '<?php echo $user; ?>';
</script>
<script>	
	$(document).ready(function() {

    var table = $('#table1').DataTable();

    $('#status-filter').change(function() {
        var status = $(this).val();

        if (status === 'all') {
			table.search('').columns().search('').draw();
        } else {
            table.column(6).search(status).draw(); 
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

            // Get the current date
            var currentDate = new Date();
            var formattedDate = currentDate.toLocaleString();

            // Create a new window and append the cloned table
            var printWindow = window.open('', '_blank');
           
            var currentDate = new Date();
            var formattedDate = currentDate.toLocaleString();

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
            printWindow.document.write('<h1  style=" margin-bottom: 0px; padding: 0;">Kings Coffee Shop</h1>');
            // Additional paragraph under h1
            printWindow.document.write('<p style=" margin-top: 0px; margin-bottom: 0px; padding: 0;">3rd floor B2 L24, San Sebastián St. Brgy. San Gabriel</p>');
            printWindow.document.write('<p style=" margin-top: 0px; padding: 0;">G.M.A. 4117, General Mariano Alvarez, Philippines, 4117</p>');
            printWindow.document.write('</div>');
            // Add your logo image source and styling here
            printWindow.document.write('<div><img src="kingcoffee.jpg" alt="Logo" style="width: 100px; height:100px; auto; margin-right:50px;"></div>');
            printWindow.document.write('</div>');

            printWindow.document.write('<hr>');

            printWindow.document.write('<h1 style=" margin-bottom: 0px; padding: 0; text-align: center; font-size:25px;">Top Selling Report</h1>');

            printWindow.document.write('<div class="center" style="text-align: left;"><p>Date: ' + formattedDate + '</p></div>');
            printWindow.document.write(printableTable.prop('outerHTML'));
            printWindow.document.write('<div class="center" style="text-align: left;"><h4><i>Prepared by: ' + phpUser + ' / Administrator<i></h4></div>');
            printWindow.document.write('</body></html>');



            // Close the new window after printing
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        });
});

</script>

<?php
?>