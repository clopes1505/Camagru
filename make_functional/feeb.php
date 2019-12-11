<?php
require('../config/connect.php');
	$page_no = $_GET['page'];
	$offset = 5 * ($page_no - 1);
	try {
		$stmt = $connect->prepare("SELECT * FROM `posts` ORDER BY `pid` DESC LIMIT 5 OFFSET :offset");
		$stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
		$stmt->execute();
		?>
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
			<?php if(isset($_SESSION['username'])){?><button href="comment.php" onclick ="redirect(<?php echo $pid?>)">Comment</button><?php }?>
			<i id = "num_likes-<?php echo $pid?>"><?php echo $like_count; ?></i>
			<h3>Posted by: <?php echo $imgs['username'] ?></h3>
			<?php
		if (isset($_SESSION['username']) && $imgs['uid'] === $_SESSION['uid'])
		{
			?>
			<h4 class = 'fa fa-trash delete_btn' onclick = "delete_post(<?php echo $pid ?>)"><a class = "delete_btn">  Delete your post?</a></h4>
		</div>
		<?php
		}
		?>
		<?php
		}
		?>
</div>
<?php
}
catch(PDOException $e) {
	echo $e->getMessage();
}
?>