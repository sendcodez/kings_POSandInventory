<?php
include('db_connect.php');

$startDate = isset($_GET['startDate']) ? $_GET['startDate'] : '';
$endDate = isset($_GET['endDate']) ? $_GET['endDate'] : '';
$currentYear = date('Y');

try {
    // Modify the query based on the selected date range
    if (empty($startDate) && empty($endDate)) {
        $product = $conn->query("SELECT * FROM orders WHERE YEAR(date_created) = $currentYear");
    } else {
        $startDate = date('Y-m-d', strtotime($startDate));
        $endDate = date('Y-m-d', strtotime($endDate));

        $product = $conn->query("SELECT * FROM orders WHERE date_created BETWEEN '$startDate' AND '$endDate'");
    }

    if (!$product) {
        throw new Exception("Error executing the query: " . $conn->error);
    }
    $i=1;
    $totalNetSales = 0; // Variable to store the total net sales
    $totalGrossSales = 0;
    $data = array();
    while ($row = $product->fetch_assoc()) {
        $totalGrossSales += $row['total_amount'];
        $grossSales = $row['total_amount'];
        $withVat = $grossSales * 0.12;

        $discountRate = getDiscountRate($row['discount']);
        $discountedSale = $grossSales * $discountRate;
        $totalDiscount = $discountedSale + $withVat;

        $totalSale = $grossSales - $totalDiscount;
        $totalNetSales += $totalSale; // Accumulate total net sales

        $data[] = array(
            $i++,
            $row['ref_no'],
            date('Y-m-d', strtotime($row['date_created'])),
            $grossSales,
            number_format($withVat, 2),
            $row['discount'] . '(' . number_format($discountedSale, 2) . ')',
            number_format($totalDiscount, 2),
            number_format($totalSale, 2),
            $row['payment_mode']
        );
    }

    $response = ['data' => $data, 'totalNetSales' => number_format($totalNetSales, 2), 'totalGrossSales' => number_format($totalGrossSales, 2)];
    
    // Encode the response as JSON
    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
} finally {
    // Close the database connection
    $conn->close();
}

function getDiscountRate($discountType) {
    switch ($discountType) {
        case 'pwd':
            return 0.20;
        case 'loyalty':
            return 0.05;
        case 'senior':
            return 0.20;
        default:
            return 0;
    }
}
?>
