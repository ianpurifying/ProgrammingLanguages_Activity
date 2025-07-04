<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/database.php';

requireAuth();

$db = new Database();
$id = (int)$_GET['id'];
$message = '';

$stmt = $db->prepare("SELECT * FROM inquire WHERE id = ?");
$stmt->execute([$id]);
$inquiry = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$inquiry) {
    header('Location: index.php');
    exit;
}

if ($_POST) {
    $stmt = $db->prepare("UPDATE inquire SET fullname = ?, email = ?, phone = ?, subject = ?, message = ?, category = ?, preferred_contact = ?, priority = ?, status = ? WHERE id = ?");
    
    if ($stmt->execute([
        $_POST['fullname'],
        $_POST['email'],
        $_POST['phone'],
        $_POST['subject'],
        $_POST['message'],
        $_POST['category'],
        $_POST['preferred_contact'],
        $_POST['priority'],
        $_POST['status'],
        $id
    ])) {
        header('Location: index.php');
        exit;
    } else {
        $message = 'Error updating inquiry';
    }
}

$title = 'Edit Inquiry';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Inquiry</h1>
        <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            <i class="fas fa-arrow-left mr-2"></i>Back
        </a>
    </div>

    <?php if ($message): ?>
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg shadow">
        <form method="POST" class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
                    <input type="text" name="fullname" value="<?= htmlspecialchars($inquiry['fullname']) ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($inquiry['email']) ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                    <input type="text" name="phone" value="<?= htmlspecialchars($inquiry['phone'] ?? '') ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                    <input type="text" name="subject" value="<?= htmlspecialchars($inquiry['subject'] ?? '') ?>" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                    <select name="category" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Category</option>
                        <option value="general" <?= $inquiry['category'] === 'general' ? 'selected' : '' ?>>General</option>
                        <option value="support" <?= $inquiry['category'] === 'support' ? 'selected' : '' ?>>Support</option>
                        <option value="sales" <?= $inquiry['category'] === 'sales' ? 'selected' : '' ?>>Sales</option>
                        <option value="billing" <?= $inquiry['category'] === 'billing' ? 'selected' : '' ?>>Billing</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Preferred Contact</label>
                    <select name="preferred_contact" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">Select Method</option>
                        <option value="email" <?= $inquiry['preferred_contact'] === 'email' ? 'selected' : '' ?>>Email</option>
                        <option value="phone" <?= $inquiry['preferred_contact'] === 'phone' ? 'selected' : '' ?>>Phone</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Priority</label>
                    <select name="priority" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="low" <?= $inquiry['priority'] === 'low' ? 'selected' : '' ?>>Low</option>
                        <option value="medium" <?= $inquiry['priority'] === 'medium' ? 'selected' : '' ?>>Medium</option>
                        <option value="high" <?= $inquiry['priority'] === 'high' ? 'selected' : '' ?>>High</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="pending" <?= $inquiry['status'] === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="in-progress" <?= $inquiry['status'] === 'in-progress' ? 'selected' : '' ?>>In Progress</option>
                        <option value="completed" <?= $inquiry['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                    </select>
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                <textarea name="message" rows="5" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($inquiry['message']) ?></textarea>
            </div>
            <div>
                <?php if (!empty($inquiry['image'])): ?>
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Attachment</label>
                        <img src="../../uploads/inquiries/<?= htmlspecialchars($inquiry['image']) ?>" alt="Attachment" class="max-w-md rounded-lg shadow">
                    </div>
                <?php endif; ?>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="index.php" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Update Inquiry</button>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>