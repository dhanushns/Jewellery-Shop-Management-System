<?php
include_once '../../account/connection.php';
session_start(); 
$fn = $_GET['fn'];
$ln = $_GET['ln'];
$address = $_GET['address'];
$landmark = $_GET['lm'];
$phone_no = $_GET['ph'];
$pincode = $_GET['code'];
$city = $_GET['city'];
$state = $_GET['state'];
$country = $_GET['country'];

$sql_cmd = "UPDATE user_accounts SET firstname = '$fn', lastname = '$ln',address = '$address',
landmark = '$landmark', phoneno = '$phone_no', pincode = '$pincode', city = '$city', state = '$state', country = '$country' WHERE username = '$_SESSION[username]'";
$conn->query($sql_cmd);
echo "<script>history.go(-1);</script>";