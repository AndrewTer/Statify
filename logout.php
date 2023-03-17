<?php 
	session_start();
	unset($_SESSION['session_user']);
	session_destroy();

	setcookie('login', '', time(), '/');
	setcookie('key', '', time(), '/');

	header("location:login");
?>