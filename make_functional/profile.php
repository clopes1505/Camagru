<?php
	require('../config/connect.php');
	require('navbar.php');
		try {
			$stmt = $connect->prepare("SELECT * FROM `posts` WHERE `uid` = ? ORDER BY `pid` DESC");
			$stmt->execute(array($_SESSION['uid']));
		}
		catch(PDOException $e) {
			echo $e->getMessage();
		}
		while ($imgs = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$pid = $imgs['pid'];
			$statement = $connect->prepare("SELECT * FROM likes WHERE pid = ?");
			$statement->execute(array($pid));
			$like_count = $statement->rowCount();
	
		?>
			<img class = "img" src = "../images/<?php echo $imgs['imageName'] ?>">
			likes <i id = "num_likes-<?php echo $pid?>"><?php echo $like_count; ?></i>
			<h3>Posted by: <?php echo $imgs['username'] ?></h3>
		<?php
		if (isset($_SESSION['username']) && $imgs['uid'] === $_SESSION['uid'])
		{
			?>
			<h4 class = 'fa fa-trash delete_btn' onclick = "delete_post(<?php echo $pid ?>)"><a class = "delete_btn">  Delete your post?</a></h4>
			</div>
		<?php
		}
		}
		?>
		<?php
	if ($_SERVER["REQUEST_METHOD"] === "POST")
	{
		$user = $_POST['username'];
		$email = $_POST['email'];
		$passw1 = $_POST['password1'];
		$passw2 = $_POST['password2'];
		if ($passw1 && $passw2)
		{
			if($passw1 != $passw2)
			{
				die ("Passwords do not match");
			}
			else
			{
				try {
					$hash= password_hash($passw1, PASSWORD_DEFAULT);
					$sql = $connect->prepare("UPDATE users SET `password` = ? WHERE username = ?");
					$sql->execute(array($hash, $_SESSION['username']));
				}
				catch (PDOException $e) {
					echo $e->getMessage();
				}
			}
		} 
		if(!empty($user))
		{
			try{
				$sql = $connect->prepare("UPDATE users SET username = ? WHERE username = ? AND `uid` = ?");
				$sql->execute(array($user, $_SESSION['username'], $_SESSION['uid']));
				$sql = $connect->prepare("UPDATE posts SET username = ? WHERE username = ? AND `uid` = ?");
				$sql->execute(array($user, $_SESSION['username'], $_SESSION['uid']));
				$sql = $connect->prepare("UPDATE likes SET username = ? WHERE username = ? AND `uid` = ?");
				$sql->execute(array($user, $_SESSION['username'], $_SESSION['uid']));
				$sql = $connect->prepare("UPDATE comments SET username = ? WHERE username = ? AND `uid` = ?");
				$sql->execute(array($user, $_SESSION['username'], $_SESSION['uid']));
				$_SESSION['username'] = $user;
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
		if(!empty($email))
		{
			try{
				$sql = $connect->prepare("UPDATE users SET email = ? WHERE username = ?");
				$sql->execute(array($email, $_SESSION['username']));
			}
			catch(PDOException $e){
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
	<title>Profile</title>
	<script src = "../js_stuff/profile.js"></script>
</head>
<body>
<button onclick="popup()" class="button is-primary is-outlined">Update profile settings</button>
<form action = "#" method = "POST" class = "form-popup" id = "myform">
	<div class = "form-container">
		<div class="field">
  <label class="label">Username</label>
  <div class="control">
    <input class="input" name="username" type="text">
  </div>
  <label class="label">Email</label>
  <div class="control">
    <input class="input" name="email" type="email">
  </div>
  <label class="label">Password</label>
  <div class="control">
    <input class="input" name="password1" type="password">
  </div>
  <label class="label">Confirm Password</label>
  <div class="control">
    <input class="input" name="password2" type="password">
  </div>
  <br>
	<h3>E-mail notfications</h3>
  	<div class="control">
  	<label class="radio">
    <input type="radio" name="answer" id="not_yes">
    	Yes
  	</label>
  	<label class="radio">
    <input type="radio" name="answer" id="not_no">
		No
	</label>
	</div>
	<br>
  <div class="field is-grouped">
	<div class="control">
	  <button type = "submit" name = "edit_btn" class="button is-link">Submit</button>
	</div>
	<div class="control">
	  <button onclick = "popdown()" class="button is-link is-light">Close</button>
	</div>
  </div>
  </div>
</form>	

</body>