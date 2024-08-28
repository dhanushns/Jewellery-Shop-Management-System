<?php
include_once 'account/connection.php';
session_start();
if(isset($_SESSION['username'])){
  if(isset($_POST['flexRadioDefault'])){
    $username = $_SESSION['username'];
    $payment_gateway = $_POST['flexRadioDefault'];

    $sql_cmd = "SELECT item_id FROM cart WHERE username = '$username'";
    $result = $conn->query($sql_cmd);
    $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $count = count($row);
    $sql_cmd = "SELECT SUM(price) from cart WHERE username = '$username'";
    $total_price_result = $conn->query($sql_cmd);
    $total_price = mysqli_fetch_all($total_price_result,MYSQLI_NUM)[0][0];
    $products = '';
    $date = date('Y-m-d') . ' ';
    date_default_timezone_set("Asia/Kolkata");
    $time = date('h:i:s');

    for($i = $count-1; $i >= 0; $i--){
      $item_id = $row[$i]['item_id'];
      $products .= $item_id . ',';
    }

    $sql_cmd = "INSERT INTO purchase_history (username,item_ids,purchase_date,total_price,payment_gateway)
    values ('$username', '$products', '$date$time','$total_price','$payment_gateway')";
    $conn->query($sql_cmd);

    $sql_cmd = "DELETE FROM CART WHERE username = '$username'";
    $conn->query($sql_cmd);

    header("Location:./payment.php?process=done");

  }
  else{
    echo "<script>alert('Select Payment Gateway');
          history.go(-1);</script>";
  }
}
else{
  echo "<script>alert('Login');
  window.location.href = 'http:/NS_Jewells/account';
  </script>";
}