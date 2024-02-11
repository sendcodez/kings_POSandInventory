<?php
include('db_connect.php');

// Get the selected size from the AJAX request
$selectedSize = $_POST['size'];

// If the selected size is "Regular", change it to "Large"
if ($selectedSize == 'Regular') {
    $selectedSize = 'Large';
}
elseif ($selectedSize == 'Large') {
    $selectedSize = 'Regular';
}

$selectedSize .= ' Cup';
error_log("Selected Size: " . $selectedSize);

// Query all ingredients except the selected size
$qry = $conn->query("SELECT * FROM ingredients WHERE name != '$selectedSize' ORDER BY name ASC");

// Output the updated ingredient checkboxes
while ($row = $qry->fetch_assoc()):
    $cname[$row['id']] = ucwords($row['name']);
?>
    <div>
        <input type="checkbox" name="ingredients[]" value="<?php echo $row['id'] ?>"> <?php echo $row['name'] ?> / <?php echo $row['unit'] ?>
        <input type="number" value="0" class="form-control" name="measurement[<?php echo $row['id'] ?>]" >
    </div>
<?php endwhile; ?>
