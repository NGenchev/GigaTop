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
			<div class="container">
			  <div id="login-form2">
				<h3>Добави сайт</h3>
				<?php
					if(isset($_POST['add'])){
						db_con();
						global $error;
						$name = stripslashes($_POST['name']);
						$link = stripslashes($_POST['link']);
						$img = "http://img.bitpixels.com/getthumbnail?code=50461&size=200&url=".$link;
						$desc = stripslashes($_POST['desc']);
						$cat = stripslashes($_POST['catid']);
						$email = stripslashes($_POST['email']);
						$pass = stripslashes($_POST['password']);
						
						$name = trim(strip_tags(htmlspecialchars($name)));
						$desc = trim(strip_tags(htmlspecialchars($desc)));
						$pass = trim(strip_tags(htmlspecialchars($pass)));
						
						$check_info = "SELECT * FROM sites WHERE site_link = '$link'";
						$check = mysqli_query($conn, $check_info);
						$num_check = mysqli_num_rows($check);
						
						if($num_check == 1){
							$error = $error.'Този сайт вече е добавен в БД <BR/>';
						}elseif(strlen($name)<5){
							$error = $error.'Твърде кратко име.. <BR/>';
						}elseif(strlen($name)>=45){
							$error = $error.'Твърде дълго име.. <BR/>'.strlen($name);
						}elseif(strlen($link)<5 || (!filter_var($link, FILTER_VALIDATE_URL))){
							$error = $error.'Твърде кратък/грешен линк към сайта <BR/>';
						}elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
							$error = $error.'Въведеният емайл е грешен. <BR/>';
						}elseif(strlen($desc)<20){
							$error = $error.'Твърде кратко описание на сайта <BR/>';
						}elseif(strlen($desc)>250){
							$error = $error.'Твърде дълго описание на сайта <BR/>';
						}
						
						if(!$error){
							$query = mysqli_query($conn, "INSERT into sites (site_name, site_link, site_img, site_cat, site_desc, site_pass, site_email) VALUES ('$name', '$link', '$img', '$cat', '$desc', '$pass', '$email')") or die(mysqli_errno($conn));
							if ($query){
								$error = 1;
							}
						}
						
					}
				?>
				<fieldset>
				  <form action="add_site.php" method="POST">
					<input type="text" name='name' required value="Име на сайта" onBlur="if(this.value=='')this.value='Име на сайта'" onFocus="if(this.value=='Име на сайта')this.value='' ">
					
					<input type="text" name='link' required value="Линк към сайта" onBlur="if(this.value=='')this.value='Линк към сайта'" onFocus="if(this.value=='Линк към сайта')this.value='' ">
					
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
					
					<input type="text" name='desc' required value="Кратко описание на сайта" onBlur="if(this.value=='')this.value='Кратко описание на сайта'" onFocus="if(this.value=='Кратко описание на сайта')this.value='' ">
					
					<input type="text" name='email' required value="Е-майл адрес:" onBlur="if(this.value=='')this.value='Е-майл адрес:'" onFocus="if(this.value=='Е-майл адрес:')this.value='' ">

					<input type="password" placeholder='Парола' name='password' required value="Парола за сайт" onBlur="if(this.value=='')this.value='Парола за сайт'" onFocus="if(this.value=='Парола за сайт')this.value='' ">

					<input type="submit" style='float: right' name='add' value="Добави">
				  </form><BR />
				  <?php if($error==1) : ?>
				  <?php $sql=mysqli_query($conn, "SELECT site_id FROM sites ORDER By site_id DESC Limit 1");
				  $row=mysqli_fetch_assoc($sql);?>
						<p>Вие успешно добавихте вашият сайт. Вашето ID: <?php echo $row['site_id']; ?>
						<BR /><BR />
						Линк за гласуване :: <a tagert='_blank' href='http://gigatop.eu?vote.php?id=<?php echo $row['site_id']; ?>'>http://gigatop.eu?vote.php?id=<?php echo $row['site_id']; ?></a>
						</p>
					<? elseif($error) : ?>
						<p>Възникна грешка при добавянето на сайта:<BR /> <?php echo $error; ?></p>
				  <?php endif; ?>
				</fieldset>
			  </div>
			 </div>
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