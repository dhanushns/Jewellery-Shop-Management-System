<?php
include_once 'account/connection.php';
session_start();
if(isset($_SESSION['username'])){
  if(isset($_POST['rm_pr'])){
    $username = $_SESSION['username'];
    $product_id = $_POST['rm_pr'];

    $sql_cmd = "DELETE FROM cart WHERE item_id = '$product_id' and username = '$username'";
    $conn->query($sql_cmd);
    echo "<script>history.go(-1);</script>";
  }
  else{
    echo "<script>alert('no data');</script>";
  }
}
else{
  echo "<script>alert('Login');
  window.location.href = 'http:/NS_Jewells/account';
  </script>";
}