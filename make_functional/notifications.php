<?php
	require('../config/connect.php');
	try {
		$sql = $connect->prepare("UPDATE users SET notifications = ? WHERE `id` = ?");
		$sql->execute(array($_POST['check'], $_SESSION['uid']));
	}
	catch (PDOException $e)
	{
		echo $e->getMessage();
	}
?>