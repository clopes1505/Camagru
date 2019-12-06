<?php
	require('../config/connect.php');

	$pid = $_POST['pid'];
	$user = $_SESSION['username'];

	$check = $connect->prepare("SELECT * FROM likes WHERE pid = :p AND username = :u");
	$check->bindParam(':p', $pid);
	$check->bindParam(':u', $user);
	$check->execute();
	$count = $check->fetch(PDO::FETCH_ASSOC);
	if(!isset($count['username']) && empty($count['username'])){
		http_response_code(200);
		$stmt = $connect->prepare("INSERT INTO likes (pid, username) VALUES(?, ?)");
		$stmt->execute(array($pid, $user));
	}
	else{
		http_response_code(205);
		$stmt = $connect->prepare("DELETE FROM likes WHERE pid = ? AND username = ?");
		$stmt->execute(array($pid, $user));
	}
?>