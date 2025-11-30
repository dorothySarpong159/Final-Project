<?php
$pageTitle ="Edit page";
$pageDesc = "Editing and updating products";
require_once './inc/Session.php';
require_once './inc/Database.php';
require_once './inc/CrudOperations.php';
require_once './templates/header.php';

if(!Session::isLoggedIn()){
    header('Location: login.php');
    exit;
}

$database = new Database();
$db = $database->getConnection();
$crud = new CrudOperations($db);

$id = $_GET['id'] ?? 0;
$product = $crud->readProduct($id);
$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $data = [
        'name' => trim($_POST['name']),
        'description' => trim($_POST['description']),
        'price' => trim($_POST['price']),
        'image_path' => trim($_POST['image_path'])
    ];
$result = $crud->updateProduct($id, $data);
$message = $result['message'];
$product = $crud->readProduct($id);
}

?>
<main class="edit-page">
    <section class="edit-container">
        <h1>Edit Product</h1>
        <?php if($message): ?>
            <div class="alert-box"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <?php if ($product): ?>
            <form method="POST">
                <label>Name:</label>
                <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>

                <label>Description:</label>
                <textarea name="description" required><?php echo htmlspecialchars($product['description']); ?></textarea>

                <label>Price:</label>
                <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>

                <label>Current Image:</label>
                <input type="text" name="image_path" value="<?php echo htmlspecialchars($product['image_path']); ?>" required>
                <img src="<?php echo htmlspecialchars($product['image_path']); ?>"
                        alt="<?php echo htmlspecialchars($product['name']); ?>"
                        class="product-img">
                <button type="submit" class="btn">Update Product</button>
            </form>
        <?php else: ?>
            <div class="alert-box">Product not found.</div>
        <?php endif; ?>
    </section>
</main>

<?php require_once './templates/footer.php'; ?>