<?php 
include ('conf.php'); 
include ('site.php'); 

	if($_GET['error'] && $_GET['err_id']){
		$error = $_GET['error'];
		if ($error == 1){
			$greshka = 'Вече сте гласували за този сайт!';
		}
		$err_id = $_GET['err_id'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<?php head();?>
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
				<h3>Редакция на сайт</h3>
				<fieldset>
				  <form action="edit.php" method="POST">
					<input type="text" name='id' required value="ID на сайта" onBlur="if(this.value=='')this.value='ID на сайта'" onFocus="if(this.value=='ID на сайта')this.value='' ">

					<input type="password" name='password' required value="Парола" onBlur="if(this.value=='')this.value='Парола'" onFocus="if(this.value=='Парола')this.value='' ">

					<input type="submit" name='edit' value="Редактирай">
					<footer class="clearfix">
					  <p><span class="info">?</span><a href="forgot.php">Забравена парола/ID</a></p>
					</footer>
				  </form>
				</fieldset>
			  </div>
			 </div>
			</div>
			<BR />
			<div class='box'>
			<div class="container">
			  <div id="login-form">
			  <?php $limit=25; ?>
				<h3>Последни <?php echo $limit; ?> добавени сайта</h3>
				<fieldset>
				<?php 
				db_con();
				$SQL = mysqli_query($conn, "SELECT * FROM sites ORDER BY site_id DESC LIMIT $limit") or die(mysqli_errno($conn)); ?>
				<?php while($row = mysqli_fetch_assoc($SQL)): ?>
					›› <a target='_blank' href='out.php?id=<?php echo $row['site_id']; ?>'><?php echo $row['site_name']; ?></a><BR />
				<?php endwhile; mysqli_close($conn); ?>
				</fieldset>
			  </div>
			 </div>
			</div>
			<BR />
			<div class='box'>
			<div class="container">
			  <div id="login-form">
				<h3>Категории</h3>
				<fieldset>
					›› <a href='srch.php?by_cat=Авто'>Авто</a><BR />
					›› <a href='srch.php?by_cat=Бизнес и финанси'>Бизнес и финанси</a><BR />
					›› <a href='srch.php?by_cat=Дизайн'>Дизайн</a><BR />
					›› <a href='srch.php?by_cat=Заведения и хранене'>Заведения и хранене</a><BR />
					›› <a href='srch.php?by_cat=Здраве и медицина'>Здраве и медицина</a><BR />
					›› <a href='srch.php?by_cat=Игри и забавления'>Игри и забавления</a><BR />
					›› <a href='srch.php?by_cat=Имоти и строителство'>Имоти и строителство</a><BR />
					›› <a href='srch.php?by_cat=Институции и оргранизации'>Институции и оргранизации</a><BR />
					›› <a href='srch.php?by_cat=Интернет'>Интернет</a><BR />
					›› <a href='srch.php?by_cat=Информация и медии'>Информация и медии</a><BR />
					›› <a href='srch.php?by_cat=Компютри и електроника'>Компютри и електроника</a><BR />
					›› <a href='srch.php?by_cat=Комуникации'>Комуникации</a><BR />
					›› <a href='srch.php?by_cat=Култура и изкуство'>Култура и изкуство</a><BR />
					›› <a href='srch.php?by_cat=Лични страници'>Лични страници</a><BR />
					›› <a href='srch.php?by_cat=Магазини и аукциони'>Магазини и аукциони</a><BR />
					›› <a href='srch.php?by_cat=Мода и козметика'>Мода и козметика</a><BR />
					›› <a href='srch.php?by_cat=Музика и клипове'>Музика и клипове</a><BR />
					›› <a href='srch.php?by_cat=Наука и образование'>Наука и образование</a><BR />
					›› <a href='srch.php?by_cat=Портали и търсачки'>Портали и търсачки</a><BR />
					›› <a href='srch.php?by_cat=Право'>Право</a><BR />
					›› <a href='srch.php?by_cat=Работа'>Работа</a><BR />
					›› <a href='srch.php?by_cat=Реклама и маркетинг'>Реклама и маркетинг</a><BR />
					›› <a href='srch.php?by_cat=Софтуер'>Софтуер</a><BR />
					›› <a href='srch.php?by_cat=Спорт'>Спорт</a><BR />
					›› <a href='srch.php?by_cat=Туризъм и пътувания'>Туризъм и пътувания</a><BR />
					›› <a href='srch.php?by_cat=Услуги'>Услуги</a><BR />
					›› <a href='srch.php?by_cat=Хоби и развлечения'>Хоби и развлечения</a>
				</fieldset>
			  </div>
			 </div>
			</div>
		</aside>
		
		<section>
			<hgroup>
				<h3>Сайтовете с най-голям рейтинг</h3>
			<?php 
			db_con();
			if($_GET['order']){
				$order = $_GET['order'];
				switch ($order){
					case views:
						echo "<h5>Сортирай по: <a href='?order=views' class='active'>преглеждания</a> <a>|</a> <a href='?order=rating'>рейтинг</a></h5>";
						$SQL = "SELECT * FROM sites ORDER BY site_views DESC LIMIT 10;";
						break;
					case rating:
						echo "<h5>Сортирай по: <a href='?order=rating' class='active'>рейтинг</a> <a>|</a> <a href='?order=views'>преглеждания</a></h5>";
						$SQL = "SELECT * FROM sites ORDER BY site_rating DESC LIMIT 10;";
						break;
					default:
						$SQL = "SELECT * FROM sites ORDER BY site_id DESC LIMIT 10;";
						break;
				}
			}else{
				echo "<h5>Сортирай по: <a href='?order=views'>преглеждания</a> <a>|</a> <a href='?order=rating'>рейтинг</a></h5>";	
				$SQL = "SELECT * FROM sites ORDER BY site_id DESC LIMIT 10;";
			}
		
			$query = mysqli_query($conn, $SQL);
			?>
			</hgroup>
				<HR /><BR />
			<?php while($row = mysqli_fetch_assoc($query)) : ?>
			<article>
			<table class='public'>
				<tr><!-- Picture.. -->
					<td><a target='_blank' href='out.php?id=<?php echo $row['site_id']; ?>'><img class='img' src='<?php echo $row['site_img']; ?>'/></a></td>
					<!-- Description -->
					<td class='descc'><p class='descB'><span class='site'><a target='_blank' href='out.php?id=<?php echo $row['site_id']; ?>'><?php echo $row['site_name']; ?></a></span><BR />
					<?php echo $row['site_desc']; ?></p></td>
					<!-- Views -->
					<td class='viewss'><p class='views'><span class='site'>Преглеждания</span><BR />
					<?php echo $row['site_views']; ?></p></td>
					<!-- Rating -->
					<td class='ratingg'><p class='rating'><span class='site'>Рейтинг</span><BR />
					<?php echo $row['site_rating']; ?>
					</p></td>
				</tr>
			</table>
			</article><BR />
			<?php endwhile; ?>
			<?php mysqli_close($conn); ?>
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