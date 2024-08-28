<div class="title">
  <label>Diamond Products</label>
</div>
<div class="container1" id='chains'>
  <hr>
  <div class="container-title">Diamond Chains</div>
  <div class="products chain">
    <?php
      set_error_handler('diamond_session_notice_handler');

      function diamond_session_notice_handler($severity, $message, $filename, $lineno) {
        if (error_reporting() == 0) {
          return;
        }
        if (error_reporting() & $severity) {
          throw new ErrorException($message, 0, $severity, $filename, $lineno);
        }
      }
      
      try {
            session_start();
      } catch (Exception $e) {
            echo "";
      }
      include_once '../account/connection.php';
      $sql_cmd = "SELECT COUNT(category) from products WHERE category = 'Diamond Chain'";
      $result = $conn->query($sql_cmd);
      $row = mysqli_fetch_array($result);
      $count = $row[0];
      $sql_cmd = "SELECT * FROM products WHERE category = 'Diamond Chain'";
      $result = $conn->query($sql_cmd);
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
          $stone = 'Diamond';
          $cart_btn_state = 'enabled';
          $cart_btn_text = 'Add to Cart';
          

          $product_color = $row['color'];
          if($row['stock'] == 1){
            $stock = 'In Stock';
          }
          else{
            $stock = 'Un available';
          }
          
          $color_code = '#d8d8d8';
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
              <form action = '../addToFav.php' method = 'post'>
                <button id='toggle-fav-btn' class='fav-btn' name = 'product_id' value = '$id' type = 'submit'> 
                  <i class='material-icons' style='font-size: 40px; color : $color_code' id = '$id' onclick = 'toggle_fav_btn(event,$session_login,1)'>favorite</i> 
                </button>
              </form>
              <button style='border:none;background-color:transparent;' data-bs-toggle='modal' data-bs-target='#modal_$id'>
                <img src='Diamond/Chain/DC00$i.jpeg'>
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
                  <img src='Diamond/Chain/DC00$i.jpeg'>
                  </div>
                  <div class='product-deatils'>
                    <form action='../addToFav.php' method='post' class='modal-fav-btn'>
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
                      <span>Diamond color</span>
                      <select>
                        <option><span>$product_color</span></option>
                      </select>
                    </div>
                    <form action='../addtoCart.php' method='post' class='product-purchase-form'>
                      <button type='submit' name = 'product_id' value = '$id,$price,cart' class='btn btn-secondary cart-btn' id = 'cart_btn_$id' $cart_btn_state onclick = 'toggle_cart_btn(event,$session_login)'>
                        <span id = 'cart_text_$id'>$cart_btn_text</span>
                        <span class='material-symbols-outlined cart_loading' id = 'loading_icon_$id'>progress_activity</span>
                      </button>
                      <button type='submit' class='btn btn-primary buy-now-btn' name = 'product_id' value = '$id,$price,buy-now'><span>Buy now</span></button>
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
                    <img src='../certificates/bis-hallmarked.jpg'>
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
<div class="container1" id='earrings'>
  <div class="container-title">Diamond Earings</div>
  <div class="products earings">
    <?php
      $sql_cmd = "SELECT COUNT(category) from products WHERE category = 'Diamond Earring'";
      $result = $conn->query($sql_cmd);
      $row = mysqli_fetch_array($result);
      $count = $row[0];
      $sql_cmd = "SELECT * FROM products WHERE category = 'Diamond Earring'";
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
      
      $color_code = '#d8d8d8';
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
          <form action = '../addToFav.php' method = 'post'>
            <button id='toggle-fav-btn' class='fav-btn' name = 'product_id' value = '$id' type = 'submit'> 
              <i class='material-icons' style='font-size: 40px; color : $color_code' id = '$id' onclick = 'toggle_fav_btn(event,$session_login,1)'>favorite</i> 
            </button>
          </form>
          <button style='border:none;background-color:transparent;' data-bs-toggle='modal' data-bs-target='#modal_$id'>
            <img src='Diamond/Earring/DE00$i.jpeg'>
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
                <img src='Diamond/Earring/DE00$i.jpeg'>
              </div>
              <div class='product-deatils'>
                <form action='../addToFav.php' method='post' class='modal-fav-btn'>
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
                  <span>Diamond color</span>
                  <select>
                    <option><span>$product_color</span></option>
                  </select>
                </div>
                <form action='../addtoCart.php' method='post' class='product-purchase-form'>
                  <button type='submit' name = 'product_id' value = '$id,$price,cart' class='btn btn-secondary cart-btn' id = 'cart_btn_$id' $cart_btn_state onclick = 'toggle_cart_btn(event,$session_login)'>
                    <span id = 'cart_text_$id'>$cart_btn_text</span>
                    <span class='material-symbols-outlined cart_loading' id = 'loading_icon_$id'>progress_activity</span>
                  </button>
                  <button type='submit' class='btn btn-primary buy-now-btn' name = 'product_id' value = '$id,$price,buy-now'><span>Buy now</span></button>
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
                <img src='../certificates/bis-hallmarked.jpg'>
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
<div class="container1" id='rings'>
  <div class="container-title">Diamond Rings</div>
  <div class="products rings">
    <?php
      $sql_cmd = "SELECT COUNT(category) from products WHERE category = 'Diamond Ring'";
      $result = $conn->query($sql_cmd);
      $row = mysqli_fetch_array($result);
      $count = $row[0];
      $sql_cmd = "SELECT * FROM products WHERE category = 'Diamond Ring'";
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
        
        $color_code = '#d8d8d8';
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
            <form action = '../addToFav.php' method = 'post'>
              <button id='toggle-fav-btn' class='fav-btn' name = 'product_id' value = '$id' type = 'submit'> 
                <i class='material-icons' style='font-size: 40px; color : $color_code' id = '$id' onclick = 'toggle_fav_btn(event,$session_login,1)'>favorite</i> 
              </button>
            </form>
            <button style='border:none;background-color:transparent;' data-bs-toggle='modal' data-bs-target='#modal_$id'>
              <img src='Diamond/Ring/DR00$i.jpeg'>
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
                <img src='Diamond/Ring/DR00$i.jpeg'>
                </div>
                <div class='product-deatils'>
                  <form action='../addToFav.php' method='post' class='modal-fav-btn'>
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
                    <span>Diamond color</span>
                    <select>
                      <option><span>$product_color</span></option>
                    </select>
                  </div>
                  <form action='../addtoCart.php' method='post' class='product-purchase-form'>
                    <button type='submit' name = 'product_id' value = '$id,$price,cart' class='btn btn-secondary cart-btn' id = 'cart_btn_$id' $cart_btn_state onclick = 'toggle_cart_btn(event,$session_login)'>
                      <span id = 'cart_text_$id'>$cart_btn_text</span>
                      <span class='material-symbols-outlined cart_loading' id = 'loading_icon_$id'>progress_activity</span>
                    </button>
                    <button type='submit' class='btn btn-primary buy-now-btn' name = 'product_id' value = '$id,$price,buy-now'><span>Buy now</span></button>
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
                  <img src='../certificates/bis-hallmarked.jpg'>
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

<!-- Diamond Chains Modals Start here-->
<!-- <div class="modal fade" id="modal_DC001" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog change-modal-width">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">NSJ Diamond Chains</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class='product-content'>
            <div class="modal_img">
              <img src="diamond chain/dc-1.jpeg">
            </div>
            <div class="product-deatils">
              <form action='../addToFav.php' method='post' class='modal-fav-btn'>
                <button id='toggle-fav-btn' class='fav-btn' name='product_id' value='$id' type='submit'>
                  <i class='material-icons' style='font-size: 40px; color : $color_code !important' id='$id'
                    onclick='toggle_fav_btn(event,$session_login)'>favorite</i>
                </button>
              </form>
              <h1>Pendant Chain</h1>
              <span>Product Id : DC001 </span><br>
              <span>Free Shipping In India | Hallmarked jewellery available for sale</span>
              <hr>
              <span>Availability: <span style="font-weight:bolder;">In Stock</span></span>
              <br>
              <span style="font-weight:bolder;font-size:25px;"> &#8377 92800.00</span>
              <span style="font-size:12px;">(Inclusive of all taxes)</span>
              <br>
              <div class='product-color'>
                <span>Diamond color</span>
                <select>
                  <option><span>Rose Gold</span></option>
                </select>
              </div>
              <form class='product-purchase-form'>
                <button type='submit' class='btn btn-secondary cart-btn'><span>Add to cart</span></button>
                <button type='submit' class='btn btn-primary buy-now-btn'><span>Buy now</span></button>
              </form>
            </div>
          </div>
          <div class="modal-footer">
            <div class='group-contact grp-1'>
              <span style='font-weight:bolder'>Any Questions ? Please contact us at</span>
              <div class='child-contact child-1'>
                <i class='material-icons'>headset</i>
                <span>+91 22 62300916</span>
                <i class="material-icons">call</i>
                <span>+91 9167780916</span>
              </div>
            </div>
            <div class='group-contact grp-2'>
              <span style='font-weight:bolder;text-align:center;'>100% Certified by<br>
                International Standards</span>
            </div>
            <div class='group-contact grp-3'>
              <img src='../certificates/bis-hallmarked.jpg'>
            </div>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><span>Close</span></button>
          </div>
        </div>
      </div>
    </div>
  </div> -->
<!-- Diamond Chains Modals Start here -->