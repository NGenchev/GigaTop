<?php 
include ('conf.php'); 
include ('site.php'); 
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
					  <?php if($wrong) : ?>
					  Грешка: <?php echo $wrong; ?>
					  <?php endif; ?>
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
			
			<?php if (isset($_POST['edit'])) {?>
			<?php 
				db_con();
				$pID = (int)$_POST['id']>0 ? (int)$_POST['id'] : NULL;
				$pPASS = $_POST['password'];
				
				if ($pID == 0) die(); else {
				
				$SQL = "SELECT * FROM sites WHERE site_id = '$pID' AND site_pass = '$pPASS'";
				$rSQL = mysqli_query($conn, $SQL);
				$rNUM = mysqli_num_rows($rSQL);
				
				
				if($rNUM == 1) { ?>
				
				<?php while($site = mysqli_fetch_assoc($rSQL)) : ?>
				<div class="container">
				<div id="login-form2">
				<h3>Редакция на сайт</h3>
				<fieldset>
				  <form action="editor.php" method="POST">
					<input type="hidden" name='id' value="<?php echo $site['site_id']?>">
					
					<input type="text" name='name' required value="<?php echo $site['site_name']?>">
					
					<input type="text" name='img' required value="<?php echo $site['site_img']?>">
					
					<select class='select' name="catid">
					<option name="1">Авто</option>
					<option name="2">Бизнес и финанси</option>
					<option name="3">Дизайн</option>
					<option name="4">Заведения и хранене</option>
					<option name="5">Здраве и медицина</option>
					<option name="6">Игри и забавления</option>
					<option name="7">Имоти и строителство</option>
					<option name="8">Институции и оргранизации</option>
					<option name="9">Интернет</option>
					<option name="10">Информация и медии</option>
					<option name="11">Компютри и електроника</option>
					<option name="12">Комуникации</option>
					<option name="13">Култура и изкуство</option>
					<option name="14">Лични страници</option>
					<option name="15">Магазини и аукциони</option>
					<option name="16">Мода и козметика</option>
					<option name="17">Музика и клипове</option>
					<option name="18">Наука и образование</option>
					<option name="19">Портали и търсачки</option>
					<option name="20">Право</option>
					<option name="21">Работа</option>
					<option name="22">Реклама и маркетинг</option>
					<option name="23">Софтуер</option>
					<option name="24">Спорт</option>
					<option name="25">Туризъм и пътувания</option>
					<option name="26">Услуги</option>
					<option name="27">Хоби и развлечения</option>
					</select>
					
					<input type="text" name='desc' required value="<?php echo $site['site_desc']?>">
					
					<input type="text" name='email' required value="<?php echo $site['site_email']?>">

					<input type="submit" style='float: right' name='editor' value="Редактирай">
					<span style=''>&nbsp;</span>
					<input type="submit" style='float: right' name='delete' value="Премахни сайта">
				  </form>
				  <BR />
				  <?php endwhile; ?>
				  
				  <?php }else{ 
							die('<meta http-equiv="refresh" content="0; url=index.php?eERROR=1">'); 
						}
				  ?>
				<?php } ?>
				<?php if($_GET['edit'] == "succeed") { 
						 echo "<p>Вие успешно редактирахте вашият сайт.</p>";
					  }elseif($_GET['edit'] == "wrong"){
						 echo "<p>Възникна грешка при редактирането на сайта:<BR />".$_GET['error']."</p>";
					  }elseif($_GET['edit'] == "succeed2"){
						 echo "<p>Вие успешно изтрихте вашият сайт:<BR />".$_GET['error']."</p>";
					  }
				?>
				 </fieldset>
				</div>
			   </div>
		</section>
		</div>
		<div class='clear'></div>
		<BR /><BR /><BR />
<?php } ft(); ?>
<?php
	mysqli_close($conn);
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