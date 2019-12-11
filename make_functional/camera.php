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
  	<link rel="stylesheet" href="../make_pretty/cam_style.css">
	<link rel="stylesheet" href="../make_pretty/style.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
	<title>Take a Picture!</title >
</head>
<body class="camera_page">

<div class ="photobooth">
	<video id="video" width="500" height="350"></video>
	<div class="picture">
		<img id="display_canvas">
		<img id="sticker_canvas">
	</div>
	<div class ="sticky" id="sticky">
		<img id="chartato" class="not_special" src="../stickers/chartato.png" alt="Char + Potato(you really missing out :( )" style="cursor: pointer;">
		<img id="raichu" class="not_special" src="../stickers/raichu.png" alt="Riahnna" style="cursor: pointer;">
		<img id="umbreon" class="not_special" src="../stickers/umbreon.png" alt="Umbrella, ella, ehh, ehh , eh" style="cursor: pointer;">
		<img id="goodboy" class="not_special" src="../stickers/goodboy.png" alt="BESTESTGOODESTBOY" style="cursor: pointer;">
	</div>
	<div class="buttona">
		<button id="capture" class="capture_button">Take Photo!</button>
		<input type ="file" id="file" class="file"/>
	</div>
	<button id="upload"><a href="#">Upload</a></button>
</div>
<script src="../js_stuff/vid.js"></script>
</body>
<?php include('footer.php');?>