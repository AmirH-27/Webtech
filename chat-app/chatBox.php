<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Chat</title>
<script src="external.js"></script>
<style>
body {
  margin: 0 auto;
  max-width: 400px;
  padding: 0 20px;
}

.container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}
.incoming{
  text-align: left;
}
.outgoing{
  text-align: right;
}
textarea {
  width: 90%;
  height: 60px;
  padding: 12px 20px;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  background-color: #f8f8f8;
  font-size: 16px;
  resize: none;
}
</style>
</head>
<body>
<form name = "regForm" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="POST">
<h2>Chat Messages</h2>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chatapp";

    $connection = new mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }
    $sql = "SELECT username FROM user";
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
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "chatapp";

    $connection = new mysqli($servername, $username, $password, $dbname);

    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }
    $sql = "SELECT * FROM messages";
    $stmt = $connection->prepare($sql);
    $response = $stmt->execute();

    if ($response) {
      $data = $stmt->get_result();
      $output = "";
      
      if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {
            if($row['sentTo'] === $sentTo){
                    $output .= "<div class = "."outgoing"."
                                    <p>". $row['message'] ."</p>
                                </d>";
                                
                }else{
                    $output .= "<div class = "."incoming"."
                                    <p>". $row['message'] ."</p>
                                </d>";
                                //$outputinco = $row['message'];
                }
        }
      }
      
      else {
        echo "No records found.";
      } 
      
    }
?>

<div id = "chatbox" class="container">
  <?php echo $output ?>
  <textarea name="message" rows="4" cols="50"></textarea>
  <button type = "button" onlick = "dbInsert">Send</button>
</div>
</form>
<script>
  function dbInsert(){
    window.location.reload();
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
      if(empty($_POST['message'])){
        echo "Message Box empty";
      } 
      else{
        $message = $_POST['message'];
        $connection = new mysqli($servername, $username, $password, $dbname);
        if ($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        }
        else {
          echo "Database Connection Successful <br>";
        }
        $sql = "INSERT INTO messages(sentTo, form, message) VALUES ('$sentTo', '$temp', '$message')";

        $data = $connection->query($sql);
        $connection->close();
      }
    ?>
  }
</script>
</body>
</html>
