<?php
	require('../config/connect.php');
	session_start();
 if ($_SERVER["REQUEST_METHOD"] === "POST"){
	$firstname = ucwords(strtolower(trim(htmlspecialchars($_POST['firstname']))));
	$lastname = ucwords(strtolower(trim(htmlspecialchars($_POST['lastname']))));
	$username = strtolower(trim(htmlspecialchars($_POST['username'])));
	$email = strtolower(trim(htmlspecialchars($_POST['email'])));
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
	if(!$firstname || !$lastname || !$username || !$email || !$password || !$password2)
		die("Please fill in all fields");
	else {
	try{
		preg_match("/.*htdocs\/(.*)\/make_functional.*/", $_SERVER["SCRIPT_FILENAME"], $matches);
		$server_location = $matches[1];
		$verifyhash=md5(rand(0,1000));
		$hash= password_hash($password, PASSWORD_DEFAULT);
		$sql="INSERT INTO users (firstname, lastname, username, email, `password`, verified, notifications, verifyhash)
		VALUES(:firstname, :lastname, :username, :email, :password, 0, 1, '$verifyhash')";
		$stmt=$connect->prepare($sql);
		$stmt->bindParam(':lastname', $lastname);
		$stmt->bindParam(':username', $username);
		$stmt->bindParam(':password', $hash);
		$stmt->bindParam(':firstname', $firstname);
		$stmt->bindParam(':email', $email);
		$stmt->execute();
		$to = $email;
		$_SESSION['email'] = $to;
		$_SESSION['hash'] = $verifyhash;
		$subject = 'Signup | Verification';
		$message = '
		Thanks for signing up!
		Your account has been created, you can login with your credentials after you have activated your account by pressing the url below.

		------------------------
		Username: '.$username.'
		------------------------

		Please click this link to activate your account:
		http://localhost:8080/'.$server_location.'/make_functional/verify.php?email='.$email.'&hash='.$verifyhash;
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
	<link rel="stylesheet" href="../make_pretty/style.css">
	<title>Home</title>
</head>
<section class="hero is-primary is-fullheight">
    <div class="hero-body">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-5-tablet is-4-desktop is-3-widescreen">
          <form action="#" method="POST" class="box">
            <div class="field">
              <label for="" class="label">First Name</label>
              <div class="control has-icons-left">
                <input type="text" name="firstname" placeholder="e.g. Bob" class="input" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-envelope"></i>
                </span>
              </div>
			</div>
			<div class="field">
              <label for="" class="label">Last name</label>
              <div class="control has-icons-left">
                <input type="text" name="lastname" placeholder="e.g. Smith" class="input" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-envelope"></i>
                </span>
              </div>
			</div>
			<div class="field">
              <label for="" class="label">Email</label>
              <div class="control has-icons-left">
                <input type="text" name="email" placeholder="e.g. bobsmith@gmail.com" class="input" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-envelope"></i>
                </span>
              </div>
			</div>
			<div class="field">
              <label for="" class="label">Username</label>
              <div class="control has-icons-left">
                <input type="text" name="username" placeholder="e.g. bobsmith22" class="input" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-envelope"></i>
                </span>
              </div>
            </div>
            <div class="field">
              <label for="" class="label">Password</label>
              <div class="control has-icons-left">
                <input type="password" name="password1" placeholder="*******" class="input" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
			</div>
			<div class="field">
              <label for="" class="label">Confrim Password</label>
              <div class="control has-icons-left">
                <input type="password" name="password2" placeholder="*******" class="input" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
            </div>
            <div class="field">
			<button class="button is-success" type="submit" name="register_btn" value="yes">Register</button>
            </div>
            <a href="login.php">Already have an account?</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
	<!-- <form action="#" method="POST">
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
	</form> -->
</body>
</html>
<?php include('footer.php');?>