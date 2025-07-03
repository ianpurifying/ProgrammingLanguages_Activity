<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM contact WHERE id = ?");
$stmt->execute([$id]);
$contact = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$contact) {
    header('Location: contact.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contact Message - Click by Nica</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gray-50 min-h-screen">
    <nav class="bg-white shadow-sm border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <a href="contact.php" class="text-indigo-600 hover:text-indigo-800 mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-eye text-indigo-600 mr-2"></i>
                        View Contact Message
                    </h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="edit.php?id=<?php echo $contact['id']; ?>" class="bg-yellow-600 text-white px-4 py-2 rounded-lg hover:bg-yellow-700">
                        <i class="fas fa-edit mr-2"></i>Edit
                    </a>
                    <a href="../logout.php" class="text-sm text-red-600 hover:text-red-800">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-indigo-50 px-6 py-4 border-b border-indigo-200">
                <h2 class="text-2xl font-bold text-indigo-900">Contact Message Details</h2>
                <p class="text-indigo-600 mt-1">ID: #<?php echo $contact['id']; ?></p>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">
                            <i class="fas fa-user text-indigo-600 mr-2"></i>Contact Information
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-user-circle text-gray-400 mr-3 w-5"></i>
                                <div>
                                    <span class="font-medium text-gray-700">Name:</span>
                                    <div class="text-gray-900"><?php echo htmlspecialchars($contact['name']); ?></div>
                                </div>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-envelope text-gray-400 mr-3 w-5"></i>
                                <div>
                                    <span class="font-medium text-gray-700">Email:</span>
                                    <div class="text-gray-900"><?php echo htmlspecialchars($contact['email']); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">
                            <i class="fas fa-clock text-indigo-600 mr-2"></i>Message Info
                        </h3>
                        <div class="space-y-3">
                            <div class="flex items-center">
                                <i class="fas fa-calendar-alt text-gray-400 mr-3 w-5"></i>
                                <div>
                                    <span class="font-medium text-gray-700">Date:</span>
                                    <div class="text-gray-900"><?php echo date('F j, Y g:i A', strtotime($contact['created_at'])); ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">
                        <i class="fas fa-subject text-indigo-600 mr-2"></i>Subject
                    </h3>
                    <p class="text-gray-700 text-lg"><?php echo htmlspecialchars($contact['subject']); ?></p>
                </div>

                <div class="mt-6 bg-gray-50 rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">
                        <i class="fas fa-comment text-indigo-600 mr-2"></i>Message
                    </h3>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-wrap"><?php echo htmlspecialchars($contact['message']); ?></p>
                </div>

                <div class="mt-6 flex justify-between items-center">
                    <a href="contact.php" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-arrow-left mr-2"></i>Back to Messages
                    </a>
                    <div class="flex space-x-3">
                        <a href="edit.php?id=<?php echo $contact['id']; ?>" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <form method="POST" action="contact.php" class="inline" onsubmit="return confirm('Are you sure you want to delete this message?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
                            <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>