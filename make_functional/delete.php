<?php
    require("../config/connect.php");

	$pid = $_POST['pid'];
	$stmt = $connect->prepare("DELETE FROM `posts` WHERE `pid` = $pid");
    $stmt->execute();
?>