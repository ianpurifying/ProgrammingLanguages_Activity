<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM inquire WHERE id = ?");
$stmt->execute([$id]);
$inquiry = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$inquiry) {
    header('Location: dashboard.php');
    exit;
}

$errors = [];

if ($_POST) {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $budget = trim($_POST['budget']);
    $service_type = trim($_POST['service_type']);
    $event_date = $_POST['event_date'] ?: null;
    $location = trim($_POST['location']);
    $additional_services = trim($_POST['additional_services']);
    $message = trim($_POST['message']);
    $referral = trim($_POST['referral']);
    
    if (empty($name)) $errors[] = 'Name is required';
    if (empty($email)) $errors[] = 'Email is required';
    if (empty($service_type)) $errors[] = 'Service type is required';
    if (empty($message)) $errors[] = 'Message is required';
    
    if (empty($errors)) {
        $stmt = $pdo->prepare("UPDATE inquire SET name=?, email=?, phone=?, budget=?, service_type=?, event_date=?, location=?, additional_services=?, message=?, referral=? WHERE id=?");
        $stmt->execute([$name, $email, $phone, $budget, $service_type, $event_date, $location, $additional_services, $message, $referral, $id]);
        header('Location: view.php?id=' . $id);
        exit;
    }
} else {
    $_POST = $inquiry;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Inquiry - Click by Nica</title>
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
                    <a href="view.php?id=<?php echo $id; ?>" class="text-indigo-600 hover:text-indigo-800 mr-4">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <h1 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-edit text-indigo-600 mr-2"></i>
                        Edit Inquiry #<?php echo $id; ?>
                    </h1>
                </div>
                <div class="flex items-center space-x-4">
                    <a href="logout.php" class="text-sm text-red-600 hover:text-red-800">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <div class="bg-yellow-50 px-6 py-4 border-b border-yellow-200">
                <h2 class="text-2xl font-bold text-yellow-900">Edit Inquiry Form</h2>
                <p class="text-yellow-600 mt-1">Update the details below</p>
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
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user mr-2"></i>Name *
                            </label>
                            <input type="text" name="name" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-envelope mr-2"></i>Email *
                            </label>
                            <input type="email" name="email" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-phone mr-2"></i>Phone
                            </label>
                            <input type="tel" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-dollar-sign mr-2"></i>Budget
                            </label>
                            <select name="budget" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                <option value="">Select budget range</option>
                                <option value="Under $500" <?php echo ($_POST['budget'] ?? '') === 'Under $500' ? 'selected' : ''; ?>>Under $500</option>
                                <option value="$500 - $1000" <?php echo ($_POST['budget'] ?? '') === '$500 - $1000' ? 'selected' : ''; ?>>$500 - $1000</option>
                                <option value="$1000 - $2000" <?php echo ($_POST['budget'] ?? '') === '$1000 - $2000' ? 'selected' : ''; ?>>$1000 - $2000</option>
                                <option value="$2000 - $5000" <?php echo ($_POST['budget'] ?? '') === '$2000 - $5000' ? 'selected' : ''; ?>>$2000 - $5000</option>
                                <option value="Over $5000" <?php echo ($_POST['budget'] ?? '') === 'Over $5000' ? 'selected' : ''; ?>>Over $5000</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-user-friends mr-2"></i>Referral
                            </label>
                            <input type="text" name="referral" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" value="<?php echo htmlspecialchars($_POST['referral'] ?? ''); ?>">
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-camera mr-2"></i>Service Type *
                            </label>
                            <select name="service_type" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500">
                                <option value="">Select service type</option>
                                <option value="Wedding Photography" <?php echo ($_POST['service_type'] ?? '') === 'Wedding Photography' ? 'selected' : ''; ?>>Wedding Photography</option>
                                <option value="Portrait Photography" <?php echo ($_POST['service_type'] ?? '') === 'Portrait Photography' ? 'selected' : ''; ?>>Portrait Photography</option>
                                <option value="Event Photography" <?php echo ($_POST['service_type'] ?? '') === 'Event Photography' ? 'selected' : ''; ?>>Event Photography</option>
                                <option value="Corporate Photography" <?php echo ($_POST['service_type'] ?? '') === 'Corporate Photography' ? 'selected' : ''; ?>>Corporate Photography</option>
                                <option value="Product Photography" <?php echo ($_POST['service_type'] ?? '') === 'Product Photography' ? 'selected' : ''; ?>>Product Photography</option>
                                <option value="Other" <?php echo ($_POST['service_type'] ?? '') === 'Other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-calendar-alt mr-2"></i>Event Date
                            </label>
                            <input type="date" name="event_date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" value="<?php echo htmlspecialchars($_POST['event_date'] ?? ''); ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-map-marker-alt mr-2"></i>Location
                            </label>
                            <input type="text" name="location" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500" value="<?php echo htmlspecialchars($_POST['location'] ?? ''); ?>">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-plus mr-2"></i>Additional Services
                            </label>
                            <textarea name="additional_services" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"><?php echo htmlspecialchars($_POST['additional_services'] ?? ''); ?></textarea>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        <i class="fas fa-comment mr-2"></i>Message *
                    </label>
                    <textarea name="message" rows="4" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-yellow-500 focus:border-yellow-500"><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                </div>

                <div class="mt-6 flex justify-between">
                    <a href="view.php?id=<?php echo $id; ?>" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                    <button type="submit" class="bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700">
                        <i class="fas fa-save mr-2"></i>Update Inquiry
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>