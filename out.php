<?php
	include ('conf.php');
	db_con();
	if($_GET['id']){
		global $out;
		$out = $_GET['id'];
		$fast = mysqli_query($conn, "SELECT * FROM sites WHERE site_id = '$out'") or die('<meta http-equiv="refresh" content="0; url=index.php">');
		while ($row = mysqli_fetch_assoc($fast)){
			$url = $row['site_link'];
			$views = $row['site_views'];
			$views++;
			$update = "UPDATE sites SET site_views='$views' WHERE site_id = '$out'";
			$query = mysqli_query($conn, $update) or die (mysqli_error());
			if($query){
				die('<meta http-equiv="refresh" content="0; url='.$row['site_link'].'">');
			}else{
				die('<meta http-equiv="refresh" content="0; url=index.php?error='.mysqli_error($conn).'">');
			}
			
		}
	}
	mysqli_close($conn);
?>