<?php
	session_start();
	if(isset($_SESSION[hash("sha512","online")]))
		header("Location:granted.php");
?>
<html>
	<head>
		<title>LoginBasicoPHP</title>
	</head>
	<body>
		<div style='margin:0auto;width:500px;text-align:center'>
			<form action='login.php' method='post'>
				<h1>Hack The Planet!!! ;)</h1>
				<label>User</label>
				<br/>
				<input name='user' type='user' value=''>
				<br/>
				<label>Password</label>
				<br/>
				<input name='pwd' type='password' value=''>
				<br/>
				<br/>
				<input name='login' type='submit' value='Login'>
			</form>
		</div>
	</body>
</html>
