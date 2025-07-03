<?php
session_start();
require_once '../db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: ../login.php');
    exit;
}

$errors = [];

if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    
    if (empty($name)) $errors[] = 'Name is required';
    if (empty($email)) $errors[] = 'Email is required';
    if (empty($subject)) $errors[] = 'Subject is required';
    if (empty($message)) $errors[] = 'Message is required';
    
    if (empty($errors)) {
        $stmt = $pdo->prepare("INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $subject, $message]);
        header('Location: contact.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Contact Message - Click by Nica</title>
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
                        <i class="fas fa-plus text-indigo-600 mr-2"></i>
                        Create New Contact Message
                    </h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="../logout.php" class="text-sm text-red-600 hover:text-red-800">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-green-50 px-6 py-4 border-b border-green-200">
                <h2 class="text-2xl font-bold text-green-900">New Contact Message</h2>
                <p class="text-green-600 mt-1">Fill in the details below</p>
            </div>

            <?php if ($errors): ?>
                <div class="bg-red-50 border-l-4 border-red-400 p-4 m-6">
                    <div class="flex">
                        <i class="fas fa-exclamation-circle text-red-400 mr-3 mt-0.5"></i>
                        <div>
                            <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                            <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                                <?php foreach ($errors as $error): ?>
                                    <li><?php echo htmlspecialchars($error); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <form method="POST" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user mr-2"></i>Name *
                        </label>
                        <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2"></i>Email *
                        </label>
                        <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-subject mr-2"></i>Subject *
                    </label>
                    <input type="text" name="subject" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" value="<?php echo htmlspecialchars($_POST['subject'] ?? ''); ?>">
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment mr-2"></i>Message *
                    </label>
                    <textarea name="message" rows="6" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                </div>

                <div class="mt-6 flex justify-between">
                    <a href="contact.php" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
                        <i class="fas fa-save mr-2"></i>Create Message
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>