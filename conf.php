<?php
	function db_con(){
		$dbhost = 'localhost';
		$dbuser = 'doubleno';
		$dbpass = 'DoubleG_123';
		$dbname = 'doubleno_giga';
		global $conn;
		$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		if(mysqli_errno($conn)){
			die(mysqli_errno($conn));
		}
	}
	
	include_once 'get_ip.php';
	$time = time(); 
	$vtime = "86400"; // това е времето в секунди, за което ще може да се гласува. в случая е 24 часа. 
	$dtime = "345600"; // времето, след което ще се изтриват ненужните записи. в случая е 4 дни(72 часа) 
	
?>