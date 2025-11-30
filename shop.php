<?php
//define our page title and description
$pageTitle = "Shop";
$pageDesc = "Explore the latest fashion collection";
require_once './templates/header.php';
require_once './inc/Database.php';
require_once './inc/CrudOperations.php';

$database = new Database();
$db = $database ->getConnection();
$crud = new CrudOperations($db);
$products = $crud->readProducts();
if($products === false){
        $readError = "No products found";
}

?>
<!-- main page -->
<main class="shop-page">
    <section class="shop-intro">
        <h1>Shop the latest fashion trends</h1>
        <p>Step into the world of fresh fits, trending styles, and bold confidence.</p>
</section>

<section class="product-grid">
        <h2 class="product-grid-title">Available Products</h2>
        <?php if($products && count($products) > 0): ?>
        <?php foreach($products as $product): ?>
        <article class="product-card">
                <a href="product.php?id=<?php echo $product['product_id'] ?>">
                <img src="<?php echo htmlspecialchars($product['image_path']) ?>"
                 alt="<?php echo htmlspecialchars($product['name'])?>">
                <h2><?php echo htmlspecialchars($product['name'])?></h2>
                </a>
<a href= "product.php?id=<?=$product['product_id']?>" class="view-btn">View Details</a>
</article>
<?php endforeach; ?>

<?php else: ?>
        <div class="alert-box">
                No products were found. Add Some!
        </div>  
        <?php endif; ?>
</section>
</main>
<?php require_once './templates/footer.php'; ?>
