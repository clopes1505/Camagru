<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../make_pretty/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Questrial&amp;display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://unpkg.com/bulma@0.8.0/css/bulma.min.css">
	<title>Login</title>
		<?php
			require('../config/connect.php');
			session_start();
		 if ($_SERVER["REQUEST_METHOD"] === "POST"){
      $username = strtolower(trim(htmlspecialchars($_POST['username'])));
      $password = htmlspecialchars($_POST['password']);
			$sql = "SELECT DISTINCT `id`, `password`, `verified`, `email` FROM `users` WHERE `username` = :u OR `email` = :e";
			$req = $connect->prepare($sql);
      $req->bindParam(':e', $username);
      $req->bindParam(':u', $username);
      $req->execute();
			$res = $req->fetch();
			if (password_verify($password,$res['password'] ))
			{
        $_SESSION['username'] = $username;
        $_SESSION['uid'] = $res['id'];
				if ($res["verified"] == 1)
				{
          $to = $res['email'];
          $subject = 'Successful Login';
          $message = 'You have successfuly logged into your account on Camagru!';
          $headers = 'From:noreply@camagru.com' . "\r\n";
          mail($to, $subject, $message, $headers);
					header("location: home.php");
				}
			} else
			{
				echo "he is a dumbass-->";
			}
		}
		?>
</head>
<body>
  <section class="hero is-primary is-fullheight">
    <p class="warning">MAKE SURE TO VERIFY YOUR ACCOUNT BEFORE LOGGING IN</p>
    <div class="hero-body">
      <div class="container">
        <div class="columns is-centered">
          <div class="column is-5-tablet is-4-desktop is-3-widescreen">
          <form action="#" method="POST" class="box">
            <div class="field">
              <label for="" class="label">Username/Email</label>
              <div class="control has-icons-left">
                <input type="text" name="username" placeholder="e.g. bobsmith@gmail.com" class="input" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-envelope"></i>
                </span>
              </div>
            </div>
            <div class="field">
              <label for="" class="label">Password</label>
              <div class="control has-icons-left">
                <input type="password" name="password" placeholder="*******" class="input" required>
                <span class="icon is-small is-left">
                  <i class="fa fa-lock"></i>
                </span>
              </div>
            </div>
            <div class="field">
              <button class="button is-success">
                Login
              </button>
            </div>
            <a href="resetPwd.php">Forgot Password?</a>
          </form>
        </div>
      </div>
    </div>
  </div>
  <footer>
	  <hr>
	  <p>clopes</p>
  </footer>
</section>