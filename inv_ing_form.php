<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
$category = $conn->query("SELECT * FROM ingredients where id =".$_GET['id']);
foreach($category->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	<div id="msg"></div>


			<form action="" id="manage_ingredients_inv" enctype="multipart/form-data">
				
							<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
							
							<div class="form-group">
								<label class="control-label">Category</label>
								<select name="category_id" id="category_id" class="custom-select select2" required>
									<option value=""></option>
									<?php
									$qry = $conn->query("SELECT * FROM categories_inventory order by name asc");
									while($row=$qry->fetch_assoc()):
										$cname[$row['id']] = ucwords($row['name']);
									?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
								</select>
							</div>

							<div class="form-group">
								<label class="control-label">Name</label>
								<input type="text" class="form-control" name="name" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
							</div>

							<!--
							                        <div class="form-group">
   							 	<label class="control-label">Cost</label==> <label class="control-label" style="margin-left: 170px;">QTY</label>
    							<div class="input-group">
        							<input type="number" class="form-control text-right" name="cost">
        							<span class="input-group-addon" style="font-weight:800;"> /</span>
                                    <input type="number" class="form-control text-right" name="qty">
                                </div>
									-->
									<div class="form-group">
    							<label class="control-label">Quantity</label>
								<div class="input-group">
									<input type="number" class="form-control text-right" name="qty" required>
									<span class="input-group-addon" style="font-weight:800;"> /</span>
									<select name="pkg" id="pkg" class="custom-select select2" onchange="showHideTextbox2()" required>
										<option value="">Select Packaging</option>
											<?php
											$qry = $conn->query("SELECT DISTINCT pkg FROM ingredients WHERE pkg IS NOT NULL AND pkg <> ''");

											while($row = $qry->fetch_assoc()):
											    $cname[$row['pkg']] = ucwords($row['pkg']);
											?>
										<option value="<?php echo $row['pkg'] ?>"><?php echo $row['pkg'] ?></option>
										<?php endwhile; ?>
										<option value="others">Others</option>
										<input type="text" class="form-control" name="pkg_other" id="otherpkg" style="display: none;" placeholder="Enter pack	" required>
    								</select>
    								
								</div>
							</div>

<script>
    function showHideTextbox2() {
        var unitSelect = document.getElementById("pkg");
        var otherUnitTextbox = document.getElementById("otherpkg");

        // If "Others" is selected, show the text input; otherwise, hide it
        otherUnitTextbox.style.display = (unitSelect.value === "others") ? "block" : "none";
    }
</script>

								


							<div class="form-group">
    							<label class="control-label">Stocks</label>
								<div class="input-group">
									<input type="number" class="form-control text-right" name="stocks" required>
									<span class="input-group-addon" style="font-weight:800;"> /</span>
									<select name="unit" id="unit" class="custom-select select2" onchange="showHideTextbox()" required>
										<option value="">Select unit</option>
										<?php
											$categories = array(); // Array to store distinct categories
											$query = "SELECT DISTINCT unit FROM ingredients "; // Query to fetch distinct categories
											$result = mysqli_query($conn, $query);

    									while ($row = mysqli_fetch_array($result)) {
       									$categories[] = $row['unit'];
    								}

  
    								foreach ($categories as $category) {
        							echo "<option value='" . $category . "'>" . $category . "</option>";
    							}

    							?>
										<option value="others">Others</option>
										<input type="text" class="form-control" name="unit_other" id="otherUnit" style="display: none;" placeholder="Enter unit" required>
    								</select>
    								
								</div>
							</div>

<script>
    function showHideTextbox() {
        var unitSelect = document.getElementById("unit");
        var otherUnitTextbox = document.getElementById("otherUnit");

        // If "Others" is selected, show the text input; otherwise, hide it
        otherUnitTextbox.style.display = (unitSelect.value === "others") ? "block" : "none";
    }
</script>


							<div class="form-group">
								<label class="control-label">Expiration Date</label>
								<input type="date" class="form-control text-right" name="expiration_date" required>
							</div>
							<div class="form-group">
								<div class="custom-control custom-switch">
								  <input type="checkbox" class="custom-control-input" id="status" name="status" checked value="1" >
								  <label class="custom-control-label" for="status">Available</label>
								</div>
							</div>
					</div>
				</div>
			</form>
			</div>
</div>
<script>
	
	$('#manage_ingredients_inv').submit(function (e) {
    e.preventDefault();

    // Validate input fields
    var name = $("input[name='name']").val();
    var qty = $("input[name='qty']").val();
    var pkg = $("select[name='pkg']").val();
    var unit = $("select[name='unit']").val();
    var expirationDate = $("input[name='expiration_date']").val();

    if (name === '' || qty === '' || pkg === '' || unit === '' || expirationDate === '') {
        $('#msg').html('<div class="alert alert-danger">Please fill in all required fields</div>');
        return;
    }

    start_load();

    $.ajax({
        url: 'ajax.php?action=save_ingredients',
        method: 'POST',
        data: $(this).serialize(),
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Data successfully saved", 'success');
                setTimeout(function () {
                    location.reload();
                }, 1500);
            } else {
                $('#msg').html('<div class="alert alert-danger">Ingredients already exist</div>');
                end_load();
            }
        }
    });
});


</script>