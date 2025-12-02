<?php
$pageTitle = "Individual product info page";
$pageDesc  = "View of a single product.";

// Load our database and crud
require_once './inc/Database.php';
require_once './inc/CrudOperations.php';

// Create Database Connection
$database = new Database();
$db = $database->getConnection();

// Create our CRUD handler
$crud = new CrudOperations($db);

$product = null;
$errorMessage = '';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = (int)$_GET['id'];
    $product = $crud->readProduct($id);

    if (!$product) {
        $errorMessage = "Error: Product not found.";
    }
} else {
    $errorMessage = "Error: Invalid or missing product ID.";
}

require_once './templates/header.php';
?>

<main class="page-container">
    <section class="page-content">
    <h1 class="page-heading">Product Details</h1>

    <?php if ($errorMessage): ?>
        <div class="message-error"><?php echo $errorMessage; ?></div>

    <?php else: ?>
        <div class="product-info-card-wrapper">

            <div class="product-image-area">
                <img src="<?php echo htmlspecialchars($product['image_path']); ?>"
                     class="product-card-image"
                     alt="<?php echo htmlspecialchars($product['name']); ?>">
            </div>

            <div class="product-details-content">
                <h2 class="product-card-name"><?php echo htmlspecialchars($product['name']); ?></h2>
                <p class="product-card-id">ID: <?php echo htmlspecialchars($product['product_id']); ?></p>

                <h4 class="detail-label">Description:</h4>
                <p class="detail-data product-description-data">
                    <?php echo htmlspecialchars($product['description']); ?>
                </p>

                <h4 class="detail-label">Price:</h4>
                <p class="detail-data product-price-data">
                    $<?php echo number_format($product['price'], 2); ?>
                </p>

               <p class="product-date">
                Product Added: <?php echo htmlspecialchars($product['created_at']); ?></p>

                <a href="adminproduct.php" class="button button-return product-card-button">
                    Back to All Products
                </a>
            </div>

        </div>
    <?php endif; ?>
    </section>
</main>

<?php require_once './templates/footer.php'; ?>
