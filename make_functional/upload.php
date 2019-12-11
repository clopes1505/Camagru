<?php
    require("../config/connect.php");

    $uid = $_SESSION['uid'];
	$data = $_POST['image'];
	$sticky = $_POST['sticker'];
    if (isset($data, $sticky))
    {
		$data = base64_decode($data);
		$img = imagecreatefromstring($data);
		$sticky = base64_decode($sticky);
		$sticker = imagecreatefromstring($sticky);

		imagecopy($img, $sticker, 0, 0, 0, 0, 500, 500);

        $imageName = md5($data).".png";
        imagepng($img, "../images/".$imageName);
    }
    $stmt = $connect->prepare("INSERT INTO posts(`uid`, `imageName`, `username`) VALUES (?, ?, ?)");
	$stmt->execute(array($uid, $imageName, $_SESSION['username']));
?>