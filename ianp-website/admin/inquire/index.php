<?php
require_once '../includes/config.php';
require_once '../includes/auth.php';
require_once '../includes/database.php';

requireAuth();

$db = new Database();

$search = $_GET['search'] ?? '';
$status = $_GET['status'] ?? '';
$sort = $_GET['sort'] ?? 'created_at';
$order = $_GET['order'] ?? 'DESC';
$page = (int)($_GET['page'] ?? 1);
$limit = 10;
$offset = ($page - 1) * $limit;

$where = [];
$params = [];

if ($search) {
    $where[] = "(fullname LIKE ? OR email LIKE ? OR subject LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($status) {
    $where[] = "status = ?";
    $params[] = $status;
}

$whereClause = $where ? "WHERE " . implode(" AND ", $where) : "";
$orderClause = "ORDER BY $sort $order";

$stmt = $db->prepare("SELECT * FROM inquire $whereClause $orderClause LIMIT $limit OFFSET $offset");
$stmt->execute($params);
$inquiries = $stmt->fetchAll(PDO::FETCH_ASSOC);

$countStmt = $db->prepare("SELECT COUNT(*) FROM inquire $whereClause");
$countStmt->execute($params);
$totalRecords = $countStmt->fetchColumn();
$totalPages = ceil($totalRecords / $limit);

$title = 'Inquiries Management';
include '../includes/header.php';
include '../includes/navbar.php';
?>

<div class="max-w-7xl mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Inquiries Management</h1>
        <a href="create.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            <i class="fas fa-plus mr-2"></i>Add New
        </a>
    </div>

    <div class="bg-white rounded-lg shadow mb-6">
        <div class="p-6">
            <form method="GET" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-64">
                    <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" 
                           placeholder="Search inquiries..." 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <select name="status" class="px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">All Status</option>
                    <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                    <option value="in-progress" <?= $status === 'in-progress' ? 'selected' : '' ?>>In Progress</option>
                    <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                    <i class="fas fa-search mr-2"></i>Search
                </button>
                <a href="index.php" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                    <i class="fas fa-refresh mr-2"></i>Reset
                </a>
            </form>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow">
        <div class="table-container">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="toggleSort('id')">
                            ID <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="toggleSort('fullname')">
                            Name <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="toggleSort('email')">
                            Email <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="toggleSort('subject')">
                            Subject <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="toggleSort('status')">
                            Status <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="toggleSort('priority')">
                            Priority <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer" onclick="toggleSort('created_at')">
                            Created <i class="fas fa-sort ml-1"></i>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php foreach ($inquiries as $inquiry): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= $inquiry['id'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($inquiry['fullname']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($inquiry['email']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($inquiry['subject'] ?? '') ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="status-<?= $inquiry['status'] ?>"><?= ucfirst($inquiry['status']) ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="priority-<?= $inquiry['priority'] ?>"><?= ucfirst($inquiry['priority']) ?></span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= date('M j, Y', strtotime($inquiry['created_at'])) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="view.php?id=<?= $inquiry['id'] ?>" class="text-blue-600 hover:text-blue-900 mr-3">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="edit.php?id=<?= $inquiry['id'] ?>" class="text-green-600 hover:text-green-900 mr-3">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button onclick="confirmDelete(<?= $inquiry['id'] ?>, 'inquire')" class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <?php if ($totalPages > 1): ?>
            <div class="px-6 py-4 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-700">
                        Showing <?= $offset + 1 ?> to <?= min($offset + $limit, $totalRecords) ?> of <?= $totalRecords ?> results
                    </div>
                    <div class="flex space-x-2">
                        <?php if ($page > 1): ?>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" 
                               class="px-3 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Previous</a>
                        <?php endif; ?>
                        
                        <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" 
                               class="px-3 py-2 <?= $i === $page ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-700' ?> rounded hover:bg-blue-600">
                                <?= $i ?>
                            </a>
                        <?php endfor; ?>
                        
                        <?php if ($page < $totalPages): ?>
                            <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" 
                               class="px-3 py-2 bg-gray-300 text-gray-700 rounded hover:bg-gray-400">Next</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>