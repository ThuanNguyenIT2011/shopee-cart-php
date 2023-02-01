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

	if (!empty($r['thumb'])) {
		if (unlink($r['thumb'])) {
			$delsql = "UPDATE products set thumb='' WHERE id=$id";
			$resdel = mysqli_query($conn, $delsql);

			if ($resdel) {
				header("location: editProduct.php?id=$id");
			}
		}
	}
}

?>