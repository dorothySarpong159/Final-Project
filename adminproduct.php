<?php
$pageTitle ="Admin page";
$pageDesc = "Admin page to delete and edit";
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
$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $data = [
        'name' => trim($_POST['name']),
        'description' => trim($_POST['description']),
        'price' => trim($_POST['price']),
        //'image_path' => trim($_POST['image_path'])
    ];
    $result = $crud->createProduct($data);
    $message = $result['message'];
}

if (isset($_GET['delete'])){
    $id = $_GET['delete'];
    $result = $crud->deleteProduct($id);
    $message = $result['message'];
}
$products = $crud->readProducts();
?>
<main class="admin-page">
    <section class="admin-container">
        <h1>Add a New Product</h1>
        <?php if ($message): ?>
            <div class="alert-box"><?php echo htmlspecialchars($message); ?></div>
            <?php endif; ?>

            <form method = "POST" enctype="multipart/form-data">
                <label>Name:</label>
                <input type="text" name="name" required>

                <label>Description:</label>
                <textarea name="description" required></textarea>

                <label>Price:</label>
                <input type="number" name="price" required>

                <label>Image File</label>
                <input type="file" name="image_path" required>

                <button type="submit" class="btn">Add Product</button>
        </form>

            <h2>All Products</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Date Added</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if($products && count ($products) > 0): ?>
                        <?php foreach ($products as $product): ?>
                            <tr>
                                <td><?php echo $product['product_id']; ?></td>
                                <td>
                                <img src="<?php echo htmlspecialchars($product['image_path']); ?>"
                                     alt="<?php echo htmlspecialchars($product['name']); ?>"
                                     class="product-img">
                                </td>
                                <td><?php echo htmlspecialchars($product['name']); ?></td>
                                <td><?php echo htmlspecialchars($product['description']); ?></td>
                                <td><?php echo number_format($product['price'], 2); ?></td>
                                <td><?php echo htmlspecialchars($product['created_at']); ?></td>
                                <td><a href="?delete=<?php echo $product['product_id']; ?>" class="delete-link">Delete</a>
                                    <a href="edit.php?id=<?php echo $product['product_id']; ?>">Edit</a>
                                    <a href="productinfo.php?id=<?php echo $product['product_id']; ?>">View</a>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td>No products found.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </section>
 </main>

 <?php require_once './templates/footer.php'; ?>