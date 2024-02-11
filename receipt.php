
<?php 
include 'db_connect.php';
include 'receipt_content.php';
$order = $conn->query("SELECT * FROM orders where id = {$_GET['id']}");
foreach($order->fetch_array() as $k => $v){
	$$k= $v;
}
$items = $conn->query("SELECT o.*,p.name FROM order_items o inner join products p on p.id = o.product_id where o.order_id = $id ");
?>

<style>
	.flex p{
		display: inline-flex;
		width: 100%;
		font-family: "Courier New", monospace;
    font-size: 10px;
	}
	.w-50{
		width: 50%;
	}
	.text-center{
		text-align:center;
		margin-right: 25%;
	}
	
	table.wborder{
		width: 100%;
		border-collapse: collapse;
	}
	table.wborder>tbody>tr, table.wborder>tbody>tr>td{
		border:1px solid;
	}
	p{
		margin:unset;
	}

	
	.address {
    	font-family: Georgia, serif;
    	font-size: 10px;
	}


	.order-info {
    font-family: "Courier New", monospace;
    font-size: 10px;
}

	
.card-footer {
    font-family: Arial, sans-serif;
    font-size: 10px;
}
</style>
<div class="container-fluid ">
	<center><p><img src="kingcoffee.jpg" alt="logo" width="110" height="60"></p></center>
	<br>
	<center><p class="addrees">3rd floor B2 L24, San Sebastián St. Brgy. San Gabriel G.M.A. 4117, General Mariano Alvarez, Philippines, 4117</p></center>
	
	<center><h4>>>>><?php  echo $mode?><<<<<</h4></center>

	<p style="font-weight:100;">Cashier Name: <b><?php echo $user ?></b></p>
	<p style="font-weight:100;">Date: <b><?php echo date("M d, Y",strtotime($date_created)) ?></b></p>
	
	<hr>
	<div class="flex">
		<div class="w-100">
			<?php if($amount_tendered > 0): ?>
			<p style="font-weight:100;">Invoice No.: <b><?php echo $ref_no ?></b></p>
			<p style="font-weight:100;">MOP: <b><?php echo $payment_mode ?></b></p>
		<?php endif; ?>
			
		</div>
	</div>

	<hr>

	<table width="20%" class="order-info">
		<thead>
			<tr>
				<td style="font-weight:300;padding:5px;"><b>QTY</b></td>
				<td style="font-weight:300;padding:5px;"><b>Description</b></td>
				<td style="font-weight:300;padding:5px;"><b>Amount</b></td>
			</tr>
		</thead>
		
		<tbody>
			<?php 
			while($row = $items->fetch_assoc()):
			?>
			<tr>
				<td  style="font-weight:100;"><?php echo $row['qty'] ?></td>
				<td style="font-weight:100;"><p><?php echo $row['name'] ?></p>
			</td>
				<td class="text-center" style="font-weight:100;"><?php echo number_format($row['amount'],2) ?></td>
			</tr>
			<?php endwhile; ?>
		</tbody>
	</table>


	<hr>
	<table width="90%" class="order-info">
		<tbody>
			<tr>
			<td style="font-weight:300;padding:5px;"><b>Total</b></td>
				<td style="font-weight:300;padding:2px;margin-right:90%;"><b><?php echo number_format($total_amount,2) ?></b></td>
			</tr>
			<tr>
			<td style="font-weight:300;padding:5px;"><b>Amount Payable</b></td>
				<td style="font-weight:300;padding:2px;margin-right:90%;"><b><?php echo number_format($amount_payable,2) ?></b></td>
			</tr>
			<tr>
			<?php if ($discount !== 'none') : ?>
        <td style="font-weight:300;padding:5px;"><b>Discount Type</b></td>
        <td style="font-weight:300;padding:2px;margin-right:90%;"><b><?php echo $discount; ?></b></td>
    <?php endif; ?>
			</tr>
			<tr>
			<?php if ($discount !== 'none') : ?>
			<td style="font-weight:300;padding:5px;"><b>Discount Amount</b></td>
			<td style="font-weight:300;padding:2px;margin-right:90%;"><b>
    			<?php
					if ($discount === 'none') {
										echo '0.00'; // If no discount, display 0.00
					} elseif ($discount === 'senior') {
										$discountAmount = $total_amount * 0.20;
										echo number_format($discountAmount, 2);
					}elseif ($discount === 'pwd') {
						$discountAmount =  $total_amount * 0.20;
						echo number_format($discountAmount, 2);
					}
					elseif ($discount === 'loyalty') {
						$discountAmount = $total_amount * 0.05;
						echo number_format($discountAmount, 2);
					}
					 else {
										// Add conditions for other discount types here
					}
				?>
</b></td>
<?php endif; ?>
			</tr>
			<?php if($amount_tendered > 0): ?>


			<tr>	
			<td style="font-weight:300;padding:5px;">Cash</b></td>
				<td class="" style="font-weight:300;padding:2px;"><b><?php echo number_format($amount_tendered,2) ?></b></td>
			</tr>
			<tr>
			<td style="font-weight:300;padding:5px;">Change</b></td>
				<td class="" style="font-weight:300;padding:2px;"><b><?php echo number_format($amount_tendered - $amount_payable,2) ?></b></td>
			</tr>
		<?php endif; ?>
			
		</tbody>
	</table>

	<hr>
	<table width="90%" class="order-info">
		<tbody>
		<tr>
		<thead>
			<tr>
				<td style="font-weight:300;padding:5px;"><b>Net.Amt</b></td>
				<td style="font-weight:300;padding:5px;"><b>Non-vat</b></td>
				<td style="font-weight:300;padding:5px;"><b>Amount</b></td>
			</tr>
		</thead>
		<?php
// Calculate the non-VAT amount (3% of total_amount)
$nonVatAmount = $total_amount * 0.03;

// Add the non-VAT amount to the total_amount
$total_amount -= $nonVatAmount;
?>
		
				<td style="font-weight:300;padding:2px;margin-right:90%;"><b><?php echo number_format($total_amount,2) ?></b></td>

				<?php
// Calculate the non-VAT amount (3% of total_amount)
$nonVatAmount = $total_amount * 0.03;

// Add the non-VAT amount to the total_amount
$total_amount -= $nonVatAmount;
?>
				<td style="font-weight:300;padding:2px;margin-right:90%;"><b><?php echo number_format($nonVatAmount,2) ?></b></td>
				<td style="font-weight:300;padding:2px;margin-right:90%;"><b><?php echo number_format($amount_payable,2) ?></b></td>
			</tr>
		</tbody>
	</table>
	<hr>
	<center><h4 style="margin-bottom:0%;"><b>Customer Name</b></h4></center>
	<center><h5 style="margin-top:1%;"><i><?php echo $customer_name ?></i></h5></center>
	<hr>

	<br>
	<center><p class="card-footer"><b>THIS RECEIPT IS NOT OFFICIAL</b></p></center>


</div>
<script type="text/javascript">
   function printReceipt() {
    // Open a new window for printing
    var printWindow = window.open('', '_blank', 'width=900,height=600');

    // Build the HTML content for the receipt
    var receiptContent = '<html><head><title>Receipt</title></head><body>';
    receiptContent += '<style>';
    receiptContent += '.flex p{display:inline-flex;width:100%;font-family:"Courier New",monospace;font-size:10px;}';
    // Include your existing styles here
    receiptContent += '</style>';
    receiptContent += '<br>'; // Line break before the first receipt
    receiptContent += '<div class="container-fluid ">';
    // Include the content of your receipt.php here
    receiptContent += '<?php include "receipt_content.php"; ?>';
    receiptContent += '</div>';
    receiptContent += '<br>'; // Line break before the second receipt
    receiptContent += '</body></html>';

    // Set the HTML content for the print window
    printWindow.document.write(receiptContent);

    // Print the first copy
    printWindow.print();

    // Use setTimeout to add a delay before adding the second copy
    setTimeout(function () {
        // Add a page break for the second copy
        receiptContent += '<div style="page-break-before: always;"></div>';

        // Set the updated HTML content for the print window
        printWindow.document.write(receiptContent);

        // Print the second copy
        printWindow.print();

        // Close the print window
        printWindow.close();
    }, 500); // Adjust the delay as needed
}

// Auto-execute the print function when the window loads
window.onload = function () {
    printReceipt();
};

</script>