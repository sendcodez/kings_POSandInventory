<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php
// Include your database connection file
include('db_connect.php');

// Retrieve date parameters
$startDate = isset($_GET['start-date']) ? $_GET['start-date'] : '';
$endDate = isset($_GET['end-date']) ? $_GET['end-date'] : '';

// Your database query with date filtering
$product = $conn->query("
   SELECT pi.ingredients_id, i.date_created, i.name, i.category_id, i.stocks, i.expiration_date, SUM(pi.measurement * oi.qty) AS total_usage
   FROM product_ingredients AS pi
   JOIN ingredients AS i ON pi.ingredients_id = i.id
   JOIN order_items AS oi ON pi.product_id = oi.product_id
   WHERE i.date_created BETWEEN '$startDate' AND '$endDate'
   GROUP BY pi.ingredients_id, i.name;
");

// Start building the HTML for the updated table
$html = '<thead>
            <tr>
                <th class="text-center">#</th>
                <th class="text-center">NAME</th>
                <th class="text-center">STOCKS</th>
                <th class="text-center">TOTAL USAGE</th>
                <th class="text-center">AVAILABLE</th>
                <th class="text-center">DATE ADDED</th>
                <th class="text-center">EXPIRATION DATE</th>
                <th class="text-center">STATUS</th>
            </tr>
        </thead>
        <tbody>';
        $date = date('Y-m-d');
$i = 1;
while ($row = $product->fetch_assoc()) {
    $available = $row['stocks'] - $row['total_usage'];

    $html .= '<tr>
                <td class="text-center">' . $i++ . '</td>
                <td class="text-center">' . $row['name'] . '</td>
                <td class="text-center">' . $row['stocks'] . '</td>
                <td class="text-center">' . $row['total_usage'] . '</td>
                <td class="text-center">' . max(0, $available) . '</td>
                <td class="text-center">' . $row['date_created'] . '</td>
                <td class="text-center">' . $row['expiration_date'] . '</td>
                <td class="text-center">';

    // Status calculation logic
    $availability_percentage = ($available / $row['stocks']) * 100;

    if ($date >= $row['expiration_date']) {
        $html .= '<span class=" badge bg-danger">Expired</span>';
    } elseif ($availability_percentage >= 30 && $availability_percentage <= 50) {
        $html .= '<span class=" badge bg-warning" style="color:white;">Low</span>';
    } elseif ($available <= 0) {
        $html .= '<span class=" badge bg-secondary" style="color:white;">Out of Stock</span>';
    } elseif ($availability_percentage < 20) {
        $html .= '<span class=" badge bg-danger" style="color:white;">Critical</span>';
    } elseif (strtotime($row['expiration_date']) - strtotime($date) <= 604800) {
        $html .= '<span class=" badge bg-warning">Expires soon</span>';
    } else {
        $html .= '<span class=" badge bg-success" style="color:white;">Normal</span>';
    }

    $html .= '</td></tr>';
}

$html .= '</tbody>';

// Output the HTML
echo $html;

// Close database connection
$conn->close();
?>
