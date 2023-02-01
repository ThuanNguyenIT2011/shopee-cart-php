<?php  
session_start();
require_once 'config/connect.php';

if(!isset($_SESSION['customer']) && empty($_SESSION['customer'])){
	header('location: login.php');
}

$uid = $_SESSION['customerid'];

if(isset($_GET['id']) && !empty($_GET['id'])){
	$id = $_GET['id'];

	$sql = "DELETE FROM wishlist WHERE id='$id'";
	$res = mysqli_query($conn, $sql);
	if ($res) {
		header('location: wishlist.php');
	}
}
?>