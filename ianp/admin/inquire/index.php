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

<div class="min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-indigo-100 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Inquiries Management</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-400">Manage and track customer inquiries efficiently</p>
                </div>
                <div class="flex items-center gap-3">
                    <div class="bg-white dark:bg-gray-800 px-4 py-2 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Total: </span>
                        <span class="text-lg font-bold text-blue-600 dark:text-blue-400"><?= $totalRecords ?></span>
                    </div>
                    <a href="create.php" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                        <i class="fas fa-plus mr-2"></i>
                        Add New Inquiry
                    </a>
                </div>
            </div>
        </div>

        <!-- Search and Filter Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 mb-8">
            <div class="p-6">
                <div class="flex items-center mb-4">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg mr-3">
                        <i class="fas fa-search text-blue-600 dark:text-blue-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Search & Filter</h3>
                </div>
                <form method="GET" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div class="lg:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Search Inquiries</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400"></i>
                                </div>
                                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" 
                                       placeholder="Search by name, email, or subject..." 
                                       class="w-full pl-10 pr-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Filter</label>
                            <select name="status" class="w-full px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white transition-colors duration-200">
                                <option value="">All Status</option>
                                <option value="pending" <?= $status === 'pending' ? 'selected' : '' ?>>Pending</option>
                                <option value="in-progress" <?= $status === 'in-progress' ? 'selected' : '' ?>>In Progress</option>
                                <option value="completed" <?= $status === 'completed' ? 'selected' : '' ?>>Completed</option>
                            </select>
                        </div>
                        <div class="flex items-end gap-2">
                            <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200">
                                <i class="fas fa-search mr-2"></i>
                                Search
                            </button>
                            <a href="index.php" class="inline-flex items-center justify-center px-4 py-3 bg-gray-500 hover:bg-gray-600 text-white font-medium rounded-lg shadow-sm hover:shadow-md transform hover:-translate-y-0.5 transition-all duration-200">
                                <i class="fas fa-refresh"></i>
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Data Table Card -->
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <div class="flex items-center justify-center w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg mr-3">
                            <i class="fas fa-table text-green-600 dark:text-green-400"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Inquiries List</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                Showing <?= $offset + 1 ?> to <?= min($offset + $limit, $totalRecords) ?> of <?= $totalRecords ?> inquiries
                            </p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-xs text-gray-500 dark:text-gray-400">Sort by:</span>
                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 rounded text-xs font-medium">
                            <?= ucfirst(str_replace('_', ' ', $sort)) ?> <?= $order ?>
                        </span>
                    </div>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-900">
                        <tr>
                            <th class="group px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200" onclick="toggleSort('id')">
                                <div class="flex items-center space-x-1">
                                    <span>ID</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                </div>
                            </th>
                            <th class="group px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200" onclick="toggleSort('fullname')">
                                <div class="flex items-center space-x-1">
                                    <span>Full Name</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                </div>
                            </th>
                            <th class="group px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200" onclick="toggleSort('email')">
                                <div class="flex items-center space-x-1">
                                    <span>Email</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                </div>
                            </th>
                            <th class="group px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200" onclick="toggleSort('subject')">
                                <div class="flex items-center space-x-1">
                                    <span>Subject</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                </div>
                            </th>
                            <th class="group px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200" onclick="toggleSort('status')">
                                <div class="flex items-center space-x-1">
                                    <span>Status</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                </div>
                            </th>
                            <th class="group px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200" onclick="toggleSort('priority')">
                                <div class="flex items-center space-x-1">
                                    <span>Priority</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                </div>
                            </th>
                            <th class="group px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors duration-200" onclick="toggleSort('created_at')">
                                <div class="flex items-center space-x-1">
                                    <span>Created Date</span>
                                    <i class="fas fa-sort text-gray-400 group-hover:text-gray-600 dark:group-hover:text-gray-300"></i>
                                </div>
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                        <?php foreach ($inquiries as $inquiry): ?>
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-150">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                            <span class="text-xs font-semibold text-blue-600 dark:text-blue-400">#<?= $inquiry['id'] ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 w-10 h-10 bg-gradient-to-r from-purple-400 to-pink-400 rounded-full flex items-center justify-center">
                                            <span class="text-sm font-semibold text-white"><?= strtoupper(substr($inquiry['fullname'], 0, 1)) ?></span>
                                        </div>
                                        <div class="ml-3">
                                            <div class="text-sm font-medium text-gray-900 dark:text-white"><?= htmlspecialchars($inquiry['fullname']) ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white"><?= htmlspecialchars($inquiry['email']) ?></div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-envelope mr-1"></i>Email
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-white max-w-xs truncate" title="<?= htmlspecialchars($inquiry['subject'] ?? '') ?>">
                                        <?= htmlspecialchars($inquiry['subject'] ?? 'No subject') ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="status-<?= $inquiry['status'] ?>"><?= ucfirst($inquiry['status']) ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="priority-<?= $inquiry['priority'] ?>"><?= ucfirst($inquiry['priority']) ?></span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900 dark:text-white"><?= date('M j, Y', strtotime($inquiry['created_at'])) ?></div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400"><?= date('g:i A', strtotime($inquiry['created_at'])) ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center space-x-3">
                                        <a href="view.php?id=<?= $inquiry['id'] ?>" 
                                           class="inline-flex items-center justify-center w-8 h-8 bg-blue-100 hover:bg-blue-200 dark:bg-blue-900 dark:hover:bg-blue-800 text-blue-600 dark:text-blue-400 rounded-lg transition-colors duration-200" 
                                           title="View Details">
                                            <i class="fas fa-eye text-sm"></i>
                                        </a>
                                        <a href="edit.php?id=<?= $inquiry['id'] ?>" 
                                           class="inline-flex items-center justify-center w-8 h-8 bg-green-100 hover:bg-green-200 dark:bg-green-900 dark:hover:bg-green-800 text-green-600 dark:text-green-400 rounded-lg transition-colors duration-200" 
                                           title="Edit Inquiry">
                                            <i class="fas fa-edit text-sm"></i>
                                        </a>
                                        <button onclick="confirmDelete(<?= $inquiry['id'] ?>, 'inquire')" 
                                                class="inline-flex items-center justify-center w-8 h-8 bg-red-100 hover:bg-red-200 dark:bg-red-900 dark:hover:bg-red-800 text-red-600 dark:text-red-400 rounded-lg transition-colors duration-200" 
                                                title="Delete Inquiry">
                                            <i class="fas fa-trash text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <?php if ($totalPages > 1): ?>
                <div class="bg-white dark:bg-gray-800 px-6 py-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center text-sm text-gray-700 dark:text-gray-300">
                            <span>Showing</span>
                            <span class="mx-1 font-semibold text-gray-900 dark:text-white"><?= $offset + 1 ?></span>
                            <span>to</span>
                            <span class="mx-1 font-semibold text-gray-900 dark:text-white"><?= min($offset + $limit, $totalRecords) ?></span>
                            <span>of</span>
                            <span class="mx-1 font-semibold text-gray-900 dark:text-white"><?= $totalRecords ?></span>
                            <span>results</span>
                        </div>
                        <div class="flex items-center space-x-2">
                            <?php if ($page > 1): ?>
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page - 1])) ?>" 
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                                    <i class="fas fa-chevron-left mr-2"></i>
                                    Previous
                                </a>
                            <?php endif; ?>
                            
                            <div class="flex items-center space-x-1">
                                <?php for ($i = max(1, $page - 2); $i <= min($totalPages, $page + 2); $i++): ?>
                                    <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" 
                                       class="inline-flex items-center justify-center w-10 h-10 text-sm font-medium <?= $i === $page ? 'bg-blue-600 text-white shadow-lg' : 'text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600' ?> border border-gray-300 dark:border-gray-600 rounded-lg transition-all duration-200 <?= $i === $page ? 'transform scale-110' : '' ?>">
                                        <?= $i ?>
                                    </a>
                                <?php endfor; ?>
                            </div>
                            
                            <?php if ($page < $totalPages): ?>
                                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $page + 1])) ?>" 
                                   class="inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-600 transition-colors duration-200">
                                    Next
                                    <i class="fas fa-chevron-right ml-2"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (empty($inquiries)): ?>
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg border border-gray-200 dark:border-gray-700 p-12 text-center">
                <div class="flex flex-col items-center">
                    <div class="flex items-center justify-center w-16 h-16 bg-gray-100 dark:bg-gray-700 rounded-full mb-4">
                        <i class="fas fa-inbox text-2xl text-gray-400 dark:text-gray-500"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">No Inquiries Found</h3>
                    <p class="text-gray-500 dark:text-gray-400 mb-6">
                        <?= $search || $status ? 'No inquiries match your current filters.' : 'No inquiries have been submitted yet.' ?>
                    </p>
                    <?php if ($search || $status): ?>
                        <a href="index.php" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-refresh mr-2"></i>
                            Clear Filters
                        </a>
                    <?php else: ?>
                        <a href="create.php" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                            <i class="fas fa-plus mr-2"></i>
                            Add First Inquiry
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-2xl max-w-md w-full transform transition-all duration-300 scale-95">
        <div class="p-6">
            <div class="flex items-center mb-4">
                <div class="flex items-center justify-center w-12 h-12 bg-red-100 dark:bg-red-900 rounded-full mr-4">
                    <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400 text-xl"></i>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Confirm Deletion</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">This action cannot be undone</p>
                </div>
            </div>
            <p class="text-gray-700 dark:text-gray-300 mb-6">Are you sure you want to delete this inquiry? All associated data will be permanently removed.</p>
            <div class="flex justify-end space-x-3">
                <button onclick="closeDeleteModal()" class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-lg font-medium transition-colors duration-200">
                    Cancel
                </button>
                <button onclick="proceedDelete()" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors duration-200">
                    <i class="fas fa-trash mr-2"></i>
                    Delete
                </button>
            </div>
        </div>
    </div>
</div>

<script>
let deleteId = null;

function confirmDelete(id, type) {
    deleteId = id;
    const modal = document.getElementById('deleteModal');
    modal.classList.remove('hidden');
    modal.querySelector('.transform').classList.remove('scale-95');
    modal.querySelector('.transform').classList.add('scale-100');
}

function closeDeleteModal() {
    const modal = document.getElementById('deleteModal');
    modal.querySelector('.transform').classList.remove('scale-100');
    modal.querySelector('.transform').classList.add('scale-95');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
    deleteId = null;
}

function proceedDelete() {
    if (deleteId) {
        window.location.href = `delete.php?id=${deleteId}`;
    }
}

function toggleSort(column) {
    const currentSort = '<?= $sort ?>';
    const currentOrder = '<?= $order ?>';
    
    let newOrder = 'ASC';
    if (column === currentSort && currentOrder === 'ASC') {
        newOrder = 'DESC';
    }
    
    const url = new URL(window.location);
    url.searchParams.set('sort', column);
    url.searchParams.set('order', newOrder);
    url.searchParams.set('page', '1');
    
    window.location.href = url.toString();
}

document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeDeleteModal();
    }
});

document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeDeleteModal();
    }
});
</script>

<?php include '../includes/footer.php'; ?>