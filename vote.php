<?php 
include ('conf.php'); 
include ('site.php'); 

	if($_GET['eERROR']){
		$wrong = htmlspecialchars($_GET['eERROR']);
		
		switch($wrong){
			case 1:
				$wrong = "Грешка #".$wrong.": Въведено е грешно ID или парола.";
				break;
			case 2: 
				$wrong = 'Грешка #'.$wrong.': Въведно е грешно ID';
				break;
			default: 
				$wrong = 'Има проблем в системата';
				break;
		}
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
					  <?php if($wrong) {echo $wrong;} ?>
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
		<?php 
			$id = is_numeric($_GET['id']) ? $_GET['id'] : 0;
			db_con();
			$sqlche = "SELECT * FROM sites WHERE site_id='$id'";
			$sqlche = mysqli_query($conn, $sqlche);
		?>
		<?php $numche = mysqli_num_rows($sqlche); ?>
	      <?php if ($numche == 0) : 
					$greshka = "Няма такова ID"; 
					?>
					<div class='box' style='margin:0 auto;width:336px;height:280px;background: SKYBLUE;border-radius: 5px;'>
					<?php 
						$sql = "select distinct * from big order by rand() limit 1";
						$sql = mysqli_query($conn, $sql) or die(mysqli_error($conn));
						$row=mysqli_fetch_assoc($sql);
						$link= $row['big_link'];
						$img= $row['big_img'];
						echo "<a href='$link' target='_blank'>
							<img src='$img' style='border: 2px solid #333;' width='336' height='280' alt='$link' />
						</a>";
					?>
					</div>
					<BR /><BR />
					Въведено е грешно ID... След 5сек. ще бъдете пренасочени към главната страница..
					<meta http-equiv="refresh" content="5; url=index.php">
					<?php
				else :
					$row1=mysqli_fetch_assoc($sqlche); ?>
			<hgroup>
				<h3>Гласувайте за <?php echo $row1['site_name']; ?> | ID: #<?php echo $row1['site_id']; ?></h3>
				<?php $id = $row1['site_id'];?>
			</hgroup>
				<HR /><BR />
				<div class='box' style='margin:0 auto;width:336px;height:280px;background: SKYBLUE;border-radius: 5px;'>
				<?php 
					$sql = "select distinct * from big order by rand() limit 1";
					$sql = mysqli_query($conn, $sql) or die(mysqli_error($conn));
					$row=mysqli_fetch_assoc($sql);
					$link= $row['big_link'];
					$img= $row['big_img'];
					echo "<a href='$link' target='_blank'>
						<img src='$img' style='border: 2px solid #333;' width='336' height='280' alt='$link' />
					</a>";
				?>
				</div>
				<BR /><BR />
				<?php 
				$sql333 = mysqli_query($conn, "SELECT ctime FROM ips WHERE ip='$ip' AND id='$id'") or die(mysqli_error($conn)); 
				if($row = mysqli_fetch_assoc($sql333)) : 
					$calc = $row['ctime'] + $vtime; 
					if ($calc < $time) :	
					?>
					<form action='rate.php?id=<?php echo $id; ?>' style='margin:0 auto; text-align: center;width: 99%;' method='POST'>
					<input style='background: #1dabb8;border-radius: 3px;color: #fff;font-weight: bold;margin: 20px auto;width: 50%;padding: 10px;' type='submit' name='go_vote' value='Гласувай!'>
					</form>
					<?php
					else : 
					?><p style='width: 85%;margin: 0 auto;text-align: center;'>Можете да гласувате на всеки 24ч.</p>
					<?php
					endif;
				else:
					?>
					<form action='rate.php?id=<?php echo $id; ?>' style='margin:0 auto; text-align: center;width: 99%;' method='POST'>
					<input style='background: #1dabb8;border-radius: 3px;color: #fff;font-weight: bold;margin: 20px auto;width: 50%;padding: 10px;' type='submit' name='go_vote' value='Гласувай!'>
					</form>
					<?php
				endif; endif;?>
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
	