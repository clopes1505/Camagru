<?php
  require('../config/connect.php');
  require('navbar.php');

	try {
		$stmt = $connect->prepare("SELECT * FROM `posts` ORDER BY `pid` DESC");
		$stmt->execute();
	}
	catch(PDOException $e) {
		echo $e->getMessage();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="../make_pretty/feed_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
	<script src = "../js_stuff/feed.js"></script>
	<script src = "../js_stuff/comment.js"></script>
	<script src = "../js_stuff/delete.js"></script>
	<title>Image Feed</title>
</head>
<body>
	<section>
		<div>
			<div>
		<?php
					while ($imgs = $stmt->fetch(PDO::FETCH_ASSOC)) {
						$pid = $imgs['pid'];
						$statement = $connect->prepare("SELECT * FROM likes WHERE pid = ?");
						$statement->execute(array($pid));
						$like_count = $statement->rowCount();

					?>
						<img class = "img" src = "../images/<?php echo $imgs['imageName'] ?>">
					<?php if(isset($_SESSION['username'])){?><button onclick = "like(<?php echo $pid;?>)">like</button><?php }?>
						<button href="comment.php" onclick ="redirect(<?php echo $pid?>)">Comment</button>
						<i id = "num_likes-<?php echo $pid?>"><?php echo $like_count; ?></i>
						<h3>Posted by: <?php echo $imgs['username'] ?></h3>
					<?php
					if (isset($_SESSION['username']) && $imgs['username'] === $_SESSION['username'])
					{
						?>
						<i class = 'fa fa-trash delete_btn' onclick = "delete_post(<?php echo $pid ?>)"><a class = "delete_btn">  Delete your post?</a></i>
						</div>
					<?php
					}
					?>
					<?php
					}
					?>
	</div>
	</div>
</section>
</body>
</html>