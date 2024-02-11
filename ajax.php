<?php
ob_start();
$action = $_GET['action'];
include 'admin_class.php';
$crud = new Action();
if($action == 'login'){
	$login = $crud->login();
	if($login)
		echo $login;
}
if($action == 'login2'){
	$login = $crud->login2();
	if($login)
		echo $login;
}
if($action == 'logout'){
	$logout = $crud->logout();
	if($logout)
		echo $logout;
}
if($action == 'logout2'){
	$logout = $crud->logout2();
	if($logout)
		echo $logout;
}
if($action == 'save_user'){
	$save = $crud->save_user();
	if($save)
		echo $save;
}
if($action == 'delete_user'){
	$save = $crud->delete_user();
	if($save)
		echo $save;
}
if($action == 'delete_permanently_users'){
	$save = $crud->delete_permanently_users();
	if($save)
		echo $save;
}
if($action == "restore_users"){
	$restore = $crud->restore_users();
	if($restore)
		echo $restore;
}

if($action == 'signup'){
	$save = $crud->signup();
	if($save)
		echo $save;
}
if($action == 'update_account'){
	$save = $crud->update_account();
	if($save)
		echo $save;
}
if($action == "save_settings"){
	$save = $crud->save_settings();
	if($save)
		echo $save;
}
if($action == "save_category"){
	$save = $crud->save_category();
	if($save)
		echo $save;
}
if($action == "delete_category"){
	$delete = $crud->delete_category();
	if($delete)
		echo $delete;

}
if($action == "delete_inv_category"){
	$delete = $crud->delete_inv_category();
	if($delete)
		echo $delete;

}
if($action == "save_cat_ingredients"){
	$save = $crud->save_cat_ingredients();
	if($save)
		echo $save;
}

if($action == "delete_permanently_categories"){
	$delete = $crud->delete_permanently_categories();
	if($delete)
		echo $delete;
}
if($action == "restore_categories"){
	$restore = $crud->restore_categories();
	if($restore)
		echo $restore;
}

if($action == "save_product"){
	$save = $crud->save_product();
	if($save)
		echo $save;
}
if($action == "delete_product"){
	$delete = $crud->delete_product();
	if($delete)
		echo $delete;
}
if($action == "delete_permanently_products"){
	$delete = $crud->delete_permanently_products();
	if($delete)
		echo $delete;
}
if($action == "restore_products"){
	$restore = $crud->restore_products();
	if($restore)
		echo $restore;
}

if($action == "save_order"){
	$save = $crud->save_order();
	if($save)
		echo $save;
}
if($action == "delete_order"){
	$delete = $crud->delete_order();
	if($delete)
		echo $delete;
}
if($action == "delete_ingredients"){
	$delete = $crud->delete_ingredients();
	if($delete)
		echo $delete;
}
if($action == "save_ingredients"){
	$save = $crud->save_ingredients();
	if($save)
		echo $save;
}
if($action == "update_product"){
	$save = $crud->update_product();
	if($save)
		echo $save;
}


ob_end_flush();
?>
