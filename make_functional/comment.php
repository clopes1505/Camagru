<?php
	require('../config/connect.php');

	$pid = $_POST['pid'];
	$user = $_SESSION['username'];
	$comment = htmlentities($_POST['comment']);
	if(!empty($comment))
	{
		try{		
			$statement = $connect->prepare("SELECT `uid` FROM posts WHERE `pid` = ?");
			$statement->execute(array($pid));
			$uid = $statement->fetchColumn();
			$stmt = $connect->prepare("SELECT email FROM users WHERE `id` = ?");
			$stmt->execute(array($uid));
			$sql = $connect->prepare("SELECT notifications FROM users WHERE `id` = ?");
			$sql->execute(array($uid));
			if($sql->fetchColumn() === "1")
			{
				$res = $stmt->fetch(PDO::FETCH_ASSOC);
				$subject = 'Someone commented on your post';
				$message = $_SESSION['username'].' has commented "'.$comment.'" on your post';
				$headers = 'From:noreply@camagru.com' . "\r\n"; 
				mail($res['email'], $subject, $message, $headers);
			}
			$stmt = $connect->prepare("INSERT INTO comments (pid,`uid`, username, comment) VALUES(?, ?, ?, ?)");
			$stmt->execute(array($pid, $_SESSION['uid'], $user, $comment));
		}
		catch (PDOException $e){
			echo $e->getMessage();
		}
	}
?>