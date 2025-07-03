<nav class="bg-white border-b border-gray-200 shadow-sm sticky top-0 z-40">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Left section: Logo and Navigation -->
            <div class="flex items-center space-x-8">
                <!-- Logo/Brand -->
                <div class="flex items-center space-x-3">
                    <div class="flex-shrink-0 flex items-center justify-center w-10 h-10 bg-gray-800 rounded-lg shadow-sm">
                        <i class="fas fa-sliders-h text-white text-lg"></i>
                    </div>
                    <h1 class="text-xl font-bold text-gray-900 tracking-tight">Admin</h1>
                </div>
                
                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="<?= BASE_URL ?>" 
                       class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-all duration-200 group">
                        <i class="fas fa-home text-gray-400 group-hover:text-blue-500 mr-2 text-sm"></i>
                        Dashboard
                    </a>
                    <a href="<?= BASE_URL ?>inquire/" 
                       class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-all duration-200 group">
                        <i class="fas fa-question-circle text-gray-400 group-hover:text-blue-500 mr-2 text-sm"></i>
                        Inquiries
                    </a>
                    <a href="<?= BASE_URL ?>contact/" 
                       class="flex items-center px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-all duration-200 group">
                        <i class="fas fa-address-book text-gray-400 group-hover:text-blue-500 mr-2 text-sm"></i>
                        Contacts
                    </a>
                </div>
            </div>

            <!-- Right section: User actions -->
            <div class="flex items-center space-x-4">
                <!-- Notifications -->
                <div class="relative">
                    <button id="notificationBtn" 
                            class="relative flex items-center justify-center w-10 h-10 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-full transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-bell text-lg"></i>
                        <span id="notificationCount" 
                              class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1 hidden">0</span>
                    </button>
                    <div id="notificationDropdown" 
                         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50 hidden">
                        <div class="py-2" id="notificationList"></div>
                    </div>
                </div>

                <!-- User Profile Section -->
                <div class="flex items-center space-x-3 pl-4 border-l border-gray-200">
                    <!-- User Avatar -->
                    <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-br from-gray-500 to-gray-600 rounded-full">
                        <i class="fas fa-user text-white text-sm"></i>
                    </div>
                    
                    <!-- Welcome Message -->
                    <div class="hidden sm:block">
                        <span class="text-sm font-medium text-gray-700">Welcome,</span>
                        <span class="text-sm font-semibold text-gray-900 ml-1"><?= $_SESSION['admin_username'] ?></span>
                    </div>
                    
                    <!-- Logout Button -->
                    <a href="<?= BASE_URL ?>logout.php" 
                       class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-gradient-to-r from-red-500 to-red-600 hover:from-red-600 hover:to-red-700 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                        <i class="fas fa-sign-out-alt mr-2 text-sm"></i>
                        Logout
                    </a>
                </div>

                <!-- Mobile menu button -->
                <div class="lg:hidden">
                    <button id="mobileMenuBtn" 
                            class="flex items-center justify-center w-10 h-10 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-md transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu" class="lg:hidden hidden border-t border-gray-200 bg-gray-50">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="<?= BASE_URL ?>" 
                   class="flex items-center px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-white rounded-md transition-all duration-200">
                    <i class="fas fa-home text-gray-400 mr-3"></i>
                    Dashboard
                </a>
                <a href="<?= BASE_URL ?>inquire/" 
                   class="flex items-center px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-white rounded-md transition-all duration-200">
                    <i class="fas fa-question-circle text-gray-400 mr-3"></i>
                    Inquiries
                </a>
                <a href="<?= BASE_URL ?>contact/" 
                   class="flex items-center px-3 py-2 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-white rounded-md transition-all duration-200">
                    <i class="fas fa-address-book text-gray-400 mr-3"></i>
                    Contacts
                </a>
            </div>
        </div>
    </div>
</nav>

<main>