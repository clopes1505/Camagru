<?php
	require("../config/connect.php");
	$sql = $connect->prepare("UPDATE users SET `password` = ? WHERE verifyhash = ?");
	$sql->execute(array($_GET['hash'], $_GET['vkey']));
	header("Location: login.php");
?>