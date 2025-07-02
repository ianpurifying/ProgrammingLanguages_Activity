<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/database.php';

requireAuth();

$db = new Database();
$id = (int)$_GET['id'];

$stmt = $db->prepare("SELECT * FROM contact WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    header('Location: index.php');
    exit;
}

$title = 'View Contact';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="max-w-4xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">View Contact #<?= $contact['id'] ?></h1>
        <div class="space-x-2">
            <a href="edit.php?id=<?= $contact['id'] ?>" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
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
                    <label class="block text-sm font-medium text-gray-700 mb-1">Name</label>
                    <p class="text-gray-900 text-lg"><?= htmlspecialchars($contact['name']) ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <p class="text-gray-900 text-lg">
                        <a href="mailto:<?= htmlspecialchars($contact['email']) ?>" class="text-blue-600 hover:text-blue-800">
                            <?= htmlspecialchars($contact['email']) ?>
                        </a>
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Created At</label>
                    <p class="text-gray-900"><?= date('M j, Y g:i A', strtotime($contact['created_at'])) ?></p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Contact ID</label>
                    <p class="text-gray-900">#<?= $contact['id'] ?></p>
                </div>
            </div>
            
            <div class="border-t pt-6">
                <label class="block text-sm font-medium text-gray-700 mb-3">Message</label>
                <div class="bg-gray-50 p-6 rounded-lg border">
                    <p class="text-gray-900 whitespace-pre-wrap leading-relaxed"><?= htmlspecialchars($contact['message']) ?></p>
                </div>
            </div>
            
            <div class="border-t pt-6 mt-6">
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Contact submitted on <?= date('F j, Y \a\t g:i A', strtotime($contact['created_at'])) ?>
                    </div>
                    <div class="space-x-2">
                        <a href="mailto:<?= htmlspecialchars($contact['email']) ?>" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            <i class="fas fa-reply mr-2"></i>Reply via Email
                        </a>
                        <button onclick="confirmDelete(<?= $contact['id'] ?>, 'contact')" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                            <i class="fas fa-trash mr-2"></i>Delete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, type) {
    if (confirm('Are you sure you want to delete this contact? This action cannot be undone.')) {
        window.location.href = `delete.php?id=${id}`;
    }
}
</script>

<?php include '../includes/footer.php'; ?>