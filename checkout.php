<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Custom stylesheet -->
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="globalStyleSheet.css">
<!-- Custom stylesheet -->

<!-- Fonts and icons -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet"
  href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
<!-- Fonts and icons -->

<!-- Jquery script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- Jquery script -->

<!-- Bootstarp 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<!-- Bootstarp 5 -->

<script src="script.js"></script>
<script type="text/javascript" src="country.js"></script>
<script>
function disableInput() {
  let classes = document.getElementsByClassName("form-control");
  for (let i = 0; i < classes.length; i++) {
    classes[i].disabled = true;
  }
}

function toggle_input_field() {
  let text = document.getElementById('edit_save_btn');
  let classes = document.getElementsByClassName("form-control");
  if (text.innerHTML === 'Edit') {
    for (let i = 0; i < classes.length; i++) {
      classes[i].disabled = false;
    }
    document.getElementById('edit_save_btn').innerHTML = 'Update';
  } else {
    for (let i = 0; i < classes.length; i++) {
      classes[i].disabled = true;
    }
    document.getElementById('edit_save_btn').innerHTML = 'Edit';
  }
}
</script>
<?php
if(isset($_GET['category']))
  echo "<title>NS - $_GET[category] product</title>";
?>

<title>NSJ - Checkout</title>

</head>

<body>

  <?php
  session_start();
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
  ?>

  <div class="nav" style="background-color: #f2e9e9">
    <h3>NS Jewellers</h3>
    <?php
    echo "<form method = 'post' action = './search.php'>
      <input type='text' name='search' placeholder='Search for Gold Jewellery, Diamond Jewellery, Silver and more....' />
    </form>";
    ?>
    <button class="Button">
      <i class="material-icons search" style="font-size: 30px">search</i>
    </button>
    <button class="Button">
      <i class="material-icons mic" style="font-size: 30px">mic</i>
    </button>
    <button class="Button">
      <i class="material-icons store" style="font-size: 30px">store</i>
    </button>
    <button class="Button">
      <i class="material-icons fav" style="font-size: 30px">favorite</i>
    </button>
    <button class="Button">
      <i class="material-icons cart" style="font-size: 30px">shopping_cart</i>
    </button>
    <button class="Button bar" style="margin-left: 600px">
      <i class="fa fa-bars" style="font-size: 30px"></i>
    </button>
  </div>

  <div class="sideNav">
    <button class="closebtn" style="border: none; background: transparent">
      <i class="fa fa-close"></i>
    </button>
    <a href="../index.php">NS Jewellery</a>
    <button class="productButton">Products<i class="fa fa-plus"></i></button>
    <ul class="dropbox" style="background: transparent">
      <?php 
        echo '<a href="index.php?category=' . 'Diamond' . '">
          <li>Diamond</li>
          </a>';
      
          echo '<a href="index.php?category=' . 'Gold' . '">
          <li>Gold</li>
          </a>';
          echo '<a href="index.php?category=' . 'Platinum' . '">
          <li>Platinum</li>
          </a>';
          echo '<a href="index.php?category=' . 'Silver' . '">
          <li>Silver</li>
          </a>';
      ?>
    </ul>
    <a href=<?php
    if (isset($username))
      echo "";
    else
      echo '"/account/"';
    ?>>
      <?php
       if (isset($username))
         echo "Account";
       else
         echo "Login";
       ?>
    </a>
    <?php
    if (isset($username)) {
      echo "<a onclick='destroy_session()'>Logout</a>";
    } else {
      echo "<a href='#'>About us</a>";
      echo "<a href='#'>Feedback</a>";
      echo "<a href='#'>Help</a>";
    }
    ?></a>
  </div>

  <div class="title" style='color:#9657b1'>Checkout</div>
  <?php
  include_once './account/connection.php';
  if(isset($_SESSION['username'])){
    $sql_cmd = "SELECT item_id FROM cart WHERE username = '$username'";
    $result = $conn->query($sql_cmd);
    $row = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $count = count($row);
    $sql_cmd = "SELECT SUM(price) from cart WHERE username = '$username'";
    $total_price_result = $conn->query($sql_cmd);
    $total_price = mysqli_fetch_all($total_price_result,MYSQLI_NUM)[0][0];
  }
  ?>
  <hr>

  <?php
  $sql_cmd = "SELECT * FROM user_accounts WHERE username = '$username'";
  $result = $conn->query($sql_cmd);
  $user = mysqli_fetch_all($result,MYSQLI_ASSOC);
  $fn = $user[0]['firstname'];
  $ln = $user[0]['lastname'];
  $address = $user[0]['address'];
  $landmark = $user[0]['landmark'];
  $phone_no = $user[0]['phoneno'];
  $pincode = $user[0]['pincode'];
  $city = $user[0]['city'];
  $state = $user[0]['state'];
  $country = $user[0]['country'];

  if(isset($address) != TRUE){
    echo "<script>alert('Complete your profile');
          location.href = './customer/account'</script>";
    exit();
  }

  ?>

  <div class='container cart-modal'>
    <div class='row cart-container'>
      <div class='col-8 checkout-col'>
        <div class='row'>
          <div class='col-8'>
            <span>Billing Information</span>
          </div>
          <div class='col'>
            <button onclick='toggle_input_field()' class='btn btn-secondary' id='edit_save_btn'
              style='padding : 10px 40px'>Edit</button>
          </div>
        </div>
        <form action='./payment.php' class='col data-form' style='margin-top:20px' methos='post'>
          <div class='row g-5'>
            <div class="col-md-5">
              <label class="form-label">Firstname*</label>
              <input type="text" class="form-control" name='fn' required id="fnInput" value='<?php echo $fn;?>'>
            </div>
            <div class="col-md-5">
              <label class="form-label">Lastname*</label>
              <input type="text" class="form-control" required id="lnInput" name='ln' value='<?php echo $ln;?>'>
            </div>
          </div>
          <div class='row g-5' style='margin-top:5px'>
            <div class="col-md-5">
              <label for="inputAddess" class="form-label">Address*</label>
              <textarea type="text" class="form-control" name='address' required
                id="AddressInput"><?php echo $address;?></textarea>
            </div>
            <div class="col-md-5">
              <label for="inputLandmark" class="form-label">Landmark*</label>
              <input type="text" class="form-control" name='lm' required id="LandmarkInput"
                value='<?php echo $landmark;?>'">
          </div>
        </div>
        <div class='row g-5' style='margin-top:5px'>
          <div class=" col-md-5">
              <label for="inputphon_no" class="form-label">Phone no*</label>
              <input type="number" class="form-control" name='ph' required id="PhoneNoInput"
                value='<?php echo $phone_no;?>'>
            </div>
            <div class="col-md-5">
              <label for="inputCode" class="form-label">Zip/Postal code*</label>
              <input type="text" class="form-control" name='code' required id="codeInput"
                value='<?php echo $pincode;?>'>
            </div>
          </div>
          <div class='row g-5' style='margin-top:5px'>
            <div class="col-md-5">
              <label for="inputCity" class="form-label">City*</label>
              <input type="text" class="form-control" name='city' required id="cityIput" value='<?php echo $city;?>'>
            </div>
            <div class="col-md-5">
              <label for="inputState" class="form-label">State*</label>
              <select name="state" id="state" class="form-control" required>
                <option selected='selected'><?php echo $state;?></option>
              </select>
            </div>
          </div>
          <div class='row g-5' style='margin-top:5px'>
            <div class="col-md-5">
              <label>Country*</label><br>
              <select class="form-control" required onchange="print_state('state',this.selectedIndex);" id="country"
                name="country">
                <option selected='selected'><?php echo $country;?></option>
              </select>
            </div>
          </div>
          <div class='row align-items-center' style='margin-top :20px;margin-bottom:20px;'>
            <button style='margin-inline:auto;width:50%' type='submit' class='btn btn-primary'>Continue
              Checkout</button>
          </div>
        </form>
      </div>

      <div class='col checkout-order-summary-col'>
        <div class='row'>
          <span>Order Summary</span>
        </div>

        <div class='row static-right-aside-flex'>
          <div class='row total-count'>
            <div class='col-7'>
              <span>
                <h5 style='font-weight:bolder'>Total item : <?php echo $count;?></h5>
              </span>
            </div>
            <div class='col'>
              <span>
                <h5 class='text-end' style='font-weight:bolder'> &#8377 <?php echo $total_price;?></h5>
              </span>
            </div>
          </div>
          <div class='col total-price-col'>
            <?php
            for($i = $count-1; $i >= 0; $i--){
            $item_id = $row[$i]['item_id'];
            $sql_cmd = "SELECT * from products where item_id = '$item_id'";
            $result = $conn->query($sql_cmd);
            $data = mysqli_fetch_all($result,MYSQLI_ASSOC);
            $product_name = $data[0]['name'];
            $carat = $data[0]['carot'];
            $stone = $data[0]['stone'];
            $price = $data[0]['price'];
            $color = $data[0]['color'];
            $category = $data[0]['category'];
            $pathArray = explode(" ",$category);
            $path = "./products/";
            for($j = 0 ; $j < count($pathArray) ; $j++){
              $path .= $pathArray[$j]."/";
            }
            echo "<div class='row'>
            <div class='col-2 checkout-img-col'>
              <img src='$path$item_id.jpeg'>
            </div>
            <div class='col'>
              <div class='row'>
                <h5 style='font-weight:bolder;font-size:12px;'>$product_name</h5>
                <div class = 'col'>
                  <h6 style='font-size:12px;'>Product code : <span>$item_id</span></h6>
                </div>
                <div class = 'col text-end'>
                  <span>Price : &#8377 $price</span>
                </div>
              </div>
            </div>
          </div>
          <hr>";
          }
            ?>
            <div class='row'>
              <div class='col-8'>
                <span style='font-weight:normal'>Subtotal : </span>
              </div>
              <div class='col' style='text-align:center;'>
                <span style='font-weight:normal'> &#8377 <?php echo $total_price;?> </span>
              </div>
            </div>
            <hr>
            <div class='row'>
              <div class='col-8'>
                <span>TOTAL : </span>
              </div>
              <div class='col' style='text-align:center;'>
                <span> &#8377 <?php echo $total_price;?> </span><br>
                <span style='font-weight:normal;font-size:10px;'>(Inclusive of all taxes)</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <?php
    if($address == TRUE){
      echo "<script>disableInput()</script>";
    }
    ?>

    <!-- Footer -->
    <div class="end">
      <div class="footer-row">
        <div class="links">
          <label>Useful Links</label>
          <ul>
            <li><a href="#">Delivery information</a></li>
            <li><a href="#">International Shipping</a></li>
            <li><a href="#">Payment Options</a></li>
            <li><a href="#">Track Your Order</a></li>
            <li><a href="#">Returns</a></li>
            <li><a href="#">Find a Store</a></li>
          </ul>
        </div>
        <div class="contact">
          <label>Contact Us</label>
          <ul style="list-style: none">
            <li>
              <i class="material-icons mail" style="font-size: 18px">mail</i><a href="#">Write to Us</a>
            </li>
            <li>
              <i class="material-icons call" style="font-size: 18px">call</i><a href="#">1890-655-778</a>
            </li>
            <li>
              <i class="material-icons chat" style="font-size: 18px">chat</i><a href="#">Chat with Us</a>
            </li>
          </ul>
          <label>Download now</label>
          <div class="download">
            <div class="googleplay">
              <a href="#"><img src="icons/googleplay.png" /></a>
            </div>
            <div class="appstore">
              <a href="#"><img src="icons/appstore.png" /></a>
            </div>
          </div>
        </div>
        <div class="info">
          <label>Information</label>
          <ul style="list-style: none">
            <li><a href="#">Careers</a></li>
            <li><a href="#">Blog</a></li>
            <li><a href="#">Others & contest Details</a></li>
            <li><a href="#">Help & FAQS</a></li>
            <li><a href="#">About NS Jewells</a></li>
          </ul>
        </div>
      </div>
    </div>

</body>