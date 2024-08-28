<?php

include_once 'connection.php';

$email = $_POST['email'];
setcookie('email',$email,time() + 10 , "/");
shell_exec("node mailer.js");
header("Location:http://localhost:8080/sendOTP");
die();
?>