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