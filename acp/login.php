<?php
session_start();
$error='';
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Грешни данни за вход!!";
}
else
{
$username=$_POST['username'];
$password=$_POST['password'];
$username = stripslashes($username);
$password = stripslashes($password);
$host = 'localhost';
$user = 'flikecom';
$pass = 'eJ,NP8z8a(hS';
$db = 'flikecom_giga';
		
$conn = mysqli_connect($host, $user, $pass, $db) or die(mysqli_error($conn));
$query = mysqli_query($conn, "select * from login where password='$password' AND username='$username'");
$rows = mysqli_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username;
	echo '<meta http-equiv="refresh" content="0; URL=index.php?page=home">';
} else {
	if (!empty($_SERVER["HTTP_CLIENT_IP"]))
	{
		$ip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif (!empty($_SERVER["HTTP_X_FORWARDED_FOR"]))
	{
		$ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	else
	{
		$ip = $_SERVER["REMOTE_ADDR"];
	}
	
	function checker ($str, $con){
		$str = preg_match('/^[a-zA-Z0-9]+_?[a-zA-Z0-9]+$/D',$str) ? $str : NULL;
		$str = (string)$str;
		$str = trim($str);
		$str = htmlspecialchars($str);
		$str = strip_tags($str);
		$str = stripslashes($str);
		$str = mysqli_real_escape_string($con, $str);
	}
	
	function ip_check($ipc){
		$ip = filter_var($ipc, FILTER_VALIDATE_IP) ? $ip : NULL;
		$ip = preg_match('/^(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)$/', $ip) ? $ip : NULL;
		$ip = !$ip ? NULL : mysqli_real_escape_string($con, $ip);
	}
	
	checker($username, $conn); checker($password, $conn); ip_check($ip);
	
	if ($ip == NULL || $username == NULL || $password == NULL){
		
		$error = "Грешни данни за вход!!";
	}else{
		$sql = "INSERT INTO `hackers`"
		."(hackers_ip, hackers_name, hackers_pass)"
		."VALUES ('$ip','$username','$password');";

		$send = mysqli_query($conn, $sql);
		if(!$send)
			{
				die('Възникна грешка при записа на хакер: ' . "Nesho: ".mysqli_error($conn));
			}
		$error = "Грешни данни за вход!! <BR />
		Вашият опит за влизане е ЗАПИСАН! IP: ".$ip;
	}
}
}
}
?>