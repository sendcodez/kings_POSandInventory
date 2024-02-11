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
            


                        <div class="col-lg-16" style="margin-left:-210px;">
                        <div class="card" style="width:100%;">
		<div class="card-header">

        <span><h5 style="color:	#36454F"><b>Sales Report</b></h5></span> 	<button class="btn btn-success btn-sm " style="font-size: 1rem;border-radius:15px; height:35px; width: 110px;float:right;" type="button" id="print" style="font-size: 1.3rem;border-radius:20px; float-right;"><i class="fa fa-print"></i> Print</button>
						 
        </div>
                <!-- Table Panel -->
                <div class="card-body">
                        <div class="table-responsive">
                        <table class="table table-hover" id="table1">
                        <div class="text-right">
                            
    				</div>
            </div>
                        <div class="filter-container">
                    <label for="startDate"style="margin-left: -31px;">Start Date:</label>
<input type="date" id="startDate" name="startDate" style="border-radius:10px; font-size: 0.90rem;">

<label for="endDate" style="margin-left: 15px;">End Date:</label>
<input type="date" id="endDate" name="endDate" style="border-radius:10px; font-size: 0.90rem;">

<button style="background-color:#FDD89D; font-size: 1rem; color:black; border-radius:15px; height:35px; width: 150px; border-color:#FDD89D; margin-left: 15px;" onclick="applyDateFilter()">Apply Filter</button>
</div>

</br>               
                            <thead>
        <tr>
            <th class="text-center">#</th>
            <th class="text-center">INVOICE</th>
            <th class="text-center">DATE</th>
            <th class="text-center">GROSS SALES</th>
            <th class="text-center">VAT 3%</th>
            <th class="text-center">DISCOUNT</th>
            <th class="text-center">TOTAL DISCOUNT</th>
            <th class="text-center">SALE</th>
            <th class="text-center">PAYMENT METHOD</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i=1;
        $totalNetSales = 0; // Variable to store the total net sales
        $totalGrossSales = 0;
        $product = $conn->query("SELECT * FROM orders order by unix_timestamp(date_created) desc");
        while ($row = $product->fetch_assoc()):
            $totalGrossSales += $row['total_amount'];
            $grossSales = $row['total_amount'];
            $withVat = $grossSales * 0.03;

            // Calculate the discount and total discount
            if ($row['discount'] === 'pwd') {
                $discountRate = 0.20;
            } elseif ($row['discount'] === 'loyalty') {
                $discountRate = 0.05;
            } elseif ($row['discount'] === 'senior') {
                $discountRate = 0.20;
            } elseif ($row['discount'] === 'none') {
                $discountRate = 0;
            } else {
                $discountRate = 0; // Default for other cases
            }

            $discountedSale = $grossSales * $discountRate;
            $totalDiscount = $discountedSale + $withVat;

            // Calculate total sale
            $totalSale = $grossSales - $totalDiscount;
            $totalNetSales += $totalSale; // Accumulate total net sales

            // Output the table row
            ?>
            <tr>
            <td class="text-right"><?= $i++ ?></td>
                <td class="text-right"><?= $row['ref_no'] ?></td>
                <td class="text-center"><?= date('Y-m-d', strtotime($row['date_created'])) ?></td>
                <td class="text-right"><?= $grossSales ?></td>
                <td class="text-right"><?= $withVat ?></td>
                <td class="text-right"><?= $row['discount'] ?> (<?= $discountedSale ?>)</td>
                <td class="text-right"><?= $totalDiscount ?></td>
                <td class="text-right"><?= $totalSale ?></td>
                <td class="text-right"><?= $row['payment_mode'] ?></td>
                
            </tr>
        <?php endwhile; ?>
    <tfoot>
    <tr>
    <td></td>

        <td class="text-center" style="font-weight:900;font-size:1.2rem;width:20vh">GROSS SALES</td>
        <td class="text-center" id="totalGrossDisplay" style="font-weight:900;font-size:1.5rem">P <?= number_format($totalGrossSales,2)    ?></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>

        <td class="text-center" style="font-weight:900;font-size:1rem">NET SALES</td>
        <td class="text-center" id="totalNetSalesDisplay" style="font-weight:900;font-size:1.5rem">P <?= number_format($totalNetSales,2)    ?></td>
    </tr>
</tfoot>
    </tbody>

   
    </table>

                    </div>
                </div>		
                <!-- Table Panel -->
            </div>
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
    
.text-right{
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
    .filter {
    margin-right: 10px; /* Adjust the margin as needed to separate the filters */
}

    .text-center, .btn{
		font-size:18px;
	}

    </style>
    <script>
var phpUser = '<?php echo $user; ?>';
</script>
<script>	
        $('table').dataTable();
        var total;
      
      
   
$(document).ready(function() {

$('#print').on('click', function () {
    printTable();
});

function printTable() {
    // Clone the table and remove unnecessary elements
    var printTable = $('#table1').clone();
    printTable.find('.dataTables_paginate, .dataTables_info, .dataTables_length').remove();

    // Create a new window for printing
    var startDate = document.getElementById("startDate").value;
    var endDate = document.getElementById("endDate").value;
    var printWindow = window.open('', '_blank');
    var currentDate = new Date();
    var formattedDate = currentDate.toLocaleString();

    printWindow.document.open();
    printWindow.document.write('<html><head><title>Net Sales</title></head><body>');

    // Append the cloned table to the new window
    printWindow.document.write('<style>table {fo    nt-size: 20px; border-collapse: collapse; width: 100%;} th, td {font-size: 14px; border: 1px solid #ddd; padding: 8px; text-align: left;} th {background-color: #f2f2f2;}.center { text-align: center; }.header {display: flex; justify-content: space-between; align-items: center;}</style>');
    printWindow.document.write('<div class="header" style="background-color: #FFEFD5">');
    printWindow.document.write('<div>');
    printWindow.document.write('<h1 style=" margin-bottom: 0px; padding: 0;">Kings Coffee Shop</h1>');
    // Additional paragraph under h1
    printWindow.document.write('<p style="margin-top: 0; margin-bottom: 0;">3rd floor B2 L24, San Sebastián St. Brgy. San Gabriel</p>');
    printWindow.document.write('<p style=" margin-top: 0px; padding: 0;">G.M.A. 4117, General Mariano Alvarez, Philippines, 4117</p>');
    printWindow.document.write('</div>');
    printWindow.document.write('<div><img src="kingcoffee.jpg" alt="Logo" style="width: 120px; height:100px; auto; margin-right:50px;"></div>');
    printWindow.document.write('</div>');

    printWindow.document.write('<hr>');

    printWindow.document.write('<h1 style=" margin-bottom: 0px; padding: 0; text-align: center; font-size:25px;">Sales Report</h1>');
    printWindow.document.write('<div class="center" style="text-align: left;">');
    printWindow.document.write('<label for="startDate">Start Date:</label>');
    printWindow.document.write('<span>' + startDate + '</span><br>');
    printWindow.document.write('<label for="endDate">End Date:</label>');
    printWindow.document.write('<span>' + endDate + '</span>');
    printWindow.document.write('</div>');

    // Include the PHP variable in the JavaScript code


    printWindow.document.write(printTable.prop('outerHTML'));
    printWindow.document.write('<div class="center" style="text-align: left;"><h4><i>Prepared by: ' + phpUser + ' / Administrator<i></h4></div>');
    printWindow.document.write('<p>Date: ' + formattedDate + '</p>');
    printWindow.document.write('</div>');

    // Close the HTML document
    printWindow.document.write('</body></html>');
    printWindow.document.close();

    // Print the new window
    printWindow.print();
}


var table;({
    "ajax": "month_filter.php",
    "columns": [
        { "data": "0" },
        { "data": "1" },
        { "data": "2" },
        { "data": "3" },
        { "data": "4" },
        { "data": "5" },
        { "data": "6" },
        { "data": "7" }
    ],  
    "paging": true,
    "searching": true,
    "footerCallback": function (row, data, start, end, display) {
        var api = this.api();
        var totalNetSales = api.column(7, { page: 'current' }).data().reduce(function (a, b) {
            return a + b;
        }, 0);
        var totalGrossSales = api.column(3, { page: 'current' }).data().reduce(function (a, b) {
            return a + b;
        }, 0);
        $('#totalNetSalesDisplay').text('NET SALES: P ' + totalNetSales.toFixed(2));
        $('#totalGrossDisplay').text('GROSS SALES: P ' + totalGrossSales.toFixed(2));
    }
});
});


function applyDateFilter() {
    console.log('Applying date filter...');
    var startDate = document.getElementById("startDate").value;
    var endDate = document.getElementById("endDate").value;

    // Reload the datatable with the selected date range filter
    var table = $('#table1').DataTable();
    table.ajax.url("month_filter.php?startDate=" + startDate + "&endDate=" + endDate).ajax.reload(function () {
        // Fetch totalNetSales separately and update the footer
        $.getJSON("month_filter.php?startDate=" + startDate + "&endDate=" + endDate, function (json) {
            console.log('Total Net Sales from server:', json.totalNetSales);
            updateTotalNetSales(json.totalNetSales);
            updateGrossSales(json.totalGrossSales);
        });
    });
}

function updateTotalNetSales(totalNetSales) {
    $('#totalNetSalesDisplay').text('P ' + totalNetSales);
}
function updateGrossSales(totalGrossSales) {
    $('#totalGrossDisplay').text('P ' + totalGrossSales);
}
    </script>
