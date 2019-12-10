<?php
	require('../config/connect.php');

	$pid = $_POST['pid'];
	$user = $_SESSION['username'];
	$check = $connect->prepare("SELECT * FROM likes WHERE pid = :p AND username = :u");
	$check->bindParam(':p', $pid);
	$check->bindParam(':u', $user);
	$check->execute();
	$count = $check->fetch(PDO::FETCH_ASSOC);
	if(!isset($count['uid']) && empty($count['uid'])){
		http_response_code(200);
		$statement = $connect->prepare("SELECT `uid` FROM posts WHERE `pid` = ?");
		$statement->execute(array($pid));
		$uid = $statement->fetchColumn();
		$sql = $connect->prepare("SELECT notifications FROM users WHERE `id` = ?");
		$sql->execute(array($uid));
		if($sql->fetchColumn() === "1")
		{
			$stmt = $connect->prepare("SELECT email FROM users WHERE `id` = ?");
			$stmt->execute(array($uid));
			$res = $stmt->fetch(PDO::FETCH_ASSOC);
			$subject = 'Someone liked your post';
			$message = $_SESSION['username'].' has liked your post';
			$headers = 'From:noreply@camagru.com' . "\r\n"; 
			mail($res['email'], $subject, $message, $headers);
		}
		$stmt = $connect->prepare("INSERT INTO likes (pid, `uid`, username) VALUES(?, ?, ?)");
		$stmt->execute(array($pid, $_SESSION['uid'], $user));
	}
	else{
		http_response_code(205);
		try {
			$stmt = $connect->prepare("DELETE FROM likes WHERE pid = ? AND `uid` = ?");
			$stmt->execute(array($pid, $_SESSION['uid']));
		}
		catch (PDOException $e)
		{
			echo $e->getMessage();
		}
	}
?>