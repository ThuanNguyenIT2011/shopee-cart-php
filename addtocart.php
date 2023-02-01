<?php
session_start();
if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];
	$quant = (isset($_GET['quant']) && !empty($_GET['quant'])) ? (int)$_GET['quant'] : 1;
	$_SESSION['cart'][$id] = ['quant' => $quant];
	header('location: index.php');
} else {
	header('location: index.php');
}
// unset($_SESSION['cart']);
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

?>