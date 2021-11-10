<?php
	session_start();
	unset($_SESSION[hash("sha512","online")]);
	header("Location:/");
?>
