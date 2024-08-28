<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Custom stylesheet -->
<link rel="stylesheet" href="stylesheet.css">
<link rel="stylesheet" href="../globalStyleSheet.css">
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
if(isset($_GET['category']))
  echo "<title>NS - $_GET[category] product</title>";
?>

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

  <div class="title" style='color:#9657b1'>NSJ Store</div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
        aria-expanded="true" aria-controls="collapseOne" style='text-align:center;'>
        Diamond Products
      </button>
    </h2>
    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
      data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <?php
        include 'diamond_products.php';
        ?>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo"
        aria-expanded="true" aria-controls="collapseOne">
        Gold Products
      </button>
    </h2>
    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingOne"
      data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <?php
        include 'gold_products.php';
        ?>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree"
        aria-expanded="true" aria-controls="collapseOne">
        Paltinum Products
      </button>
    </h2>
    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingOne"
      data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <?php
        include 'platinum_products.php';
        ?>
      </div>
    </div>
  </div>

  <div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour"
        aria-expanded="true" aria-controls="collapseOne">
        Silver Products
      </button>
    </h2>
    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingOne"
      data-bs-parent="#accordionExample">
      <div class="accordion-body">
        <?php
        include 'silver_products.php';
        ?>
      </div>
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
            <a href="#"><img src="../icons/googleplay.png" /></a>
          </div>
          <div class="appstore">
            <a href="#"><img src="../icons/appstore.png" /></a>
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