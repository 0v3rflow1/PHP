<?php
session_start();
if(isset($_SESSION[hash("sha512","online")]))
	header("Location:granted.php");
?>
<h1 style='color:red'>Denied</h1>
