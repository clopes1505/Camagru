<?php
	require('../config/connect.php');

	var_dump($pid = $_POST['pid']);
	var_dump($user = $_SESSION['username']);
	var_dump($comment = $_POST['comment']);

	try{
		$stmt = $connect->prepare("INSERT INTO comments (pid, username, comment) VALUES(?, ?, ?)");
		$stmt->execute(array($pid, $user, $comment));
	}
	catch (PDOException $e){
		echo $e->getMessage();
	}
?>