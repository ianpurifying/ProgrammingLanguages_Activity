<?php
require_once 'includes/config.php';
require_once 'includes/auth.php';
require_once 'includes/database.php';

requireAuth();

$db = new Database();

$inquireCount = $db->prepare("SELECT COUNT(*) FROM inquire");
$inquireCount->execute();
$totalInquiries = $inquireCount->fetchColumn();

$contactCount = $db->prepare("SELECT COUNT(*) FROM contact");
$contactCount->execute();
$totalContacts = $contactCount->fetchColumn();

$pendingInquiries = $db->prepare("SELECT COUNT(*) FROM inquire WHERE status = 'pending'");
$pendingInquiries->execute();
$pendingCount = $pendingInquiries->fetchColumn();

$recentInquiries = $db->prepare("SELECT * FROM inquire ORDER BY created_at DESC LIMIT 5");
$recentInquiries->execute();
$inquiries = $recentInquiries->fetchAll(PDO::FETCH_ASSOC);

$recentContacts = $db->prepare("SELECT * FROM contact ORDER BY created_at DESC LIMIT 5");
$recentContacts->execute();
$contacts = $recentContacts->fetchAll(PDO::FETCH_ASSOC);

$title = 'Dashboard';
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-500">
                    <i class="fas fa-envelope text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Total Inquiries</h3>
                    <p class="text-3xl font-bold text-blue-600"><?= $totalInquiries ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-500">
                    <i class="fas fa-address-book text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Total Contacts</h3>
                    <p class="text-3xl font-bold text-green-600"><?= $totalContacts ?></p>
                </div>
            </div>
        </div>
        
        <div class="bg-white p-6 rounded-lg shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-500">
                    <i class="fas fa-clock text-2xl"></i>
                </div>
                <div class="ml-4">
                    <h3 class="text-lg font-semibold text-gray-900">Pending</h3>
                    <p class="text-3xl font-bold text-yellow-600"><?= $pendingCount ?></p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Inquiries</h3>
            </div>
            <div class="p-6">
                <?php if ($inquiries): ?>
                    <div class="space-y-4">
                        <?php foreach ($inquiries as $inquiry): ?>
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                                <div>
                                    <p class="font-medium text-gray-900"><?= htmlspecialchars($inquiry['fullname']) ?></p>
                                    <p class="text-sm text-gray-600"><?= htmlspecialchars($inquiry['subject']) ?></p>
                                    <p class="text-xs text-gray-500"><?= date('M j, Y', strtotime($inquiry['created_at'])) ?></p>
                                </div>
                                <span class="status-<?= $inquiry['status'] ?>"><?= ucfirst($inquiry['status']) ?></span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="text-gray-500">No inquiries yet.</p>
                <?php endif; ?>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-lg font-semibold text-gray-900">Recent Activities</h3>
            </div>
            <div class="p-6">
                <div id="recentActivities" class="space-y-4"></div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>