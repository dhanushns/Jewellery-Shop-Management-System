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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js"></script>


<script>
function disableInput() {
  let classes = document.getElementsByClassName("form-control");
  for (let i = 0; i < classes.length; i++) {
    classes[i].disabled = true;
  }
}

function rm_components() {
  document.getElementById("rm-payment").style.display = "none";
  document.getElementById("display-form").style.display = "block";
  document.getElementById('payment-title').innerHTML = 'Your order has been placed...!';
  document.getElementById('payment-title').style.color = 'green';
  placeorder();
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

  <div class="title" id='payment-title' style='color:#9657b1'>Payment</div>
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

  <div id='animation-container'>
    <form class='final-form' id='display-form' action='./customer/order-history'>
      <button type='submit' class='my-order-btn'>My Orders</button>
    </form>
  </div>
  <div class='container payment-modal' id='rm-payment'>
    <div class='row cart-container'>
      <div class='col-8 checkout-col'>
        <form class='row' method='post' action='./order.php'>
          <div class='col-8'>
            <span>Payment method</span>
          </div>
          <div class='row' style='margin-top:20px'>
            <div class="accordion-item">
              <h6 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
                  aria-expanded="true" aria-controls="collapseOne">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" value='online'
                      id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1" style='margin-top:3px;'>
                      Online Payment (Credit / Debit / Net Banking / UPI / Wallets)s
                    </label><br>
                    <img src='./icons/online-payment.jpg' style='margin-top:10px;'>
                  </div>
                </button>
              </h6>
              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <span>You will be redirected to Razorpay website when you place an order.</span>
                </div>
              </div>
            </div>
          </div>
          <div class='row' style='margin-top:20px'>
            <div class="accordion-item">
              <h6 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                  aria-expanded="true" aria-controls="collapseOne">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" value='bank'
                      id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2" style='margin-top:3px;'>
                      Bank Transfer
                    </label><br>
                    <label style='margin-top:10px;'>Pay manually using this method on the below bank details</label>
                  </div>
                </button>
              </h6>
              <div id="collapseTwo" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <span>Verification : </span>
                  <div class='row' style='margin-top:20px;'>
                    <span style='font-size:12px;'>Verify your 10 digit mobile number to place your order.</span>
                  </div>
                  <div class='row' style='margin-top:20px;'>
                    <div class='col-3'>
                      <input type='number' style='padding:5px'>
                    </div>
                    <div class='col-3'>
                      <button type='submit' class='btn btn-primary'>send otp</button>
                    </div>
                  </div>
                  <hr class='dividers'>
                  <div class='row'>
                    <div class='col-3'>
                      <img src='./icons/hdfc-logo.png' style='width:100%;height:100%;'>
                    </div>
                  </div>
                  <div class='row' style='margin-top:20px;'>
                    <div class='col-5'>
                      <span class='sub'>Beneficiary Name</span><br>
                      <span class='sub-title'> NS Jewellers PVT LTD E-COMMERCR</span>
                    </div>
                    <div class='col-3'>
                      <span class='sub'>Bank Name</span><br>
                      <span class='sub-title'>HDFC Bank</span>
                    </div>
                    <div class='col-3'>
                      <span class='sub'>Account no</span><br>
                      <span class='sub-title'>0089635075</span>
                    </div>
                  </div>
                  <div class='row' style='margin-top:20px;'>
                    <div class='col-5'>
                      <span class='sub'>IFSC Code</span><br>
                      <span class='sub-title'>HDFC00892</span>
                    </div>
                    <div class='col-3'>
                      <span class='sub'>Branch</span><br>
                      <span class='sub-title'>SALEM-MAIN</span>
                    </div>
                  </div>
                  <div class='row' style='margin-top:20px;'>
                    <div class='col-10'>
                      <span class='sub'>After Bank transfer please email us transaction ID to confirm your
                        payment.
                        Email ID <a href='#'>care.in@nsj.com</a></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='row' style='margin-top:20px'>
            <div class="accordion-item">
              <h6 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
                  aria-expanded="true" aria-controls="collapseOne">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="flexRadioDefault" value='cash'
                      id="flexRadioDefault3">
                    <label class="form-check-label" for="flexRadioDefault3" style='margin-top:3px;'>
                      Cash On Delivery
                    </label><br>
                    <label style='margin-top:10px;'>Pay manually using this method on the below bank details</label>
                  </div>
                </button>
              </h6>
              <div id="collapseThree" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                data-bs-parent="#accordionExample">
                <div class="accordion-body">
                  <span>Verfication :</span>
                  <div class='row' style='margin-top:20px;'>
                    <span style='font-size:12px;'>Verify your 10 digit mobile number to place your order.</span>
                  </div>
                  <div class='row' style='margin-top:20px;'>
                    <div class='col-3'>
                      <input type='number' style='padding:5px'>
                    </div>
                    <div class='col-3'>
                      <button type='submit' class='btn btn-primary'>send otp</button>
                    </div>
                  </div>
                  <hr class='dividers'>
                  <div class='row' style='margin-top:20px;'>
                    <div class='col-5'>
                      <span class='sub'>Cash on Delivery terms and condition:</span><br>
                    </div>
                  </div>
                  <div class='row' style='margin-top:20px;'>
                    <div class='col'>
                      <ol>
                        <li class='sub-small'>Our delivery associates will not allow you to open packet at the time of
                          delivery</li>
                        <li class='sub-small'>Product will be delivered only after receiving cash by delivery associates
                        </li>
                        <li class='sub-small'>If you find any discrepancy with the packet please call us immediately on
                          our customer care no. +91 9150134353</li>
                        <li class='sub-small'>If the packet is tempered, please do not accept it</li>
                        <li class='sub-small'>Cash on Delivery is available in selected location only</li>
                      </ol>
                      <span class='sub-small'>For more details you can call us on our customer care no +91 9150134353
                        or mail
                        us at care.in@nsj.com</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class='row order-sum-footer' style='margin-top:20px;'>
            <div class='col-5 text-center'>
              <button type='submit' onclick='placeorder()'><span>Place order</span></button>
            </div>
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
                <h5 style='font-weight:bolder'> &#8377 <?php echo $total_price;?></h5>
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
            <div class='col-3 checkout-img-col'>
              <img src='$path$item_id.jpeg'>
            </div>
            <div class='col'>
              <div class='row'>
                <h5 style='font-weight:bolder;'>$product_name</h5>
                <h6 style='font-size:12px;'>Product code : <span>$item_id</span></h6>
              </div>
              <div class='row align-items-end'>
                <span>Price : &#8377 $price</span>
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
  if(isset($_GET['process'])){
    echo "<script>rm_components()</script>";
  }
  ?>

</body>