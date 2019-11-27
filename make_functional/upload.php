<?php
    require("../config/connect.php");

    $uid = $_SESSION['uid'];
    $data = $_POST['image'];
    // cool got post
    //creates image on server
    if (isset($_POST['image']))
    {
        $imageName = md5($data).".png";
        $data = str_replace('data:image/png;base64,', '', $data);
        $data = str_replace(' ', '+', $data);
        $data = base64_decode($data);
        $img = imagecreatefromstring($data);
        imagepng($img, "../images/".$imageName);
    }
    $stmt = $connect->prepare("INSERT INTO posts(`uid`, `imageName`) VALUES (?, ?)");
    $stmt->execute(array($uid, $imageName));

    // if post (get from DB)
    // title
    // img (where?)
    // likes
    // 
?>