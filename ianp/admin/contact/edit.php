<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/database.php';

requireAuth();

$db = new Database();
$id = (int)$_GET['id'];
$message = '';

$stmt = $db->prepare("SELECT * FROM contact WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    header('Location: index.php');
    exit;
}

if ($_POST) {
    $stmt = $db->prepare("UPDATE contact SET name = ?, email = ?, message = ? WHERE id = ?");
    
    if ($stmt->execute([
        $_POST['name'],
        $_POST['email'],
        $_POST['message'],
        $id
    ])) {
        header('Location: index.php');
        exit;
    } else {
        $message = 'Error updating contact';
    }
}

$title = 'Edit Contact';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Edit Contact #<?= $contact['id'] ?></h1>
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
                    <input type="text" name="name" value="<?= htmlspecialchars($contact['name']) ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                    <input type="email" name="email" value="<?= htmlspecialchars($contact['email']) ?>" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                <textarea name="message" rows="8" required class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"><?= htmlspecialchars($contact['message']) ?></textarea>
            </div>
            
            <div class="bg-gray-50 p-4 rounded-md">
                <div class="text-sm text-gray-600">
                    <p><strong>Created:</strong> <?= date('M j, Y g:i A', strtotime($contact['created_at'])) ?></p>
                    <p><strong>Contact ID:</strong> #<?= $contact['id'] ?></p>
                </div>
            </div>
            
            <div class="flex justify-end space-x-4">
                <a href="view.php?id=<?= $contact['id'] ?>" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Update Contact</button>
            </div>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>