<?php
	$conn = mysqli_connect('localhost', 'root', '123456', 'shoppycart');
	if(!$conn){
		die('Connection Faild ' . mysqli_connect_error());
	}
?>