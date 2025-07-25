<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/database.php';

requireAuth();

$db = new Database();
$id = (int)$_GET['id'];

$stmt = $db->prepare("SELECT * FROM inquire WHERE id = ?");
$stmt->execute([$id]);
$inquiry = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$inquiry) {
    header('Location: index.php');
    exit;
}

$title = 'View Inquiry';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">View Inquiry #<?= $inquiry['id'] ?></h1>
        <div class="space-x-2">
            <a href="edit.php?id=<?= $inquiry['id'] ?>" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                <i class="fas fa-edit mr-2"></i>Edit
            </a>
            <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                <i class="fas fa-arrow-left mr-2"></i>Back
            </a>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <p class="text-gray-900"><?= htmlspecialchars($inquiry['fullname']) ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <p class="text-gray-900"><?= htmlspecialchars($inquiry['email']) ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <p class="text-gray-900"><?= htmlspecialchars($inquiry['phone'] ?? 'N/A') ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                    <p class="text-gray-900"><?= htmlspecialchars($inquiry['subject'] ?? 'N/A') ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <p class="text-gray-900"><?= htmlspecialchars($inquiry['category'] ?? 'N/A') ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Preferred Contact</label>
                    <p class="text-gray-900"><?= htmlspecialchars($inquiry['preferred_contact'] ?? 'N/A') ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <span class="status-<?= $inquiry['status'] ?>"><?= ucfirst($inquiry['status']) ?></span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                    <span class="priority-<?= $inquiry['priority'] ?>"><?= ucfirst($inquiry['priority']) ?></span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Created At</label>
                    <p class="text-gray-900"><?= date('M j, Y g:i A', strtotime($inquiry['created_at'])) ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Updated At</label>
                    <p class="text-gray-900"><?= $inquiry['updated_at'] ? date('M j, Y g:i A', strtotime($inquiry['updated_at'])) : 'N/A' ?></p>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                <div class="bg-gray-50 p-4 rounded-md">
                    <p class="text-gray-900 whitespace-pre-wrap"><?= htmlspecialchars($inquiry['message']) ?></p>
                </div>
            </div>
            <?php if (!empty($inquiry['image'])): ?>
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Attachment</label>
                    <img src="../../uploads/inquiries/<?= htmlspecialchars($inquiry['image']) ?>" alt="Attachment" class="max-w-md rounded-lg shadow">
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>