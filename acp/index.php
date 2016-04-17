<?php
	switch($_GET['page']){
		case "home":
			include "profile.php";
			break;
		case "small":
			include "small.php";
			break;
		case "medium":
			include "medium.php";
			break;
		case "big":
			include "big.php";
			break;
		case "vip":
			include "vip.php";
			break;
		case "del":
			include "del.php";
			break;
		case "vote":
			include "vote.php";
			break;
		case "admins":
			include "admins.php";
			break;
		case "logout":
			include "logout.php";
			break;
		default:
			include "login_form.php";
			break;
	}