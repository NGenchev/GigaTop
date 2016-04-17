<?php	
	// echo $login_session;
	include 'session.php';
	include '../conf.php';
	db_con();
	$sql= mysqli_query($conn, "SELECT * FROM medium ORDER by medium_id DESC") or die(mysqli_error($conn));
	$num = mysqli_num_rows($sql);
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
				<h3>468x60 Банери</h3>
			</hgroup>
				<HR /><BR />
			<article>
			<h3 class='page-title'>Добавени 468x60 банери:</h3>
			<p class='num'>В сайта има общо <?php echo $num; ?> 468x60 банера</p>
			<?php 
			$query = 'SELECT * FROM medium';
			$get88x31 = mysqli_query($conn, $query) or die(mysqli_error($conn));
			$nums = mysqli_num_rows($get88x31);
			If ($nums == 0){
				echo "<div id='hackers'>Няма добавени банери..</div>";
			}else{
				while ($row = mysqli_fetch_assoc($get88x31)){
					$id = $row['medium_id'];
					$link = $row['medium_link'];
					$img = $row['medium_img'];
					
					echo "<div class='medium'><strong>#$id</strong> 
					Link: <a href='$link'>$link</a><BR />
					<img src='$img' alt=''/>
					<form method='POST' action='medium.php?id=$id'>
						<input type='submit' name='delete' value='Премахни'>
					</form>
					</div>
					<BR />";
				
					if(isset($_POST['delete'])){
						$id = $_GET['id'];
						$delete = "DELETE FROM medium WHERE medium_id = '$id'";
						$delete = mysqli_query($conn, $delete) or die(mysqli_errno($conn));
						echo "<meta http-equiv='refresh' content='0' />";
					}
				}
			}
			?>
			</article>
			<BR /><BR />
			<article>
			<h3 class='page-title'>Добави 468x60 банер:</h3>
			<div class="container">
			  <div id="login-form2">
			  <form action='' method='POST'>
				<BR />
				<input type='text' placeholder='Линк към сайт' name='link'><Br />
				<input type='text' placeholder='Линк към банер' name='img'><Br />
				<input type='submit' value='Добави' name='add'><Br /><Br />
			  </form>
			  </div>
			</div>
			<?php
				if(isset($_POST['add'])):
					$link = $_POST['link'];
					$img = $_POST['img'];
					
					$sql = "insert into medium(`medium_link`, `medium_img`) values ('$link', '$img')";
					$sql = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					if(!$sql){
						die(mysqli_error($conn));
					}else{echo "Успешно добавихте банер! :)";}
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