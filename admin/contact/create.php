<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/database.php';

requireAuth();

$db = new Database();
$message = '';

if ($_POST) {
    $stmt = $db->prepare("INSERT INTO contact (name, email, message) VALUES (?, ?, ?)");
    
    if ($stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['message']
    ])) {
        header('Location: index.php');
        exit;
    } else {
        $message = 'Error creating contact';
    }
}

$title = 'Create New Contact';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Create New Contact</h1>
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
                    <label class="block text-sm font-medium text-gray-700 mb-2">Name *</label>
                    <input type="text" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                <textarea name="message" rows="8" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter your message..."></textarea>
            </div>
            <div class="flex justify-end space-x-4">
                <a href="index.php" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Create Contact</button>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>