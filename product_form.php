<?php include('db_connect.php');?>
<style>
	
    .card2{
        margin-left:1000 px;
    
    }
	.card-body{
		font-size: 20px;
	}
    .row{
        width: 350px;
     
    }
	#manage-product{
	background-color: #FFFAD7;
	font-size: 200px;
	}
    .newp{
		font-size: 200px;
	}


</style>
<div class="container-fluid">

			<form action="" id="manage-product">
			<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
			<div class="form-group">
			
		
					<div class="card-body">
						
							<input type="hidden" name="id">
							<div class="form-group">
								<label class="control-label">Category</label>
								<select name="category_id" id="category_id" class="custom-select select2">
									
									<option value=""></option>
									<?php
									$qry = $conn->query("SELECT * FROM categories order by name asc");
									while($row=$qry->fetch_assoc()):
										$cname[$row['id']] = ucwords($row['name']);
									?>
									<option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
								<?php endwhile; ?>
								</select>
							</div>
							<div class="form-group">
								<label class="control-label">Name</label>
								<input type="text" class="form-control" name="name">
							</div>
							<div class="form-group">
								<label class="control-label">Description</label>
								<textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
							</div>
							<div class="form-group">
								<label class="control-label">Price</label>
								<input type="number" class="form-control text-right" name="price">
							</div>
							<div class="form-group">
								<label class="control-label">Expiration Date</label>
								<input type="date" class="form-control text-right" name="expiration_date">
							</div>
							
							<div class="form-group">
    							<label class="control-label">Ingredients</label>
    							<?php
    								$qry = $conn->query("SELECT * FROM ingredients ORDER BY name ASC");
    								while ($row = $qry->fetch_assoc()):
        							$cname[$row['id']] = ucwords($row['name']);
    							?>
        						<div>
            						<input type="checkbox" name="ingredients[]" value="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?>
            						<input type="number" value="0" class="form-control" name="measurement[<?php echo $row['id'] ?>]">
        						</div>
    							<?php endwhile; ?>
								</div>

							<div class="form-group">
								<label class="control-label">Image</label>
								<input type="file" class="form-control text-right" name="image">
							</div>
							
							<div class="form-group">
								<div class="custom-control custom-switch">
								  <input type="checkbox" class="custom-control-input" id="status" name="status" checked value="1">
								  <label class="custom-control-label" for="status">Available</label>
								</div>
							</div>
					</div>

					
							
					
				</div>
			</form>
			</div>
<script>


$('#manage-product').submit(function (e) {
    e.preventDefault();

    // Validate input fields
    var category_id = $("select[name='category_id']").val();
    var name = $("input[name='name']").val();
    var description = $("textarea[name='description']").val();
    var price = $("input[name='price']").val();
    var expiration_date = $("input[name='expiration_date']").val();
    var ingredients = $("input[name^='ingredients']:checked").length;

    if (category_id === '' || name === '' || description === '' || price === '' || expiration_date === '' || ingredients === 0) {
        $('#msg').html('<div class="alert alert-danger">Please fill in all required fields</div>');
        return;
    }

    start_load();

    $.ajax({
        url: 'ajax.php?action=save_product',
        method: 'POST',
        data: $(this).serialize(),
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Data successfully saved", 'success');
                setTimeout(function () {
                    location.reload();
                }, 1500);
            } else {
                $('#msg').html('<div class="alert alert-danger">Username already exists</div>');
                end_load();
            }
        }
    });
});


</script>