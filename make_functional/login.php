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
	<title>Home</title>
		<?php
			require('../config/connect.php');
			session_start();
		 if ($_SERVER["REQUEST_METHOD"] === "POST"){
			  $sql = "SELECT DISTINCT `id`, `password`, `verified` FROM `users` WHERE `username` = :u OR `email` = :e";
			  $req = $connect->prepare($sql);
        $req->bindParam(':e', $_POST['username']);
        $req->bindParam(':u', $_POST['username']);
        $req->execute();
			$res = $req->fetch();
			if (password_verify($_POST['password'],$res['password'] ))
			{
        $_SESSION['username'] = $_POST['username'];
        $_SESSION['uid'] = $res['id'];
				if ($res["verified"] == 1)
				{
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
          </form>
        </div>
      </div>
    </div>
  </div>
</section>