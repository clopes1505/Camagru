<nav class="navbar" role="navigation" aria-label="main navigation">
  <div class="navbar-brand">
    <a class="navbar-item" href="
        <?php
          if(isset($_SESSION['username']))
          echo 'home.php';
          else
          echo 'index.php';
        ?>">
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
          if(isset($_SESSION['username']))
          echo 'home.php';
          else
          echo 'index.php';
        ?>">
        Home
      </a>
      <?php if(isset($_SESSION['username'])){?>
      <a class="navbar-item" href="camera.php">
        Camera
      </a>
      <?php }?>
      <a class="navbar-item" href="feed.php">
        Feed
      </a>
      <?php if(isset($_SESSION['username'])){?>
      <div class="navbar-item has-dropdown is-hoverable">
        <a class="navbar-link">
          More
        </a>
        <div class="navbar-dropdown">
          <a class="navbar-item" href="profile.php">
            Profile
          </a>
          <?php }?>
        </div>
      </div>
    </div>

    <div class="navbar-end">
		<div class="navbar-item">
        	<div class="buttons">
			<?php if (isset($_SESSION['username']))
			{
			?>
          		<a class="button is-primary" href="logout.php">
            	<strong>Log out</strong>
			  	</a>
			<?php
			}
			?>
        	</div>
      	</div>
	</div>
  </div>
</nav>
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