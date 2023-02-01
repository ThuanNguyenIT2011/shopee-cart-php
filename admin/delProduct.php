<?php  
session_start();
require_once "../config/connect.php";

if(!isset($_SESSION['email']) && empty($_SESSION['email'])){
	header('location: login.php');
}

if (isset($_GET['id']) && !empty($_GET['id'])) {
	$id = (int)$_GET['id'];
	$sql = "SELECT * FROM products WHERE id=$id";
	$res = mysqli_query($conn, $sql);

	$r = mysqli_fetch_assoc($res);
	if (unlink($r['thumb'])) {
		$sqldel = "DELETE FROM products WHERE id=$id";
		$resdel = mysqli_query($conn, $sqldel);

		if($resdel){
			header('location: products.php');
		}
	}
} else {
	header('location: products.php');
}
?>