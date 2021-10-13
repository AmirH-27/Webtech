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
  <?php
    $isValid = false;
    if (empty($firstname) or empty($lastname) or empty($gender)
      or empty($birthday) or $religion == "select religion" or empty($email)
      or empty($userName) or empty($password)){
      
      $isValid = false;
    }
    else{
      $isValid = true;
    }
  ?>

  <?php

    function sanitize($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    if ($isValid) {
      $firstname = sanitize($firstname);
      $lastname = sanitize($lastname);
    }
  ?>

  <?php
    if ($isValid) { 
      $handle1 = fopen("data.json", "a");
      $arr1 = array('firstname' => $firstname, 'lastname' => $lastname, 'gender' => $gender,
        'birthday' => $birthday, 'religion' => $religion, 'address' => $address, 
        'perAddress' => $perAddress, 'phone'=>$phone, 'email' => $email, 
        'personalWeb' => $personalWeb, 'usrName' => $userName, 'password' => $password);
      $encode = json_encode($arr1);

      $res = fwrite($handle1, $encode . "\n");
    }

    if ($res) {
      header("Location: Login.php");
    }
    else {
      echo "Error while saving.";
    }
  ?>

</body>
</html>