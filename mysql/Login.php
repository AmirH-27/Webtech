<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form</title>
</head>
<body>

	<h1>Login Form</h1>

	<form action="LoginAction.php" method="POST">
		<fieldset>
			<legend>Login:</legend>
			<label for="userName">Username:</label>
    		<input type="text" name="usrName"><br><br>
    		<label for="password">Password:</label>
    		<input type="password" name="password"><br><br>
		</fieldset>
		<br>
		<input type="submit" value="Login">
	</form>
	
</body>
</html>