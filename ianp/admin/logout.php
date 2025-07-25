<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';

$auth = new Auth();
$auth->logout();
header('Location: ' . BASE_URL . '../index.php');
exit;
?>