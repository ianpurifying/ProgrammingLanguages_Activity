<nav class="bg-white shadow-lg">
    <div class="max-w-7xl mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-4">
                <h1 class="text-xl font-bold text-gray-800">Admin Dashboard</h1>
                <div class="hidden md:flex space-x-4">
                    <a href="<?= BASE_URL ?>" class="text-gray-600 hover:text-blue-600">Dashboard</a>
                    <a href="<?= BASE_URL ?>inquire/" class="text-gray-600 hover:text-blue-600">Inquiries</a>
                    <a href="<?= BASE_URL ?>contact/" class="text-gray-600 hover:text-blue-600">Contacts</a>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <button id="notificationBtn" class="text-gray-600 hover:text-blue-600">
                        <i class="fas fa-bell"></i>
                        <span id="notificationCount" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full px-1 hidden">0</span>
                    </button>
                    <div id="notificationDropdown" class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg z-50 hidden">
                        <div class="py-2" id="notificationList"></div>
                    </div>
                </div>
                <span class="text-gray-700">Welcome, <?= $_SESSION['admin_username'] ?></span>
                <a href="<?= BASE_URL ?>logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Logout</a>
            </div>
        </div>
    </div>
</nav>