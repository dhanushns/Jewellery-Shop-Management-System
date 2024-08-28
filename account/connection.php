<?php

$conn = mysqli_connect("localhost", "root", "root@14");
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql_cmd = "CREATE DATABASE IF NOT EXISTS ns_account;";
if ($conn->query($sql_cmd) == TRUE) {
  $conn = mysqli_connect("localhost", "root", "root@14", "ns_account");
}

$sql_cmd_1 = "CREATE TABLE IF NOT EXISTS USER_ACCOUNTS(
  id int unique key auto_increment,
  firstname varchar(50) not null,
  lastname varchar(50) not null,
  username varchar(20) not null primary key,
  emailId varchar(50) not null unique key,
  password blob not null
)";

$sql_cmd_2 = "CREATE TABLE IF NOT EXISTS wishlist (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username varchar(20) ,
  item_id varchar(10) NOT NULL,
  FOREIGN KEY (username) REFERENCES user_accounts(username)
);";

$sql_cmd_3 = "CREATE TABLE IF NOT EXISTS cart (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username varchar(20),
  item_id varchar(10) NOT NULL,
  price DECIMAL NOT NULL,
  FOREIGN KEY (username) REFERENCES user_accounts(username)
);";

$sql_cmd_4 = "CREATE TABLE IF NOT EXISTS purchase_history (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username varchar(20),
  item_id varchar(10) NOT NULL,
  quantity INT NOT NULL,
  purchase_date DATETIME NOT NULL,
  total_price DECIMAL NOT NULL,
  FOREIGN KEY (username) REFERENCES user_accounts(username)
);";

$sql_cmd_5 = "CREATE TABLE IF NOT EXISTS products (
  item_id varchar(10) PRIMARY KEY,
  category varchar(50) NOT NULL,
  name VARCHAR(100) NOT NULL,
  carat INT NOT NULL,
  color varchar(50) NOT NULL,
  stone varchar(50) NULL,
  price DECIMAL(10, 2) NOT NULL,
  stock boolean NOT NULL
);";

$conn->query($sql_cmd_1);
$conn->query($sql_cmd_2);
$conn->query($sql_cmd_3);
$conn->query($sql_cmd_4);
$conn->query($sql_cmd_5);