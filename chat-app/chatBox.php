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
<form name = "jsForm" action="insertMessage.php" method="POST">
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
                $output .= "<p class = "."outgoing >". $row['message'] ."</p>";
                                
            }
            else{
                $output .= "<p class = "."incoming >". $row['message'] ."</p>";
            }
        }
      }
      else {
        echo "No records found.";
      } 
      
    }
?>

<div id = "chatbox" class="container">
  
  <div id = "allMessage">
    <?php echo $output ?>
</div>
  <textarea id = "message" name="message" rows="4" cols="50"></textarea>
  <button type="button" name="Send" onclick="sendData();">Send-></button>
</div>
</form>
<script>
  function sendData(){

    const xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){

    if(this.readyState === 4 && this.status === 200){
      var node = "<p>"+this.responseText+"</p>";
      var p = document.createElement("p");
      var t = document.createTextNode(this.responseText);
      p.appendChild(t);
      p.className = "outgoing";
        document.getElementById("allMessage").appendChild(p);
    } 
  }
    xhttp.open("POST", "insertMessage.php" );
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    const myData = {
        "message" : document.getElementById("message").value
      }
    xhttp.send("msg="+JSON.stringify(myData));

    document.getElementById("message").value = "";
  }

  function checkIncomingMessage(){
      var x = document.getElementsByClassName("incoming").length;
      const xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){

        if(this.readyState === 4 && this.status === 200){
        
          try{
              var temp = JSON.parse(this.responseText);
              var message = temp.messages;
              message.forEach(function newMessage(item, index){
              var node = "<p>"+this.responseText+"</p>";
              var p = document.createElement("p");
              var t = document.createTextNode(item);
              p.appendChild(t);
              p.className = "incoming";
              document.getElementById("allMessage").appendChild(p);
            }); 
          }
          catch(err){

          }
          console.log(message);
        } 
      }
      xhttp.open("POST", "RealTimeChat.php" );
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      const myData = {
          "count" : x
      }
      xhttp.send("count="+JSON.stringify(myData));
    }
    var interval = setInterval(checkIncomingMessage, 700);
</script>
</body>
</html>
