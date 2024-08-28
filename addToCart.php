<?php
include_once 'account/connection.php';
session_start();
if(isset($_SESSION['username'])){
  if(isset($_POST['product_id'])){
    $username = $_SESSION['username'];
    $product = explode(",",$_POST['product_id']);
    $product_id = $product[0];
    $price = $product[1];
    $state = $product[2];
    $flag = TRUE;

    if($state == 'buy-now'){
      $sql_cmd = "SELECT item_id FROM cart WHERE username = '$username'";
      $result = $conn->query($sql_cmd);
      $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
      for($i = 0 ; $i < count($row); $i++){
        if($row[$i]['item_id'] == $product_id){
          $flag = TRUE;
          header('location:./cart.php');
        }
        else{
          $flag = FALSE;
        }
      }
      if($flag == FALSE){
        $sql_cmd = "INSERT INTO cart (username,item_id,price) VALUES ('$username','$product_id',$price)";
        $conn->query($sql_cmd);
        header('location:./cart.php');
      }
    }
    else{
      $sql_cmd = "INSERT INTO cart (username,item_id,price) VALUES ('$username','$product_id',$price)";
      $conn->query($sql_cmd);
      setcookie('cart','true',time() + 10 ,"/");
      header("location:javascript://history.go(-1)");
    }
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