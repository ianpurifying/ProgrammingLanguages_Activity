<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/database.php';

requireAuth();

$db = new Database();
$id = (int)$_GET['id'];

$stmt = $db->prepare("DELETE FROM inquire WHERE id = ?");
$stmt->execute([$id]);

header('Location: index.php');
exit;
?>