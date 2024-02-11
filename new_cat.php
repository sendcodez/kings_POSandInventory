
<?php 
include('db_connect.php');
session_start();
if(isset($_GET['id'])){
$user = $conn->query("SELECT * FROM categories where id =".$_GET['id']);
foreach($user->fetch_array() as $k =>$v){
	$meta[$k] = $v;
}
}
?>
<div class="container-fluid">
	<div id="msg"></div>
	
	<form action="" id="new_category">	
		<input type="hidden" name="id" value="<?php echo isset($meta['id']) ? $meta['id']: '' ?>">
		<div class="form-group">
			<label for="name">Name</label>
			<input type="text" name="name" id="name" class="form-control" value="<?php echo isset($meta['name']) ? $meta['name']: '' ?>" required>
		</div>
		<div class="form-group">
			<label for="description">Description</label>
			<input type="text" name="description" id="description" class="form-control" value="<?php echo isset($meta['description']) ? $meta['description']: '' ?>" required  autocomplete="off">
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
	
	$('#new_category').on('reset',function(){
		$('input:hidden').val('')
		$('.select2').val('').trigger('change')
	})
	
	$('#new_category').submit(function (e) {
    e.preventDefault();
    
    // Check for empty fields manually
    var name = $('#name').val().trim();
    var description = $('#description').val().trim();

    if (!name || !description) {
        alert_toast("Please fill in all required fields.", 'warning');
        return;
    }

    start_load();

    $.ajax({
        url: 'ajax.php?action=save_category',
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        success: function (resp) {
            if (resp == 1) {
                alert_toast("Data successfully added", 'success');
                setTimeout(function () {
                    location.reload();
                }, 1500);
            } else if (resp == 2) {
                alert_toast("Data successfully updated", 'success');
                setTimeout(function () {
                    location.reload();
                }, 1500);
            }
        }
    });
});

	$('.edit_cat').click(function(){
		start_load()
		var cat = $('#new_category')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
		cat.find("[name='description']").val($(this).attr('data-description'))
		end_load()
	})
	function delete_product($id){
		start_load()
		$.ajax({
			url:'ajax.php?action=delete_category',
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