<?php
	require('../config/connect.php');
	session_start();
 if ($_SERVER["REQUEST_METHOD"] === "POST"){
	if($_POST[password1] != $_POST[password2])
	{	
		echo "Passwords do not match";
	// make sure username != email format
	} else {
	try{
		$sql="INSERT INTO users (firstname, lastname, username, email, password, verified, notifications) 
		VALUES('{$_POST[firstname]}', '{$_POST[lastname]}', '{$_POST[username]}', '{$_POST[email]}', '{$_POST[password1]}', 0, 0)";
		$connect->exec($sql);
	}
	catch(PDOException $e){
		if($e->getCode() === 23000)
			echo "Username/e-mail already exists";
		else
			echo $e->getMessage();
	}
}
	$connect = NULL;
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Home</title>
</head>
<body>
	<form action="#" method="POST">
		<input type="text" name="firstname" placeholder="First Name" required>
		<br>
		<input type="text" name="lastname" placeholder="Last Name" required>
		<br>
		<input type="email" name="email" placeholder="you@gmail.com" required>
		<br>
		<input type="text" name="username" placeholder="Username" required>
		<br>
		<input type="password" name="password1" placeholder="Password" required>
		<br>
		<input type="password" name="password2" placeholder="Confirm Password" required>
		<br>
		<button type="submit" name="login_btn" value="yes">login</button>
	</form>
</body>
</html>