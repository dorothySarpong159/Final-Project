<?php
//define our page title and description
$pageTitle = "Home|FunDee Collection";
$pageDesc = "Welcome Page";
require_once './templates/header.php'
?>
<!-- main page -->
<main class="home-page">
    <!-- the carousel -->
    <section class="carousel-container">
        <!-- carousel slide -->
        <div class="carousel-slides">
            <div class="carousel-slide active">
                <img src="./img/carousel1.jpg" alt="Outfit on women">
                <div class="carousel-text">
                    <h1>Find Your Inner Diva</h1>
                    <p>Dive into your fashion world</p>
                    <a href="shop.php" class="cta-btn">Shop Now</a>
</div>
</div>
<div class="carousel-slide">
    <img src="./img/carousel2.jpg" alt="Outfit on men">
    <div class="carousel-text">
        <h2>Explore your true style</h2>
        <p>Discover looks that perfectly reflects your confidence and identity</p>
        <a href="shop.php" class="cta-btn">Explore</a>
</div>
</div>

<div class="carousel-slide">
    <img src="./img/carousel3.jpg" alt="Cozy female outfit">
    <div class="carousel-text">
        <h2>Feel trendy. Feel authentic</h2>
        <p>Wear what makes you comfortable and unique.</p>
        <a href="shop.php" class="cta-btn">Explore</a>
</div>
</div>
</div>
</section>

<section class="intro">
    <h2>Welcome to FunDee Collection</h2>
    <p>Where you get to explore your inner fashion by experiencing the trendiest clothes made for every moment, mood and movement.</p>
</section>
<!-- card section -->
<section class="features">
    <div class="feature-card">
        <img src="./img/img1.jpg" alt="Female models">
        <h2>Shop latest trends</h2>
        <p>Discover what's next in fashion by exploring fresh styles that keep you fashion-forward.</p>
</div>

<div class="feature-card">
        <img src="./img/img2.jpg" alt="Male and female models">
        <h2>Find your signature style.</h2>
        <p>Find fashion that celebrates your individuality</p>
</div>

<div class="feature-card">
        <img src="./img/img3.jpg" alt="Male model">
        <h2>Fashion at your fingertips</h2>
        <p>From screen to wardrobe, shop your style in seconds.</p>
</div>
</section>
</main>
<?php require_once './templates/footer.php'; ?>

