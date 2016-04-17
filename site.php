<?php 
	function head(){
		echo "<meta charset='UTF-8'>
	<title>GigaTOP.com</title>
	<meta name='viewport' content='width = device-width, initial-scale = 1'>
	<script type=\"text/javascript\" src=\"http://code.jquery.com/jquery-compat-git.js\"></script>
	<link href=\"imgs/favicon.ico\" rel=\"icon\" type=\"image/x-icon\" />
	<link rel='stylesheet' href='css/normalize.css' type='text/css'>
	<link rel='stylesheet' href='css/header.css' type='text/css'>
	<link rel='stylesheet' href='css/topbar.css' type='text/css'>
	<link rel='stylesheet' href='css/search.css' type='text/css'>
	<link rel='stylesheet' href='css/login.css' type='text/css'>
	<link rel='stylesheet' href='css/cont.css' type='text/css'>
	<link rel='stylesheet' href='css/footer.css' type='text/css'>";
	}

	function hd(){
	echo "<header>
	<div id='topbar'>
	<nav>
		<a href='index.php'>Начало</a>
			<span class='navs'>&nbsp;</span>
		<a href='klasaciq.php'>Класиране</a>
			<span class='navs'>&nbsp;</span>
		<a href='add_site.php'>Добави сайт</a>
			<span class='navs'>&nbsp;</span>
		<a href='get_link.php'>Вземи линк</a>
			<span class='navs'>&nbsp;</span>
		<a href='terms.php'>Общи условия</a>
			<span class='navs'>&nbsp;</span>
		<a href='contacts.php'>Контакти</a>
	</nav>
	<div class=\"search_field\">
		<form method='POST' action='srch.php'>
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
		<img src='imgs/cr.png' />
		</a>
		
		<a href='http://creativecommons.org/licenses/by-nc/4.0/'>
		<img src='imgs/cr2.png' />
		</a>
		<!-- 88x31 REKLAMA -->";
}
?>