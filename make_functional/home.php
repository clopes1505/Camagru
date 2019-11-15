<?php
  require('../config/connect.php');
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
<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="
        <?php
          if($_SESSION['username'])
          echo 'home.php">';
          else
          echo 'index.php">';
        ?>
      <h1>Camagru</h1>
    </a>

    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false" data-target="navbarBasicExample">
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
      <span aria-hidden="true"></span>
    </a>
  </div>

  <div id="navbarBasicExample" class="navbar-menu">
    <div class="navbar-start">
      <a class="navbar-item" href="
        <?php
          if($_SESSION['username'])
          echo 'home.php">';
          else
          echo 'index.php">';
        ?>
        Home
      </a>
      <a class="navbar-item" href="about.php">
        About
      </a>
      <a class="navbar-item" href="feed.php">
        Feed
      </a>
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>

        <div class="navbar-dropdown">
          <a class="navbar-item" href="profile.php">
            Profile
          </a>
          <a class="navbar-item" href="conatct.php">
            Contact
          </a>
          <hr class="navbar-divider">
          <a class="navbar-item">
            Report an issue
          </a>
        </div>
      </div>
    </div>

    <div class="navbar-end">
    </div>
  </div>
</nav>
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
