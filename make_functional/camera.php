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
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.5/css/bulma.min.css">
	<title>Take a Picture!</title>
</head>
<body class="camera_page">

<div class ="photobooth">
  <video id="video" width="500" height="350"></video>
  
  <canvas id="canvas" width="500" height="375"> </canvas><button id="capture" class="capture_button">Take Photo!</button>
  <button id="save">save</button>
  <input type ="file" id="upload" class="upload"/>
  </div>
<script src="/camagru/js_stuff/vid.js"></script>
