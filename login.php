<?php
//define our page title and description
$pageTitle = "Login Page";
$pageDesc ="Sign in into your account";

require_once './inc/Database.php';
require_once './inc/Session.php';
require_once './inc/User.php';
require_once './templates/header.php';

if(Session::isLoggedIn()){
    header('Location: Dashboard.php');
    exit;
}
$error ='';
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);
    $username = $_POST['login_username'];
    $password = $_POST['login_password'];
    $logged_in_user = $user->login($username, $password);
    if($logged_in_user){
        Session::set('user_id', $logged_in_user['user_id']);
        Session::set('username', $logged_in_user['username']);
        header('Location: Dashboard.php');
        exit;
    }else{
        $error = "Invalid username or password";
    }
}
?>
<!-- admin page-->
<main class="login-admin-page">
    <section class="login-admin-container">
        <div class="login-page">
            <h1>Login</h1>
            <!-- customer information -->
            <form method="post" action="login.php">
                <label for="login_username">Username</label>
                <input type="text" id="login_username" name="login_username">

                <label for="login_password">Password</label>
                <input type="password" id="login_password" name="login_password">

                <button type="submit" class="btn">Login</button>
</form>
<p class="register-box">Don't have an account?
    <a href ="register.php">Register here</a>
</p>
</div>
</section>
</main>
<?php require_once './templates/footer.php';?>
