<?php  
session_start();
require_once 'config/connect.php';
if(isset($_POST) && !empty($_POST)){
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	// $password = md5($_POST['password']);
	$password = $_POST['password'];

	$sql = "SELECT * FROM users WHERE email='$email'";
	$result = mysqli_query($conn, $sql) or die(mysql_error($conn));
	$res = mysqli_fetch_assoc($result);
	if (password_verify($password, $res['password'])) {
		// echo 'User exist, create session';
		$_SESSION['customer'] = $email;
		$_SESSION['customerid'] = $res['id'];

		header('location: checkout.php');
	} else {
		header('location: login.php?message=1');
	}
}

?>
