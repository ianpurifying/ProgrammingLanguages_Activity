<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Click by Nica</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'poppins': ['Poppins', 'sans-serif'],
          },
        }
      }
    }
  </script>
</head>
<body class="font-poppins bg-gradient-to-br from-slate-50 to-gray-100 min-h-screen">
  <!-- Navigation Header -->
  <header class="fixed w-full top-0 z-50 bg-white/80 backdrop-blur-md border-b border-gray-200/50 shadow-sm">
    <nav class="container mx-auto px-6 py-4">
      <div class="flex items-center justify-between">
        <!-- Logo -->
        <div class="text-2xl font-bold text-gray-800">
          <i class="fas fa-camera text-indigo-600 mr-2"></i>
          Click by Nica
        </div>
        
        <!-- Desktop Navigation -->
        <ul class="hidden md:flex space-x-8">
          <li><a href="index.php" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-300 relative group">
            HOME
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300"></span>
          </a></li>
          <li><a href="about.php" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-300 relative group">
            ABOUT
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300"></span>
          </a></li>
          <li><a href="service.php" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-300 relative group">
            SERVICES
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300"></span>
          </a></li>
          <li><a href="contact.php" class="text-gray-700 hover:text-indigo-600 font-medium transition-colors duration-300 relative group">
            CONTACT
            <span class="absolute -bottom-1 left-0 w-0 h-0.5 bg-indigo-600 group-hover:w-full transition-all duration-300"></span>
          </a></li>
          <li><a href="inquire.php" class="bg-indigo-600 text-white px-6 py-2 rounded-full hover:bg-indigo-700 transition-colors duration-300 font-medium shadow-md hover:shadow-lg">
            INQUIRE
          </a></li>
        </ul>
        
        <!-- Mobile Menu Button -->
        <button class="md:hidden text-gray-700 hover:text-indigo-600 focus:outline-none" id="mobile-menu-button">
          <i class="fas fa-bars text-xl"></i>
        </button>
      </div>
      
      <!-- Mobile Navigation -->
      <div class="md:hidden hidden mt-4 pb-4 border-t border-gray-200" id="mobile-menu">
        <ul class="space-y-3 pt-4">
          <li><a href="index.php" class="block text-gray-700 hover:text-indigo-600 font-medium py-2">HOME</a></li>
          <li><a href="about.php" class="block text-gray-700 hover:text-indigo-600 font-medium py-2">ABOUT</a></li>
          <li><a href="service.php" class="block text-gray-700 hover:text-indigo-600 font-medium py-2">SERVICES</a></li>
          <li><a href="contact.php" class="block text-gray-700 hover:text-indigo-600 font-medium py-2">CONTACT</a></li>
          <li><a href="inquire.php" class="block bg-indigo-600 text-white px-6 py-3 rounded-full hover:bg-indigo-700 transition-colors duration-300 font-medium text-center">INQUIRE</a></li>
        </ul>
      </div>
    </nav>
  </header>

  <script>
    // Mobile menu toggle
    document.getElementById('mobile-menu-button').addEventListener('click', function() {
      const mobileMenu = document.getElementById('mobile-menu');
      mobileMenu.classList.toggle('hidden');
    });
  </script>