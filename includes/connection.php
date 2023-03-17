<?php
	defined('mystatify');
	$configs = include('constants.php');
	$con = pg_connect("host=".$configs['host']." port=5433 dbname=".$configs['database']." user=".$configs['username']." password=".$configs['password'])
			or die("Failed to create connection: ". pg_last_error(). "<br/>");
?>