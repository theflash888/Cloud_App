<?php
phpinfo();
?>
<html>
	<body>
	<h1>Login!</h1>
		<form action="login.php" method="POST">
			<p>Username:</p><input type="text" name="user" />
			<p>Password:</p><input type="password" name="pass" />
			<br />
			<input type="submit" value="Login" />
		</form>
		
		<a href="new_user.php">Signup Here!</a>
	</body>
</html>
