<?php
	require('../config/connect.php');
	session_destroy();
	header("Location: ../make_functional/index.php");
?>