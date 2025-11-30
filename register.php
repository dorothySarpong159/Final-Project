<?php
//define our page title and description
$pageTitle = "Register Page";
$pageDesc ="Create an account";

require_once './inc/Database.php';
require_once './inc/Session.php';
require_once './inc/User.php';
require_once './templates/header.php';

if(Session::isLoggedIn()){
    header('Location: Dashboard.php');
    exit;
}
$message = '';
$message_type = '';

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    $message = $user->register($username, $email, $password, $confirm_password);
    if($message === "User Created"){
        $message_type = 'success';
    }else{
        $message_type = 'fail';
    }
}
?>
<!-- register page -->
<main class="admin-register">
    <section class="admin-register-container">
        <div class="register-page">
            <h1>Register</h1>

            <?php if($message): ?>
                <div class="alert alert-<?php echo $message_type ?>">
                    <?php echo htmlspecialchars($message)?>
                </div>
            <?php endif; ?>
            <!-- customer information -->
            <form method="post" action="register.php">
                <label for="username">Username</label>
                <input type="text" id="username" name="username">

                <label for="email">Email</label>
                <input type="email" id="email" name="email">

                <label for="password">Password</label>
                <input type="password" id="password" name="password">

                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" required>

                <button type="submit" class="btn">Register</button>
            </form>
            <p class="login-box">Already have an account?
                <a href="login.php">Login here</a>
            </p>
        </div>
    </section>
</main>
<?php require_once './templates/footer.php'; ?>
