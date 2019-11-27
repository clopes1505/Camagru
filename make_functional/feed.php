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
  <section class = "gallery_links">
        <div class = "wrapper">
          <div class = "gallery_container">
            <?php
              require("./config/connect.php");
              $stmt = $connection->prepare("SELECT * FROM `gallery` ORDER BY `postid` DESC");
              $stmt->execute();
              while ($img = $stmt->fetch(PDO::FETCH_ASSOC))
              {
                $pid = $img['postid'];
                $statement = $connection->prepare("SELECT * FROM `likes` WHERE `pid` = :pid");
                $statement->bindParam(":pid", $pid);
                $statement->execute();
                $like_count = $statement->rowCount();
                $statement = $connection->prepare("SELECT COUNT(*) FROM `likes` WHERE `uid`=? AND `pid`=?");
                $statement->execute(array($_SESSION["uid"], $pid));
                $isliked = $statement->fetch()[0];
                ?>
                <div id="delete_post-<?php echo $pid; ?>">
                  <a>
                    <div class = 'gal_img' style = 'background-image: url(./img/uploads/<?php echo $img['imgFullNameGallery'] ?>)'></div>
                    <h3>Posted by: <?php echo $img['username'] ?></h3>
                  </a>
                  <i class = 'fa fa-thumbs-o-<?php echo !$isliked ? "up" : "down";?> like_btn' id = "like-<?php echo $pid; ?>" onclick = "like(<?php echo $pid; ?>)"><a> Like!</a></i>

                  <a id="like-count-<?php echo $pid; ?>"><?php echo $like_count; ?></a>
                  <i onclick = "redirect(<?php echo $pid ?>)"><button>Comment</button></i>
                  <?php
                  if ($img['username'] === $_SESSION['username'])
                  {
                  ?>
                  <i class = 'fa fa-trash delete_btn' use-id="<?php echo $pid; ?>"><a class = "delete_btn">  Delete your post?</a></i>
                </div>
                <?php
                }
              }
            ?>
          </div>
        </div>
      </section>
</body>
</html>