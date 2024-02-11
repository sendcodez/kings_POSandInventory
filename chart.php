
<?php
include 'db_connect.php';

// Set the content type to JSON
header('Content-Type: application/json');

// Function to format dates consistently
function formatDate($date)
{
    return date('Y-m-d', strtotime($date));
}

// API endpoint for daily sales
if ($_SERVER['REQUEST_URI'] === '/kingscoffee/chart.php/daily-sales') {
    $result = $conn->query("SELECT DATE_FORMAT(date_created, '%Y-%m-%d') AS order_date, SUM(total_amount) AS daily_sales 
                           FROM orders 
                           GROUP BY DATE_FORMAT(date_created, '%Y-%m-%d') 
                           ORDER BY DATE_FORMAT(date_created, '%Y-%m-%d')");

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $row['order_date'] = formatDate($row['order_date']);
        $data[] = $row;
    }

    echo json_encode($data);
}

// API endpoint for monthly sales
elseif ($_SERVER['REQUEST_URI'] === '/kingscoffee/chart.php/monthly-sales') {
    $result = $conn->query("SELECT DATE_FORMAT(date_created, '%Y-%m') AS order_month, SUM(total_amount) AS monthly_sales 
                           FROM orders 
                           GROUP BY DATE_FORMAT(date_created, '%Y-%m') 
                           ORDER BY DATE_FORMAT(date_created, '%Y-%m')");

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $row['order_month'] = formatDate($row['order_month']);
        $data[] = $row;
    }

    echo json_encode($data);
}

// API endpoint for yearly sales
elseif ($_SERVER['REQUEST_URI'] === '/kingscoffee/chart.php/yearly-sales') {
    $result = $conn->query("SELECT DATE_FORMAT(date_created, '%Y') AS order_year, SUM(total_amount) AS yearly_sales 
                           FROM orders 
                           GROUP BY DATE_FORMAT(date_created, '%Y') 
                           ORDER BY DATE_FORMAT(date_created, '%Y')");

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }

    echo json_encode($data);
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Endpoint not found']);
}

$conn->close();
?>