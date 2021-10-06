<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Form Action</title>
</head>
<body>

  <h1>Form Action</h1>
  <?php
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $religion = $_POST['religion'];
    $address = $_POST['txtAdd'];
    $perAddress = $_POST['txtAddPer'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $personalWeb = $_POST['link'];
    $userName = $_POST['usrName'];
    $password = $_POST['password'];
  ?>

  <hr>

  <p> Retrieved values: 
  </p>

  First Name: <?php echo $firstname; ?>
  <br>
  Last Name: <?php echo $lastname; ?>
  <br>
  Gender: <?php echo $gender;?>
    <br>
  Birthday: <?php echo $birthday;?>
    <br>
  Religion: <?php echo $religion;?>
    <br>
  Address: <?php echo $address;?>
    <br>
  Permanent Address: <?php echo $perAddress;?>
    <br>
  Phone: <?php echo $phone;?>
    <br>
  Email: <?php echo $email;?>
    <br>
  Personal Web: <?php echo $personalWeb;?>  
  <br>
  UserName: <?php echo $userName;?>  
  <br>
  Password: <?php echo $password;?>

  <hr>
  <?php
    $isValid = false;

    if (empty($firstname)){
      echo "Firstname Is Empty<br><br>";
    }
    if(empty($lastname)) {
      echo "Lastname Is Empty<br><br>";
    }
    if(empty($gender)) {
      echo "Gender Is Empty<br><br>";
    }
    if(empty($birthday)) {
      echo "DOB Is Empty<br><br>";
    }
    if(empty($religion)) {
      echo "Religion Is Empty<br><br>";
    }
    if(empty($email)) {
      echo "Email Is Empty<br><br>";
    }
    if(empty($userName)) {
      echo "Username Is Empty<br><br>";
    }
    if(empty($password)) {
      echo "Password Is Empty<br><br>";
    }
  ?>
</body>
</html>