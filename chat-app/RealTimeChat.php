<?php
    session_start();
    $decode = json_decode($_POST["count"], false);
    $count = $decode->count;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chatapp";
    $array = array();
    $connection = new mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }
    $name = $_SESSION['usrName'];
    $sql = "SELECT message FROM messages where sentTo = '$name'";
    $stmt = $connection->prepare($sql);
    $response = $stmt->execute();

    if ($response) {
      $data = $stmt->get_result();

      if ($data->num_rows > $count){
        $c = 0;
        while ($row = $data->fetch_assoc()) {
          $c++;
          if($c>$count){   
            $message = $row['message'];
            array_push($array, $message);
          }
        }
        $temp = json_encode(array('messages'=>$array));
        echo $temp;
      }
      
    }

?>
