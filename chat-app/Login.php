<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form</title>
	<script src="external.js"></script>
</head>
<body>

	<h1>Login Form</h1>

	<form name ="login" action="LoginAction.php" method="POST" onsubmit="return isValid(this);">
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
	<p id = "message"></p>
</body>
</html>