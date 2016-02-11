<?php
	$username = "root";
	$password = "password";
	$hostname = "assign1cloud.c3bipt8hjluw.us-west-2.rds.amazonaws.com";
	
	$dbhandle = mysql_connect($hostname, $username, $password) or die("Could not connect to database");
	
	$selected = mysql_select_db("assign1cloud", $dbhandle);

		if(isset($_POST['user']) && isset($_POST['pass'])){
			$user = $_POST['user'];
			$pass = $_POST['pass'];

			$query = mysql_query("SELECT * FROM users WHERE Username='$user'");

			if(mysql_num_rows($query) > 0 ) {
				echo "Username already exists!";
			}else {
				mysql_query("INSERT INTO users (Username, Password) VALUES ('$user', '$pass')");
				header("location:index.php");
			}
	}
	mysql_close();
?>

<html>
	<body>
		<h1>Signup!</h1>
			<form action="new_user.php" method="POST">
				<p>Username:</p><input type="text" name="user" />
				<p>Password:</p><input type="password" name="pass" />
				<br />
				<input type="submit" value="Signup!" />
			</form>
	</body>
</html>