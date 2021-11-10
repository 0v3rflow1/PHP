<?php
	session_start();
	if(isset($_SESSION[hash("sha512","online")]))
		header("Location:granted.php");
		
	$_REQUEST=$_POST;
	$requiredFields=array(
		"user",
		"pwd",
		"login",
	);
	$ok=0;
	foreach($_REQUEST as $key=>$val){
		if(in_array($key,$requiredFields))
			$ok++;
	}
	if( isset($_REQUEST) && $ok==count($requiredFields)){
		//Obtener esta lista usando una query mysql, sqlite blah como sea
		//SQL...
		$inWhiteList=array(
			"admin",
			"tester",
			"pwned",
			"ov3rflow1",
		);
		//LO MISMO DE ARRIBA NADA EN PLAINTEXT TODO EN HASH
		$passwords=array(
			"admin"=>md5("admin"),
			"tester"=>md5("12345"),
			"pwned"=>md5("lol"),
			"ov3rflow1"=>md5("solarwinds123"),
		);
		
		$user=htmlentities($_REQUEST["user"]);
		$pwd=md5($_REQUEST["pwd"]);
		if( in_array($user,$inWhiteList) && $pwd == $passwords["$user"] ){
			$_SESSION[hash("sha512","online")]=uniqid(hash("sha512",$user));
			$_SESSION[hash("sha512","user")]=$user;
			header("Location:granted.php");
		}
		else
			header("Location:denied.php");
	}else{
		echo "Invalid Request";
		print_r($_REQUEST);
	}
?>
