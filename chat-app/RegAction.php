<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registration Form</title>
</head>
<body>
  <h1>Registration Form</h1>
<form action="Login.php" method="POST">
   <fieldset>
    <legend>Account Information:</legend>
    <label for="userName">Username:</label>
    <input type="text" id="usrName" name="usrName"><br><br>
    <label for="password">Password:</label>
    <input type="text" id="password" name="password"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
  </fieldset>
  <br><input type="submit" value="Submit">
</form>
<?php 
  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "chatapp";

  $email = $usrName = $password = "";
 
  $usrName = $_POST['usrName'];
  $password = $_POST['password'];
  $email = $_POST['email'];

  if(empty($email) or empty($usrName) or empty($password)){
    echo "Fill the form";
  }

  else{
    $connection = new mysqli($servername, $username, $password, $dbname);
    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }
    else {
      echo "Database Connection Successful <br>";
    }
    $sql = "INSERT INTO user(userName, password, email) VALUES ('$usrName', '$password', '$email')";

    $data = $connection->query($sql);

    if($data === true){
      header("Location: Login.php");
    }
    else{
      echo "Error";
    }
    header("Location: Login.php");
    $connection->close();
  }
?>
</body>
</html>