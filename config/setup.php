<?php
	session_start();
	require('database.php');

	try {
	$db = "CREATE DATABASE IF NOT EXISTS $DB_NAME";
	$connect = new PDO('mysql:host=localhost', $DB_USER, $DB_PASSWORD);
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$connect->exec($db);
	// echo "It made the things <br>";
	}
	catch(PDOException $e) {
		echo $e->getMessage();
		
	}
	try {
		$connect = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE IF NOT EXISTS users (
			id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			firstname VARCHAR(100) NOT NULL,
			lastname VARCHAR(100) NOT NULL,
			username VARCHAR(100) NOT NULL UNIQUE, 
			email VARCHAR(100) NOT NULL UNIQUE,
			`password` VARCHAR(200) NOT NULL,
			verified BOOLEAN NOT NULL,
			notifications BOOLEAN NOT NULL,
			verifyhash VARCHAR(100) NOT NULL
			)";
		$connect->exec($sql);
		echo "It really did stuff";
		// header("Location: ../make_functional/index.php");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}
	try {
		$connect = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = "CREATE TABLE IF NOT EXISTS posts (
			`pid` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			`uid` INT(11) NOT NULL,
			`imageName` LONGTEXT NOT NULL
			)";
		$connect->exec($sql);
		echo "It really did post stuff";
		// header("Location: ../make_functional/index.php");
	}
	catch(PDOException $e){
		echo $e->getMessage();
	}/* 
	$connect = NULL; */
?>