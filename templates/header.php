<?php
require_once './inc/Session.php';
Session::start();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- meta data -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $pageDesc ?>">
    <meta name="robots" content="noindex, nofollow">
    <meta charset="utf-8">
    <title><?php echo $pageTitle ?></title>

    <!-- 2 different fonts inserted-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Delius&display=swap" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Tinos:ital,wght@0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
   
    <!-- add our css file -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>

    <!--global header-->
    <header class= "global-header">

    <!-- navigation links -->

        <nav class="main-nav">

    <ul class="nav-center">
      <li><a href="index.php">Home</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="shop.php">Shop</a></li>
      <li><a href="contact.php">Contact</a></li>
    </ul>

    <ul class="nav-right">
      <li><a href="login.php">Login</a></li>
      <li><a href="cart.php">Cart</a></li>
    </ul>
  </nav>
</header>