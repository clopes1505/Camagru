<?php
	require('../config/connect.php');
	require('navbar.php');
	if($_POST['password1'] != $_POST['password2'])
	{
		die ("Passwords do not match");
	}
	if(isset($_POST['username']))
	{
		
	}
		try{
			$hash= password_hash($_POST['password1'], PASSWORD_DEFAULT);
			$sql="UPDATE users SET(username, email, `password`)
			VALUES(:username, :email, :password)";
			$stmt=$connect->prepare($sql);
			$stmt->bindParam(':username', $_POST['username']);
			$stmt->bindParam(':password', $hash);
			$stmt->bindParam(':email', $_POST['email']);
			$stmt->execute();
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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
<link rel="stylesheet" href="../make_pretty/style.css">
<script src = "../js_stuff/profile.js"></script>
<button onclick="popup()" class="button is-primary is-outlined">Update profile settings</button>
<div class = "form-popup" id = "myform">
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
</div>


<div class="field is-grouped">
  <div class="control">
    <button onclick = "edit_validate()" class="button is-link">Submit</button>
  </div>
  <div class="control">
    <button onclick = "popdown()" class="button is-link is-light">Close</button>
  </div>
</div>