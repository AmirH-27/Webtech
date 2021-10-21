<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Registration Form</title>
</head>
<body>
  <h1>Page 2 [Add Beneficiary]</h1>
<form action="BeneficiaryAction.php" method="post">
  <h2>Digital Wallet</h2>
  1. <a href="Home.php">Home</a>
  2. <a href="Beneficiary.php">Add Beneficiary</a>
  3. <a href="Transaction.php">Transaction History</a>
  <br>
  <h2>Add Beneficiary</h2>
  Beneficiary Name: <input type="Text" name="name">
  Mobile No: <input type="tel" name="number">
  <input type="submit" value="Submit">
</form>


  <?php
    $data = "";
    $handle = fopen("Beneficiary.json", "r+");
    if(filesize("Beneficiary.json")>2){
    $data = fread($handle, filesize("Beneficiary.json"));
  }
  ?>


  <?php
    $explode = explode("\n", $data);
    array_pop($explode); 
  ?>

  <?php
    $arr1 = array();
    for($i = 0; $i < count($explode); $i++){
      $json = json_decode($explode[$i]);
      array_push($arr1, $json);
    }
  ?>

  <br>

  <table border="1">
    <tbody>
      <?php
        for($k = 0; $k < count($arr1); $k++){
          echo "<tr>";
            echo "<td>". $arr1[$k]->name
                  ."</td>";
            echo "<td>". $arr1[$k]->number
                  ."</td>";
          echo "</tr>";
        }
      ?>
    </tbody>
  </table>
</body>
</html>