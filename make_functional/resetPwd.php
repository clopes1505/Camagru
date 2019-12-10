<?php
	require("navbar.php");
	require("../config/connect.php");
	
	if ($_SERVER["REQUEST_METHOD"] === "POST"){
		preg_match("/.*htdocs\/(.*)\/make_functional.*/", $_SERVER["SCRIPT_FILENAME"], $matches);
		$server_location = $matches[1];
		$password = htmlspecialchars($_POST['password1']);
		$password2 = htmlspecialchars($_POST['password2']);
		if (strlen($password) < 4)
			die("Too few characters in password");
		else if (!preg_match("@[A-Z]@", $password))
			die("No uppercase letter in password");
		else if (!preg_match("@[a-z]@", $password))
			die("No Lowercase letter in password");
		else if (!preg_match("@[0-9]@", $password))
			die("No number in password");
		else if (!preg_match("@[^\w]@", $password))
			die("No special character in password");
		else if($password != $password2)
			die("Passwords do not match");
		else{
			$email = htmlspecialchars($_POST['email']);
			$hash= password_hash($password, PASSWORD_DEFAULT);
			$sql = $connect->prepare("SELECT `verifyhash` FROM `users` WHERE `email` = ?");
			$sql->execute(array($email));
			$vkey = $sql->fetchColumn();
			$to = $email;
			$subject = 'Password reset';
			$message = 'You have requested to change your password on Camagru click the link below to confirm this change 
			http://localhost:8080/'.$server_location.'/make_functional/passwrd.php?vkey='.$vkey.'&hash='.$hash;
			$headers = 'From:noreply@camagru.com' . "\r\n"; 
			mail($to, $subject, $message, $headers);
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
	<link rel="stylesheet" href="../make_pretty/style.css">
	<title>Reset Password</title>
	<script src = "../js_stuff/profile.js"></script>
</head>
<body>
<form action = "#" method = "POST">
<div class="field">  
<p class="control has-icons-left has-icons-right">
    <input class="input" name="email" type="email" placeholder="Email">
    <span class="icon is-small is-left">
      <i class="fas fa-envelope"></i>
    </span>
    <span class="icon is-small is-right">
      <i class="fas fa-check"></i>
    </span>
  </p>
</div>
<div class="field">
  <p class="control has-icons-left">
    <input class="input" name="password1" type="password" placeholder="Password">
    <span class="icon is-small is-left">
      <i class="fas fa-lock"></i>
    </span>
  </p>
</div>
<div class="field">
  <p class="control has-icons-left">
    <input class="input" name="password2" type="password" placeholder="Confrim Password">
    <span class="icon is-small is-left">
      <i class="fas fa-lock"></i>
    </span>
  </p>
</div>
<div class="field">
  <p class="control">
    <button class="button is-success" type="submit">Reset Password</button>
  </p>
</div>
</form>