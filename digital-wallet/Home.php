<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Digital Wallet</title>
</head>
<body>
  <h1>Page 1 [Home]</h1>
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

  <?php
    $Category = $To = $Amount = "";
    $request_method = $_SERVER['REQUEST_METHOD'];
    if($request_method === 'POST'){
      $Category = $_POST['Category'];
      $To = $_POST['To'];
      $Amount = $_POST['Amount'];
    }
  ?>

  <h2>Digital Wallet</h2>
  1. <a href="Home.php">Home</a>
  2. <a href="Beneficiary.php">Add Beneficiary</a>
  3. <a href="Transaction.php">Transaction History</a>

  <br>
  <br>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
  Select Category: 
    <select name="Category">
      <option value="select">Select a value</option>
      <option value="SendMoney">Send Money</option>
      <option value="CashOut">Cash Out</option>
      <option value="PayBill">Pay Bill</option>
      <option value="MobileRecharge">Mobile Recharge</option>
    </select>
  <br>
  <br>
    To: 
    <select name="To">
      <option value="select">Select a value</option>
      <?php 
      for($i = 0; $i<count($arr1); $i++){
        $value = "name".strval($i);
        $temp = $arr1[$i]->name;
        echo "<option value =".$temp.">". $temp . "</option>";
      }
      ?>
    </select>  
    <br>
    <br>
    Amount: <input type="number" name="Amount" value="<?php echo $Amount?>">
    <br>
    <br>
  <input type="submit" value="Submit">
</form>
<?php
  if($_SERVER['REQUEST_METHOD']=='POST'){
    $Category = $_POST['Category'];
    $SendTo = $_POST['To'];
    $Amount = $_POST['Amount'];
    $isValid = false;
    if ($Category == "select" or $SendTo == "select" or empty($Amount)){
      $isValid = false;
      echo "All fields are not filled";
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
      $Category = sanitize($Category);
      $SendTo = sanitize($SendTo);
      $Amount = sanitize($Amount);
    }
    if ($isValid) { 
      date_default_timezone_set('Asia/Dhaka');
      $handle1 = fopen("Transaction.json", "a");
      $arr1 = array('category' => $Category, 'SentTo' => $SendTo, 'amount' => $Amount, 'date' => date("Y-m-d H:i:s A"));
      $encode = json_encode($arr1);

      $res = fwrite($handle1, $encode . "\n");
      if ($res) {
        echo "Saved";
      }
      else {
        echo "Error while saving.";
      }
    }
  }
  ?>


</body>
</html>