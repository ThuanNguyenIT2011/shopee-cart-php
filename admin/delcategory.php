<?php 
session_start();
require_once '../config/connect.php';

if(!isset($_SESSION['email']) && empty($_SESSION['email'])){
	header('location: login.php');
}

if(isset($_GET) && !empty($_GET)){
	$id = (int)$_GET['id'];

	$sql="DELETE FROM category WHERE id=$id";
	if (mysqli_query($conn, $sql)) {
		header('location: categories.php');
	}
}else{
	header('location: categories.php');
}


?>