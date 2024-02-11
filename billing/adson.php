
<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM products where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="new_product">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
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
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<input type="text" name="description" id="description" class="form-control" value="<?php echo isset($meta['description']) ? $meta['description']: '' ?>" required  autocomplete="off">
		</div>
		<div class="form-group">
    <label class="control-label">Ingredients</label>
    <div class="ingredient-container">
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
</div>

		<div class="form-group">
			<label for="price">Price</label>
			<input type="text" name="price" id="price" class="form-control" value="<?php echo isset($meta['price']) ? $meta['price']: '' ?>" required>
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
		
		

	</form>
</div>
<style>
	.ingredient-container {
    max-height: 150px; /* Adjust the maximum height as needed */
    overflow-y: auto;
    border: 1px solid #ccc; /* Optional: Add a border for visual separation */
}
</style>
<script>
	
	$('#new_product').on('reset',function(){
		$('input:hidden').val('')
		$('.select2').val('').trigger('change')
	})
	
	$('#new_product').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_product',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully added",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
				else if(resp==2){
					alert_toast("Data successfully updated",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	})
	$('.edit_product').click(function(){
		start_load()
		var cat = $('#new_product')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		cat.find("[name='price']").val($(this).attr('data-price'))
		cat.find("[name='category_id']").val($(this).attr('data-category_id')).trigger('change')
		if($(this).attr('data-status') == 1)
			$('#status').prop('checked',true)
		else
			$('#status').prop('checked',false)
		end_load()
	})
	function delete_product($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_product',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'success')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
	$('table').dataTable()


	var total;
    cat_func();
   $('#prod-list .prod-item').click(function(){
        var data = $(this).attr('data-json')
            data = JSON.parse(data)
        if($('#o-list tr[data-id="'+data.id+'"]').length > 0){
            var tr = $('#o-list tr[data-id="'+data.id+'"]')
            var ingredients = tr.find('[name="ingredients[]"]').val();
                ingredients = parseInt(ingredients) + 1;
                ingredients = tr.find('[name="ingredients[]"]').val(ingredients).trigger('change')
                calc()
            return false;
        }
   })
	
</script>