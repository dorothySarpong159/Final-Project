<?php
require_once './inc/Session.php';
Session::start();
Session::destroy();
header('Location: login.php');
exit;
?>