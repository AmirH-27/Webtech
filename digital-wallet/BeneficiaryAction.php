<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Beneficiary Action</title>
</head>
<body>

  <h1>Beneficiary Action</h1>
  <?php
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $Name = $_POST['name'];
    $Number = $_POST['number'];
    $isValid = false;
    if (empty($Number) or empty($Name)){
      $isValid = false;
      echo "Please Fill All the Fields";
    }
    else{
      $isValid = true;
    }
    function sanitize($data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    if ($isValid) {
      $Name = sanitize($Name);
      $Number = sanitize($Number);
    }
    if ($isValid) { 
      $handle1 = fopen("Beneficiary.json", "a");
      $arr1 = array('name' => $Name, 'number' => $Number);
      $encode = json_encode($arr1);

      $res = fwrite($handle1, $encode . "\n");
      if ($res) {
        header("Location: Beneficiary.php");
      }
      else {
        echo "Error while saving.";
      }
    }
  }
  ?>
</body>
</html>