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
		$verifyhash=md5(rand(0,1000));
		$hash= password_hash($_POST['password1'], PASSWORD_DEFAULT);
		$sql="INSERT INTO users (firstname, lastname, username, email, `password`, verified, notifications, verifyhash) 
		VALUES(:firstname, :lastname, :username, :email, :password, 0, 0, '$verifyhash')";
		$stmt=$connect->prepare($sql);
		$stmt->bindParam(':lastname', $_POST['lastname']);
		$stmt->bindParam(':username', $_POST['username']);
		$stmt->bindParam(':password', $hash);
		$stmt->bindParam(':firstname', $_POST['firstname']);
		$stmt->bindParam(':email', $_POST['email']);
		$stmt->execute();
		$to      = $_POST['email'];
		$_SESSION['email'] = $to;
		$_SESSION['hash'] = $verifyhash;
		$subject = 'Signup | Verification';
		$message = '
		Thanks for signing up!
		Your account has been created, you can login with your credentials after you have activated your account by pressing the url below.
 
		------------------------
		Username: '.$name.'
		------------------------
 
		Please click this link to activate your account:
		http://localhost:8080/camagru/make_functional/verify.php?email='.$_POST['email'].'&hash='.$verifyhash;

		$headers = 'From:noreply@camagru.com' . "\r\n"; // Set from headers
		mail($to, $subject, $message, $headers);
		header("Location: login.php");
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
		<button type="submit" name="register_btn" value="yes">Register</button>
	</form>
</body>
</html>