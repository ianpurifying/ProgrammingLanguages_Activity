<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/database.php';

requireAuth();

$db = new Database();

$activities = [];

$recentInquiries = $db->prepare("SELECT fullname, created_at FROM inquire ORDER BY created_at DESC LIMIT 3");
$recentInquiries->execute();
$inquiries = $recentInquiries->fetchAll(PDO::FETCH_ASSOC);

foreach ($inquiries as $inquiry) {
    $activities[] = [
        'description' => "New inquiry from " . htmlspecialchars($inquiry['fullname']),
        'time' => date('M j, Y g:i A', strtotime($inquiry['created_at'])),
        'icon' => 'fa-envelope'
    ];
}

$recentContacts = $db->prepare("SELECT name, created_at FROM contact ORDER BY created_at DESC LIMIT 3");
$recentContacts->execute();
$contacts = $recentContacts->fetchAll(PDO::FETCH_ASSOC);

foreach ($contacts as $contact) {
    $activities[] = [
        'description' => "New contact from " . htmlspecialchars($contact['name']),
        'time' => date('M j, Y g:i A', strtotime($contact['created_at'])),
        'icon' => 'fa-address-book'
    ];
}

usort($activities, function($a, $b) {
    return strtotime($b['time']) - strtotime($a['time']);
});

$activities = array_slice($activities, 0, 5);

header('Content-Type: application/json');
echo json_encode($activities);
?>