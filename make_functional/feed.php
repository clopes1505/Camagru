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
	<link rel="stylesheet" href="../make_pretty/feed_style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
	<script src = "../js_stuff/feed.js"></script>
	<script src = "../js_stuff/comment.js"></script>
	<script src = "../js_stuff/delete.js"></script>
	<title>Image Feed</title>
</head>
<body>
	<section>
		<div id="feed"></div>
</section>
</body>
<footer>
	<hr>
	<p>clopes</p>
</footer>
</html>