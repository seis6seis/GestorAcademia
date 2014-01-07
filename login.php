<?php
	session_start();
	include("login.class.php");
	$login=new login();
	$login->inicia(365, $_GET['user'], $_GET['pass']);

?>
