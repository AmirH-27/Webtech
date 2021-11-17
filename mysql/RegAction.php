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
    <legend>Basic Information:</legend>
    <label for="fname">First name:</label>
    <input type="text" id="fname" name="fname"><br><br>
    <label for="lname">Last name:</label>
    <input type="text" id="lname" name="lname"><br><br>
    <label for="gender">Gender:</label>
    <input type="radio" id="gender" name="gender" value="male">Male
    <input type="radio" id="gender" name="gender" value="female">Female
    <input type="radio" id="gender" name="gender" value="others">Others<br><br>
    <label for="birthday">Birthday:</label>
    <input type="date" id="birthday" name="birthday"><br><br>
    <label for="religion">Religion:</label>
    <select name="religion" id="religion">
      <option value="select religion">Select a religion</option>
      <option value="islam">Islam</option>
      <option value="hinduism">Hinduism</option>
      <option value="christanity">Christanity</option>
      <option value="buddhists">Buddhists</option>
  </select><br><br>
  </fieldset>

  <fieldset>
    <legend>Contact Information:</legend>
    <label for="presentAddress">Present Address:</label>
    <textarea id="txtAdd" name="txtAdd" rows = "2" cols = "50" maxlength="200"></textarea><br><br>
    <label for="permanentAddress">Permanent Address:</label>
    <textarea id="txtAddPer" name="txtAddPer" rows = "2" cols = "50" maxlength="200"></textarea><br><br>
    <label for="phone">Phone:</label>
    <input type="tel" id="phone" name="phone"><br><br>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email"><br><br>
    <label for="personalWeb">Personal Website Link:</label>
    <input type="url" id="link" name="link"><br><br>
  </fieldset>

  <fieldset>
    <legend>Account Information:</legend>
    <label for="userName">Username:</label>
    <input type="text" id="usrName" name="usrName"><br><br>
    <label for="password">Password:</label>
    <input type="text" id="password" name="password"><br><br>

  </fieldset>
  <br><input type="submit" value="Submit">
</form>
<?php 
  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "users";

  $firstname = $lastname = $gender = $birthday = $religion = $email = $usrName = $password = "";

  $firstname = $_POST['fname'];
  $lastname = $_POST['lname'];
  $gender = $_POST['gender'];
  $birthday = $_POST['birthday'];
  $religion = $_POST['religion'];
  $preAdd = $_POST['txtAdd'];
  $perAdd = $_POST['txtAddPer'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $perWeb = $_POST['link'];
  $usrName = $_POST['usrName'];
  $password = $_POST['password'];

  if(empty($firstname) or empty($lastname) or empty($gender) or
          empty($birthday) or empty($religion) or empty($email) or empty($usrName) or empty($password)){
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
    $sql = "INSERT INTO user(fName, lName, gender, dob, religion, preAddress, perAddress, phone, email, personalWeb, userName, password) VALUES (
         '$firstname', '$lastname', '$gender', '$birthday', '$religion', '$preAdd', '$perAdd', '$phone', '$email', '$perWeb', '$usrName', '$password')";

    $data = $connection->query($sql);

    if($data === true){
      echo "Data Inserted Successfully";
    }
    else{
      echo "Error";
    }
    $connection->close();
  }
?>
</body>
</html>