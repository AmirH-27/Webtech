<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Transaction History</title>
</head>
<body>
  <h1>Page 3 [Transaction History]</h1>
<?php
    $starting_date  = $ending_date = "";
    $request_method = $_SERVER['REQUEST_METHOD'];
    if($request_method === 'POST'){
      $starting_date  = $_POST['from'];
      $ending_date = $_POST['to'];
    }
  ?>
<form method="POST">
  <h2>Digital Wallet</h2>
  1. <a href="Home.php">Home</a>
  2. <a href="Beneficiary.php">Add Beneficiary</a>
  3. <a href="Transaction.php">Transaction History</a>
  <br>
  <br>
  From: <input type="datetime-local" name="from" value= <?php echo $starting_date ?>>
  To: <input type="datetime-local" name="to" value = <?php echo $ending_date ?>>
  <input type="submit" value="Search">

</form>
 <?php
    $data = "";
    $handle = fopen("Transaction.json", "r+");
    if(filesize("Transaction.json")>2){
    $data = fread($handle, filesize("Transaction.json"));
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
    $arr2 = array();
    for($i = 0; $i < count($explode); $i++){
      $json = json_decode($explode[$i]);
      array_push($arr2, $json);
    }
  ?>
  <h2>Total Records: (<?php echo count($arr1);?>)</h2>

  <br>

  <table border="1">
    <thead>
      <tr>
        <th>Transaction Category</th>
        <th>To</th>
        <th>Amount</th>
        <th>Transferred On</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $temp = "";
        for($k = 0; $k < count($arr1); $k++){
          if($arr1[$k]->date >= $starting_date && $arr1[$k]->date <= $ending_date){
            for($j = 0; $j<count($arr2); $j++){
              if($arr1[$k]->SentTo === $arr2[$j]->name){
                  $temp = $arr2[$j]->number;
              }
            }
            echo "<tr>";
              echo "<td>". $arr1[$k]->category
                  ."</td>";
              echo "<td>". $temp
                  ."</td>";
              echo "<td>". $arr1[$k]->amount
                  ."</td>";
              echo "<td>". $arr1[$k]->date
                  ."</td>";
            echo "</tr>";
          }
        }
      ?>
    </tbody>
  </table>

</body>
</html>