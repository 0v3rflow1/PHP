<?php
	session_start();
	if(isset($_SESSION[hash("sha512","online")])){
		$userOnline=htmlentities($_SESSION[hash("sha512","user")]);
?>
		<h1>GRANTED <?=$userOnline?>!!!</h1>
		<a href='logout.php'>Logout</a>
<?php
	}else{
		header("Location:denied.php");
	}
?>
