<?php
include_once 'account/connection.php';
//Inserting Products Data
$diamond_product = [
  ["DC001", "Diamond Chain", "Pendant Chain", 18, "White", "", 92800, true],
  ["DC002", "Diamond Chain", "Pendant Chain", 18, "White", "", 70000, true],
  ["DC003", "Diamond Chain", "Pendant Chain", 18, "White", "", 80000, true],
  ["DE001", "Diamond Earring", "Stone Stud and Drops", 18, "White", "", 70000, true],
  ["DE002", "Diamond Earring", "Stone Stud and Drops", 18, "White", "", 62000, true],
  ["DE003", "Diamond Earring", "Stone Stud and Drops", 18, "White", "", 92000, true],
  ["DR001", "Diamond Ring", "Round Brilliant Ring", 18, "White", "", 74000, true],
  ["DR002", "Diamond Ring", "Oval Diamond Ring", 18, "White", "", 32000, true],
  ["DR003", "Diamond Ring", "Round Brilliant Ring", 18, "White", "", 87000, true],
  
  ["GC001", "Gold Chain", "Pendant Chain", 22, "Yellow Gold", "CZ stone", 57100, true],
  ["GC002", "Gold Chain", "Pendant Chain", 22, "Yellow Gold", "CZ stone", 52975, true],
  ["GC003", "Gold Chain", "Pendant Chain", 22, "Yellow Gold", "CZ stone", 59500, true],
  ["GEJ001", "Gold Earring Jumka", "Stone Stud and Jumka", 22, "Yellow Gold", "CZ with green stone", 122250, true],
  ["GEJ002", "Gold Earring Jumka", "Stone Stud and drops", 22, "Yellow Gold", "Polki stone with pearl", 130400, true],
  ["GEJ003", "Gold Earring Jumka", "Stone Stud and drops", 22, "Yellow Gold", "Polki stone with pearl", 73350, true],
  ["GEJ004", "Gold Earring Jumka", "Fancy Stud", 22, "Yellow Gold", "", 32600, true],
  ["GEJ005", "Gold Earring Jumka", "Stone Stud and drops", 22, "Yellow Gold", "Polki stone with pearl", 138550, true],
  ["GEA001", "Gold Earring Antique", "Chandbali earrings", 22, "Yellow Gold Anitque Polish", "", 130500, true],
  ["GEA002", "Gold Earring Antique", "Antique Jumka", 22, "Yellow Gold Anitque Polish", "", 146700, true],
  ["GEA003", "Gold Earring Antique", "Antique Jumka", 22, "Yellow Gold Anitque Polish", "", 138550, true],
  ["GEE001", "Gold Earrind Elegant", "Casting Stone Eartops", 22, "Yellow Gold", "CZ stone", 48900, true],
  ["GEE002", "Gold Earrind Elegant", "Casting Stone Eartops", 22, "Yellow Gold", "", 22000, true],
  ["GEE003", "Gold Earrind Elegant", "Casting Pearl Eartops", 22, "Yellow Gold", "", 87100, true],
  ["GR001", "Gold Ring", "Stone Ring", 22, "Yellow Gold", "CZ stone", 48900, true],
  ["GR002", "Gold Ring", "Stone Ring", 22, "Yellow Gold", "CZ stone", 57050, true],
  ["GR003", "Gold Ring", "Stone Ring", 22, "Yellow Gold", "CZ stone", 22000, true],

  ["SC001", "Silver Chain", "Men Silver Chain", 925, "White", "", 3750, true],
  ["SC002", "Silver Chain", "Men Silver Chain", 925, "White", "", 6000, true],
  ["SC003", "Silver Chain", "Butterfly Pendant Chain", 925, "white", "", 4800, true],
  ["SC004", "Silver Chain", "Butterfly Pendant Chain", 925, "white", "", 4600, true],
  ["SC005", "Silver Chain", "Men Silver Chain", 925, "White", "", 7000, true],
  ["SB001", "Silver Bracelet", "Stone Bracelet", 925, "White", "", 2700, true],
  ["SB002", "Silver Bracelet", "Stone Bracelet", 925, "White", "", 3000, true],
  ["SB003", "Silver Bracelet", "Silver Bracelet", 925, "White", "", 3000, true],
  ["SB004", "Silver Bracelet", "Silver Bracelet", 925, "White", "", 3200, true],
  ["SB005", "Silver Bracelet", "Silver Bracelet", 925, "White", "", 2250, true],
  ["SB006", "Silver Bracelet", "Pearl Silver Bracelet", 925, "White", "", 2400, true],
  ["SR001", "Silver Ring", "Silver Stone Ring", 925, "White", "Stone", 450, true],
  ["SR002", "Silver Ring", "Silver Ring", 925, "White", "Stone", 350, true],
  ["SR003", "Silver Ring", "Silver Stone Ring", 925, "White", "Stone", 400, true],
  ["SR004", "Silver Ring", "Silver Ring", 925, "White", "CZ stone", 500, true],
  ["SR005", "Silver Ring", "Silver Ring", 925, "White", "CZ stone", 250, true],
  ["SR006", "Silver Ring", "Silver Ring", 925, "White", "CZ stone", 600, true],

  ["PC001", "Platinum Chain", "Platinum Pendant", 950, "White", "", 64375, true],
  ["PC002", "Platinum Chain", "Platinum Flower Pendant", 950, "White", "", 56500, true],
  ["PC003", "Platinum Chain", "Platinum Dragonfly Pendant", 950, "White", "", 98000, true],
  ["PC004", "Platinum Chain", "Platinum Heart Wings Pendant", 950, "White", "", 67500, true],
  ["PC005", "Platinum Chain", "Platinum Double Heart Pendant", 950, "White", "", 62500, true],
  ["PC006", "Platinum Chain", "Unique Platinum Diamond", 950, "White", "", 61000, true],
  ["PE001", "Platinum Earring", "Platinum Diamond Earring", 950, "White", "", 38250, true],
  ["PE002", "Platinum Earring", "Platinum Diamond Eartops", 950, "White", "", 57500, true],
  ["PE003", "Platinum Earring", "Platinum Diamond Earring", 950, "White", "", 40000, true],
  ["PR001", "Platinum Ring", "Platinum Heart Ring", 950, "White", "", 60600, true],
  ["PR002", "Platinum Ring", "Couple Platinum Ring", 950, "White", "", 58500, true],
  ["PR003", "Platinum Ring", "Platinum Ring", 950, "Rose Gold", "", 80800, true]
];

$sql_cmd = "SELECT * FROM products";
$result = $conn->query($sql_cmd);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC + MYSQLI_NUM);
if ($row == null) {
  foreach ($diamond_product as $item) {
    $sql_cmd = "INSERT INTO products VALUES ('$item[0]','$item[1]','$item[2]','$item[3]','$item[4]','$item[5]','$item[6]','$item[7]')";
    if ($conn->query($sql_cmd) != TRUE) {
      echo "Error while creating product table";
    }
  }
}