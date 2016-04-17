<?php
	include ('conf.php'); 
	include ('site.php'); 

	if($_GET['error']){
		$error = $_GET['error'];
		if ($error == 1){
			$greshka = 'Вече сте гласували за този сайт!';
		}
		}elseif($_GET['eERROR']){
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
					  <?php if($wrong) { 
							echo $wrong;
						} 
					  ?>
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
				<h3>Свържете се с нас: </h3>
			</hgroup>
				<HR /><BR />
			<div class="container">
			  <div id="login-form2">
				<h3>Можете да се свържете с нас чрез контакт формата:</h3>
				<fieldset>
				  <form action="" method="POST">
					<input type="text" pattern=".{3,35}" name="name" placeholder="Вашето име…" autofocus>
					<BR />
					
					<input type="text" pattern=".{6,60}" name="email" placeholder="Вашият емайл…">
					<BR />
					
					<select style='margin-top: 5px;' name='choice'>
						<option disabled="disabled" selected>Изберете тема…</option>
						<option value="1">Предложение за сайта</option>
						<option value="2">Проблем, бъг или грешка в сайта</option>
						<option value="3">Реклама в сайта</option>
						<option value="4">Друго запитване</option>
					</select>
					<BR />
					
					<textarea name="msg" pattern=".{45,666}" placeholder="Вашето съобщение…"></textarea>
					<BR />
					
					<input type="submit" name='send' value="Изпрати съобщението!">
				  </form> <BR /> <BR />
				  <?php
					if(isset($_POST['send'])) :
						$greshka=0;
						$name = $_POST['name'];
						$name = strlen($name)>3 ? $name : $greshka++;
						$to = "thewinner10000001@gmail.com";
						$to .= ", winless2015@abv.bg";
						$from = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ? $_POST['email'] : $greshka++;
						$subject = is_numeric($_POST['choice']) ? $_POST['name'] : $greshka++;
						$msg = is_string($_POST['msg']) ? $_POST['msg'] : $greshka++;
						
						if ($greshka > 0){
							echo "Вашето съобщение няма да се изпрати. Моля въведете валидни данни";
						}else{
							$headers = "From: ".$from."\r\nReply-To: ".$from."";
							$mail_sent = @mail($to, $subject, $msg, $headers);
							echo $mail_sent ? "Вашият емайл е успешно изпратен!" : "Грешка при изпращането..";
						}
						endif;
					?>
				 
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