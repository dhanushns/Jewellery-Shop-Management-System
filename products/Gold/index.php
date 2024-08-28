<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Custom stylesheet -->
<link rel="stylesheet" href="../stylesheet.css">
<link rel="stylesheet" href="/../NS_Jewells/globalStyleSheet.css">
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

<script src="../script.js"></script>

<title>NS - Gold product</title>
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
    <input type="text" name="search" placeholder="Search for Gold Jewellery, Diamond Jewellery, Silver and more...." />
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
    <a href="/../NS_Jewells/index.php">NS Jewellery</a>
    <button class="productButton">Products<i class="fa fa-plus"></i></button>
    <ul class="dropbox" style="background: transparent">
      <a href="../diamond">
        <li>Diamond</li>
      </a>
      <a href="../platinum">
        <li>Platinum</li>
      </a>
      <a href="">
        <li>Gold</li>
      </a>
      <a href="../silver">
        <li>Silver</li>
      </a>
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
    <div class="activeBox"></div>
  </div>

  <div class="title">
    <label>Gold Products</label>
  </div>
  <div class="container1">
    <hr>
    <div class="container-title">Gold Chains</div>
    <div class="products chain">
      <?php
      include_once '../../account/connection.php';
      $sql_cmd = "SELECT COUNT(category) from products WHERE category = 'GC'";
      $result = $conn->query($sql_cmd);
      $row = mysqli_fetch_array($result);
      $count = $row[0];
      $sql_cmd = "SELECT * FROM products WHERE category = 'GC'";
      $result = $conn->query("$sql_cmd");
      $session_login = 0;

      if(isset($_SESSION['username'])){
        $session_login = 1;
        $sql_cmd = "SELECT item_id from wishlist WHERE username = '$_SESSION[username]'";
        $product_fetch = mysqli_fetch_all($conn->query($sql_cmd),MYSQLI_NUM);
        $sql_cmd = "SELECT item_id from cart WHERE username = '$_SESSION[username]'";
        $cart_fetch = mysqli_fetch_all($conn->query($sql_cmd),MYSQLI_NUM);
       }
  
        for ($i = 1; $i <= $count; $i++) {
          
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          $name = $row["name"];
          $price = $row["price"];
          $id = $row['item_id'];
          $carot = $row['carot'];
          $stone = $row['stone'];
          $cart_btn_state = 'enabled';
          $cart_btn_text = 'Add to Cart';

          $product_color = $row['color'];
          if($row['stock'] == 1){
            $stock = 'In Stock';
          }
          else{
            $stock = 'Un available';
          }
          
          $color_code = 'white';
          $modal_color_code = '#d8d8d8';
          if(isset($_SESSION['username'])){
            foreach($product_fetch as $item){
              if($item[0] == $id){
                $color_code = '#9c03be';
                $modal_color_code = '#9c03be';
              }
            }
          }

          if(isset($_SESSION['username'])){
            foreach($cart_fetch as $item){
              if($item[0] == $id){
                $cart_btn_state = 'disabled';
                $cart_btn_text = 'Added to cart';
              }
            }
          }
        
          echo "<div class='group'>
              <form action = '../../addToFav.php' method = 'post'>
                <button id='toggle-fav-btn' class='fav-btn' name = 'product_id' value = '$id' type = 'submit'> 
                  <i class='material-icons' style='font-size: 40px; color : $color_code' id = '$id' onclick = 'toggle_fav_btn(event,$session_login,1)'>favorite</i> 
                </button>
              </form>
              <button style='border:none;background-color:transparent;' data-bs-toggle='modal' data-bs-target='#modal_$id'>
                <img src='chains/gc-$i.jpg'>
              </button>
              <div class='text-wrapper price'>$name  </div>
              <div class='text-wrapper price'>&#8377 $price</div>
            </div>";

            // Diamond Chains Modals
        echo 
        "<div class='modal fade' id='modal_$id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
          <div class='modal-dialog change-modal-width'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>NSJ Diamond Chains</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
              </div>
              <div class='modal-body'>
                <div class='product-content'>
                  <div class='modal_img'>
                    <img src='chains/gc-$i.jpg'>
                  </div>
                  <div class='product-deatils'>
                    <form action='../../addToFav.php' method='post' class='modal-fav-btn'>
                      <button id='toggle-fav-btn' class='fav-btn' name='product_id' value='$id' type='submit'>
                        <i class='material-icons' style='font-size: 40px; color : $modal_color_code !important' id='modal_fav_$id'
                          onclick='toggle_fav_btn(event,$session_login,2)'>favorite</i>
                      </button>
                    </form>
                    <h1>Pendant Chain</h1>
                    <span>Product Id : $id </span><br>
                    <span>Free Shipping In India | Hallmarked jewellery available for sale</span>
                    <hr>
                    <span>Availability: <span style='font-weight:bolder;'>$stock</span></span>
                    <br>
                    <div class = 'price-details'>
                      <div class = 'details-1'>
                        <ul>
                          <li><span style='font-weight:bolder;font-size:25px;'> &#8377 $price</span></li>
                          <li><span style='font-size:12px;'>(Inclusive of all taxes)</span></li>
                        <ul>
                      </div>
                      <div class = 'details-2'>
                        <span>Carat : <span style='font-weight:bolder;'>$carot ct</span></span>
                      </div>
                      <div class = 'details-3'>
                        <span>Stone : <span style='font-weight:bolder;'>$stone</span></span>
                      </div>
                    </div>
                    
                    <div class='product-color'>
                      <span>Metal color</span>
                      <select>
                        <option><span>$product_color</span></option>
                      </select>
                    </div>
                    <form action='../../addtoCart.php' method='post' class='product-purchase-form'>
                      <button type='submit' name = 'product_id' value = '$id' class='btn btn-secondary cart-btn' id = 'cart_btn_$id' $cart_btn_state onclick = 'toggle_cart_btn(event,$session_login)'>
                        <span id = 'cart_text_$id'>$cart_btn_text</span>
                        <span class='material-symbols-outlined cart_loading' id = 'loading_icon_$id'>progress_activity</span>
                      </button>
                      <button type='submit' class='btn btn-primary buy-now-btn'><span>Buy now</span></button>
                    </form>
                  </div>
                </div>
                <div class='modal-footer'>
                  <div class='group-contact grp-1'>
                    <span style='font-weight:bolder'>Any Questions ? Please contact us at</span>
                    <div class='child-contact child-1'>
                      <i class='material-icons'>headset</i>
                      <span>+91 22 62300916</span>
                      <i class='material-icons'>call</i>
                      <span>+91 9167780916</span>
                    </div>
                  </div>
                  <div class='group-contact grp-2'>
                    <span style='font-weight:bolder;text-align:center;'>100% Certified by<br>
                      International Standards</span>
                  </div>
                  <div class='group-contact grp-3'>
                    <img src='../../certificates/bis-hallmarked.jpg'>
                  </div>
                  <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'><span>Close</span></button>
                </div>
              </div>
            </div>
          </div>
        </div>";
        }
      ?>
    </div>

    <hr>
  </div>
  <div class="container1">
    <div class="container-title">Gold Earings</div>
    <div class="container-title">Jimiki Collections </div>
    <div class="products earings">
      <?php
      $sql_cmd = "SELECT COUNT(category) from products WHERE category = 'GEJ'";
      $result = $conn->query($sql_cmd);
      $row = mysqli_fetch_array($result);
      $count = $row[0];
      $sql_cmd = "SELECT * FROM products WHERE category = 'GEJ'";
      $result = $conn->query("$sql_cmd");
      $session_login = 0;

     if(isset($_SESSION['username'])){
      $session_login = 1;
      $sql_cmd = "SELECT item_id from wishlist WHERE username = '$_SESSION[username]'";
      $product_fetch = mysqli_fetch_all($conn->query($sql_cmd),MYSQLI_NUM);
     }

     for ($i = 1; $i <= $count; $i++) {
          
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $name = $row["name"];
      $price = $row["price"];
      $id = $row['item_id'];
      $carot = $row['carot'];
      $stone = $row['stone'];
      $cart_btn_state = 'enabled';
      $cart_btn_text = 'Add to Cart';

      $product_color = $row['color'];
      if($row['stock'] == 1){
        $stock = 'In Stock';
      }
      else{
        $stock = 'Un available';
      }
      
      $color_code = 'white';
      $modal_color_code = '#d8d8d8';
      if(isset($_SESSION['username'])){
        foreach($product_fetch as $item){
          if($item[0] == $id){
            $color_code = '#9c03be';
            $modal_color_code = '#9c03be';
          }
        }
      }

      if(isset($_SESSION['username'])){
        foreach($cart_fetch as $item){
          if($item[0] == $id){
            $cart_btn_state = 'disabled';
            $cart_btn_text = 'Added to cart';
          }
        }
      }
    
      echo "<div class='group'>
          <form action = '../../addToFav.php' method = 'post'>
            <button id='toggle-fav-btn' class='fav-btn' name = 'product_id' value = '$id' type = 'submit'> 
              <i class='material-icons' style='font-size: 40px; color : $color_code' id = '$id' onclick = 'toggle_fav_btn(event,$session_login,1)'>favorite</i> 
            </button>
          </form>
          <button style='border:none;background-color:transparent;' data-bs-toggle='modal' data-bs-target='#modal_$id'>
            <img src='earrings/Jimiki/GEJ-$i.jpeg'>
          </button>
          <div class='text-wrapper price'>$name  </div>
          <div class='text-wrapper price'>&#8377 $price</div>
        </div>";

        // Diamond Chains Modals
    echo 
    "<div class='modal fade' id='modal_$id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog change-modal-width'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>NSJ Diamond Chains</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <div class='modal-body'>
            <div class='product-content'>
              <div class='modal_img'>
                <img src='earrings/Jimiki/GEJ-$i.jpeg'>
              </div>
              <div class='product-deatils'>
                <form action='../../addToFav.php' method='post' class='modal-fav-btn'>
                  <button id='toggle-fav-btn' class='fav-btn' name='product_id' value='$id' type='submit'>
                    <i class='material-icons' style='font-size: 40px; color : $modal_color_code !important' id='modal_fav_$id'
                      onclick='toggle_fav_btn(event,$session_login,2)'>favorite</i>
                  </button>
                </form>
                <h1>$name</h1>
                <span>Product Id : $id </span><br>
                <span>Free Shipping In India | Hallmarked jewellery available for sale</span>
                <hr>
                <span>Availability: <span style='font-weight:bolder;'>$stock</span></span>
                <br>
                <div class = 'price-details'>
                  <div class = 'details-1'>
                    <ul>
                      <li><span style='font-weight:bolder;font-size:25px;'> &#8377 $price</span></li>
                      <li><span style='font-size:12px;'>(Inclusive of all taxes)</span></li>
                    <ul>
                  </div>
                  <div class = 'details-2'>
                    <span>Carat : <span style='font-weight:bolder;'>$carot ct</span></span>
                  </div>
                  <div class = 'details-3'>
                    <span>Stone : <span style='font-weight:bolder;'>$stone</span></span>
                  </div>
                </div>
                
                <div class='product-color'>
                  <span>Metal color</span>
                  <select>
                    <option><span>$product_color</span></option>
                  </select>
                </div>
                <form action='../../addtoCart.php' method='post' class='product-purchase-form'>
                  <button type='submit' name = 'product_id' value = '$id' class='btn btn-secondary cart-btn' id = 'cart_btn_$id' $cart_btn_state onclick = 'toggle_cart_btn(event,$session_login)'>
                    <span id = 'cart_text_$id'>$cart_btn_text</span>
                    <span class='material-symbols-outlined cart_loading' id = 'loading_icon_$id'>progress_activity</span>
                  </button>
                  <button type='submit' class='btn btn-primary buy-now-btn'><span>Buy now</span></button>
                </form>
              </div>
            </div>
            <div class='modal-footer'>
              <div class='group-contact grp-1'>
                <span style='font-weight:bolder'>Any Questions ? Please contact us at</span>
                <div class='child-contact child-1'>
                  <i class='material-icons'>headset</i>
                  <span>+91 22 62300916</span>
                  <i class='material-icons'>call</i>
                  <span>+91 9167780916</span>
                </div>
              </div>
              <div class='group-contact grp-2'>
                <span style='font-weight:bolder;text-align:center;'>100% Certified by<br>
                  International Standards</span>
              </div>
              <div class='group-contact grp-3'>
                <img src='../../certificates/bis-hallmarked.jpg'>
              </div>
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'><span>Close</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>";
    }
      ?>
    </div>


    <!-- Antique Collections -->
    <div class="container-title">Antique Collections </div>
    <div class="products earings">
      <?php
      $sql_cmd = "SELECT COUNT(category) from products WHERE category = 'GEA'";
      $result = $conn->query($sql_cmd);
      $row = mysqli_fetch_array($result);
      $count = $row[0];
      $sql_cmd = "SELECT * FROM products WHERE category = 'GEA'";
      $result = $conn->query("$sql_cmd");
      $session_login = 0;

     if(isset($_SESSION['username'])){
      $session_login = 1;
      $sql_cmd = "SELECT item_id from wishlist WHERE username = '$_SESSION[username]'";
      $product_fetch = mysqli_fetch_all($conn->query($sql_cmd),MYSQLI_NUM);
     }

     for ($i = 1; $i <= $count; $i++) {
          
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $name = $row["name"];
      $price = $row["price"];
      $id = $row['item_id'];
      $carot = $row['carot'];
      $stone = $row['stone'];
      $cart_btn_state = 'enabled';
      $cart_btn_text = 'Add to Cart';

      $product_color = $row['color'];
      if($row['stock'] == 1){
        $stock = 'In Stock';
      }
      else{
        $stock = 'Un available';
      }
      
      $color_code = 'white';
      $modal_color_code = '#d8d8d8';
      if(isset($_SESSION['username'])){
        foreach($product_fetch as $item){
          if($item[0] == $id){
            $color_code = '#9c03be';
            $modal_color_code = '#9c03be';
          }
        }
      }

      if(isset($_SESSION['username'])){
        foreach($cart_fetch as $item){
          if($item[0] == $id){
            $cart_btn_state = 'disabled';
            $cart_btn_text = 'Added to cart';
          }
        }
      }
    
      echo "<div class='group'>
          <form action = '../../addToFav.php' method = 'post'>
            <button id='toggle-fav-btn' class='fav-btn' name = 'product_id' value = '$id' type = 'submit'> 
              <i class='material-icons' style='font-size: 40px; color : $color_code' id = '$id' onclick = 'toggle_fav_btn(event,$session_login,1)'>favorite</i> 
            </button>
          </form>
          <button style='border:none;background-color:transparent;' data-bs-toggle='modal' data-bs-target='#modal_$id'>
            <img src='earrings/antique/GEA-$i.jpeg'>
          </button>
          <div class='text-wrapper price'>$name  </div>
          <div class='text-wrapper price'>&#8377 $price</div>
        </div>";

        // Diamond Chains Modals
    echo 
    "<div class='modal fade' id='modal_$id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog change-modal-width'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>NSJ Diamond Chains</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <div class='modal-body'>
            <div class='product-content'>
              <div class='modal_img'>
                <img src='earrings/antique/GEA-$i.jpeg'>
              </div>
              <div class='product-deatils'>
                <form action='../../addToFav.php' method='post' class='modal-fav-btn'>
                  <button id='toggle-fav-btn' class='fav-btn' name='product_id' value='$id' type='submit'>
                    <i class='material-icons' style='font-size: 40px; color : $modal_color_code !important' id='modal_fav_$id'
                      onclick='toggle_fav_btn(event,$session_login,2)'>favorite</i>
                  </button>
                </form>
                <h1>$name</h1>
                <span>Product Id : $id </span><br>
                <span>Free Shipping In India | Hallmarked jewellery available for sale</span>
                <hr>
                <span>Availability: <span style='font-weight:bolder;'>$stock</span></span>
                <br>
                <div class = 'price-details'>
                  <div class = 'details-1'>
                    <ul>
                      <li><span style='font-weight:bolder;font-size:25px;'> &#8377 $price</span></li>
                      <li><span style='font-size:12px;'>(Inclusive of all taxes)</span></li>
                    <ul>
                  </div>
                  <div class = 'details-2'>
                    <span>Carat : <span style='font-weight:bolder;'>$carot ct</span></span>
                  </div>
                  <div class = 'details-3'>
                    <span>Stone : <span style='font-weight:bolder;'>$stone</span></span>
                  </div>
                </div>
                
                <div class='product-color'>
                  <span>Metal color</span>
                  <select>
                    <option><span>$product_color</span></option>
                  </select>
                </div>
                <form action='../../addtoCart.php' method='post' class='product-purchase-form'>
                  <button type='submit' name = 'product_id' value = '$id' class='btn btn-secondary cart-btn' id = 'cart_btn_$id' $cart_btn_state onclick = 'toggle_cart_btn(event,$session_login)'>
                    <span id = 'cart_text_$id'>$cart_btn_text</span>
                    <span class='material-symbols-outlined cart_loading' id = 'loading_icon_$id'>progress_activity</span>
                  </button>
                  <button type='submit' class='btn btn-primary buy-now-btn'><span>Buy now</span></button>
                </form>
              </div>
            </div>
            <div class='modal-footer'>
              <div class='group-contact grp-1'>
                <span style='font-weight:bolder'>Any Questions ? Please contact us at</span>
                <div class='child-contact child-1'>
                  <i class='material-icons'>headset</i>
                  <span>+91 22 62300916</span>
                  <i class='material-icons'>call</i>
                  <span>+91 9167780916</span>
                </div>
              </div>
              <div class='group-contact grp-2'>
                <span style='font-weight:bolder;text-align:center;'>100% Certified by<br>
                  International Standards</span>
              </div>
              <div class='group-contact grp-3'>
                <img src='../../certificates/bis-hallmarked.jpg'>
              </div>
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'><span>Close</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>";
    }
      ?>
    </div>

    <div class="container-title">Elegant Collections </div>
    <div class="products earings">
      <?php
      $sql_cmd = "SELECT COUNT(category) from products WHERE category = 'GEE'";
      $result = $conn->query($sql_cmd);
      $row = mysqli_fetch_array($result);
      $count = $row[0];
      $sql_cmd = "SELECT * FROM products WHERE category = 'GEE'";
      $result = $conn->query("$sql_cmd");
      $session_login = 0;

     if(isset($_SESSION['username'])){
      $session_login = 1;
      $sql_cmd = "SELECT item_id from wishlist WHERE username = '$_SESSION[username]'";
      $product_fetch = mysqli_fetch_all($conn->query($sql_cmd),MYSQLI_NUM);
     }

     for ($i = 1; $i <= $count; $i++) {
          
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      $name = $row["name"];
      $price = $row["price"];
      $id = $row['item_id'];
      $carot = $row['carot'];
      $stone = $row['stone'];
      $cart_btn_state = 'enabled';
      $cart_btn_text = 'Add to Cart';

      $product_color = $row['color'];
      if($row['stock'] == 1){
        $stock = 'In Stock';
      }
      else{
        $stock = 'Un available';
      }
      
      $color_code = 'white';
      $modal_color_code = '#d8d8d8';
      if(isset($_SESSION['username'])){
        foreach($product_fetch as $item){
          if($item[0] == $id){
            $color_code = '#9c03be';
            $modal_color_code = '#9c03be';
          }
        }
      }

      if(isset($_SESSION['username'])){
        foreach($cart_fetch as $item){
          if($item[0] == $id){
            $cart_btn_state = 'disabled';
            $cart_btn_text = 'Added to cart';
          }
        }
      }
    
      echo "<div class='group'>
          <form action = '../../addToFav.php' method = 'post'>
            <button id='toggle-fav-btn' class='fav-btn' name = 'product_id' value = '$id' type = 'submit'> 
              <i class='material-icons' style='font-size: 40px; color : $color_code' id = '$id' onclick = 'toggle_fav_btn(event,$session_login,1)'>favorite</i> 
            </button>
          </form>
          <button style='border:none;background-color:transparent;' data-bs-toggle='modal' data-bs-target='#modal_$id'>
            <img src='earrings/elegant/GEE-$i.jpeg'>
          </button>
          <div class='text-wrapper price'>$name  </div>
          <div class='text-wrapper price'>&#8377 $price</div>
        </div>";

        // Diamond Chains Modals
    echo 
    "<div class='modal fade' id='modal_$id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
      <div class='modal-dialog change-modal-width'>
        <div class='modal-content'>
          <div class='modal-header'>
            <h5 class='modal-title' id='exampleModalLabel'>NSJ Diamond Chains</h5>
            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
          </div>
          <div class='modal-body'>
            <div class='product-content'>
              <div class='modal_img'>
                <img src='earrings/elegant/GEE-$i.jpeg'>
              </div>
              <div class='product-deatils'>
                <form action='../../addToFav.php' method='post' class='modal-fav-btn'>
                  <button id='toggle-fav-btn' class='fav-btn' name='product_id' value='$id' type='submit'>
                    <i class='material-icons' style='font-size: 40px; color : $modal_color_code !important' id='modal_fav_$id'
                      onclick='toggle_fav_btn(event,$session_login,2)'>favorite</i>
                  </button>
                </form>
                <h1>$name</h1>
                <span>Product Id : $id </span><br>
                <span>Free Shipping In India | Hallmarked jewellery available for sale</span>
                <hr>
                <span>Availability: <span style='font-weight:bolder;'>$stock</span></span>
                <br>
                <div class = 'price-details'>
                  <div class = 'details-1'>
                    <ul>
                      <li><span style='font-weight:bolder;font-size:25px;'> &#8377 $price</span></li>
                      <li><span style='font-size:12px;'>(Inclusive of all taxes)</span></li>
                    <ul>
                  </div>
                  <div class = 'details-2'>
                    <span>Carat : <span style='font-weight:bolder;'>$carot ct</span></span>
                  </div>
                  <div class = 'details-3'>
                    <span>Stone : <span style='font-weight:bolder;'>$stone</span></span>
                  </div>
                </div>
                
                <div class='product-color'>
                  <span>Metal color</span>
                  <select>
                    <option><span>$product_color</span></option>
                  </select>
                </div>
                <form action='../../addtoCart.php' method='post' class='product-purchase-form'>
                  <button type='submit' name = 'product_id' value = '$id' class='btn btn-secondary cart-btn' id = 'cart_btn_$id' $cart_btn_state onclick = 'toggle_cart_btn(event,$session_login)'>
                    <span id = 'cart_text_$id'>$cart_btn_text</span>
                    <span class='material-symbols-outlined cart_loading' id = 'loading_icon_$id'>progress_activity</span>
                  </button>
                  <button type='submit' class='btn btn-primary buy-now-btn'><span>Buy now</span></button>
                </form>
              </div>
            </div>
            <div class='modal-footer'>
              <div class='group-contact grp-1'>
                <span style='font-weight:bolder'>Any Questions ? Please contact us at</span>
                <div class='child-contact child-1'>
                  <i class='material-icons'>headset</i>
                  <span>+91 22 62300916</span>
                  <i class='material-icons'>call</i>
                  <span>+91 9167780916</span>
                </div>
              </div>
              <div class='group-contact grp-2'>
                <span style='font-weight:bolder;text-align:center;'>100% Certified by<br>
                  International Standards</span>
              </div>
              <div class='group-contact grp-3'>
                <img src='../../certificates/bis-hallmarked.jpg'>
              </div>
              <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'><span>Close</span></button>
            </div>
          </div>
        </div>
      </div>
    </div>";
    }
      ?>
    </div>

  </div>

  <hr>
  <div class="container1">
    <div class="container-title">Gold Rings</div>
    <div class="products rings">
      <?php
      $sql_cmd = "SELECT COUNT(category) from products WHERE category = 'GR'";
      $result = $conn->query($sql_cmd);
      $row = mysqli_fetch_array($result);
      $count = $row[0];
      $sql_cmd = "SELECT * FROM products WHERE category = 'GR'";
      $result = $conn->query("$sql_cmd");
      $session_login = 0;

      if(isset($_SESSION['username'])){
        $session_login = 1;
        $sql_cmd = "SELECT item_id from wishlist WHERE username = '$_SESSION[username]'";
        $product_fetch = mysqli_fetch_all($conn->query($sql_cmd),MYSQLI_NUM);
       }
  
       for ($i = 1; $i <= $count; $i++) {
          
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $name = $row["name"];
        $price = $row["price"];
        $id = $row['item_id'];
        $carot = $row['carot'];
        $stone = $row['stone'];
        $cart_btn_state = 'enabled';
        $cart_btn_text = 'Add to Cart';
  
        $product_color = $row['color'];
        if($row['stock'] == 1){
          $stock = 'In Stock';
        }
        else{
          $stock = 'Un available';
        }
        
        $color_code = 'white';
        $modal_color_code = '#d8d8d8';
        if(isset($_SESSION['username'])){
          foreach($product_fetch as $item){
            if($item[0] == $id){
              $color_code = '#9c03be';
              $modal_color_code = '#9c03be';
            }
          }
        }
  
        if(isset($_SESSION['username'])){
          foreach($cart_fetch as $item){
            if($item[0] == $id){
              $cart_btn_state = 'disabled';
              $cart_btn_text = 'Added to cart';
            }
          }
        }
      
        echo "<div class='group'>
            <form action = '../../addToFav.php' method = 'post'>
              <button id='toggle-fav-btn' class='fav-btn' name = 'product_id' value = '$id' type = 'submit'> 
                <i class='material-icons' style='font-size: 40px; color : $color_code' id = '$id' onclick = 'toggle_fav_btn(event,$session_login,1)'>favorite</i> 
              </button>
            </form>
            <button style='border:none;background-color:transparent;' data-bs-toggle='modal' data-bs-target='#modal_$id'>
              <img src='rings/GR-$i.jpg'>
            </button>
            <div class='text-wrapper price'>$name  </div>
            <div class='text-wrapper price'>&#8377 $price</div>
          </div>";
  
          // Diamond Chains Modals
      echo 
      "<div class='modal fade' id='modal_$id' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
        <div class='modal-dialog change-modal-width'>
          <div class='modal-content'>
            <div class='modal-header'>
              <h5 class='modal-title' id='exampleModalLabel'>NSJ Diamond Chains</h5>
              <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
            </div>
            <div class='modal-body'>
              <div class='product-content'>
                <div class='modal_img'>
                  <img src='rings/GR-$i.jpg'>
                </div>
                <div class='product-deatils'>
                  <form action='../../addToFav.php' method='post' class='modal-fav-btn'>
                    <button id='toggle-fav-btn' class='fav-btn' name='product_id' value='$id' type='submit'>
                      <i class='material-icons' style='font-size: 40px; color : $modal_color_code !important' id='modal_fav_$id'
                        onclick='toggle_fav_btn(event,$session_login,2)'>favorite</i>
                    </button>
                  </form>
                  <h1>$name</h1>
                  <span>Product Id : $id </span><br>
                  <span>Free Shipping In India | Hallmarked jewellery available for sale</span>
                  <hr>
                  <span>Availability: <span style='font-weight:bolder;'>$stock</span></span>
                  <br>
                  <div class = 'price-details'>
                    <div class = 'details-1'>
                      <ul>
                        <li><span style='font-weight:bolder;font-size:25px;'> &#8377 $price</span></li>
                        <li><span style='font-size:12px;'>(Inclusive of all taxes)</span></li>
                      <ul>
                    </div>
                    <div class = 'details-2'>
                      <span>Carat : <span style='font-weight:bolder;'>$carot ct</span></span>
                    </div>
                    <div class = 'details-3'>
                      <span>Stone : <span style='font-weight:bolder;'>$stone</span></span>
                    </div>
                  </div>
                  
                  <div class='product-color'>
                    <span>Diamond color</span>
                    <select>
                      <option><span>$product_color</span></option>
                    </select>
                  </div>
                  <form action='../../addtoCart.php' method='post' class='product-purchase-form'>
                    <button type='submit' name = 'product_id' value = '$id' class='btn btn-secondary cart-btn' id = 'cart_btn_$id' $cart_btn_state onclick = 'toggle_cart_btn(event,$session_login)'>
                      <span id = 'cart_text_$id'>$cart_btn_text</span>
                      <span class='material-symbols-outlined cart_loading' id = 'loading_icon_$id'>progress_activity</span>
                    </button>
                    <button type='submit' class='btn btn-primary buy-now-btn'><span>Buy now</span></button>
                  </form>
                </div>
              </div>
              <div class='modal-footer'>
                <div class='group-contact grp-1'>
                  <span style='font-weight:bolder'>Any Questions ? Please contact us at</span>
                  <div class='child-contact child-1'>
                    <i class='material-icons'>headset</i>
                    <span>+91 22 62300916</span>
                    <i class='material-icons'>call</i>
                    <span>+91 9167780916</span>
                  </div>
                </div>
                <div class='group-contact grp-2'>
                  <span style='font-weight:bolder;text-align:center;'>100% Certified by<br>
                    International Standards</span>
                </div>
                <div class='group-contact grp-3'>
                  <img src='../../certificates/bis-hallmarked.jpg'>
                </div>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'><span>Close</span></button>
              </div>
            </div>
          </div>
        </div>
      </div>";
      }
      ?>
    </div>
  </div>

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
            <a href="#"><img src="../../icons/googleplay.png" /></a>
          </div>
          <div class="appstore">
            <a href="#"><img src="../../icons/appstore.png" /></a>
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

</html>