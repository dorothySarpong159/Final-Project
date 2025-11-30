<?php 
    $pageTitle = "Your Cart";
    $pageDesc = "Your Items";
    require_once './templates/header.php';
?>

<main>
    <section class="cart-section">
        <h1 class="cart-title">Your Shopping Cart</h1>

        <div id="cart-items" class="cart-items"></div>
        <!-- Cart summary -->
        <div id="cart-summary" class="cart-summary hidden">
            <div class="summary-item">
                <span>Subtotal:</span>
                <span id="cart-subtotal">$0.00</span>
            </div>
            <div class="summary-item-total">
                <span>Total</span>
                <span id="cart-total">$0.00</span>
            </div>

            <button class="checkout-button">Checkout</button>
        </div>

        <!-- Empty cart message -->
        <p id="empty-cart-message" class="empty-cart-message">Your Cart is Empty</p>

        <!-- Thank you message -->
        <section id="thank-you-message" class="thank-you-message hidden">
            <h2>Thank You for Shopping!</h2>
            <p>Order successfully placed!</p>
        </section>
    </section>
</main>

<?php require_once './templates/footer.php'; ?>
