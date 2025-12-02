<?php
//define our page title and description
   $pageTitle = "About FunDee";
   $pageDesc = "Learn more about us";
   require './templates/header.php';
?>

<!-- main page -->
<main class="about-page">
    <section class="about-section">
        <h1>About Our Brand</h1>
        <div class="about-container">
            <div class="about-text container">
            <p>
                FunDee's mission is to bring you timeless style and lasting quality. We believe true style is more than appearance - it is about confidence, comfort, and self-expression.
            </p>
            <p>
                Our collections are thoughtfully designed, not rushed, ensuring a comfortable fit and effortless look for every occasion.
            </p>
        </div>
        <div class="about-image-wrapper">
            <img src= "./img/img4.jpg" alt="Female Model">
        </div>
    </div>
    </section>  
    <!-- Mission section-->
    <section class="about-mission-section">
        <div class="about-mission-container">
            <div class="about-mission-image">
             <img src= "./img/img5.jpg" alt="Male Model">
            </div>

        <div class="about-mission-text">
            <h2>Our Mission: Creating Styles That Last Beyond Seasons</h2>
            <p>
                At FunDee Collection, we believe in fashion that empowers - clothes that tell your story, highlight your personality, and support a better future for all.
            </p>
           
</div>
</div>
</section>
</main>
<?php require './templates/footer.php'; ?>
