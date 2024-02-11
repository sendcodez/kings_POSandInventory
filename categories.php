<?php
if (!isset($_SESSION['login_type']) || $_SESSION['login_type'] != 1) {
header("Location: error.php"); // Change "login.php" to your desired redirect page
exit(); // Stop further execution of the page
}
?>
<?php include('db_connect.php');?>
    <?php include('billing/header.php');?>

    <!-- Modal -->
    <div class="modal fade" id="category" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="categoryLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title fs-5" id="manage-categoryLabel">Categories</h5>

                <span class="close" style="cursor:pointer" data-bs-dismiss="modal" aria-label="Close">&times;</span>

            </div>

            <form action="" id="manage-category">
                <div class="modal-body">
                    <input type="hidden" name="id">
                        <div class="form-group">
                            <label class="control-label">Name</label>
                            <input type="text" class="form-control" name="name">
                        </div>

                        <div class="form-group">
                            <label class="control-label">Description</label>
                            <textarea name="description" id="description" cols="30" rows="4" class="form-control"></textarea>
                        </div>
                </div>

                <div class="modal-footer">

                        <div class="col-md-12">
                            <button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
                            <button class="btn btn-sm btn-secondary col-sm-3" type="button" onclick="$('#manage-category').get(0).reset()"> Cancel</button>
                        </div>
                    </div>
                </div>

                </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <span><h5><b>Categories</b></h5></span>
                        <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal" data-bs-target="#category">+| Add Category</button>
                    </div>

                    <!-- Table Panel -->
                    <div class="card-body">

                    <div class="col-md-12">

                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">CATEGORY INFO.</th>
                                <th class="text-center">ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 1;
                            $category = $conn->query("SELECT * FROM categories order by id asc");
                            while($row=$category->fetch_assoc()):
                            ?>
                            <tr>
                                <td class="text-center"><b><?php echo $i++ ?></b></td>
                                <td class="">
                                    <p>Name: <?php echo $row['name'] ?></p>
                                    <p><small>Description: <?php echo $row['description'] ?></small></p>
                                </td>
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary edit_category" type="button" data-id="<?php echo $row['id'] ?>" data-description="<?php echo $row['description'] ?>" data-name="<?php echo $row['name'] ?>" >Edit</button>
                                    <button class="btn btn-sm btn-danger delete_category" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                </td>
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
        .cform{
            margin-right: 20px;
            margin-left: 100px;
            width: 400px;
        }
        table {
      font-size: 20px; /* Adjust the font size value as needed */
    }

    th, td, p {
      font-size: 15px; /* Adjust the font size value as needed */
    }
    </style>
    <script>
        $('#manage-category').on('reset',function(){
            $('input:hidden').val('')
        })

        $('#manage-category').submit(function(e){
            e.preventDefault()
            start_load()
            $.ajax({
                url:'ajax.php?action=save_category',
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
        $('.edit_category').click(function(){
            start_load()
            var cat = $('#manage-category')
            cat.get(0).reset()
            cat.find("[name='id']").val($(this).attr('data-id'))
            cat.find("[name='name']").val($(this).attr('data-name'))
            cat.find("[name='description']").val($(this).attr('data-description'))
            end_load()
        })
        $('.delete_category').click(function(){
            _conf("Are you sure to delete this category?","delete_category",[$(this).attr('data-id')])
        })
        function delete_category($id){
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
    </script>

    <?php include('billing/modal_footer.php');?>