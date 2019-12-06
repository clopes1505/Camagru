<?php
	require('../config/connect.php');

	if ($_GET['email'] == $_SESSION['email'])
	{
		if ($_GET['hash'] == $_SESSION['hash'])
		{
			$email=$_GET['email'];
			
			$sql="UPDATE `users` SET `verified`=1 WHERE `email` = :e";
			$req = $connect->prepare($sql);
			$req->execute(['e' => $email]);
			echo $email;
			echo ("Verified!");
		}
	}
?> 