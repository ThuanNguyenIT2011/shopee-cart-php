<?php  
session_start();
ob_start();

require_once 'config/connect.php';

if(isset($_GET['id']) && !empty($_GET['id'])){
	$pid = $_GET['id'];
} else {
	header('location: index.php');
}

echo "<pre>";
print_r($_SESSION);
echo "</pre>";



if (isset($_SESSION['customerid']) && !empty($_SESSION['customerid'])) {
	$uid = filter_var($_SESSION['customerid'], FILTER_SANITIZE_NUMBER_INT);
	$uid = filter_var($_SESSION['customerid'], FILTER_SANITIZE_NUMBER_INT);

	$datetimnow = date("Y-m-d H:i:s");
	echo $sql = "INSERT INTO wishlist(pid, uid, timestamp) VALUES('$pid', '$uid', '$datetimnow')";

	$res = mysqli_query($conn, $sql);

	if($res) {
		header('location: wishlist.php');
	} else {
		header("location: single.php?id=$pid");
	}

} else {
	header("location: single.php?id=$pid");
}



?>