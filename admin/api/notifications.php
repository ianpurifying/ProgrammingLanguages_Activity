<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/database.php';

requireAuth();

$db = new Database();

$notifications = [];

$pendingInquiries = $db->prepare("SELECT COUNT(*) FROM inquire WHERE status = 'pending' AND created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)");
$pendingInquiries->execute();
$pendingCount = $pendingInquiries->fetchColumn();

if ($pendingCount > 0) {
    $notifications[] = [
        'title' => "$pendingCount new pending inquiries",
        'time' => 'Last 24 hours'
    ];
}

$recentContacts = $db->prepare("SELECT COUNT(*) FROM contact WHERE created_at > DATE_SUB(NOW(), INTERVAL 24 HOUR)");
$recentContacts->execute();
$contactCount = $recentContacts->fetchColumn();

if ($contactCount > 0) {
    $notifications[] = [
        'title' => "$contactCount new contacts",
        'time' => 'Last 24 hours'
    ];
}

header('Content-Type: application/json');
echo json_encode($notifications);
?>