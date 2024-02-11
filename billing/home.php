<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 2) {
header("Location: ../error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php
 include '../db_connect.php';
?>
 
<style>
    .out-of-stock {
    filter: blur(0px); /* Add a blur effect */
    pointer-events: none; /* Disable pointer events */
}
.unavailable-text {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(255, 0, 0, 0.7); /* Adjust the opacity as needed */
    padding: 5px 10px;
    border-radius: 5px;
    font-weight: bold;
    font-size:1.6rem;
    color: #f5f4f1; /* Adjust the color as needed */
    filter: none; /* Remove blur effect */
}


    span.float-right.summary_icon {
    font-size: 3rem;
    position: absolute;
    right: 1rem;
    top: 0;
}

    main .card{
        height:calc(100%);
        
      
    }
    main .card-body{
        height:calc(100%);
        padding: 2px;
        position: relative;

}

    main .container-fluid, main .container-fluid>.row,main .container-fluid>.row>div{
        height:calc(100%);
        margin-top:10px;
        
        
    }
    #o-list{
        height: calc(87%);
       
    }
    #calc{
        position: absolute;
        bottom: 1rem;
        height: calc(10%);
        width: calc(98%);
    }
    
    input[name="qty[]"]{
        width: 30px;
        text-align: center
    }
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    .btn{
    font-size:18px;
}
/* Style for the category buttons */
.btn-con, .btn-size {
    padding: 10px 15px; /* Adjust the padding to control the button size */
    background-color: #000000; /* Change the background color to your preference */
    color: #fff; /* Text color */
    border: none;
    border-radius: 5px; /* Adjust the border radius for rounded corners */
    margin-right: 50px; /* Adjust the margin for spacing between buttons */
    cursor: pointer;
    transition: background-color 0.3s;
    width:200px;
    font-size: 18px;

}

.btn-con:hover {
    background-color: orange; /* Change the background color on hover */
}
.btn-size:hover{
    background-color: orange;
}
    .cat-list{
    margin-top: 10px;
    background-color: #fff;
    margin-bottom: 10px;
    white-space: nowrap; /* Prevent line breaks */
    height: 100px; /* You can adjust the height as needed */
    overflow-x: auto; /* Add horizontal scroll bar */
    overflow-y: hidden;
    border-radius:0.5rem;
   
   
   }
   .card-bodysize{
    color:red;
    margin-bottom:20px;
   }
   .container-fluid.o-field {
    margin-top:100px;
    outline-offset: 15px;
    margin: 0;
    padding: 0;
    max-width: 100%;
    overflow-y: scroll;
    scrollbar-width: thin; /* Firefox */
    -ms-overflow-style: none; /* Internet Explorer and Edge
     */
}

.container-fluid.o-field::-webkit-scrollbar {
    display: none; /* Webkit (Chrome, Safari, Opera) */
    scrollbar-width: thin;
}
.custom-control-label, .card-title{
    font-size: 18px;
}
.cat-container{
    display: flex;
}

.category-scroll {
    overflow-x: auto;
    white-space: nowrap;
    scrollbar-width: thin;
    scrollbar-color: #fff transparent;
    display: flex;
    justify-content: space-between; /* Add space between buttons */
  }
/* Thin scrollbar track */
.category-scroll::-webkit-scrollbar {
  width: 1px;
  overflow-x:none;
}

/* Thin scrollbar thumb */
.category-scroll::-webkit-scrollbar-thumb {
  background-color: #fff;
  border-radius: 3px;

}

/* Thin scrollbar track for Firefox */

.cat-item {
     font-size:18px;
     margin-right: 10px; /* Adjust the margin for spacing between items */
  
}
   
    .cat-item:hover{
        opacity: .8;
    }
    .catcard-body{
        width: 10px;
        background-color: #00e2fa;
    }
    
    input{
        border: none;
        outline: none;
        background: transparent;
        width: 90%;
        height:40px;
        margin-left:3%;
        text-transform: capitalize;
        font-size: 18px;
    }
    .icon:hover{
        color: blue;
        cursor: pointer;
    }
    .col-md-9{
        width: calc(100%);
        overflow-x: auto; /* Add horizontal scroll bar */
        overflow-y: hidden;
}
    
    
    .col-md-4{
        background-color: #fff;
       overflow-x: auto;
       
    }
    .col-lg-8{
    background-color:#FFFFFF;
  
   }
   .col-sm-3 .card{
    margin-top: 20px;
        width: 120px;
        height: 120px;
        margin-left:50px;
    }

   .d-flex .card{
 width:200px;
}

.prod-item{
        min-height: 1vh;
        max-width: 100%;
        cursor: pointer;
        overflow: auto;

    }
    .prod-item:hover{
        opacity: .8;
    }
    .prod-item .card-body {
        display: flex;
        justify-content: center;
        align-items: center;
        max-width: 100%;
        max-height: 100%;
        overflow: auto;

    }
   .row{ 
    background-color: #FFFFFF;
    margin-top:5px;
    margin-bottom:10px;
    
   }
   .search{
    background-color:#f5f4f1;
    border-radius: 5px;
    width:calc(100%);

   }
.search-bar {
  display: flex;
  justify-content: flex-end;
  margin-top: 10px;
}

.search-bar input {
  margin-right: 5px;
}

.search-bar button {
  padding: 5px 10px;
}
#product-container {
        max-height: 415px; /* Set a maximum height for the container */
        overflow-y: auto; /* Add vertical scrollbar if needed */
    }
    #scrollable-row {
        max-height: 450px; /* Set a maximum height for the row */
        overflow-y: auto; /* Add vertical scrollbar if needed */
    }
  /* Add your styles here */
  .size-item {
            margin: 5px;
        }

        .btn-size {
            padding: 10px;
            cursor: pointer;
        }

        .selected-size {
            background-color: #D78C15; /* Change this to the color you want for the selected size */
            color: #fff; /* Change this to the text color for the selected size */
        }

        .selected-category {
            background-color: #D78C15; /* Change this to the color you want for the selected category */
            color: #fff; /* Change this to the text color for the selected category */
        }
        #o-list {
        max-height: 600px; /* Adjust the height as needed */
        overflow-y: auto;
    }
    .bg-white{
        max-height: 660px;
      
    }
</style>






<?php 
if(isset($_GET['id'])):
$order = $conn->query("SELECT * FROM orders where id = {$_GET['id']}");
foreach($order->fetch_array() as $k => $v){
    $$k= $v;
}
$items = $conn->query("SELECT o.*,p.name FROM order_items o inner join products p on p.id = o.product_id where o.order_id = $id ");
endif;
?>
<div class="container-fluid o-field">
	<div class="row mt-7 ml-7 mr-3">
        <div class="col-lg-4">
           <div class="card bg-white">
                <div class="card-header text-dark ">
                    <?php
                    $user = $_SESSION['login_name'];
                    ?>
                    <b class="card-title">Cashier's Name:  <?=$user?></b>
                    
                
                </div>
               <div class="card-body">
            <form action="" id="manage-order">
                <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] : '' ?>">
                <input type="hidden" name="user" value="<?php echo isset($_SESSION['login_name']) ? $_SESSION['login_name'] : '' ?>">
                <div class="bg-white" id='o-list'>
                <div class="d-flex w-100 bg-white mb-1">
                                <input type="text" class="form-control-md" style ="border: 1px solid #ccc; width:96%;" placeholder="Enter Customer's Name...." name="customer_name" value="<?php echo isset($customer_name) ? $customer_name : '' ?>" required>
                            </div>
                   <table class="table table-bordered bg-light" >
                        <colgroup>
                            <col width="20%">
                            <col width="40%">
                            <col width="40%">
                            <col width="5%">
                        </colgroup>
                       <thead>
                           <tr class="card-title">
                               <th>QTY</th>
                               <th>Order</th>
                               <th>Amount</th>
                               <th></th>
                           </tr>
                       </thead>
                       <tbody class="card-title">
                           <?php 
                                if(isset($items)):
                           while($row=$items->fetch_assoc()):
                           ?>
                           <tr>
                               <td>
                                    <div class="d-flex">
                                        <span class="btn btn-sm btn-secondary btn-minus"><b><i class="fa fa-minus"></i></b></span>
                                        <input type="number" name="qty[]" id="" value="<?php echo $row['qty'] ?>">
                                        <span class="btn btn-sm btn-secondary btn-plus"> <b><i class="fa fa-plus"></i></b></span>
                                    </div>
                                </td>
                                <td>
                                    <input type="hidden" name="item_id[]" id="" value="<?php echo $row['id'] ?>">
                                    <input type="hidden" name="product_id[]" id="" value="<?php echo $row['product_id'] ?>"><?php echo ucwords($row['name']) ?>
                                    <small class="psmall"> (<?php echo number_format($row['price'],2) ?>)</small>
                                </td>
                                <td class="text-right">
                                    <input type="hidden" name="price[]" id="" value="<?php echo $row['price'] ?>">
                                    <input type="hidden" name="amount[]" id="" value="<?php echo $row['amount'] ?>">
                                    <span class="amount"><?php echo number_format($row['amount'],2) ?></span>
                                </td>
                                <td>
                                    <span class="btn btn-sm btn-danger btn-rem"><b><i class="fa fa-times text-white"></i></b></span>
                                </td>
                           </tr>
                           <script>
                               $(document).ready(function(){
                                 qty_func()
                                    calc()
                                    cat_func();
                                   
                               })
                           </script>
                       <?php endwhile; ?>
                       <?php endif; ?>
                       </tbody>
                   </table>
                </div>
                   <div class="d-block bg-white" id="calc">
                       <table class="" width="100%">
                           <tbody>
                                <tr>
                                   <td><h4><b>Total</h4></b></td>
                                   <td class="text-right">
                                       <input type="hidden" name="total_amount" value="0">
                                       <input type="hidden" name="total_tendered" value="0">
                                       <span class=""><h2> ₱<b id="total_amount">0.00</b></h2></span>
                                   </td>
                               </tr>
                           </tbody>
                       </table>
                   </div>
         
               </div>
               <div class="card-footer bg-white">
                <div class="row justify-content-center">
                    <div class="    btn btn btn-md col-md-11  mr-2" style=" background-color:#D78C15;  color:black;" type="button" id="pay"><b>Payment</b></div>
                </div>
            </div>
           </div>
        </div>

    
     
        <div class="col-lg-8 p-field">
  <div class="card-body bg-dark-flex" id="prod-list">
    <div class="row">
      

    <div class="col-md-16 size-list">
    <!-- Size Container -->
    <b class="" style="margin-bottom: 500px; font-size: 25px; margin-left: 10px;">SIZES</b>

    <div class="category-scroll">
        <div class="d-flex flex-nowrap">
            <!-- Your existing size items -->

            <?php
            $size_query = $conn->query("SELECT DISTINCT size FROM products WHERE size IS NOT NULL AND size <> ''");
            while ($row = $size_query->fetch_assoc()):
            ?>
            <div class="card bg-white size-item" data-size='<?php echo $row['size'] ?>'>
    <button class="btn-size">
        <?php echo ucwords($row['size']) ?>
    </button>
</div>
            <?php endwhile; ?>
        </div>
    </div>
</div>  
        
<div class="col-md-16 cat-list" >
    <!-- Category Container -->
    <b class="" style="margin-bottom: 500px; font-size: 25px; margin-left: 10px; ">CATEGORIES</b>
   
    <div class="category-scroll" >
        <div class="d-flex flex-nowrap" >
            <div class="card sm-1 sm-2 cat-item" data-id='all'>
                <button class="btn-con" style="background-color:#D78C15 ;">All</button>
            </div>
            <?php
                $qry = $conn->query("SELECT * FROM categories WHERE name <> 'addons' ORDER BY name ASC");

            while ($row = $qry->fetch_assoc()):
            ?>
            <div class="card  bg-white cat-item" data-id='<?php echo $row['id'] ?>'>
                <button class="btn-con">
                    <?php echo ucwords($row['name']) ?>
                </button>
                
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</div>




            
                    <!--SEARCH BAR-->
                    <div class="search">    
                        <input type="text" id="find" placeholder="Search Product..." onkeyup="search()">
                        <i class="bx bx-search icon"></i>
                    </div>
                        <hr style="margin:15px; border: 1px solid #eee;">

                        <div class="col-md-12">
                        <div class="row" id="scrollable-row">
                        <?php
$prod = $conn->query("SELECT * FROM products WHERE status = 1 ORDER BY name ASC");
while($row = $prod->fetch_assoc()):
    // Assume product is unavailable by default
    $available = false;

    // Query to get the ingredients and their total usage for this product
    $query = "
        SELECT pi.ingredients_id, i.stocks, SUM(pi.measurement * oi.qty) AS total_usage
        FROM product_ingredients AS pi
        JOIN ingredients AS i ON pi.ingredients_id = i.id
        JOIN order_items AS oi ON pi.product_id = oi.product_id
        WHERE pi.product_id = {$row['id']}
        GROUP BY pi.ingredients_id, i.stocks
    ";
    $product = $conn->query($query);

    // Check if the product has ingredients
    if ($product->num_rows > 0) {
        while($product_row = $product->fetch_assoc()) {
            // Check if the necessary keys exist
            if (isset($product_row['stocks']) && isset($product_row['total_usage'])) {
                // Calculate available quantity
                $available |= ($product_row['total_usage'] >= $product_row['stocks']);
            }
        }
    }

    // Add a CSS class based on availability status
 
    $card_class = $available ? 'out-of-stock' : '' ;
    $data_attr = $available ? 'data-disabled="true"' : '' ;
    $unavailable_text = $available ? '<div class="unavailable-text">UNAVAILABLE</div>' : '';


?>
    <div class="col-md-3 mb-2">
        <div class="card bg-white prod-item <?php echo $card_class ?>" <?php echo $data_attr ?> data-json='<?php echo json_encode($row) ?>' data-category-id="<?php echo $row['category_id'] ?>" data-size="<?php echo $row['size'] ?>">
            <div class="card-body">
           
                <span><b class="text-black">
                <img src="<?php echo "../assets/uploads/".$row['image'];?>" width="100%" height="150px" alt="<?php echo $row['name'] ?>">
                <center><p class="card-title" ><?php echo ucwords($row['name']) ?></p> </center>
                </b></span>
                <?php echo $unavailable_text; ?>
            </div>
        </div>
    </div>
<?php endwhile; ?>





                        </div>
                    </div>   
           
           
         
            </div>      			
        </div>
    </div>



<div class="modal fade" id="pay_modal" role='dialog'>
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"><b>PAYMENT</b></h5>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">

        <div class="form-group">
    <label class="card-title">Total Amount</label>
    <input type="text" class="form-control text-right" id="total_amount" name="total_amount" readonly="" value="">
    <span id="discount-text" class="text-muted"></span>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="card-title">Non-vat (3%)</label>
            <input type="text" class="form-control text-right" id="non-vat" name="non-vat" readonly="" value="">
            <span id="discount-text" class="text-muted"></span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="card-title">Net Sales</label>
            <input type="text" class="form-control text-right" id="net-sales" name="net-sales" readonly="" value="">
            <span id="discount-text" class="text-muted"></span>
        </div>
    </div>
</div>



        <div class="form-group">
    <label class="card-title">Amount Payable</label>
    <input type="text" class="form-control text-right" id="apayable" name="amount_payable" readonly="" value="">
    <span id="discount-text" class="text-muted"></span>
</div>

            <div class="form-group">
                <label class="card-title">Amount Tendered</label>
                <input type="text" class="form-control text-right" id="tendered" value="" autocomplete="off">
            </div>
            <div class="form-group">
                <label class="card-title">Change</label>
                <input type="text" class="form-control text-right" id="change" value="0.00" readonly="">
            </div>
            <div class="custom-control custom-switch">
    <div class="row">
        <div class="col-md-6">
            <input type="checkbox" class="custom-control-input" id="payment_mode" name="payment_mode" checked value="1">
            <label class="custom-control-label" for="payment_mode">CASH</label>
        </div>
        <div class="col-md-6" style="left:15vh;">
            <input type="checkbox" class="custom-control-input" id="mode" name="mode" checked value="1">
            <label class="custom-control-label" for="mode">DINE IN</label>
        </div>
    </div>
</div>
      
            <br>     
            <div class="form-group">    
    <label for="discount">Select Discount:</label>
    <div class="custom-control custom-radio">
        <input type="radio" id="noDiscount" name="discount" class="custom-control-input" value="none" data-discount="0" checked>
        <label class="custom-control-label" for="noDiscount">No Discount</label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" id="seniorDiscount" name="discount" class="custom-control-input" value="senior" data-discount="0.20">
        <label class="custom-control-label" for="seniorDiscount">Senior Discount (20%)</label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" id="pwdDiscount" name="discount" class="custom-control-input" value="pwd" data-discount="0.20">
        <label class="custom-control-label" for="pwdDiscount">PWD Discount (20%)</label>
    </div>
    <div class="custom-control custom-radio">
        <input type="radio" id="loyaltyDiscount" name="discount" class="custom-control-input" value="loyalty" data-discount="0.05">
        <label class="custom-control-label" for="loyaltyDiscount">Loyalty Discount (5%)</label>
    </div>
</div>


<?php
// Get the selected discount option from the form
if (isset($_POST['discount'])) {
    $selectedDiscount = $_POST['discount'];

    // Calculate the total amount before applying the discount
    $totalAmount = floatval($_POST['total_amount']);

    // Apply the selected discount
    if ($selectedDiscount === 'senior') {
        $discountedTotal = $totalAmount * 0.8; // 20% discount for seniors
    } elseif ($selectedDiscount === 'pwd') {
        $discountedTotal = $totalAmount * 0.8; // 20% discount for PWDs
    } elseif ($selectedDiscount === 'loyalty') {
        $discountedTotal = $totalAmount * 0.95; // 5% discount for loyal customers
    } elseif ($selectedDiscount === 'none') {
        $discountedTotal = $totalAmount * 0;
    }
    else {
     $discountedTotal = $totalAmount; // No discount
    }

    // Update the total amount with the discount applied
    $_POST['total_amount'] = $discountedTotal;
}

// Rest of your PHP code remains unchanged
// You can use the updated $_POST['total_amount'] to display the discounted total in your HTML.


?>
        </div>
    </div>
        
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary btn-sm" id="payButton" form="manage-order">Pay</button>
        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cancel</button>
      </div>
      </div>
      </form>
    </div>
  </div>


<div class="modal fade" id="AdsonModal" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="customModalLabel">Customize Product</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="add_adson">
                <?php
// Define the category name (e.g., "adson")
$categoryName = "addons";

// Query the "categories" table to find the category ID based on the category name
$sql = "SELECT id FROM categories WHERE name = '$categoryName'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Category found, retrieve its ID
    $row = $result->fetch_assoc();
    $categoryId = $row["id"];

    // Query the "products" table to fetch products in the specified category
    $sql = "SELECT * FROM products WHERE category_id = $categoryId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Products found, display them in the modal
        echo '<div class="modal-body">';
        echo '<form action="" id="add_adson">';
        while ($row = $result->fetch_assoc()) {
            // Output the product information as checkboxes
            echo '<label class="label"><input type="checkbox" name="adson[]" value="' . $row["name"] . '" data-product_id="' . $row['id'] . '" data-price="' . $row["price"] . '"> ' . $row["name"] . ' (P' . $row["price"] . ')</label><br>';



        }
        echo '</form>';
        echo '</div>';
    } else {
        echo "No products found in the '$categoryName' category.";
    }
} else {
    echo "Category '$categoryName' not found.";
}

$conn->close();
?>


                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmCustomizations">Add</button>
            </div>
        </div>
    </div>
</div>


  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="sweetalert2.all.min.js"></script>
  
  <!--SEARCH BAR JS-->


<script>

function search() {
        var input, filter, cards, card, i, txtValue;
        input = document.getElementById("find");
        filter = input.value.toUpperCase();
        cards = document.querySelectorAll(".prod-item");

        for (i = 0; i < cards.length; i++) {
            card = cards[i];
            txtValue = card.textContent || card.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                card.style.display = "";
            } else {
                card.style.display = "none";
            }
        }
    }


        var total;
        cat_func();
  
    $('#prod-list .prod-item').click(function () {
        console.log("Product clicked!");

        var data = $(this).attr('data-json');
        data = JSON.parse(data);

        // Store a reference to the clicked product row
        var clickedProductRow = $(this);
        selectedRow = clickedProductRow;

        console.log("Selected Product ID:", data.id);

        if ($('#o-list tr[data-id="' + data.id + '"]').length > 0) {
            console.log("Product already in order list.");
            var tr = $('#o-list tr[data-id="' + data.id + '"]');
            var qty = tr.find('[name="qty[]"]').val();
            qty = parseInt(qty) + 1;
            tr.find('[name="qty[]"]').val(qty).trigger('change');
            calc();
            return false;
        }

        console.log("Product not in order list. Adding...");

        var tr = $('<tr class="o-item"></tr>');
        tr.attr('data-id', data.id);
        tr.append('<td><div class="d-flex"><span class="btn btn-sm btn-secondary btn-minus"><b><i class="fa fa-minus"></i></b></span><input type="number" name="qty[]" id="" value="1"><span class="btn btn-sm btn-secondary btn-plus"><b><i class="fa fa-plus"></i></b></span></div></td>');
        tr.append('<td><input type="hidden" name="item_id[]" id="" value=""><input type="hidden" name="product_id[]" id="" value="' + data.id + '">' + data.name + ' </td>');
        tr.append('<td class="text-right"><input type="hidden" name="price[]" id="" value="' + data.price + '"><input type="hidden" name="amount[]" id="" value="' + data.price + '"><span class="amount">' + (parseFloat(data.price).toLocaleString("en-US", { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 })) + '</span></td>');

        tr.append('<td><span class="btn btn-sm btn-danger btn-rem"><b><i class="fa fa-times text-white"></i></b></span></td>');
        tr.append('<td><span class="btn btn-sm btn-warning btn-custom"><b><i class="fa fa-fa fa-plus text-white"></i></b></span></td>');

        var adsonModal = $('#AdsonModal');
        var selectedAdons = [];

        // Add an event handler for the "Add" button in the modal
        adsonModal.find('#confirmCustomizations').off().on('click', function () {

         
            console.log("Confirm Customizations clicked!");

            var selectedCheckboxes = adsonModal.find('input[name="adson[]"]:checked');

            if (selectedRow) {
                console.log("Selected Row found!");

                var adsonNameContainer = $('<div class="adson-item-name"></div>');
                var adsonAmountContainer = $('<div class="adson-amount"></div>');
                
selectedRow.find('.adson-amount').html('');
selectedCheckboxes.each(function () {
    var adsonValue = $(this).val();
    console.log($(this).data('price'));
    var adsonPrice = parseFloat($(this).data('price'));


    // Create separate containers for "extra" section
    var adsonExtraContainer = $('<div class="adson-extra">--- extra ' + adsonValue + '</div>');
    var product_id = $(this).data('product_id');
    var amount = $(this).data('price');
    // Append the adson items directly to the containers
    adsonNameContainer.append(adsonExtraContainer.clone());
    adsonAmountContainer.append('<div>' + adsonPrice.toFixed(2) + '</div>');
    
    // Add hidden input fields for each adson item
    adsonAmountContainer.append('<input type="hidden" name="qty[]" value="1">');
    adsonAmountContainer.append('<input type="hidden" name="item_id[]" value="">');
    adsonAmountContainer.append('<input type="hidden" name="product_id[]" value="' + product_id + '">');
    adsonAmountContainer.append('<input type="hidden" name="price[]" value="'+ adsonPrice +'" >');
    console.log(adsonPrice);
    adsonAmountContainer.append('<input type="hidden" name="amount[]" value="'+ adsonPrice +'" >');


});


                selectedRow.find('.adson-item-name').html('');
                selectedRow.find('.adson-amount').html('');
              
                selectedRow.find('td:nth-child(2)').append(adsonNameContainer);
                selectedRow.find('td:nth-child(3)').append(adsonAmountContainer);
            }

            adsonModal.modal('hide');
            calc();
        });



//void

tr.find('.btn-custom').on('click', function() {
  // Show the Bootstrap modal with the ID 'customModal'
  selectedRow = tr;
  $('#AdsonModal').modal('show');
  // You can customize the modal content or behavior here.
});

$('#o-list tbody').on('click', '.btn-rem', function () {
    // Store a reference to the clicked remove button
    var clickedRemoveButton = $(this);

    // Show a SweetAlert prompt for password input
    Swal.fire({
        title: 'Enter Password',
        input: 'password',
        inputAttributes: {
            autocapitalize: 'off',
        },
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel',
        preConfirm: (password) => {
            // Check if the entered password is correct (replace 'your_password' with the actual password)
            if (password === 'test') {
                console.log("Sending AJAX request to 'void.php'");
                $.ajax({
    url: 'void.php',
    type: 'POST',
    data: {
        password: password,
        cashierName: '<?php echo $_SESSION['login_name']; ?>',
        price: parseFloat(clickedRemoveButton.closest('tr').find('input[name="price[]"]').val())
    },
                    success: function (response) {
                        if (response === 'Success') {
                            // Password is correct, item removed, and data saved successfully
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Password is correct. Item removed and data saved successfully.',
                            });

                            // Perform removal logic here
                            var tr = clickedRemoveButton.closest('tr');
                            tr.remove();
                            calc();  // You may need to recalculate your totals after removing the item
                        } else {
                            // Password is correct, but there was an issue saving data
                            Swal.fire({
                                icon: 'success',
                                title: 'Success!',
                                text: 'Item removed successfully.',
                                showConfirmButton: false, // Remove the "OK" button
                                timer: 1000, // Automatically close after 2 seconds
                            });
                            var tr = clickedRemoveButton.closest('tr');
                            tr.remove();
                            calc(); 
                        }
                    },
                    error: function () {
                        // An error occurred with the AJAX request
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred. Please try again.',
                            showConfirmButton: false, // Remove the "OK" button
                            timer: 1000, // Automatically close after 2 seconds
                        });
                    }
                });
            } else {
                // Password is incorrect, show an error message
                Swal.fire({
                    icon: 'error',
                    title: 'Incorrect Password',
                    text: 'Please enter the correct password.',
                    showConfirmButton: false, // Remove the "OK" button
                    timer: 2000, // Automatically close after 2 seconds
                });
            }
        }
    });
});

        $('#o-list tbody').append(tr)
        qty_func()
        calc()
        cat_func();
        
   })
    function qty_func(){
         $('#o-list .btn-minus').click(function(){
            var qty = $(this).siblings('input').val()
                qty = qty > 1 ? parseInt(qty) - 1 : 1;
                $(this).siblings('input').val(qty).trigger('change')
                calc()
         })
         $('#o-list .btn-plus').click(function(){
            var qty = $(this).siblings('input').val()
                qty = parseInt(qty) + 1;
                $(this).siblings('input').val(qty).trigger('change')
                calc()
         })
        
         
    }
    function calc() {
    $('[name="qty[]"]').each(function () {
        $(this).change(function () {
            var tr = $(this).closest('tr');
            var qty = $(this).val();
            var price = tr.find('[name="price[]"]').val();
            var amount = parseFloat(qty) * parseFloat(price);

            // Check for selected checkboxes and add their prices

            tr.find('[name="amount[]"]').val(amount);
            tr.find('.amount').text(parseFloat(amount).toLocaleString("en-US", { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }));
        });
    });

    total = 0; // Use the outer total variable
    $('[name="amount[]"]').each(function () {
        total += parseFloat($(this).val());
    });

    // Update the total amount with the checkbox prices
    $('[name="total_amount"]').val(total);
    $('#total_amount').text(parseFloat(total).toLocaleString("en-US", { style: 'decimal', minimumFractionDigits: 2, maximumFractionDigits: 2 }));

    var totalAmount = total; // Use the total calculated above
    var nonVatAmount = totalAmount * 0.03;

    // Update the non-VAT field with the calculated value
    $('#non-vat').val(nonVatAmount.toFixed(2));

    var amount = $('[name="total_amount"]').val();
    var netSales = parseFloat($('#net-sales').val());

    var totalSales = parseFloat(amount) - nonVatAmount;

    $('#net-sales').val(totalSales.toFixed(2));
}


var selectedSize = 'all'; // Initialize a global variable to store the selected size

function cat_func() {
    $(document).on('click', '.size-item', function () {
        selectedSize = $(this).attr('data-size');
        var categoryId = getCurrentCategoryFilter();
        filterProducts(categoryId, selectedSize);
    });

    $('.cat-item').click(function () {
        var categoryId = $(this).attr('data-id');
        filterProducts(categoryId, selectedSize);
    });

    function getCurrentCategoryFilter() {
        return $('.cat-item.active').attr('data-id') || 'all';
    }

    function filterProducts(categoryId, size) {
        console.log('Filtering Products. Category:', categoryId, 'Size:', size);
        $('.prod-item').parent().hide();

        $('.prod-item').each(function () {
            var categoryMatch = (categoryId === 'all' || $(this).attr('data-category-id') == categoryId);
            var sizeMatch = (size === 'all' || $(this).attr('data-size') == size);

            if (categoryMatch && sizeMatch) {
                $(this).parent().show();
            }
        });
    }
}



    $('#save_order').click(function(){
    $('#tendered').val('').trigger('change')
    $('[name="total_tendered"]').val('')
    $('[name="payment_mode"]').val('')
    $('#manage-order').submit()
   })
   $("#pay").click(function(){
    start_load()
    var amount = $('[name="total_amount"]').val()
    if($('#o-list tbody tr').length <= 0){
        alert_toast("Please add atleast 1 product first.",'danger')
        end_load()
        return false;
    }
    $('#apayable').val(parseFloat(amount).toFixed(2));
    $('#pay_modal').modal('show')
    setTimeout(function(){
        $('#tendered').val('').trigger('change')
        $('#tendered').focus()
        end_load()
    },500)
    
   })

   $('#tendered').keyup('input', function (e) {
    if (e.which == 13) {
        $('#manage-order').submit();
        return false;
    }
    
    var tend = $(this).val();
    tend = tend.replace(/,/g, '');
    $('[name="total_tendered"]').val(tend);
    if (tend == '') {
        $(this).val('');
    } else {
        $(this).val((parseFloat(tend).toLocaleString("en-US")));
    }
    tend = tend > 0 ? tend : 0;
    var amount = $('[name="amount_payable"]').val();
    var change = parseFloat(tend) - parseFloat(amount);

    // Check if change is negative (amount tendered < amount payable)
    if (change <= -1) {
        // Display an "Invalid Amount" message or handle it as needed
        $('#change').val('Invalid Amount');
        // Disable the "Pay" button
        $('#payButton').prop('disabled', true);
        
    } else {
        // Display the calculated change with two decimal places
        $('#change').val(parseFloat(change).toLocaleString("en-US", {
            style: 'decimal',
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }));
        // Enable the "Pay" button
        $('#payButton').prop('disabled', false);
    }
});



$('#manage-order').submit(function (e) {
    e.preventDefault();
    start_load();

    var totalTendered = parseFloat($('[name="total_tendered"]').val());

    // Check if totalTendered is greater than 0 (payment made)
    if (totalTendered <= 0) {
        alert_toast("Please enter a valid tendered amount.", 'danger');
        end_load();
        return false;
    }

    // Get the selected discount percentage
    var selectedDiscount = $('[name="discount"]:checked').data('discount');

    $.ajax({
        url: '../ajax.php?action=save_order',
        method: 'POST',
        data: $(this).serialize(),
        success: function (resp) {
            if (resp > 0) {
                if (totalTendered > 0) {
                    // Calculate the discounted total
                    var totalAmount = parseFloat($('[name="total_amount"]').val());
                    var discountedTotal = totalAmount - (totalAmount * selectedDiscount);

                    // Update the "Amount Payable" field with the discounted total
                    $('#apayable').val(discountedTotal.toFixed(2));

                    alert_toast("Data successfully saved.", 'success');
                    setTimeout(function () {
                        var nw = window.open('../receipt.php?id=' + resp, "_blank", "width=900,height=600");
                        setTimeout(function () {
                            nw.print();
                            setTimeout(function () {
                                nw.close();
                                location.reload();
                            }, 500);
                        }, 500);
                    }, 500);
                } else {
                    alert_toast("Data successfully saved.", 'success');
                    setTimeout(function () {
                        location.reload();
                    }, 500);
                }
            }
        }
    });
});

$('[name="discount"]').change(function() {
    var selectedDiscount = $('[name="discount"]:checked').val();
    var totalAmount = parseFloat($('[name="total_amount"]').val());
    


    if (selectedDiscount === 'senior') {
        // Apply a 20% discount for seniors
        var discountedAmount = totalAmount * 0.8;
        var netSales = discountedAmount - (totalAmount * 0.03);
    } else if (selectedDiscount === 'pwd') {
        // Apply a 20% discount for PWDs
        var discountedAmount = totalAmount * 0.8;
        var netSales = discountedAmount - (totalAmount * 0.03);
    } else if (selectedDiscount === 'loyalty') {
        // Apply a 5% discount for loyal customers
        var discountedAmount = totalAmount * 0.95;
        var netSales = discountedAmount - (totalAmount * 0.03);
    } else {
        // No discount selected
        var discountedAmount = totalAmount;
        var netSales = discountedAmount - (totalAmount * 0.03);
    }
    // Update the "Amount Payable" field with the discounted amount
    $('#apayable').val(discountedAmount.toFixed(2));

    $('#net-sales').val(netSales.toFixed(2));

});

// Trigger the change event when the page loads to initialize the "Amount Payable" field
$('[name="discount"]:checked').change();
$('[name="discount"]:checked').change();


    $('.form-control-sm[name="customer_name"]').keydown(function (e) {
    if (e.keyCode === 13) { // Check if Enter key (key code 13) is pressed
        e.preventDefault(); // Prevent the default form submission behavior
        // You can add any custom behavior here or simply do nothing
        return false; // Optional: Return false to prevent further processing
    }
});

// Initialize the previous discount to 0 initially

window.addEventListener("beforeunload", function (e) {
    // Display a standard browser confirmation dialog
    e.preventDefault();
    e.returnValue = "Your changes may not be saved. Are you sure you want to leave this page?";
});
$(document).ready(function() {
    $('.btn-custom').click(function() {
      $('#myModal').modal('show'); // Open the modal
    });
  });
  $(document).ready(function () {
        $('.btn-size').click(function () {
            // Remon-cove the 'selected-size' class from all size buttons
            $('.btn-size').removeClass('selected-size');
            
            // Add the 'selected-size' class to the clicked size button
            $(this).addClass('selected-size');
        });
    });
    $(document).ready(function () {
        $('.btn-con').click(function () {
            // Remove the 'selected-category' class from all category buttons
            $('.btn-con').removeClass('selected-category');

            // Add the 'selected-category' class to the clicked category button
            $(this).addClass('selected-category');
        });
    });
    
</script>






