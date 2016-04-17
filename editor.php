<?php 
include 'conf.php';
if (isset($_POST['editor'])){
	db_con();
	global $error;
	$pID = $_POST['id'];
	$name = stripslashes($_POST['name']);
	$img = stripslashes($_POST['img']);
	$desc = $_POST['desc'];
	$cat = stripslashes($_POST['catid']);
	$email = stripslashes($_POST['email']);

	if(strlen($name)<5){
		$error = $error.'Твърде кратко име.. <BR/>';
	}elseif(strlen($name)>=45){
		$error = $error.'Твърде дълго име.. <BR/>'.strlen($name);
	}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		$error = $error.'Въведеният емайл е грешен. <BR/>';
	}elseif(strlen($img)<5 || ereg("^(http://www|www)[.]([a-z,A-Z,0-9]+)([-,_])([a-z,A-Z,0-9]+)[.]([a-z,A-Z]){2,3}[.]?(([a-z,A-Z]){2,3})[/]?[~]?([/,a-z,A-Z,0-9]+)?$",$img)){
		$error = $error.'Твърде кратък/грешен линк към снимката <BR/>';
	}elseif(strlen($desc)<20){
		$error = $error.'Твърде кратко описание на сайта <BR/>';
	}elseif(strlen($desc)>250){
		$error = $error.'Твърде дълго описание на сайта <BR/>';
	}

	if(!$error){ 
	$SQL = mysqli_query($conn, "UPDATE sites SET site_name = '$name', site_img = '$img', site_cat = '$cat', site_desc = '$desc', site_email = '$email' WHERE site_id = '$pID'") or die(mysqli_error($conn));
		if(!$SQL){
			die('<meta http-equiv="refresh" content="0; url=edit.php?edit=wrong&error='.$error.'">');
		}else{
			die('<meta http-equiv="refresh" content="0; url=edit.php?edit=succeed&id='.$pID.'">');
		}
	}
}elseif(isset($_POST['delete'])){
	db_con();
	$pID = $_POST['id'];
	$sql = "DELETE FROM sites WHERE site_id='$pID'";
	$sql = mysqli_query($conn, $sql);
	if(!$sql){
			die('<meta http-equiv="refresh" content="0; url=edit.php?edit=wrong&error='.$error.'">');
		}else{
			die('<meta http-equiv="refresh" content="0; url=edit.php?edit=succeed2&id='.$pID.'">');
		}
}else{
	die('<meta http-equiv="refresh" content="0; url=index.php">');
}
?>