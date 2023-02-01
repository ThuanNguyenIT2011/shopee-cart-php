<?php  
session_start();
require_once 'config/connect.php';
if(isset($_POST) && !empty($_POST)){
	// $email = mysqli_real_escape_string($conn, $_POST['email']);
	$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);

	$password = $_POST['password'];
	$passwordagain = $_POST['passwordagain'];
	if($password != $passwordagain){
		header('location: login.php?message=2');
	} else {
		$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

		$sql = "INSERT INTO users(email, password) VALUES('$email', '$password')";
		$res = mysqli_query($conn, $sql) or die(mysql_error($conn));
		if ($res) {
			$_SESSION['customer'] = $email;
			$_SESSION['customerid'] = mysqli_insert_id($conn);
			header('location: checkout.php');
		} else {
			header('location: login.php?message=2');
		}
	}

	
}

?>