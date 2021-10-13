<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Form</title>
</head>
<body>

	<h1>Login Form</h1>

	<?php
		$handle = fopen("data.json", "r");
		$data = fread($handle, filesize("data.json"));
	?>

	<?php
		$explode = explode("\n", $data);
		array_pop($explode);
	?>
	<?php
		$arr1 = array();
		for($i = 0; $i < count($explode); $i++){
			$json = json_decode($explode[$i]);
			array_push($arr1, $json);
		}
	?>
	<form method="GET">
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
		$flag = false;
		if($_SERVER['REQUEST_METHOD'] === "GET" and count($_REQUEST) > 0){
			for($k=0; $k<count($arr1); $k++){
				if($_GET['usrName'] === $arr1[$k]->usrName and $_GET['password'] === $arr1[$k]->password){
					$flag = true;
				}
			}
		}
		if($flag){
			header("Location: Welcome.php?name=". $_GET['usrName']);
		}
		else{

		}
	?>

</body>
</html>