<?php 
	if($_GET['vote'] && $_GET['id']){
		global $id;
		$id = $_GET['id'];
		include_once 'conf.php';
		include_once 'get_ip.php';
		db_con();
		
		$Check = "SELECT site_rating FROM sites WHERE site_id = '$id'";
		$Check_Res = mysqli_query($conn, $Check) or die(mysqli_errno($conn));
		$row = @mysqli_fetch_array($Check_Res);
		$newrating = $row['site_rating'];
		$vote = $_GET['vote'];
		
		$Second_Check = "SELECT * FROM rating WHERE rating_ip = '$ip' AND rating_sid = '$id'";
		$SC_Res = mysqli_query($conn, $Second_Check) or die(mysqli_errno($conn));
		$Num_SC = mysqli_num_rows($SC_Res);
		
		if ($Num_SC == 0){
			$Add = "INSERT INTO rating (`rating_sid`, `rating_ip`) VALUES ('$id', '$ip')";
			$Add_DB = mysqli_query($conn, $Add) or die(mysqli_errno($conn));
			if(!$Add_DB){
				die(mysqli_error($conn));
			}
			
			switch($vote){
			case plus:
				$newrating++;
				$update = "UPDATE sites SET site_rating='$newrating' WHERE site_id = '$id'";
				$query = mysqli_query($conn, $update) or die (mysqli_error($conn));;
				if($query){
					die('<meta http-equiv="refresh" content="0; url=klasaciq.php">');
				}else{
					die('<meta http-equiv="refresh" content="0; url=klasaciq.php?error='.mysqli_error($conn).'">');
				}
				break;
			case minus:
				$newrating--;
				$update = "UPDATE sites SET site_rating='$newrating' WHERE site_id = '$id'";
				$query = mysqli_query($conn, $update) or die (mysqli_error($conn));;
				if($query){
					die('<meta http-equiv="refresh" content="0; url=klasaciq.php">');
				}else{
					die('<meta http-equiv="refresh" content="0; url=klasaciq.php?error='.mysqli_error($conn).'">');
				}
				break;
			}
		}else{
			$error = 1;
			die('<meta http-equiv="refresh" content="0; url=klasaciq.php?error='.$error.'&err_id='.$id.'">');
		}
	}