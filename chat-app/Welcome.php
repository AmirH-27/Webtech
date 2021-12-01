<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome</title>

</head>
<body>

  <h1>Chat App</h1>
  <?php 
    echo "<a href= "."chatBox.php".">".$_SESSION['usrName']."</a><br>";
  ?>
  
  <p>Active Now</p>

  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chatapp";

  $connection = new mysqli($servername, $username, $password, $dbname);

  if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
  }
  $sql = "SELECT * FROM user";
  $stmt = $connection->prepare($sql);
  $response = $stmt->execute();

  if ($response) {
    $data = $stmt->get_result();

    if ($data->num_rows > 0) {
      while ($row = $data->fetch_assoc()) {
        if($row['username'] != $_SESSION['usrName']){
          echo "<a href= "."chatBox.php".">".$row['username']."</a><br>";
          echo "<hr>";
        }
      }
    }
    else {
      echo "No records found.";
    }
  }

  $connection->close();
?>
  </body>
</html>