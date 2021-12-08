<?php
  session_start();

  if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $decode = json_decode($_POST["msg"], false);
    //var_dump($decode);

    $message = $decode->message;
  
    if (empty($message)) {
      echo "Please fill up the form properly";
    }
    else {
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
             $sentTo = $row['username'];
          }
        }
      }
      else {
        echo "No records found.";
      }
    }

    $connection->close();
      $temp = $_SESSION['usrName'];
    
  
        //$message = $_POST['message'];
        $connection = new mysqli($servername, $username, $password, $dbname);
        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        }
        else {
          $sql = "INSERT INTO messages(sentTo, form, message) VALUES ('$sentTo', '$temp', '$message')";

        $data = $connection->query($sql);
        }
        
        $connection->close();
    }
  }
    echo $message;

?>
  
