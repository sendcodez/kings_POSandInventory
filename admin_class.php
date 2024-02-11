<?php
session_start();
ini_set('display_errors', 1);
Class Action {
	private $db;

	public function __construct() {
		ob_start();
   	include 'db_connect.php';
    
    $this->db = $conn;
	}
	function __destruct() {
	    $this->db->close();
	    ob_end_flush();
	}

	function login() {
		extract($_POST);
	
		// Check if the user with the given username and password exists and is active
		$qry = $this->db->query("SELECT * FROM users WHERE username = '" . $username . "' AND password = '" . md5($password) . "' AND status = 'active'");
	
		if ($qry->num_rows > 0) {
			$user = $qry->fetch_array();
			foreach ($user as $key => $value) {
				if ($key != 'password' && !is_numeric($key))
					$_SESSION['login_' . $key] = $value;
			}
	
			// Log user login time
			$this->logUserLoginTime($user['id']);
	
			return 1; // Login successful
		} else {
			return 3; // User not found or status is not active
		}
	}
	
    function logout() {
        // Log user logout time
        $this->logUserLogoutTime($_SESSION['login_id']);

        session_destroy();
        foreach ($_SESSION as $key => $value) {
            unset($_SESSION[$key]);
        }
        header("location:login.php");
    }

    // Function to log user login time
	function logUserLoginTime($userId) {
		// Get the user's name from the database
		$nameQuery = $this->db->query("SELECT name FROM users WHERE id = $userId");
		$userName = '';
		if ($nameQuery->num_rows > 0) {
			$userRow = $nameQuery->fetch_array();
			$userName = $userRow['name'];
		}
		date_default_timezone_set('Asia/Manila');
		$currentTime = date('Y-m-d H:i:s');
		$statement = "$userName logged in ";
		$query = "INSERT INTO user_log (user_id, action_description, action_timestamp) VALUES ($userId, '$statement', '$currentTime')";
		$this->db->query($query);
	}
	
    // Function to log user logout time
    function logUserLogoutTime($userId) {
		$nameQuery = $this->db->query("SELECT name FROM users WHERE id = $userId");
		$userName = '';
		if ($nameQuery->num_rows > 0) {
			$userRow = $nameQuery->fetch_array();
			$userName = $userRow['name'];
		}
		date_default_timezone_set('Asia/Manila');
        $currentTime = date('Y-m-d H:i:s');
		$statement = "$userName logged out ";
        $query = "INSERT INTO user_log (user_id, action_description, action_timestamp) VALUES ($userId, '$statement', '$currentTime')";
        $this->db->query($query);
    }

	function save_user(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", username = '$username' ";
		$data .= ", email = '$email' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$data .= ", type = '$type' ";
		$chk = $this->db->query("Select * from users where username = '$username' and id !='$id' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO users set ".$data);
		}else{
			$save = $this->db->query("UPDATE users set ".$data." where id = ".$id);
		}
		if($save){
			return 1;
		}
	}
	function delete_user(){
		extract($_POST);
		$query =  $this->db->query("INSERT INTO archieve_users (id,name,username,password,type) SELECT id,name,username,password,type FROM users WHERE id =".$id);
		if($query)
			$delete = $this->db->query("DELETE FROM users where id = ".$id);
			return 1;
	}
	function delete_permanently_users(){
		extract($_POST);
		$delete2 = $this->db->query("DELETE FROM archieve_users where id = ".$id);
		if($delete2){
			return 1;
		}
	}
	function restore_users(){
		extract($_POST);
		$restore = $this->db->query("INSERT INTO users (id,name,username,password,type) SELECT id,name,username,password,type FROM archieve_users	 WHERE id = ".$id);
		if($restore){
			$delete2 = $this->db->query("DELETE FROM archieve_users where id = ".$id);
			return 1;
		}
	}
	function signup(){
		extract($_POST);
		$data = " name = '$name' ";
		$data .= ", email = '$email' ";
		$data .= ", address = '$address' ";
		$data .= ", contact = '$contact' ";
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * from complainants where email ='$email' ".(!empty($id) ? " and id != '$id' " : ''))->num_rows;
		if($chk > 0){
			return 3;
			exit;
		}
		if(empty($id))
			$save = $this->db->query("INSERT INTO complainants set $data");
		else
			$save = $this->db->query("UPDATE complainants set $data where id=$id ");
		if($save){
			if(empty($id))
				$id = $this->db->insert_id;
				$qry = $this->db->query("SELECT * FROM complainants where id = $id ");
				if($qry->num_rows > 0){
					foreach ($qry->fetch_array() as $key => $value) {
						if($key != 'password' && !is_numeric($key))
							$_SESSION['login_'.$key] = $value;
					}
						return 1;
				}else{
					return 3;
				}
		}
	}
	function update_account(){
		extract($_POST);
		$data = " name = '".$firstname.' '.$lastname."' ";
		$data .= ", username = '$email' ";
		if(!empty($password))
		$data .= ", password = '".md5($password)."' ";
		$chk = $this->db->query("SELECT * FROM users where username = '$email' and id != '{$_SESSION['login_id']}' ")->num_rows;
		if($chk > 0){
			return 2;
			exit;
		}
			$save = $this->db->query("UPDATE users set $data where id = '{$_SESSION['login_id']}' ");
		if($save){
			$data = '';
			foreach($_POST as $k => $v){
				if($k =='password')
					continue;
				if(empty($data) && !is_numeric($k) )
					$data = " $k = '$v' ";
				else
					$data .= ", $k = '$v' ";
			}
			if($_FILES['img']['tmp_name'] != ''){
							$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
							$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
							$data .= ", avatar = '$fname' ";

			}
			$save_alumni = $this->db->query("UPDATE alumnus_bio set $data where id = '{$_SESSION['bio']['id']}' ");
			if($data){
				foreach ($_SESSION as $key => $value) {
					unset($_SESSION[$key]);
				}
				$login = $this->login2();
				if($login)
				return 1;
			}
		}
	}

	function save_settings(){
		extract($_POST);
		$data = " name = '".str_replace("'","&#x2019;",$name)."' ";
		$data .= ", email = '$email' ";
		$data .= ", contact = '$contact' ";
		$data .= ", about_content = '".htmlentities(str_replace("'","&#x2019;",$about))."' ";
		if($_FILES['img']['tmp_name'] != ''){
						$fname = strtotime(date('y-m-d H:i')).'_'.$_FILES['img']['name'];
						$move = move_uploaded_file($_FILES['img']['tmp_name'],'assets/uploads/'. $fname);
					$data .= ", cover_img = '$fname' ";

		}
		
		// echo "INSERT INTO system_settings set ".$data;
		$chk = $this->db->query("SELECT * FROM system_settings");
		if($chk->num_rows > 0){
			$save = $this->db->query("UPDATE system_settings set ".$data);
		}else{
			$save = $this->db->query("INSERT INTO system_settings set ".$data);
		}
		if($save){
		$query = $this->db->query("SELECT * FROM system_settings limit 1")->fetch_array();
		foreach ($query as $key => $value) {
			if(!is_numeric($key))
				$_SESSION['system'][$key] = $value;
		}

			return 1;
				}
	}
	function save_category(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM categories where name ='$name' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO categories set $data");
		}else{
			$save = $this->db->query("UPDATE categories set $data where id = $id");
		}

		if($save)
			return 1;
	}

	function save_cat_ingredients(){
		extract($_POST);
		$data = "";
		foreach($_POST as $k => $v){
			if(!in_array($k, array('id')) && !is_numeric($k)){
				if(empty($data)){
					$data .= " $k='$v' ";
				}else{
					$data .= ", $k='$v' ";
				}
			}
		}
		$check = $this->db->query("SELECT * FROM categories_inventory where name ='$name' ".(!empty($id) ? " and id != {$id} " : ''))->num_rows;
		if($check > 0){
			return 2;
			exit;
		}
		if(empty($id)){
			$save = $this->db->query("INSERT INTO categories_inventory set $data");
		}else{
			$save = $this->db->query("UPDATE categories_inventory set $data where id = $id");
		}

		if($save)
			return 1;
	}

	
	function delete_category(){
		extract($_POST);
		$query =  $this->db->query("INSERT INTO archieve_categories (id,name,description) SELECT id,name,description FROM categories WHERE id =".$id);
		if($query){
			$delete = $this->db->query("DELETE FROM categories where id = ".$id);
			return 1;
		}
	}
	function delete_inv_category(){
		extract($_POST);
		$query =  $this->db->query("INSERT INTO archieve_inv_categories (id,name,description) SELECT id,name,description FROM categories WHERE id =".$id);
		if($query){
			$delete = $this->db->query("DELETE FROM categories_inventory where id = ".$id);
			return 1;
		}
	}
	function delete_ingredients(){
		extract($_POST);
			$delete = $this->db->query("DELETE FROM ingredients where id = ".$id);
			if($delete){
				return 1;
			}
		}
	function delete_permanently_categories(){
		extract($_POST);
		$delete2 = $this->db->query("DELETE FROM archieve_categories where id = ".$id);
		if($delete2){
			return 1;
		}
	}
	function restore_categories(){
		extract($_POST);
		$restore = $this->db->query("INSERT INTO categories (id,name,description) SELECT id,name,description FROM archieve_categories WHERE id = ".$id);
		if($restore){
			$delete2 = $this->db->query("DELETE FROM archieve_categories where id = ".$id);
			return 1;
		}
	}
	function save_product()
{
    extract($_POST);
    $data = "";
    $action_description = "";

    if (empty($id)) {
        $action_description = "Added a new product";
    } else {
        $action_description = "Updated an existing product";
    }

    // Fetch the category_name based on the selected category_id
    $category_query = $this->db->query("SELECT name FROM categories WHERE id = '$category_id'");
    $category = $category_query->fetch_assoc();
    $category_name = $category['name'];

    foreach ($_POST as $k => $v) {
        if (!in_array($k, array('id', 'status', 'ingredients', 'measurement')) && !is_numeric($k)) {
            if ($k == 'price') {
                $v = str_replace(',', '', $v);
            }
            if (empty($data)) {
                $data .= " $k='$v' ";
            } else {
                $data .= ", $k='$v' ";
            }
        }
    }

    if ($_FILES['image']['tmp_name'] != '') {
        $fname = strtotime(date('y-m-d H:i')) . '_' . $_FILES['image']['name'];
        $move = move_uploaded_file($_FILES['image']['tmp_name'], 'assets/uploads/' . $fname);
        $data .= ", image = '$fname' ";
    }

    if (isset($status)) {
        $data .= ", status=1 ";
    } else {
        $data .= ", status=0 ";
    }

    $check = $this->db->query("SELECT * FROM products WHERE name ='$name' " . (!empty($id) ? " AND id != {$id} " : ''))->num_rows;
    if ($check > 0) {
        return 2;
        exit;
    }

    if (empty($id)) {
        $save = $this->db->query("INSERT INTO products SET $data, category_name = '$category_name'");
        $product_id = $this->db->insert_id; // Get the inserted product ID
    } else {
        $save = $this->db->query("UPDATE products SET $data, category_name = '$category_name' WHERE id = $id");
        $product_id = $id; // Use the existing product ID
    }

    $this->logUserActivity($name, $action_description);
    $delete = $this->db->query("DELETE FROM product_ingredients WHERE product_id = $product_id");

    // Insert new product-ingredient relationships
    if (isset($ingredients) && is_array($ingredients)) {
        foreach ($ingredients as $ingredient_id) {
            $measurement_value = isset($measurement[$ingredient_id]) ? $measurement[$ingredient_id] : 0; // Get the corresponding measurement value or default to 0 if not set
            $this->db->query("INSERT INTO product_ingredients (product_id, ingredients_id, measurement) VALUES ($product_id, $ingredient_id, $measurement_value)");
        }
    }

    if ($save) {
        return 1;
    }
}

function logUserActivity($productName, $actionDescription) {
    // Log the user activity in the 'user_log' table
    $userId = $_SESSION['login_id'];
    $userName = $_SESSION['login_name'];
	date_default_timezone_set('Asia/Manila');
    $currentTime = date('Y-m-d H:i:s');
    $statement = "$userName $actionDescription with product name: $productName"; // Include the product name
    $query = "INSERT INTO user_log (user_id, action_description, action_timestamp) VALUES ($userId, '$statement', '$currentTime')";
    $this->db->query($query);
}

function delete_product(){
    extract($_POST);
    $product_name = ''; // Initialize a variable to store the product name

    // Retrieve the product name before deletion
    $query = $this->db->query("SELECT name FROM products WHERE id = $id");
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $product_name = $row['name'];
    }

    // Insert the information about the deleted product in the user_log table
    $this->logUserActivity($product_name, "Deleted a product");

    // Copy the product information to the archive table
    $query = $this->db->query("INSERT INTO archieve_products (id, category_id, name, description, price, status, image) SELECT id, category_id, name, description, price, status, image FROM products WHERE id = $id");
    
    // Delete the product from the products table
    if ($query) {
        $delete = $this->db->query("DELETE FROM products WHERE id = $id");
        return 1;
    }
}

function delete_permanently_products(){
    extract($_POST);
    $product_name = ''; // Initialize a variable to store the product name

    // Retrieve the product name before deletion
    $query = $this->db->query("SELECT name FROM archieve_products WHERE id = $id"); // Retrieve the product name from the archive table
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $product_name = $row['name'];
    }

    // Insert the information about the permanently deleted product in the user_log table
    $this->logUserActivity($product_name, "permanently deleted a product");

    $delete = $this->db->query("DELETE FROM archieve_products WHERE id = $id");
    
    if ($delete) {
        return 1;
    }
}

function restore_products() {
    extract($_POST);
    $product_name = ''; // Initialize a variable to store the product name

    // Retrieve the product name before restoration
    $query = $this->db->query("SELECT name FROM archieve_products WHERE id = $id");
    if ($query->num_rows > 0) {
        $row = $query->fetch_assoc();
        $product_name = $row['name'];
    }

    // Restore the product from the archive table to the products table
    $restore = $this->db->query("INSERT INTO products (id, category_id, name, description, price, status, image) SELECT id, category_id, name, description, price, status, image FROM archieve_products WHERE id = $id");

    if ($restore) {
        // Delete the product from the archive table
        $delete2 = $this->db->query("DELETE FROM archieve_products WHERE id = $id");

        // Log the restoration of the product in the user_log table
        $this->logUserActivity($product_name, "restored a product");

        return 1;
    }
}

	function save_order(){
		extract($_POST);
		$vat = $total_amount * 0.03;
		$with_vat = $total_amount + $vat;
		$data = " total_amount = '$total_amount' ";
		$data .= ", amount_tendered = '$total_tendered' ";
		$data .= ", amount_payable = '$amount_payable' ";
		$data .= ", customer_name = '$customer_name' ";
		$data .= ", user = '$user' "; 
		$data .= ", with_vat = '$with_vat' ";
		
		$selectedDiscount = $_POST['discount'];
		
		$data .= ", discount = '$selectedDiscount' ";
 

		if (isset($payment_mode)) {
			$data .= ", payment_mode='cash' ";
		} else {
			$data .= ", payment_mode='gcash' ";
		}
		if (isset($mode)) {
			$data .= ", mode='DINE IN' ";
		} else {
			$data .= ", mode='TAKEOUT' ";
		} 
		
		
	
		if (empty($id)) {
			$i = 0;
			while ($i == 0) {
				$ref_no  = mt_rand(1, 999999999999);
				$ref_no = sprintf("%'012d", $ref_no);
				$chk = $this->db->query("SELECT * FROM orders where ref_no ='$ref_no' ");
				if ($chk->num_rows <= 0) {
					$i = 1;
				}
			}
			$data .= ", ref_no = '$ref_no' ";
			date_default_timezone_set('Asia/Manila');
			$currentDate = date('Y-m-d'); // Get the current date
			$save = $this->db->query("INSERT INTO orders set $data");
	
			if ($save) {
				$id = $this->db->insert_id;
				// Calculate and insert daily sales data
				$save2 = $this->db->query("INSERT INTO daily_sales (date, total_sales) SELECT '$currentDate', SUM(amount_payable) FROM orders WHERE DATE(date_created) = '$currentDate'");
			}
		} else {
			$save = $this->db->query("UPDATE orders set $data where id = $id");
		}
	
		if ($save) {
			$ids = array_filter($item_id);
			$ids = implode(',', $ids);                
			if (!empty($ids)) {
				$this->db->query("DELETE FROM order_items where order_id = $id and id not ($ids)");
			}
	
			foreach ($item_id as $k => $v) {
				$data = " order_id = $id ";
				$data .= ", product_id = '{$product_id[$k]}' ";
				$data .= ", qty = '{$qty[$k]}' ";
				$data .= ", price = '{$price[$k]}' ";
				$data .= ", amount = '{$amount[$k]}' ";
				error_log("DEBUG: Data to be inserted/updated: $data");

				if (empty($v)) {
					$this->db->query("INSERT INTO order_items set $data");
				} else {
					$this->db->query("UPDATE order_items set $data where id = $v");
				}
			}
			
			return $id;
		}
	}
	
	function delete_order(){
		extract($_POST);
		$delete = $this->db->query("DELETE FROM orders where id = ".$id);
		$delete2 = $this->db->query("DELETE FROM order_items where order_id = ".$id);
		if($delete){
			return 1;
		}
	}
	function save_ingredients(){
    extract($_POST);
	
	//$total_cost = $qty * $cost;
	$category_query = $this->db->query("SELECT name FROM categories_inventory WHERE id = '$category_id'");
    if ($category_query) {
        $category = $category_query->fetch_assoc();
        $category_name = $category['name'];
    } else {
        // Handle any errors in fetching the category name (e.g., invalid category_id)
        return 0;
    }
	$units = '';
	$pkgs = '';
	if (isset($_POST['unit'])) {
        // If the "unit" dropdown is selected
        $units = ($_POST['unit'] === 'others') ? $_POST['unit_other'] : $_POST['unit'];
    } elseif (isset($_POST['unit_other'])) {
        // If only the "unit_other" text input is used
        $units = $_POST['unit_other'];
    }
	if (isset($_POST['pkg'])) {
        // If the "unit" dropdown is selected
        $pkgs = ($_POST['pkg'] === 'others') ? $_POST['pkg_other'] : $_POST['pkg'];
    } elseif (isset($_POST['pkg_other'])) {
        // If only the "pkg_other" text input is used
        $pkgs = $_POST['pkg_other'];
    }
	date_default_timezone_set('Asia/Manila');
	$date_created = date("Y-m-d");

    $data = " name = '$name' ";
    $data .= ", category_id = '$category_id' ";
    $data = " name = '$name' ";
    $data .= ", category_id = '$category_id' ";
	$data .= ", category_name = '$category_name' ";
    $data .= ", stocks = '$stocks' ";
	$data .= ", qty = '$qty' ";
	$data .= ", pkg = '$pkgs' ";
	$data .= ", unit = '$units' ";
	$data .= ", date_created = '$date_created' ";
	$data .= ", expiration_date = '$expiration_date' ";

    if(isset($status)){
        $data .= ", status = 1 ";
    }else{
        $data .= ", status = 0 ";
    }

    // Check if the ingredient with the same name exists
    $existingIngredient = $this->db->query("SELECT * FROM ingredients WHERE name = '$name' AND category_id = '$category_id'						")->fetch_assoc();

    if (empty($existingIngredient)) {
		// If it doesn't exist, insert a new record
		$save = $this->db->query("INSERT INTO ingredients SET $data");
		return 1;
	} else {
		// If it exists, update the existing record with new stock value
		$newStocks = $existingIngredient['stocks'] + $stocks;
		$update = $this->db->query("UPDATE ingredients SET stocks = '$newStocks', expiration_date = '$expiration_date', unit = '$units', qty = '$qty' WHERE id = '{$existingIngredient['id']}'");
	
		if ($update) {
			// Log the old data into the history table
			$historyData = " ingredient_id = '{$existingIngredient['id']}' ";
			$historyData .= ", name = '{$existingIngredient['name']}' ";
			$historyData .= ", category_id = '{$existingIngredient['category_id']}' ";
			$historyData .= ", category_name = '{$existingIngredient['category_name']}' ";
			$historyData .= ", stocks = '{$existingIngredient['stocks']}' ";
			$historyData .= ", qty = '{$existingIngredient['qty']}' ";
			$historyData .= ", pkg = '{$existingIngredient['pkg']}' ";
			$historyData .= ", unit = '{$existingIngredient['unit']}' ";
			$historyData .= ", date_created = '{$existingIngredient['date_created']}' ";
			$historyData .= ", expiration_date = '{$existingIngredient['expiration_date']}' ";
			$historyData .= ", status = '{$existingIngredient['status']}' ";
			$this->db->query("INSERT INTO ingredient_history SET $historyData");	
			return 1;
		} else {
			// Handle the case where the update fails
			echo "Update failed.";
			return 0;
		}
	}

}


}