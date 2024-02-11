<?php
 include 'db_connect.php';

session_start();

// Check if the user is logged in (you need to implement your own authentication logic)
if (!isset($_SESSION['login_name'])) {
    // Redirect the user to the login page or handle the case where the user is not logged in.
    header('Location: login.php');
    exit();
}
// Set the timezone to 'Asia/Manila'
date_default_timezone_set('Asia/Manila');

$today = date('Y-m-d');

$userID = $_SESSION['login_name'];

// Query to retrieve orders for today
$query = "SELECT * FROM orders WHERE user = '$userID' AND DATE(date_created) = CURDATE()";

$result = $conn->query($query);

$printData = "<pre><span style='font-size: 20px; font-weight: bold;'> $userID</span></pre>\n\n";
echo "<pre>$printData</pre>";

$productBreakdown = array();

// Check if there are transactions for the user
if ($result->num_rows > 0) {
    // Initialize the print data and total
    $printData = "";
    $totalAmount = 0;

    // Loop through the results and format the data for printing
    while ($row = $result->fetch_assoc()) {
        $orderId = $row['id'];
        $refNo = $row['ref_no'];
        $transactionAmount = $row['total_amount']; // Get the transaction amount
        $amountTendered = $row['amount_tendered'];
        $customerName = $row['customer_name'];
        $dateCreated = $row['date_created'];
        $paymentMode = $row['payment_mode'];

        $orderID = $row['id'];
        $productQuery = "SELECT * FROM order_items WHERE order_id = $orderID";
        $productResult = $conn->query($productQuery);

        while ($productRow = $productResult->fetch_assoc()) {
            $productID = $productRow['product_id'];
            $quantity = $productRow['qty'];
            $price = $productRow['price'];

            // Retrieve the product name based on the product_id
            $productInfoQuery = "SELECT name FROM products WHERE id = $productID";
            $productInfoResult = $conn->query($productInfoQuery);
            $productInfo = $productInfoResult->fetch_assoc();
            $productName = $productInfo['name'];

            // Update or initialize the product breakdown array
            if (isset($productBreakdown[$productName])) {
                $productBreakdown[$productName]['quantity'] += $quantity;
                $productBreakdown[$productName]['total'] += $price * $quantity;
            } else {
                $productBreakdown[$productName] = array(
                    'quantity' => $quantity,
                    'total' => $price * $quantity
                );
            }
        }



        // Add the transaction amount to the total
        $totalAmount += $transactionAmount;

        // Format the data for printing
        $printData .= "Order ID: $orderId\n";
        $printData .= "Reference No: $refNo\n";
        $printData .= "Total Amount: $transactionAmount\n"; // Display transaction amount
        $printData .= "Amount Tendered: $amountTendered\n";
        $printData .= "Customer Name: $customerName\n";
        $printData .= "Date: $dateCreated\n";
        $printData .= "Payment Mode: $paymentMode\n";
        $printData .= "-------------------------------------\n";
       
    
    }
    $today = date('Y-m-d');
    date_default_timezone_set('Asia/Manila');
    $totalVoidAmount = 0;
    $voidedQuery = "SELECT * FROM void WHERE cashier_name = '$userID' AND DATE(date) = CURDATE()";
    $voidedResult = $conn->query($voidedQuery);
 
    if ($voidedResult->num_rows > 0) {
        $printData .= "<span style='color: black; font-weight: 900;'>VOIDED ITEMS</span>\n";

        while ($voidedRow = $voidedResult->fetch_assoc()) {
            $voidedItemID = $voidedRow['void_id'];
            $voidedCashierName = $voidedRow['cashier_name'];
            $voidedPrice = $voidedRow['price'];
            $voidedDate = $voidedRow['date'];

            $totalVoidAmount += $voidedPrice;

            // Format the voided item data for printing
            $printData .= "Item ID: $voidedItemID\n";
            $printData .= "Price: $voidedPrice\n";
            $printData .= "Date: $voidedDate\n";
            $printData .= "-------------------------------------\n";
        }
    }
    // Close the database connection
    $conn->close();
    $printData .= "<b>Product Breakdown:</b>\n\n";
    foreach ($productBreakdown as $productName => $details) {
        $printData .= "$productName - Sold: {$details['quantity']}, Total: {$details['total']}\n\n";
    }

    // Display the total at the end of the print data
    $printData .= "<b>Total Sales: $totalAmount</b>\n";  // Add an extra line break here
    $printData .= "<b>Total Void: $totalVoidAmount</b>\n";
   
    // Print the data
    echo "<pre>$printData</pre>";
    
    // JavaScript to trigger automatic printing
    echo '<script type="text/javascript">
    window.onload = function() {
        window.print();
        
    }
</script>';
} else {
    echo "No transactions found for the logged-in user.";
}   
?>  