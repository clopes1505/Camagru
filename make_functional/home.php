<?php
  require('../config/connect.php');
  require('navbar.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="../make_pretty/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
	<title>Document</title>
</head>
<body>
<img class="bckgrd" src="https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcThdy_XX2J2s9JGPf1nlUpOmn30sYhWBQUAOw5NvQLZksH9RAiw">
  <div class="floating">
    <p>Welcome to Camagru <?php echo ($_SESSION["username"])?>!</p>
  </div>
  <button id="take_pic" onclick="window.location.href = 'camera.php';">Take A Picture!</button>
</div>
	<script>
		document.addEventListener('DOMContentLoaded', () => {

		// Get all "navbar-burger" elements
		const $navbarBurgers = Array.prototype.slice.call(document.querySelectorAll('.navbar-burger'), 0);

		// Check if there are any navbar burgers
		if ($navbarBurgers.length > 0) {

		// Add a click event on each of them
		$navbarBurgers.forEach( el => {
			el.addEventListener('click', () => {

			// Get the target from the "data-target" attribute
			const target = el.dataset.target;
			const $target = document.getElementById(target);

			// Toggle the "is-active" class on both the "navbar-burger" and the "navbar-menu"
			el.classList.toggle('is-active');
			$target.classList.toggle('is-active');
			});
		});
		}

		});
	</script>
</body>
</html>
