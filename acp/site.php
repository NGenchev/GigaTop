<?php 
	function hd(){
	echo "<header>
	<div id='topbar'>
	<nav>
		<a href='index.php?page=home'>Начало</a>
			<span class='navs'>&nbsp;</span>
		<a href='index.php?page=admins'>Админи</a>
			<span class='navs'>&nbsp;</span>
		<a href='index.php?page=vip'>VIP сайтове</a>
			<span class='navs'>&nbsp;</span>
		<a href='index.php?page=del'>Изтрий сайт</a>
			<span class='navs'>&nbsp;</span>
		<a href='../index.php'>Върни се в сайта</a>
			<span class='navs'>&nbsp;</span>
		<a href='index.php?page=logout'>Изход</a>
		
	</nav>
	<div class=\"search_field\">
		<form method='POST' action='../srch.php'>
		<input name=\"sTXT\" type='search' pattern=\".{3,50}\" placeholder='Търси'>
		<input name=\"submit\" type='submit' value=''>
		</form>
	</div>
	</div>
	<div id='logo'></div>
	<div id='rek1'></div>
	<Br /><Br /><Br /><Br /><Br /><Br />
	</header>
	<div class='clear'></div>";
}

function ft(){
	echo "<footer id='footer'>
		<p style='float: right;margin-top:15px;'>
		Design by: WinLess..<BR />
		System by: NGenchev</p>
		
		<p>Copyright &copy; 2015 Всички права са запазени. GigaTOP<sup>&reg;</sup></p>
		<BR />
		<a href='http://gigatop.com'>
		<img src='../imgs/cr.png' />
		</a>
		
		<a href='http://creativecommons.org/licenses/by-nc/4.0/'>
		<img src='../imgs/cr2.png' />
		</a>
		<!-- 88x31 REKLAMA -->";
}
?>