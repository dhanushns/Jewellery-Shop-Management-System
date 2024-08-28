<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Custom stylesheet -->
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href='.products/stylesheet.css'>
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
<?php
if (isset($_GET['category']))
  echo "<title>NS - $_GET[category] product</title>";
?>

<title>NSJ - Cart</title>

</head>

<body>
  <?php
  session_start();
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
  } else {
    echo '<script>
    history.go(-1);</script>';
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
      <a href="./products/store.php"><i class="material-icons store" style="font-size: 30px">store</i></a>
    </button>
    <button class="Button">
      <a href='./customer/wishlist'><i class="material-icons fav" style="font-size: 30px">favorite</i></a>
    </button>
    <button class="Button">
      <a href="../cart.php"><i class="material-icons cart" style="font-size: 30px">shopping_cart</i>
    </button></a>
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
      echo '<a href="./products/index.php?category=' . 'Diamond' . '">
          <li>Diamond</li>
          </a>';

      echo '<a href="./products/index.php?category=' . 'Gold' . '">
          <li>Gold</li>
          </a>';
      echo '<a href="./products/index.php?category=' . 'Platinum' . '">
          <li>Platinum</li>
          </a>';
      echo '<a href="./products/index.php?category=' . 'Silver' . '">
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

  <div class="title" style='color:#9657b1'>Shopping Cart</div>
  <?php
  include_once './account/connection.php';
  if (isset($_SESSION['username'])) {
    $sql_cmd = "SELECT item_id FROM cart WHERE username = '$username'";
    $result = $conn->query($sql_cmd);
    $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $count = count($row);
    $sql_cmd = "SELECT SUM(price) from cart WHERE username = '$username'";
    $total_price_result = $conn->query($sql_cmd);
    $total_price = mysqli_fetch_all($total_price_result, MYSQLI_NUM)[0][0];
  }
  ?>
  <hr>

  < class='container cart-modal'>
    <div class='row cart-container'>
      <div class='row total-count'>
        <div class='col-7'>
          <span>
            <h5 style='font-weight:bolder'>Total item : <?php echo $count; ?></h5>
          </span>
        </div>
        <div class='col'>
          <span>
            <h5 style='font-weight:bolder'> &#8377 <?php echo $total_price; ?></h5>
          </span>
        </div>
      </div>
      <div class='col-8 display-products-col'>
        <?php
        for ($i = $count - 1; $i >= 0; $i--) {
          $item_id = $row[$i]['item_id'];
          $sql_cmd = "SELECT * from products where item_id = '$item_id'";
          $result = $conn->query($sql_cmd);
          $data = mysqli_fetch_all($result, MYSQLI_ASSOC);
          $product_name = $data[0]['name'];
          $carat = $data[0]['carot'];
          $stone = $data[0]['stone'];
          $price = $data[0]['price'];
          $color = $data[0]['color'];
          $category = $data[0]['category'];
          $pathArray = explode(" ", $category);
          $path = "./products/";
          for ($j = 0; $j < count($pathArray); $j++) {
            $path .= $pathArray[$j] . "/";
          }

          echo "<div class='row cart-flex'>
            <div class='row products-content'>
              <div class='col-4 pr-img-col'>
                <img src='$path$item_id.jpeg' style='border-radius:10px;'>
              </div>
              <div class='col'>
                <div class='row'>
                  <div class='col product-title'>
                    <h4 style='font-weight:bolder;'>$product_name</h4>
                    <h6 style='font-size:12px;'>Product code : <span>$item_id</span></h6>
                    <hr>
                  </div>
                </div>
                <div class='row product-price'>
                  <span>Price : &#8377 $price</span>
                </div>
                <hr>
                <div class='row pr-desc'>
                  <div class='col-5 desc dec-1'>
                    <h6>Metal color : <span>$color</span></h6>
                  </div>
                  <div class='col-3 desc dec-2'>
                    <h6>Carat : <span>$carat ct</span></h6>
                  </div>
                  <div class='col-4 desc dec-3'>
                    <h6>Stone : <span>$stone</span></h6>
                  </div>
                  <div class='col-5 desc dec-4'>
                    <h6>Category : <span>$category</span></h6>
                  </div>
                  <div class='col-2 desc dec-2'>
                    <form action = 'removeCart.php' method = 'post'>
                      <button type = 'submit' name = 'rm_pr' value = $item_id class='rm-btn'>Remove</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div> ";
        }
        ?>
      </div>
      <div class='col order-summary-col'>
        <div class='row'>
          <span>Order Summary</span>
        </div>
        <div class='row static-right-aside-flex'>
          <div class='col total-price-col'>
            <div class='row'>
              <div class='col-8'>
                <span style='font-weight:normal'>Subtotal : </span>
              </div>
              <div class='col' style='text-align:center;'>
                <span style='font-weight:normal'> &#8377 <?php echo $total_price; ?> </span>
              </div>
            </div>
            <hr>
            <div class='row'>
              <div class='col-8'>
                <span>TOTAL : </span>
              </div>
              <div class='col' style='text-align:center;'>
                <span> &#8377 <?php echo $total_price; ?> </span><br>
                <span style='font-weight:normal;font-size:10px;'>(Inclusive of all taxes)</span>
              </div>
            </div>
            <div class='row order-sum-footer'>
              <div class='col text-center'>
                <form method='post' action='./checkout.php'>
                  <button type='submit'><span>Place order</span></button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
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
            <a href="#"><img src="./icons/googleplay.png" /></a>
          </div>
          <div class="appstore">
            <a href="#"><img src="./icons/appstore.png" /></a>
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