<aside id="sidebar" class="fixed left-0 top-0 z-50 h-screen w-64 bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-700 shadow-xl transition-transform duration-300 transform -translate-x-full lg:translate-x-0">
    <div class="flex flex-col h-full">
        <!-- Logo/Brand Section -->
        <div class="flex items-center justify-between p-6 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg shadow-lg">
                    <i class="fas fa-sliders-h text-white text-lg"></i>
                </div>
                <h1 class="text-xl font-bold text-gray-900 dark:text-white tracking-tight">Admin</h1>
            </div>
            <button id="closeSidebar" class="lg:hidden p-1 rounded-md text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                <i class="fas fa-times text-lg"></i>
            </button>
        </div>

        <!-- Navigation Links -->
        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="<?= BASE_URL ?>" 
               class="nav-link flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-800 rounded-lg transition-all duration-200 group">
                <i class="fas fa-home text-gray-400 group-hover:text-blue-500 mr-3 text-lg"></i>
                Dashboard
            </a>
            <a href="<?= BASE_URL ?>inquire/" 
               class="nav-link flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-800 rounded-lg transition-all duration-200 group">
                <i class="fas fa-question-circle text-gray-400 group-hover:text-blue-500 mr-3 text-lg"></i>
                Inquiries
            </a>
            <a href="<?= BASE_URL ?>contact/" 
               class="nav-link flex items-center px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-800 rounded-lg transition-all duration-200 group">
                <i class="fas fa-address-book text-gray-400 group-hover:text-blue-500 mr-3 text-lg"></i>
                Contacts
            </a>
        </nav>

        <!-- Theme Toggle -->
        <div class="px-4 py-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Theme</span>
                <button id="themeToggle" class="relative inline-flex h-6 w-11 items-center rounded-full bg-gray-200 dark:bg-gray-600 transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <span id="toggleSlider" class="inline-block h-4 w-4 transform rounded-full bg-white shadow-lg transition-transform duration-200 translate-x-1 dark:translate-x-6"></span>
                </button>
            </div>
        </div>

        <!-- User Profile Section -->
        <div class="px-4 py-4 border-t border-gray-200 dark:border-gray-700">
            <!-- Notifications -->
            <div class="relative mb-4">
                <button id="notificationBtn" 
                        class="w-full flex items-center justify-center p-3 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <i class="fas fa-bell text-lg mr-2"></i>
                    <span class="text-sm font-medium">Notifications</span>
                    <span id="notificationCount" 
                          class="ml-auto bg-red-500 text-white text-xs rounded-full px-2 py-1 hidden">0</span>
                </button>
                <div id="notificationDropdown" 
                     class="absolute bottom-full left-0 right-0 mb-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 z-50 hidden">
                    <div class="py-2" id="notificationList"></div>
                </div>
            </div>

            <!-- User Info -->
            <div class="flex items-center space-x-3 mb-4">
                <div class="flex items-center justify-center w-10 h-10 bg-gradient-to-br from-gray-500 to-gray-600 rounded-full">
                    <i class="fas fa-user text-white text-sm"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 dark:text-white truncate">Welcome</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate"><?= $_SESSION['admin_username'] ?></p>
                </div>
            </div>

            <!-- Logout Button -->
            <a href="<?= BASE_URL ?>logout.php" 
               class="w-full inline-flex items-center justify-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                <i class="fas fa-sign-out-alt mr-2 text-sm"></i>
                Logout
            </a>
        </div>
    </div>
</aside>

<!-- Mobile Overlay -->
<div id="sidebarOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 lg:hidden hidden"></div>

<!-- Mobile Header -->
<header class="lg:hidden bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-700 shadow-sm sticky top-0 z-30">
    <div class="flex items-center justify-between px-4 py-3">
        <button id="openSidebar" class="p-2 rounded-md text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 transition-colors">
            <i class="fas fa-bars text-lg"></i>
        </button>
        <div class="flex items-center space-x-3">
            <div class="flex-shrink-0 flex items-center justify-center w-8 h-8 bg-gradient-to-br from-blue-600 to-blue-700 rounded-lg">
                <i class="fas fa-sliders-h text-white text-sm"></i>
            </div>
            <h1 class="text-lg font-bold text-gray-900 dark:text-white">Admin</h1>
        </div>
        <div class="w-10"></div>
    </div>
</header>

<main class="lg:ml-64 min-h-screen bg-gray-100 dark:bg-gray-950 transition-colors duration-200">

<script>
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const sidebarOverlay = document.getElementById('sidebarOverlay');
    const openSidebarBtn = document.getElementById('openSidebar');
    const closeSidebarBtn = document.getElementById('closeSidebar');
    const themeToggle = document.getElementById('themeToggle');
    const toggleSlider = document.getElementById('toggleSlider');
    const notificationBtn = document.getElementById('notificationBtn');
    const notificationDropdown = document.getElementById('notificationDropdown');

    // Theme Management
    function initTheme() {
        const savedTheme = localStorage.getItem('theme') || 'light';
        applyTheme(savedTheme);
    }

    function applyTheme(theme) {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
            toggleSlider.classList.remove('translate-x-1');
            toggleSlider.classList.add('translate-x-6');
        } else {
            document.documentElement.classList.remove('dark');
            toggleSlider.classList.remove('translate-x-6');
            toggleSlider.classList.add('translate-x-1');
        }
        localStorage.setItem('theme', theme);
    }

    themeToggle.addEventListener('click', function() {
        const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
        const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
        applyTheme(newTheme);
    });

    // Sidebar Management
    function showSidebar() {
        sidebar.classList.remove('-translate-x-full');
        sidebarOverlay.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function hideSidebar() {
        sidebar.classList.add('-translate-x-full');
        sidebarOverlay.classList.add('hidden');
        document.body.style.overflow = '';
    }

    openSidebarBtn?.addEventListener('click', showSidebar);
    closeSidebarBtn?.addEventListener('click', hideSidebar);
    sidebarOverlay?.addEventListener('click', hideSidebar);

    // Active Link Highlighting
    function setActiveLink() {
        const currentPath = window.location.pathname.replace(/\/+$/, ''); // trim trailing slash
        const navLinks = document.querySelectorAll('.nav-link');

        navLinks.forEach(link => {
            link.classList.remove('bg-blue-100', 'dark:bg-blue-900', 'text-blue-600', 'dark:text-blue-400');

            const url = new URL(link.href);
            const linkPath = url.pathname.replace(/\/+$/, '');

            if (currentPath === linkPath) {
                link.classList.add('bg-blue-100', 'dark:bg-blue-900', 'text-blue-600', 'dark:text-blue-400');
            }
        });
    }

    // Keyboard Navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            hideSidebar();
            notificationDropdown?.classList.add('hidden');
        }
    });

    // Handle window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 1024) {
            hideSidebar();
        }
    });

    // Initialize
    initTheme();
    setActiveLink();
});
</script>