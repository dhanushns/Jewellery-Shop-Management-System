<?php
include_once 'account/connection.php';
session_start();
if(isset($_SESSION['username'])){
  if(isset($_POST['product_id'])){
    $username = $_SESSION['username'];
    $product_id = $_POST['product_id'];

    $sql_cmd = "SELECT item_id FROM wishlist WHERE username = '$username'";
    $result = $conn->query($sql_cmd);
    $result = mysqli_fetch_all($result);
    $flag = FALSE;
    foreach($result as $item){
      if($item[0] == $product_id){
        $sql_cmd = "DELETE FROM wishlist WHERE item_id = '$product_id'";
        $conn->query($sql_cmd);
        $flag = TRUE;
        break;
      }
    }
    if(!$flag){
      $sql_cmd = "INSERT INTO wishlist (username,item_id) VALUES ('$username','$product_id')";
      $conn->query($sql_cmd);
    }
    header("location:javascript://history.go(-1)");
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