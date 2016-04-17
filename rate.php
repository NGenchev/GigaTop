<meta charset='utf-8'>
<?php 
	include_once 'conf.php';
	include_once 'get_ip.php';
	db_con();
	if(isset($_POST['go_vote'])){
			global $id;
			$id = (int)$_GET['id']>0 ? (int)$_GET['id'] : NULL;
			ob_start(); 
			
			$sql = mysqli_query($conn, "SELECT ctime FROM ips WHERE ip=\"$ip\" AND id=\"$id\""); 
			if($row = mysqli_fetch_array($sql)) { 
				$calc = $row['ctime'] + $vtime; 
				if ($calc > $time) {
					echo "Можете да гласувате на 24ч. ";
				}else { 
					$sqlQ = mysqli_query($conn, "UPDATE ips SET ctime = \"$time\" WHERE ip=\"$ip\" AND id=\"$id\""); 
						$Check = "SELECT site_rating FROM sites WHERE site_id = '$id'";
						$Check_Res = mysqli_query($conn, $Check) or die(mysqli_error($conn));
						$row = mysqli_fetch_assoc($Check_Res);
						$newrating = $row['site_rating'];
						$newrating++;
						$update = "UPDATE sites SET site_rating='$newrating' WHERE site_id = '$id'";
						$query = mysqli_query($conn, $update) or die (mysqli_error($conn));;
						if($query){
							die('<meta http-equiv="refresh" content="0; url=index.php?hi=2">');
						}else{
							die('<meta http-equiv="refresh" content="0; url=index.php?error='.mysqli_error($conn).'">');
						}
				}
			 }else{
				$sql = mysqli_query($conn, "INSERT into ips(`id`,`ip`,`ctime`) VALUES ('$id','$ip','$time')"); 
					$Check = "SELECT site_rating FROM sites WHERE site_id = '$id'";
					$Check_Res = mysqli_query($conn, $Check) or die(mysqli_error($conn));
					$row = mysqli_fetch_assoc($Check_Res);
					$newrating = $row['site_rating'];
					$newrating++;
					$update = "UPDATE sites SET site_rating='$newrating' WHERE site_id = '$id'";
					$query = mysqli_query($conn, $update) or die (mysqli_error($conn));;
					if($query){
						die('<meta http-equiv="refresh" content="0; url=index.php?hi=1">');
					}else{
						die('<meta http-equiv="refresh" content="0; url=index.php?error='.mysqli_error($conn).'">');
					}
			}
	}
	
		