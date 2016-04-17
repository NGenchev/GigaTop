<?php	
	// echo $login_session;
	include 'session.php';
	include '../conf.php';
	db_con();
	$sql="select * from login";
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
			  <?php $limit=10; ?>
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
			  <?php $limit=15; ?>
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
			<h3 class='page-title'>Администратори в сайта</h3>
			<p class='num'>Брой админи <?php echo $num; ?></p>
			<BR />
			<?php 
			$query = 'SELECT * FROM login';
			$gethackers = mysqli_query($conn, $query) or die("Nesho: ".mysqli_error($conn));
			$nums = mysqli_num_rows($gethackers);
			If ($nums == 0){
				echo "<div id='hackers'>Няма добавени администратори...</div>";
			}else{
				while ($row = mysqli_fetch_assoc($gethackers)){
					$id=$row['id'];
					$user = $row['username'];
					$pass = $row['password'];
					
					echo "<div class='small'>Име :: $user".
					"<BR /> Парола :: $pass <BR />
					<form method='POST' action='admins.php?id=".$id."'>
						<input type='submit' name='delete' value='Премахни'>
					</form>
					</div>";
				
				
					if(isset($_POST['delete'])){
						$id = $_GET['id'];
						$delete = "DELETE FROM login WHERE id = '$id'";
						$delete = mysqli_query($conn, $delete) or die(mysqli_errno($conn));
						echo "<meta http-equiv='refresh' content='0' />";
					}
				}
			}
			?>
		</article>
		<BR /><BR />
			<article>
			<h3 class='page-title'>Добави администратор:</h3>
			<div class="container">
			  <div id="login-form2">
			  <form action='' method='POST'>
				<BR />
				<input type='text' placeholder='Админ име' name='user'><Br />
				<input type='password' placeholder='Парола' name='pass'><Br />
				<input type='submit' value='Добави' name='add'><Br /><Br />
			  </form>
			  </div>
			</div>
			<?php
				if(isset($_POST['add'])):
					$user = strlen($_POST['user']) ? htmlspecialchars($_POST['user']) : 0;
					$pass = htmlspecialchars($_POST['pass']);
					
					$sql = "insert into login(`username`, `password`) values ('$user', '$pass')";
					$sql = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					if(!$sql){
						die(mysqli_error($conn));
					}else{echo "Успешно добавихте администратор! :)";}
				endif;
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