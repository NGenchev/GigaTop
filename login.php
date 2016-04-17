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
$user = 'winlesst';
$pass = '910919ivo';
$db = 'giga';
		
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
?>