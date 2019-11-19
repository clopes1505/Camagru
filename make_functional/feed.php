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
    <title>Image Feed</title>
</head>
<body>
<div class="row">
  <div class="column">
    <!-- <img class="image" src="https://www.seekpng.com/png/detail/990-9906722_zorua-cute-pokemon-chibi-pokemon-zorua.png" alt="Zorua" style="width:100%" onclick="myFunction(this);"> -->
    <img class="image" src="/camagru/images/img.png" alt="Zorua" style="width:100%" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img class="image" src="https://wallpaperplay.com/walls/full/f/5/1/280126.jpg" alt="Sun & Moon" style="width:100%" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img class="image" src="https://www.nicepng.com/png/detail/381-3814032_tumblr-n9ebiijkhl1rii0fxo1-500-cute-anime-chibi-pokemon.png" alt="Mountains" style="width:100%" onclick="myFunction(this);">
  </div>
  <div class="column">
    <img class="image" src="https://res.cloudinary.com/teepublic/image/private/s--n1VHvAFl--/t_Resized%20Artwork/c_fit,g_north_west,h_954,w_954/co_fffffe,e_outline:48/co_fffffe,e_outline:inner_fill:48/co_ffffff,e_outline:48/co_ffffff,e_outline:inner_fill:48/co_bbbbbb,e_outline:3:1000/c_mpad,g_center,h_1260,w_1260/b_rgb:eeeeee/c_limit,f_jpg,h_630,q_90,w_630/v1517187965/production/designs/2317322_0.jpg" alt="Lights" style="width:100%" onclick="myFunction(this);">
  </div>
</div>
<!-- My ugly stuff -->
  <?php
    var_dump($_POST); // cool got post
    
    //creates image on server
    if (isset($_POST['image']))
    {
      $img = base64_decode($_POST['image']);
      file_put_contents( "../images/img.png",$img);
      // add to db (location of image)
      // title etc..
    }
    

    // if post (get from DB)
    // title
    // img (where?)
    // likes
    // 
  ?>

<!-- shhh  -->
<div class="container">
  <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
  <img id="expandedImg" style="width:100%">
  <div id="imgtext"></div>
</div>
<script>
function myFunction(imgs) {
    var expandImg = document.getElementById("expandedImg");
    var imgText = document.getElementById("imgtext");
    expandImg.src = imgs.src;
    imgText.innerHTML = imgs.alt;
    expandImg.parentElement.style.display = "block";
  }
</script>
</body>
</html>