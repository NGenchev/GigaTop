<?php	
	// echo $login_session;
	include 'session.php';
	include '../conf.php';
	db_con();
	$sql="select * from hackers where hackers_active=1";
	$sql=mysqli_query($conn, $sql) or die(mysqli_error($sql));
	$num=mysqli_num_rows($sql);
	session_start();
	include ('site.php');
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset='UTF-8'>
	<title>GigaTOP.com</title>
	<meta name='viewport' content='width = device-width, initial-scale = 1'>
	<script type="text/javascript" src="http://code.jquery.com/jquery-compat-git.js"></script>
	<link href="../imgs/favicon.ico" rel="icon" type="image/x-icon" />
	<link rel='stylesheet' href='css\normalize.css' type='text/css'>
	<link rel='stylesheet' href='css\header.css' type='text/css'>
	<link rel='stylesheet' href='css\topbar.css' type='text/css'>
	<link rel='stylesheet' href='css\search.css' type='text/css'>
	<link rel='stylesheet' href='css\login.css' type='text/css'>
	<link rel='stylesheet' href='css\cont.css' type='text/css'>
	<link rel='stylesheet' href='css\footer.css' type='text/css'>
</head>
<body>
		<?php hd(); ?>
		<div id='rek1'>
		<?php 
			db_con();
			$sql="select * from medium order by rand() limit 1";
			$sql=mysqli_query($conn, $sql) or die(mysqli_error($conn));
			$row=mysqli_fetch_assoc($sql);
			$link = $row['medium_link'];
			$img = $row['medium_img'];
			echo "<a href='$link' target='_blank'><img src='$img' alt='' /></a>";
		?>
		</div>
		</header>
		<div class='clear'></div>
		<div id='wrap'>
		<aside>
			<div class='box'>
			<div class="container">
			  <div id="login-form">
				<h3>За реклама: </h3>
				<fieldset style='text-align: center;'>
					<a href='index.php?page=small'>88x31 Банери</a>
					<BR /><BR />
					<a href='index.php?page=medium'>468х60 Банери</a>
					<BR /><BR />
					<a href='index.php?page=big'>336х280 Банери</a>
					<BR /><BR />
					<a href='index.php?page=vote'>Банери за гласуване</a><BR />
				</fieldset>
			  </div>
			 </div>
			</div>
			<BR />
			<div class='box'>
			<div class="container">
			  <div id="login-form">
			  <?php $limit=20; ?>
				<h3>Последни <?php echo $limit; ?> добавени сайта</h3>
				<fieldset>
				<?php 
				db_con();
				$SQL = mysqli_query($conn, "SELECT * FROM sites ORDER BY site_id DESC LIMIT $limit") or die(mysqli_errno($conn)); ?>
				<?php while($row = mysqli_fetch_assoc($SQL)): ?>
					›› <a target='_blank' href='out.php?id=<?php echo $row['site_id']; ?>'><?php echo $row['site_name']; ?></a><BR />
				<?php endwhile; ?>
				</fieldset>
			  </div>
			 </div>
			</div>
			<BR />
		</aside>
		<section>
		<HR />
		<hgroup>
				<h3>ADMIN PANEL</h3>
			</hgroup>
				<HR /><BR />
			<article>
			<h3 class='page-title'>Начало на админ панела</h3>
			<p class='num'>Брой хакерски атаки <?php echo $num; ?></p>
			<BR />
			<p id='welcome'>Здравейте, администратор <?php echo $login_session; ?></p>
			<BR />
			<?php 
			$query = 'SELECT * FROM hackers WHERE `hackers_active` = 1';
			$gethackers = mysqli_query($conn, $query) or die("Nesho: ".mysqli_error($conn));
			$nums = mysqli_num_rows($gethackers);
			If ($nums == 0){
				echo "<div id='hackers'>Никой не се е опитвал да влезе в админ панела.</div>";
			}else{
				while ($row = mysqli_fetch_assoc($gethackers)){
					$id = $row['hackers_id'];
					$ip = $row['hackers_ip'];
					$user = $row['hackers_name'];
					$pass = $row['hackers_pass'];
					$tstamp = $row['hackers_time'];
					
					echo "<div id='hackers'><strong>#$id</strong> На <strong>".$tstamp."ч.</strong>, IP: <strong>$ip</strong> опита да влезе с потребителско име <strong>$user</strong> и парола <strong>$pass</strong><form method='POST' action='profile.php?id=$id'><input type='submit' name='delete' value='Премахни'></form></div>";
				
				
					if(isset($_POST['delete'])){
						$id = $_GET['id'];
						$delete = "DELETE FROM hackers WHERE hackers_id = '$id'";
						$delete = mysqli_query($conn, $delete) or die(mysqli_errno($conn));
						echo "<meta http-equiv='refresh' content='0' />";
					}
				}
			}
			?>
		</article>
		</section>
		</div>
		<div class='clear'></div>
		<BR /><BR /><BR />
<?php ft(); ?>
<?php
	$sql=mysqli_query($conn, "SELECT DISTINCT * FROM small ORDER BY RAND() LIMIT 5") or die(mysqli_error($conn));
		while($row=mysqli_fetch_assoc($sql)) :
		echo "<a href='".$row['small_link']."'>
		<img src='".$row['small_img']."' />
		</a>"; //skype:winless2015?chat
		endwhile;
	echo "</footer>";
?>
</body>
</html>