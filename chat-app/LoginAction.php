<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form</title>
</head>
<body>

	<h1>Login Form</h1>

	<form method="POST">
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
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "chatapp";

		$connection = new mysqli($servername, $username, $password, $dbname);

		if ($connection->connect_error) {
			die("Connection failed: " . $connection->connect_error);
		}
		$usrName = $password = ""; 

		$usrName = $_POST['usrName'];
		$password = $_POST['password'];

		if(empty($usrName) or empty($password)){
			echo "Fill up the form";
		}
		else{
			
			$sql = "SELECT * FROM user WHERE userName = '$usrName' and password = '$password'";
			$stmt = $connection->prepare($sql);
			$response = $stmt->execute();

			if ($response) {
				$data = $stmt->get_result();

				if ($data->num_rows > 0) {
					while ($row = $data->fetch_assoc()) {
						session_start();
						$_SESSION['usrName']=$usrName;
						
						header("Location: Welcome.php");
					}
				}
				else {
					echo "No records found.";
				}
			}

			$connection->close();
		}
	?>
</body>
</html>