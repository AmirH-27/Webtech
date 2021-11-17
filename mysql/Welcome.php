<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Form Action</title>
</head>
<body>

  <h1>Welcome</h1>
  <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "users";

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
        echo "First Name: " . $row["fName"] . "<br>";
        echo "Last Name: " . $row["lName"] . "<br>";
        echo "Gender: " . $row["gender"] . "<br>";
        echo "Dob: " . $row["dob"] . "<br>";
        echo "Religion: " . $row["religion"] . "<br>";
        echo "Present Address: " . $row["preAddress"] . "<br>";
        echo "Permanent Address: " . $row["perAddress"] . "<br>";
        echo "Phone: " . $row["phone"] . "<br>";
        echo "Email: " . $row["email"] . "<br>";
        echo "Personal Website: " . $row["personalWeb"];
        echo "<hr>";
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