<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php include('db_connect.php');?>
<?php include('billing/header.php');?>

<header>
<!-- Add these links to your HTML header -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
</header>
   

        <div class="col-lg-16" style="margin-left:-210px;">
        <div class="card" style="width:100%;">
                <div class="card-header text-left">
                <span><h5 style="color:	#36454F"><b>User Log</b></h5></span>
						
					</div>
                    <!-- Table Panel -->
                    <div class="card-body">

                    <div class="col-md-12">

                    <table id="userLogTable" class="table table-hover">

                        <thead>
                            <tr>
                                <th class="text-center">NAME</th>
                                <th class="text-center">ACTION DESCRIPTION</th>
                                <th class="text-center">DATE</th>
                                <th class="text-center">TIME</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
$i = 1;
$category = $conn->query("SELECT ul.*, u.name, DATE(ul.action_timestamp) AS date_part, TIME(ul.action_timestamp) AS time_part
    FROM user_log ul
    LEFT JOIN users u ON ul.user_id = u.id
    ORDER BY ul.action_timestamp DESC");  // Order the results by action_timestamp in descending order
while($row = $category->fetch_assoc()):
?>
<tr>
    <td class="text-left"><?php echo $row['name'] ?></td>
    <td class="text-left"><?php echo $row['action_description'] ?></td>
    <td class="text-left"><?php echo $row['date_part'] ?></td>
    <td class="text-left"><?php echo $row['time_part'] ?></td>
</tr>
<?php endwhile; ?>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- Table Panel -->




    <style>

        td{
            vertical-align: middle !important;
        }
        td p {
            margin:unset;
        }
      
        table {
      font-size: 20px; /* Adjust the font size value as needed */
    }

    th, td, p {
      font-size: 15px; /* Adjust the font size value as needed */
    }
    
    .text-center, .btn , .badge{
		font-size:18px;
	}

    .text-left{
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
    
    </style>

<script>
$(document).ready(function() {
    $('#userLogTable').DataTable(); // Use your table ID here
});
</script>