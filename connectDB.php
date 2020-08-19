<?php
//connect database
	$ip ='127.0.0.1';
	$user ='root';
	$pass = '';
	$db = 'miniproject';
	$query = 'SET NAMES UTF8';

	$con = mysqli_connect($ip,$user,$pass,$db);
	if($con == null)
	{
		echo "คำสั่งผิด";
		exit;
	}

	mysqli_query($con,$query);
	
?>
