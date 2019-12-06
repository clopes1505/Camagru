<?php
	session_start();
	require('database.php');
	try {
	$connect = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch (PDOException $e) {
		echo $e->getMessage();
	}
?>