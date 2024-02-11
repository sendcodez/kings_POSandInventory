<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css"> 
<script src="javascript/jquery.dataTables.min.js"></script>

<?php
    include 'db_connect.php';
    $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-01');
    $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-t');
    $payment_mode = isset($_GET['payment_mode']) ? $_GET['payment_mode'] : '';
    $month = isset($_GET['month']) ? $_GET['month'] : date('Y-m'); // Add this line to handle the month variable
?>
    <div class="container-fluid">
        <div class="col-lg-18">
            <div class="card">
                <div class="card_body">
                <div class="row justify-content-center pt-4">
                    <label for="" class="mt-2">Date Range</label>
                <div class="col-sm-3">
                    <input type="date" name="start_date" id="start_date" value="<?php echo $start_date ?>" class="form-control">
                </div>
                <div class="col-sm-3">
                    <input type="date" name="end_date" id="end_date" value="<?php echo $end_date ?>" class="form-control">
                </div>
                <div class="col-sm-3">
    <button type="button" class="btn btn-primary" id="search-button">Filter</button>
</div>
                <br>
                   
                    <div class="col-sm-6">
                        <br>
                       <center><label for="" class="mt-2">Mode of Payment</label></center> 
                        <select name="payment_mode" id="payment_mode" class="form-control">
                            <option value="">All</option>
                            <option value="gcash" <?php echo $payment_mode == 'gcash' ? 'selected' : '' ?>>GCash</option>
                            <option value="cash" <?php echo $payment_mode == 'cash' ? 'selected' : '' ?>>Cash</option>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="col-md-16">
                    <table class="table" id='report-list'>
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="">CASHIER NAME</th>
                                <th class="">DATE</th>
                                <th class="">INVOICE</th>
                                <th class="">CUSTOMER NAME</th>
                                <th class="">MODE OF PAYMENT</th>
                                <th class="">AMOUNT</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $i = 1;
                        $total = 0;
                        $sales = $conn->query("SELECT * FROM orders WHERE amount_tendered > 0 AND date_created BETWEEN '$start_date' AND '$end_date' " . ($payment_mode ? "AND payment_mode = '$payment_mode'" : "") . " ORDER BY unix_timestamp(date_created) ASC"); 

                        if($sales->num_rows > 0):
                        while($row = $sales->fetch_array()):
                            $total += $row['total_amount'];
                        ?>
                        <tr>
                            
                            <td class="text-center"><b><?php echo $i++ ?></td>
                          
                            <td><?php echo $row['user'] ?></td>
            
                            <td>
                                <p> <?php echo date("M d,Y",strtotime($row['date_created'])) ?></p>
                            </td>
                        
                            <td>
                                <p> <?php echo $row['amount_tendered'] > 0 ? $row['ref_no'] : 'N/A' ?></p>
                            </td>
                            <td class="text-center">
                                <p> <?php echo $row['customer_name'] ?></p>
                            </td>
                            <td class="text-center">
                            <?php if($row['payment_mode'] == 'cash'): ?>
                                                <span class="badge badge-success">Cash</span>
                                            <?php else: ?>
                                                <span class="badge badge-primary">Gcash</span>
                                            <?php endif; ?>
                            </td>
                            <td>
                                <p class="text-right">₱ <?php echo number_format($row['total_amount'],2) ?></p>
                            </td>
                        </tr>
                        <?php 
                            endwhile;
                            else:
                        ?>
                        <tr>
                                <th class="text-center" colspan="5">No Data.</th>
                        </tr>
                        <?php 
                            endif;
                        ?>
                        </tbody>
                        <tfoot>
                            <tr>
                              
                                <th colspan="6" class="text-right">Total</th>
                                <th class="text-right"><?php echo number_format($total,2) ?></th>
                            </tr>
                        </tfoot>
                    </table>
                    <hr>
                    <div class="col-md-12 mb-4">
                        <center>
                            <button class="btn btn-success btn-sm col-sm-3" type="button" id="print"><i class="fa fa-print"></i> Print</button>
                        </center>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
    <noscript>
        <style>
                 
            table#report-list{
                width:100%;
                border-collapse:collapse
            }
            table#report-list td,table#report-list th{
                border:1px solid
            }
            p{
                margin:unset;
            }
            .text-center{
                text-align:center
            }
            .text-right{
                text-align:right
            }
        </style>
    </noscript>


    <script>
        $(document).ready(function() {
    $('#report-list').DataTable();
});
  $('#start_date, #end_date, #payment_mode').on('keydown', function(event) {
    if (event.keyCode === 13) { // Check if Enter key is pressed
        event.preventDefault(); // Prevent form submission
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var payment_mode = $('#payment_mode').val();
        location.replace('index.php?page=sales_report&start_date=' + start_date + '&end_date=' + end_date + '&payment_mode=' + payment_mode + '&month=' + '<?php echo $month ?>');
    }   
});


$('#print').click(function(){
        var _c = $('#report-list').clone();
        var ns = $('noscript').clone();
        ns.append(_c);
        var nw = window.open('','_blank','width=900,height=600');
        nw.document.write('<img src ="Logo Kings.jpg" style ="float:left; width:100px; height:100px; margin-bottom:20px;"/>  <p class="text-center" style= "font-size:20px; text-align: center;"><b> <br> <br><br> SALES REPORT as of <?php echo date("F, Y",strtotime($month)) ?></b></p><br>  ') ;
        nw.document.write(ns.html());
        nw.document.write('<p class="text" style= "font-size:20px; text-align: center;"> <b><br> Prepared by: <?php $user = $_SESSION['login_name'];?> </b></p>');
        nw.document.close();
        nw.print();
        setTimeout(() => {
            nw.close();
        }, 500);
    });

       // Function to perform the search
       function performSearch() {
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var payment_mode = $('#payment_mode').val();
        location.replace('index.php?page=sales_report&start_date=' + start_date + '&end_date=' + end_date + '&payment_mode=' + payment_mode + '&month=' + '<?php echo $month ?>');
    }

    // Bind the search function to the search button click event
    $('#search-button').on('click', function() {
        performSearch();
    });

    // Bind the search function to the Enter key press event in the input fields
    $('#start_date, #end_date, #payment_mode').on('keydown', function(event) {
        if (event.keyCode === 13) { // Check if Enter key is pressed
            event.preventDefault(); // Prevent form submission
            performSearch();
        }
    });

    </script>