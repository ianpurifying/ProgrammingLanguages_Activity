<?php
session_start();
require_once 'db.php';

if (!isset($_SESSION['admin_logged_in'])) {
    header('Location: login.php');
    exit;
}

$search = $_GET['search'] ?? '';
$page = max(1, $_GET['page'] ?? 1);
$perPage = 10;
$offset = ($page - 1) * $perPage;

$whereClause = '';
$params = [];

if ($search) {
    $whereClause = "WHERE name LIKE ? OR email LIKE ? OR phone LIKE ? OR service_type LIKE ? OR location LIKE ?";
    $searchTerm = "%{$search}%";
    $params = array_fill(0, 5, $searchTerm);
}

$countStmt = $pdo->prepare("SELECT COUNT(*) FROM inquire {$whereClause}");
$countStmt->execute($params);
$totalRecords = $countStmt->fetchColumn();
$totalPages = ceil($totalRecords / $perPage);

$stmt = $pdo->prepare("SELECT * FROM inquire {$whereClause} ORDER BY created_at DESC LIMIT {$perPage} OFFSET {$offset}");
$stmt->execute($params);
$inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($_POST['action'] ?? '' === 'delete') {
    $id = $_POST['id'];
    $deleteStmt = $pdo->prepare("DELETE FROM inquire WHERE id = ?");
    $deleteStmt->execute([$id]);
    header('Location: dashboard.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Click by Nica</title>
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
                    <h1 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-camera text-indigo-600 mr-2"></i>
                        Click by Nica Admin
                    </h1>
                   
                </div>
                 <a href="contact/contact.php" class="text-sm text-indigo-600 hover:text-indigo-800 flex items-center">
                        <i class="fas fa-envelope mr-1"></i>
                        Contact Messages
                    </a>
                <div class="flex items-center space-x-4">
                    
                    <span class="text-sm text-gray-700">
                        <i class="fas fa-user mr-1"></i>
                        Watashi wa, <?php echo htmlspecialchars($_SESSION['admin_username']); ?>
                    </span>
                    <a href="logout.php" class="text-sm text-red-600 hover:text-red-800">
                        <i class="fas fa-sign-out-alt mr-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-lg shadow-sm">
            <div class="p-6 border-b border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Inquiries Management</h2>
                        <p class="text-sm text-gray-600 mt-1">Total: <?php echo $totalRecords; ?> inquiries</p>
                    </div>
                    <div class="mt-4 sm:mt-0 flex items-center space-x-3">
                        <form method="GET" class="flex">
                            <input 
                                type="text" 
                                name="search" 
                                value="<?php echo htmlspecialchars($search); ?>"
                                placeholder="Search inquiries..."
                                class="px-4 py-2 border border-gray-300 rounded-l-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                            >
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-r-lg hover:bg-indigo-700">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                        <a href="create.php" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            <i class="fas fa-plus mr-2"></i>Add New
                        </a>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Service</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Event Details</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($inquiries as $inquiry): ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="bg-indigo-100 rounded-full w-10 h-10 flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-indigo-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-900"><?php echo htmlspecialchars($inquiry['name']); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars($inquiry['email']); ?></div>
                                        <div class="text-sm text-gray-500"><?php echo htmlspecialchars($inquiry['phone']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900"><?php echo htmlspecialchars($inquiry['service_type']); ?></div>
                                <div class="text-sm text-gray-500">Budget: <?php echo htmlspecialchars($inquiry['budget']); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900"><?php echo htmlspecialchars($inquiry['location']); ?></div>
                                <div class="text-sm text-gray-500">
                                    <?php if ($inquiry['event_date']): ?>
                                        <i class="fas fa-calendar mr-1"></i><?php echo date('M j, Y', strtotime($inquiry['event_date'])); ?>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo date('M j, Y', strtotime($inquiry['created_at'])); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex space-x-2">
                                    <a href="view.php?id=<?php echo $inquiry['id']; ?>" class="text-indigo-600 hover:text-indigo-900">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="edit.php?id=<?php echo $inquiry['id']; ?>" class="text-yellow-600 hover:text-yellow-900">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this inquiry?')">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="id" value="<?php echo $inquiry['id']; ?>">
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <?php if ($totalPages > 1): ?>
            <div class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                <div class="flex-1 flex justify-between sm:hidden">
                    <?php if ($page > 1): ?>
                        <a href="?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                    <?php endif; ?>
                    <?php if ($page < $totalPages): ?>
                        <a href="?page=<?php echo $page + 1; ?>&search=<?php echo urlencode($search); ?>" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</a>
                    <?php endif; ?>
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium"><?php echo $offset + 1; ?></span> to <span class="font-medium"><?php echo min($offset + $perPage, $totalRecords); ?></span> of <span class="font-medium"><?php echo $totalRecords; ?></span> results
                        </p>
                    </div>
                    <div>
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px">
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <a href="?page=<?php echo $i; ?>&search=<?php echo urlencode($search); ?>" class="<?php echo $i == $page ? 'z-10 bg-indigo-50 border-indigo-500 text-indigo-600' : 'bg-white border-gray-300 text-gray-500 hover:bg-gray-50'; ?> relative inline-flex items-center px-4 py-2 border text-sm font-medium">
                                    <?php echo $i; ?>
                                </a>
                            <?php endfor; ?>
                        </nav>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>