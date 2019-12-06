<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="../make_pretty/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
		<script src = "../js_stuff/comment.js"></script>
		<title>Document</title>
	</head>
	<body>


		<?php
	require('../config/connect.php');
	require('navbar.php');
	$pid = $_GET['pid'];
	try {
		$stmt = $connect->prepare("SELECT imageName FROM `posts` WHERE `pid` = $pid");
		$stmt->execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
	$img = $stmt->fetchColumn();
	$statement = $connect->prepare("SELECT * FROM likes WHERE pid = ?");
	$statement->execute(array($pid));
	$like_count = $statement->rowCount();
	?>
		<img class = "img" src = "../images/<?php echo $img ?>">
		<br>
		<i id = " num_likes-<?php echo $pid?>">likes <?php echo $like_count; ?></i>
		<div class="box">
  <article class="media">
    <div class="media-left">
      <figure class="image is-64x64">
        <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
      </figure>
    </div>
    <div class="media-content">
      <div class="content">
        <p>
          <strong> <?php echo $_SESSION['username']?>
          <div class="field">
  <div class="control">
    <input id="comment" class="input is-info" type="text" placeholder="Your deepest and darkest thoughts...">
  </div>
        </p>
      </div>
      <nav class="level is-mobile">
        <div class="level-left">
          <a class="level-item" aria-label="reply">
            <span class="icon is-small">
              <i class="fas fa-reply" aria-hidden="true"></i>
            </span>
          </a>
          <a class="level-item" aria-label="retweet">
            <span class="icon is-small">
              <i class="fas fa-retweet" aria-hidden="true"></i>
            </span>
          </a>
          <a class="level-item" aria-label="like">
            <span class="icon is-small">
				<button onclick="post(<?php echo $pid?>)" class="button is-info is-focused">Post</button>
              <i class="fas fa-heart" aria-hidden="true"></i>
            </span>
          </a>
        </div>
      </nav>
    </div>
  </article>
</div>
<?php
	$statement = $connect->prepare("SELECT * FROM comments WHERE pid = ?");
	$statement->execute(array($pid));
	while ($comments = $statement->fetch(PDO::FETCH_ASSOC)) {
	?>
		<div class="box">
  <article class="media">
    <div class="media-left">
      <figure class="image is-64x64">
        <img src="https://bulma.io/images/placeholders/128x128.png" alt="Image">
      </figure>
    </div>
    <div class="media-content">
      <div class="content">
        <p>
          <strong> <?php echo $comments['username']?>
          <div class="field">
  <div class="control">
    <p class="input is-info" type="text"><?php echo $comments['comment']?></p>
  </div>
        </p>
      </div>
      <nav class="level is-mobile">
        <div class="level-left">
          <a class="level-item" aria-label="reply">
            <span class="icon is-small">
              <i class="fas fa-reply" aria-hidden="true"></i>
            </span>
          </a>
          <a class="level-item" aria-label="retweet">
            <span class="icon is-small">
              <i class="fas fa-retweet" aria-hidden="true"></i>
            </span>
          </a>
          <a class="level-item" aria-label="like">
            <span class="icon is-small">
              <i class="fas fa-heart" aria-hidden="true"></i>
            </span>
          </a>
        </div>
      </nav>
    </div>
  </article>
</div>
	<?php
	}
	?>
</body>
</html>
