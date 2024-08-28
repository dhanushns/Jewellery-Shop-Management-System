<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="stylesheet.css">
  <link rel="stylesheet" href="globalStyleSheet.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="script.js"></script>
  <title>Home</title>
  <style>
    .slide {
      display: none;
    }

    img {
      vertical-align: middle;
    }

    .slideshow {
      max-width: 100%;
      margin: auto;
    }
  </style>
</head>

<body>
  <?php
  include_once 'add_product.php';
  session_start();
  $_SESSION["once"] = TRUE;
  if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
  }
  ?>
  <div class="nav" style="background-color: #f2e9e9">
    <h3>NS Jewellers</h3>
    <?php
    echo "<form class = 'search_form' method = 'post' action = './products/search.php'>
      <input type='text' name='search' placeholder='Search for Gold Jewellery, Diamond Jewellery, Silver and more....' />
      <i class='material-icons search_icon search' style='font-size: 30px'>search</i>
    </form>";
    ?>
    <div class='right_top_nav'>
      <a href="./products/store.php" class="toggle_nav"><i class="material-icons store" style="font-size: 30px">store</i></a>
      <a href='./customer/wishlist' class="toggle_nav"><i class="material-icons fav" style="font-size: 30px">favorite</i></a>
      <a href="./cart.php" class='toggle_nav'><i class="material-icons cart" style="font-size: 30px">shopping_cart</i></a>
      <i class="fa fa-bars bar" style="font-size: 30px"></i>
    </div>
  </div>
  <div class="sideNav">
    <button class="closebtn" style="border: none; background: transparent">
      <i class="fa fa-close"></i>
    </button>
    <a href="index.php">NS Jewellery</a>
    <button class="productButton">Products<i class="fa fa-plus"></i></button>
    <ul class="dropbox" style="background: transparent">
      <?php
      echo '<a href="products/index.php?category=' . 'Diamond' . '">
          <li>Diamond</li>
          </a>';

      echo '<a href="products/index.php?category=' . 'Platinum' . '">
          <li>Platinum</li>
          </a>';

      echo '<a href="products/index.php?category=' . 'Gold' . '">
          <li>Gold</li>
          </a>';

      echo '<a href="products/index.php?category=' . 'Silver' . '">
          <li>Silver</li>
          </a>';
      ?>
    </ul>
    <a href=<?php
            if (isset($username))
              echo "./customer/account/";
            else
              echo '"./account/index.html"';
            ?>><?php
                if (isset($username))
                  echo "Account";
                else
                  echo "Login";
                ?></a>
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
  <div class="slideshow">
    <div class="slide fade">
      <img src="slideshow images/img1.png" style="width: 100%" />
    </div>
    <div class="slide fade">
      <img src="slideshow images/img2.png" style="width: 100%" />
    </div>
    <div class="slide fade">
      <img src="slideshow images/img3.png" style="width: 100%" />
    </div>
    <div class="slide fade">
      <img src="slideshow images/img4.png" style="width: 100%" />
    </div>
  </div>
  <div style="text-align: center; margin-left: 40px">
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
    <span class="dot"></span>
  </div>
  <script>
    let slideIndex = 0;
    let textSlideIndex = 0;
    showSlides();

    function showSlides() {
      let i;
      let imageSlides = document.getElementsByClassName("slide");
      let dots = document.getElementsByClassName("dot");
      for (i = 0; i < imageSlides.length; i++) {
        imageSlides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > imageSlides.length) {
        slideIndex = 1;
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" active", "");
      }
      imageSlides[slideIndex - 1].style.display = "block";
      dots[slideIndex - 1].className += " active";
      setTimeout(showSlides, 5000);
      showTextSlides();
    }

    function showTextSlides() {
      let i;
      let imageSlides = document.getElementsByClassName("box");
      let dots = document.getElementsByClassName("text");
      for (i = 0; i < imageSlides.length; i++) {
        imageSlides[i].style.display = "none";
      }
      textSlideIndex++;
      if (textSlideIndex > imageSlides.length) {
        textSlideIndex = 1;
      }
      for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" activeText", "");
      }
      imageSlides[textSlideIndex - 1].style.display = "block";
      dots[textSlideIndex - 1].className += " activeText";
      return;
    }
  </script>
  <div class="heritage">
    <h2 style="text-align: center">
      OUR HERITAGE
      <hr style="width: 10%" />
    </h2>
    <p>
      NS Jewels - a stellar concept store envisioned by Late Sri A.S.
      Adhinarayanan @ Sridhar from the house of 92 years heritage<br />
      NS Kumbakonam Jewellers group based in Salem
    </p>
    <p>
      Founded in 1928 by Late Sri. A.R. Balasubramaniam Chettiar and Late Sri
      A.B. Adhinarayanan Chettiar, primarily as silver articles merchants.
      Later the business was continued by Late A.N. Srinivasa Guptha & Sons
      and Late Sri A.V. Ramachandra Chettiar & Sons. The family run enterprise
      laid a solid foundation in the business of gold jewellery and silver
      wares. With the advent of Late Sri A.S.Adhinarayanan @ Sridhar in the
      1960s, the enterprise further grew as a hallmark of hi-quality and
      perfection.<a href="#" style="text-decoration: none; color: rgb(139, 58, 58)">
        Read more..</a>
    </p>
  </div>
  <h2 style="text-align: center; margin-top: 100px">
    PRODUCT CATEGORIES
    <hr style="width: 10%" />
  </h2>
  <div class="productBox">
    <div class="products"><a href="./products/index.php?category=Diamond"><img src="products/banners/diamond [ED85EC5].png" /></a></div>
    <div class="products"><a href="./products/index.php?category=Platinum"><img src="products/banners/Platinum [643D277].png" /></a></div>
    <div class="products"><a href="./products/index.php?category=Gold"><img src="products/banners/gold [6D57F30].png" /></a></div>
    <div class="products"><a href="./products/index.php?category=Silver"><img src="products/banners/silver [3BC5329].png" /></a></div>
  </div>
  <br />
  <h2 style="text-align: center">
    TESTIMONIALS
    <hr style="width: 8%" />
  </h2>
  <div class="testimonials">
    <div class="box mov">
      <p>
        NS Jewells has been the store I go to everytime. I am always impressed
        by their tasteful, creative and vibrant collection. It is a family
        tradition now to hold a piece of jewellery from NS Jewells.<br />
        - AADHIRAI, ERODE
      </p>
    </div>
    <div class="box mov">
      <p>
        We have been shopping at NS Jewells right from the initial years. We
        bought my wedding jewellery as well as my daughters from them. We
        always enjoy the hospitality they offer at the store and their wide
        ranging collections.<br />
        - RUKMINI, SALEM
      </p>
    </div>
    <div class="box mov">
      <p>
        NS Jewells is a very nice place to buy gold jewellery. It is also a
        lucky place for me. Their customer service is so good and they also
        celebrate our precious moments with them.<br />
        - KASTHOORI EZHILMANI, SALEM
      </p>
    </div>
    <div class="box mov">
      <p>
        Finest jewellers in Salem. Kids activity center takes care of your
        kids when you shop. Serene Ambience and supportive staff members.<br />
        - SIVAKUMAR, SALEM
      </p>
    </div>
  </div>
  <div class="textContainer" style="position: absolute; left: 46%">
    <span class="text"></span>
    <span class="text"></span>
    <span class="text"></span>
    <span class="text"></span>
  </div>
  <h2 style="text-align: center; margin-top: 100px">
    DESIGN YOUR OWN JEWELLERY
    <hr style="width: 8%" />
  </h2>
  <div class="customeClass">
    <p>
      Fancy a customized design for yourself? Bring us your design and we will
      help you craft your dreams with a brilliant craftsmanship.
    </p>
    <button type = 'button' class="customeButton">Custome</button>
  </div>

  <!-- Footer -->
  <div class="end">
    <div class="footer-row">
      <div class="links">
        <ul>
          <label>Useful Links</label>
          <li><a href="#">Delivery information</a></li>
          <li><a href="#">International Shipping</a></li>
          <li><a href="#">Payment Options</a></li>
          <li><a href="#">Track Your Order</a></li>
          <li><a href="#">Returns</a></li>
          <li><a href="#">Find a Store</a></li>
        </ul>
      </div>
      <div class="contact">
        <ul style="list-style: none">
          <label>Contact Us</label>
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
        <ul style="list-style: none">
          <label>Information</label>
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