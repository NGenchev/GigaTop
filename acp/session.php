<?php
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$host = 'localhost';
$user = 'flikecom';
$pass = 'eJ,NP8z8a(hS';
$db = 'flikecom_giga';
		
$conn = mysqli_connect($host, $user, $pass, $db) or die(mysqli_error($conn));
session_start();

$user_check=$_SESSION['login_user'];

$ses_sql=mysqli_query($conn, "select username from login where username='$user_check'") or die("Nesho: ".mysqli_error($conn));
$row = mysqli_fetch_assoc($ses_sql);
$login_session =$row['username'];

if(!isset($login_session)){
	mysqli_close($conn); // Closing Connection
	header('Location: index.php'); // Redirecting To Home Page
}
?>