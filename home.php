
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales Dashboard</title>
    <script src="chart.js"></script>
</head>
<body>
<style>
* {
  box-sizing: border-box;
}


body {
  margin-top: -1px;
}

/* Float four columns side by side */
.column {
  float: left;
  padding: 0 15px;
  margin-bottom: 2%;
  width: 50%;
  height: 60%;
  margin-left: -100px;
  margin-right: 100px;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 -5px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 768px) {
  .column {
    width: 100%;
    display: block;
    margin-bottom: 20px;
  }

}


.card {
  /*box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);*/
  padding: 16px;
  background-color: #fff;
}
.title{
    margin-left: -18%;
    margin-top: 1%;
}

.cards{
  margin-left: -10%;
}

.linechart{
    background-color: white;
}

.title{
    margin-top: -3%;
    margin-bottom: 1%;


}


.round-button {
  display: flex; 
  align-items: center;
  justify-content: center;
  width: 60px; /* Adjust the size as needed for your design */
  height: 60px; /* Adjust the size as needed for your design */
  border-radius: 50%; /* Makes the button round */
  background-color: #D78C15; /* Background color of the button */
  color: white; /* Text color */
  border: none; /* Remove the border if needed */
  cursor: pointer;
  outline: none; /* Remove the default focus outline */
}

.chart-area {
  position: relative;
  height: 10rem;
  width: 100%;
}

@media (min-width: 768px) {
  .chart-area {
    height: 20rem;
  }
}

@media (min-width: 768px) {
  .chart-area {
    height: 40rem;
  }
}

#periodDropdown {
        color: white;
        background-color: #808080; 
        border-radius: 5px; 
        font-size: 18px;
    }

    /* Style for the options on hover */
    .option:hover {
        background-color: #5A5A5A;
        color:white;
    }

</style>


<br>
<br>

<div class="title">
    <h3>Dashboard</h3>
    <span>Today's Data</span>
</div>

  <div class="column">
  <div class="card border-right-dark shadow h-100 py-2">
  <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1"> Best Seller</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                        $query = "SELECT oi.product_id, p.name, COUNT(DISTINCT o.ref_no) AS total_customers
                        FROM order_items oi
                        JOIN orders o ON oi.order_id = o.id
                        JOIN products p ON oi.product_id = p.id
                        GROUP BY oi.product_id, p.name
                        ORDER BY total_customers DESC";
                        $query_run = mysqli_query($conn, $query);
    
                    if (mysqli_num_rows($query_run) > 0) {
                        $row = mysqli_fetch_assoc($query_run);
                        $bestSellingProductName = $row['name'];
        
                        // Display the best-selling product's name
                        echo '<h4 style="color:#502913EB"> <b> '.$bestSellingProductName.'</h4>';
                } else {
                    echo '<h4>No sales data.</h4>';
                }
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                <button class="round-button">
                    
                    <i class="fas fa-utensils fa-2x text-gray-300"></i>
                </button>
                </div>
            </div>

            </div>
    </div>
  </div>

  <div class="column">
  <div class="card border-right-dark shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1"> orders</div>
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
                <button class="round-button">
                    <i class="fas fa-calculator  fa-2x text-gray-300"></i>
            </button>
                </div>
            </div>
        </div>
    </div>
        
    </div>
  </div>
  
  <div class="column">
  <div class="card border-right-dark shadow h-100 py-2">
        <div class="card-body">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1"> Today Sales</div>
                    <div class="h5 mb-0 font-weight text-gray-800">
                    <?php
                    include 'db_connect.php';

                    date_default_timezone_set('Asia/Manila');
                    $currentDate = date('Y-m-d');

                    // Query to retrieve today's sales
                    $query = "SELECT SUM(amount_payable) AS total_sales FROM orders WHERE DATE(date_created) = CURDATE()";
                    $result = $conn->query($query);

                    if ($result && $result->num_rows > 0) {
                        $row = $result->fetch_assoc();
                        $totalSales = $row['total_sales'];
                        echo 'Php.' . number_format($totalSales, 2); // Format and display the total sales
                    } else {
                        echo 'No sales recorded today.';
                    }

                    
                    ?>
                    </div>
                </div>

                <div class="col-auto">
                <button class="round-button">
                    <i class="fas fa-box  fa-2x text-gray-300"></i>
                </button>
                </div>

            </div>
        </div>
                
        </div>  
    </div>
  </div>
  <?php
    $totalNetSales = 0; // Variable to store the total net sales
    $totalGrossSales = 0;
    $product = $conn->query("SELECT * FROM orders ORDER BY unix_timestamp(date_created) DESC");

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
    endwhile;
?>
  <div class="column">

  <div class="card border-right-info shadow h-100 py-2">
        <div class="card-body border-right-info">
            <div class="row no-gutters align-items-center">
                <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-dark text-uppercase mb-1"> SALES</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                    <?php
                            echo 'Php.' . number_format($totalNetSales, 2); // Format and display the total sales
                        ?>
                    </div>
                </div>
                <div class="col-auto">
                <button class="round-button">
                    <i class="fas fa-list  fa-2x text-gray-300"></i>
                </button>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Add a select dropdown for the user to choose the period -->
<div class="row" style="margin-left: -20%; margin-top: 170px;float: right;position: relative; z-index: 1;">
    <div class="col-xl-12 col-lg-12">

        <select id="periodDropdown" onchange="handlePeriodChange()" >
        <option value="default" disabled selected>Select Period</option>
            <option value="daily">Daily</option>
            <option value="monthly">Monthly</option>
            <option value="yearly">Yearly</option>
        </select>
    </div>
</div>

<!-- Daily Sales Chart -->
<div class="row" style="margin-left: -20%; margin-right: -4%;">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4" id="dailySalesCard">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">DAILY SALES</h6>
                <button class="btn btn-primary btn-sm" style="background-color:#FDD89D; font-size: 1rem; color:black; border-radius:15px; height:35px; width: 150px; border-color:#FDD89D; margin-right: 225px;" id="printDaily">Print</button>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="dailySalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Monthly Sales Chart -->
<div class="row" style="margin-left: -20%; margin-right: -4%;">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4" id="monthlySalesCard" style="display: none;">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">MONTHLY SALES</h6>
                <button class="btn btn-primary btn-sm" style="background-color:#FDD89D; font-size: 1rem; color:black; border-radius:15px; height:35px; width: 150px; border-color:#FDD89D; margin-right: 225px;" id="printMonthly">Print</button>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="monthlySalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Yearly Sales Chart -->
<div class="row" style="margin-left: -20%; margin-right: -4%;">
    <div class="col-xl-12 col-lg-12">
        <div class="card shadow mb-4" id="yearlySalesCard" style="display: none;">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold">YEARLY SALES</h6>
                <button class="btn btn-primary btn-sm" style="background-color:#FDD89D; font-size: 1rem; color:black; border-radius:15px; height:35px; width: 150px; border-color:#FDD89D; margin-right: 225px;" id="printYearly">Print</button>
            </div>
            <div class="card-body">
                <div class="chart-area">
                    <canvas id="yearlySalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function handlePeriodChange() {
        var period = document.getElementById("periodDropdown").value;

        // Hide all charts initially
        document.getElementById("dailySalesCard").style.display = "none";
        document.getElementById("monthlySalesCard").style.display = "none";
        document.getElementById("yearlySalesCard").style.display = "none";

        // Show the selected chart based on user's choice
        if (period === "daily") {
            document.getElementById("dailySalesCard").style.display = "block";
        } else if (period === "monthly") {
            document.getElementById("monthlySalesCard").style.display = "block";
        } else if (period === "yearly") {
            document.getElementById("yearlySalesCard").style.display = "block";
        }
    }

    // Fetch data from your backend
    function fetchData(url, callback) {
        fetch(url)
            .then(response => response.json())
            .then(data => callback(data))
            .catch(error => console.error('Error:', error));
    }


 // Add a print function
function printGraph(chartId) {
    var canvas = document.getElementById(chartId);
    var image = new Image();
    image.src = canvas.toDataURL();

    image.onload = function() {
        var win = window.open('', 'Print', 'width=500,height=500');
        win.document.write('<html><head><title>Stock Report</title>');
			win.document.write('<style>');
			win.document.write('.printable-table { border-collapse: collapse; width: 100%; }');
			win.document.write('.printable-table th, .printable-table td { padding: 8px; text-align: left; }');
			win.document.write('.center { text-align: center; }');
			win.document.write('.header { display: flex; justify-content: space-between; align-items: center; }');
			win.document.write('</style></head><body>');

			// Header with "Kings Coffee Shop" and logo
			win.document.write('<div class="header" style="background-color: #FFEFD5">');
			win.document.write('<div>');
			win.document.write('<h1 style=" margin-bottom: 0px; padding: 0;">Kings Coffee Shop PH</h1>');
			// Additional paragraph under h1
			win.document.write('<p style=" margin-top: 0px; margin-bottom: 0px; padding: 0;">3rd floor B2 L24, San Sebastián St. Brgy. San Gabriel</p>');
			win.document.write('<p style=" margin-top: 0px; padding: 0;">G.M.A. 4117, General Mariano Alvarez, Philippines, 4117</p>');
			win.document.write('</div>');
			win.document.write('<div><img src="../kingscoffee/kingcoffee.jpg" alt="Logo" style="width: 120px; height:100px; auto; margin-right:50px;"></div>');
			win.document.write('</div>');
        win.document.write('<img src="' + image.src + '">');



        
        win.document.write('</body></html>');
        win.document.close();
        win.print();
    };
}

    // Draw the chart
    function drawChart(chartId, labels, data, label) {
        var ctx = document.getElementById(chartId).getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: label,
                    data: data,
                    borderWidth: 1,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                }]
            },
            options: {
                scales: {
                    x: [{
                        type: 'linear',
                        position: 'bottom'
                    }]
                }
            }
        });
    }
// Fetch and draw charts
fetchData('chart.php/daily-sales', function (dailyData) {
    console.log('Daily Data:', dailyData);
    var dailyLabels = dailyData.map(item => item.order_date);
    var dailySales = dailyData.map(item => item.daily_sales);
    drawChart('dailySalesChart', dailyLabels, dailySales, 'Daily Sales');
});

fetchData('chart.php/monthly-sales', function (monthlyData) {
    console.log('Monthly Data:', monthlyData);
    var monthlyLabels = monthlyData.map(item => item.order_month);
    var monthlySales = monthlyData.map(item => item.monthly_sales);
    drawChart('monthlySalesChart', monthlyLabels, monthlySales, 'Monthly Sales');
});

fetchData('chart.php/yearly-sales', function (yearlyData) {
    console.log('Yearly Data:', yearlyData);
    var yearlyLabels = yearlyData.map(item => item.order_year);
    var yearlySales = yearlyData.map(item => item.yearly_sales);
    drawChart('yearlySalesChart', yearlyLabels, yearlySales, 'Yearly Sales');
});
document.getElementById('printDaily').addEventListener('click', function() {
    printGraph('dailySalesChart');
});
document.getElementById('printMonthly').addEventListener('click', function() {
    printGraph('monthlySalesChart');
});
document.getElementById('printYearly').addEventListener('click', function() {
    printGraph('yearlySalesChart');
});
</script>

</body>
</html>