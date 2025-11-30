<?php
$pageTitle ="Dashboard";
$pageDesc = "Logged in";
require_once './inc/Session.php';
require_once './templates/header.php';

if(!Session::isLoggedIn()){
    header('Location: login.php');
    exit;
}

$username = Session::get('username');
?>

<main class="dashboard-page">
    <section class="dashboard-container">
        <div class="dashboard-header">
            <h2>Dashboard</h2>
            <h3>Welcome, <?php echo htmlspecialchars($username); ?>!</h3>
            <p>You're successfully logged in - get shopping!</p>
            <a href="logout.php" class="btn btn-danger">Logout</a>
</div>
</section>
</main>
<?php require_once './templates/footer.php'; ?>