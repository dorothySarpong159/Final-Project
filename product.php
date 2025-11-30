<?php
$pageTitle ="Product page";
$pageDesc = "Individual products available";
require_once './inc/Database.php';
require_once './inc/CrudOperations.php';

$db = (new Database())->getConnection();
$crud = new CrudOperations($db);

$id = $_GET['id'] ?? 0;
$product = $crud->readProduct($id);
//$images = $crud->readProductImages($id);
$images = [];
if($product['name'] === 'Casual Women Top'){
    $images = [
        ['image_path' => './img/P1color2.jpg'],
        ['image_path' => './img/P1color3.jpg'],
        ['image_path' => './img/P1color4.jpg']
    ];
}elseif($product['name'] === 'Baggy Women Jeans'){
    $images = [
        ['image_path' => './img/P2color2.jpg'],
        ['image_path' => './img/P2color3.jpg'],
        ['image_path' => './img/P2color4.jpg']
    ];
}elseif($product['name'] === 'Casual Women Hoodie for Fall/Winter'){
    $images = [
        ['image_path' => './img/P3color2.jpg'],
        ['image_path' => './img/P3color3.jpg'],
        ['image_path' => './img/P3color4.jpg']
    ];
}elseif($product['name'] === 'Men Short Sleeve T-Shirt'){
    $images = [
        ['image_path' => './img/P4color2.jpg'],
        ['image_path' => './img/P4color3.jpg'],
        ['image_path' => './img/P4color4.jpg']
    ];
}elseif($product['name'] === 'Men Denim Baggy Jeans'){
    $images = [
        ['image_path' => './img/P5color2.jpg'],
        ['image_path' => './img/P5color3.jpg'],
        ['image_path' => './img/P5color4.jpg']
    ];
}elseif($product['name'] === 'Men Hooded Sweatshirt'){
    $images = [
        ['image_path' => './img/P6color2.jpg'],
        ['image_path' => './img/P6color3.jpg'],
        ['image_path' => './img/P6color4.jpg']
    ];
}

require_once './templates/header.php';
?>

<main class="product-page">
        <?php if(!$product): ?>
        <div class="alert-box">No product was found.</div>
    <?php else: ?>

    <section class="product-detail">
        <div class="product-image-gallery">
            <img src="<?php echo $product['image_path'] ?>"
             alt="<?php echo htmlspecialchars($product['name']); ?>"
            class="product-image active">
           
           
        <?php foreach($images as $img): ?>
                <img src="<?php echo htmlspecialchars($img['image_path']) ?>"
                alt="<?php echo htmlspecialchars($product['name']); ?>"
                class="product-image">
            <?php endforeach; ?>

            <button class="gallery-nav prev" aria-label="Previous Image">&#10094;</button>
            <button class="gallery-nav next" aria-label="Next Image">&#10095;</button>
        </div>

        <div class="product-info">
            <h1><?php echo htmlspecialchars($product['name']) ?></h1>
            <p><?php echo htmlspecialchars($product['description']) ?></p>

            <div class="price-and-cart">
                <span class="price">$<?= number_format($product['price'], 2) ?></span>
                <button class="buy-button" id="add-to-cart"
                data-id="<?php echo  $product['product_id']; ?>"
                data-name="<?php echo htmlspecialchars($product['name']); ?>"
                data-price="<?php echo $product['price']; ?>"
                data-image="<?php echo  htmlspecialchars($product['image_path']); ?>">
                Add to Cart</button>
            </div>
        </div>
    </section>
     <div class="back-button-container">
        <a href="shop.php" class="back-btn">Back to Shop</a>
    </div>
    <?php endif; ?>
</main>
<?php require_once './templates/footer.php'; ?>