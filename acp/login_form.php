<?php
	include 'login.php';
	include 'site.php';
	include '../conf.php';
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
		<section style='margin-left: 135px;'>
		<HR />
		<hgroup>
				<h3>Вход в системата</h3>
			</hgroup>
				<HR /><BR />
			<article style='margin:0 auto;text-align:center;'>
			<h3 class='page-title'>Login form:</h3>
			<p class='num'>Моля въведете вашите данни за вход в админ панела</p>
				<form id='form' action="" method="POST"><BR /><BR />
				<input id="name" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,30}$" name="username" placeholder="Вашето име" type="text"><BR /><BR />
				<input id="password" pattern="^[a-zA-Z][a-zA-Z0-9-_\.]{1,30}$" name="password" placeholder="Парола.." type="password">
					<BR /><BR />
					<input name="submit" class='admin' type="submit" value="Вход в админ панела">
					<BR /><BR />
				<span><?php echo $error; ?></span><BR /><BR />
				</form>
			</article>
			<BR />
		</section>
		</div>
		<div class='clear'></div>
		<BR /><BR /><BR />
<?php ft(); ?>
<?php
	db_con();
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