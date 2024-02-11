<?php 
include('db_connect.php');
// Step 1: Retrieve sales data from the database
$query = "SELECT o.date_created, oi.product_id, oi.qty, oi.price, p.name
          FROM orders o
          JOIN order_items oi ON o.id = oi.order_id
          JOIN products p ON oi.product_id = p.id";
$result = mysqli_query($conn, $query);

// Organize and calculate total sales for each product
$productSalesData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $date = $row['date_created'];
    $productName = $row['name'];
    $quantity = $row['qty'];
    $price = $row['price'];
    $sales = $quantity * $price;

    // Store product sales for each date
    $productSalesData[$date][$productName] = ($productSalesData[$date][$productName] ?? 0) + $sales;
}

// Prepare data for top-selling products
$topSellingProducts = array();
foreach ($productSalesData as $date => $productSales) {
    $topProduct = reset($productSales);
    $topSellingProducts[$date] = [
        'product' => key($productSales),
        'sales' => $topProduct
    ];
}

// Prepare data for line graph
$dates = array_keys($topSellingProducts);
$totalSales = array_values(array_column($topSellingProducts, 'sales'));
$productNames = array_values(array_column($topSellingProducts, 'product'));

?>
<style>
    .acard, .bcard, .ccard, .dcard {
        width: 100%;
        max-width: 250px;
        margin: 20px auto;
    }

    @media (min-width: 768px) {
        .acard {
            margin-left: 0;
        }

        .bcard {
            margin-left: 0;
            margin-top: -115px;
        }

        .ccard {
            margin-left: 0;
            margin-top: -115px;
        }

        .dcard {
            margin-left: 0;
            margin-top: -115px;
        }
    }

    /* Add more media queries for larger screens if needed */
</style>


<div class="acard">
    <div class="card border-right-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Registered Users</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                
                            $query = "SELECT id FROM users ORDER BY id";  
                            $query_run = mysqli_query($conn, $query);
                            $row = mysqli_num_rows($query_run);
                            echo '<h4> Total : '.$row.'</h4>';
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-user fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="bcard">
    <div class="card border-right-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> orders</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                
                            $query = "SELECT id FROM orders ORDER BY id";  
                            $query_run = mysqli_query($conn, $query);
                            $row = mysqli_num_rows($query_run);
                            echo '<h4> Total: '.$row.'</h4>';
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-calculator  fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="ccard">
    <div class="card border-right-primary shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Categories</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                
                            $query = "SELECT id FROM categories ORDER BY id";  
                            $query_run = mysqli_query($conn, $query);
                            $row = mysqli_num_rows($query_run);
                            echo '<h4> Total: '.$row.'</h4>';
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-box  fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="dcard">
    <div class="card border-right-info shadow h-100 py-2">
        <div class="card-body border-right-info">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1"> Products</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        <?php
                
                            $query = "SELECT id FROM products ORDER BY id";  
                            $query_run = mysqli_query($conn, $query);
                            $row = mysqli_num_rows($query_run);
                            echo '<h4> Total: '.$row.'</h4>';
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                    <i class="fas fa-list  fa-2x text-gray-300"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="chart.js"></script>
<canvas id="lineChart"></canvas>
<script>
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($dates); ?>,
            datasets: [{
                label: 'Total Sales',
                data: <?php echo json_encode($totalSales); ?>,
                backgroundColor: 'rgba(0, 123, 255, 0.3)',
                borderColor: 'rgba(0, 123, 255, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            onClick: function (event, elements) {
                if (elements.length > 0) {
                    var dataIndex = elements[0].index;
                    var productName = <?php echo json_encode($productNames); ?>[dataIndex];
                    alert('Product: ' + productName);
                }
            }
        }
    });
</script>