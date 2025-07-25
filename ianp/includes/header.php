<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>IAN | Portfolio</title>
  
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Share+Tech+Mono&display=swap" rel="stylesheet">
  
  <!-- Remix Icons -->
  <link href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css" rel="stylesheet">
  
  <!-- Animate.css -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
  
  <script>
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            'orbitron': ['Orbitron', 'monospace'],
            'tech': ['Share Tech Mono', 'monospace']
          },
          colors: {
            'cyber-dark': '#0a0a0a',
            'cyber-gray': '#1a1a1a',
            'cyber-yellow': '#ffd700',
            'cyber-blue': '#00ffff',
            'cyber-purple': '#8b00ff'
          },
          animation: {
            'glow': 'glow 2s ease-in-out infinite alternate',
            'float': 'float 3s ease-in-out infinite',
            'scan': 'scan 3s linear infinite'
          },
          keyframes: {
            glow: {
              '0%': { 'box-shadow': '0 0 5px #ffd700, 0 0 10px #ffd700, 0 0 15px #ffd700' },
              '100%': { 'box-shadow': '0 0 10px #ffd700, 0 0 20px #ffd700, 0 0 30px #ffd700' }
            },
            float: {
              '0%, 100%': { transform: 'translateY(0px)' },
              '50%': { transform: 'translateY(-10px)' }
            },
            scan: {
              '0%': { transform: 'translateX(-100%)' },
              '100%': { transform: 'translateX(100vw)' }
            }
          }
        }
      }
    }
  </script>
  
  <style>
    body {
      background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 50%, #0a0a0a 100%);
      background-attachment: fixed;
    }
    
    .cyber-grid {
      background-image: 
        linear-gradient(rgba(255, 215, 0, 0.1) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255, 215, 0, 0.1) 1px, transparent 1px);
      background-size: 50px 50px;
    }
    
    .neon-border {
      border: 1px solid #ffd700;
      box-shadow: 
        0 0 5px #ffd700,
        inset 0 0 5px rgba(255, 215, 0, 0.2);
    }
    
    .glass-effect {
      background: rgba(255, 255, 255, 0.05);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 215, 0, 0.2);
    }
    
    .scanner-line {
      position: absolute;
      top: 0;
      left: -100%;
      width: 2px;
      height: 100%;
      background: linear-gradient(to bottom, transparent, #ffd700, transparent);
      animation: scan 3s linear infinite;
    }
  </style>
</head>
<body class="bg-cyber-dark text-white min-h-screen cyber-grid">
  
  <!-- Animated scanner line -->
  <div class="scanner-line"></div>
  
  <header class="fixed top-0 w-full z-50 glass-effect border-b border-cyber-yellow/30">
    <nav class="container mx-auto px-6 py-4">
      <div class="flex items-center justify-between">
        
        <!-- Logo -->
        <div class="flex items-center space-x-2 animate__animated animate__fadeInLeft">
          <div class="relative">
            <a href="index.php"><h1 class="text-3xl font-orbitron font-black text-cyber-yellow">
              IAN<span class="text-white">P</span>
            </h1></a>
            <div class="absolute -inset-1 bg-gradient-to-r from-cyber-yellow/20 to-cyber-blue/20 blur-sm -z-10"></div>
          </div>
          <i class="ri-cpu-line text-2xl text-cyber-yellow animate-pulse"></i>
        </div>
        
        <!-- Desktop Navigation -->
        <div class="hidden md:flex items-center space-x-8">
          <a href="index.php" class="nav-link relative group font-tech text-white hover:text-cyber-yellow transition-all duration-300">
            <i class="ri-home-4-line mr-2"></i>Home
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyber-yellow group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="about.php" class="nav-link relative group font-tech text-white hover:text-cyber-yellow transition-all duration-300">
            <i class="ri-user-3-line mr-2"></i>About
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyber-yellow group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="services.php" class="nav-link relative group font-tech text-white hover:text-cyber-yellow transition-all duration-300">
            <i class="ri-service-line mr-2"></i>Services
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyber-yellow group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="contact.php" class="nav-link relative group font-tech text-white hover:text-cyber-yellow transition-all duration-300">
            <i class="ri-message-3-line mr-2"></i>Contact
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyber-yellow group-hover:w-full transition-all duration-300"></span>
          </a>
          <a href="inquiries.php" class="nav-link relative group font-tech text-white hover:text-cyber-yellow transition-all duration-300">
            <i class="ri-question-line mr-2"></i>Inquire
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-cyber-yellow group-hover:w-full transition-all duration-300"></span>
          </a>
          
          <!-- Resume Button -->
          <a href="files/resume.pdf" target="_blank" 
             class="neon-border px-6 py-2 rounded-lg font-tech text-cyber-yellow hover:bg-cyber-yellow hover:text-black transition-all duration-300 transform hover:scale-105 animate-float">
            <i class="ri-file-text-line mr-2"></i>Resume
          </a>
        </div>
        
        <!-- Mobile Menu Button -->
        <button id="mobile-menu-btn" class="md:hidden text-cyber-yellow text-2xl hover:animate-pulse">
          <i class="ri-menu-3-line"></i>
        </button>
      </div>
      
      <!-- Mobile Navigation -->
      <div id="mobile-menu" class="md:hidden hidden mt-4 pb-4">
        <div class="flex flex-col space-y-4 glass-effect p-6 rounded-lg neon-border">
          <a href="index.php" class="flex items-center space-x-3 font-tech text-white hover:text-cyber-yellow transition-colors">
            <i class="ri-home-4-line"></i><span>Home</span>
          </a>
          <a href="about.php" class="flex items-center space-x-3 font-tech text-white hover:text-cyber-yellow transition-colors">
            <i class="ri-user-3-line"></i><span>About</span>
          </a>
          <a href="services.php" class="flex items-center space-x-3 font-tech text-white hover:text-cyber-yellow transition-colors">
            <i class="ri-service-line"></i><span>Services</span>
          </a>
          <a href="contact.php" class="flex items-center space-x-3 font-tech text-white hover:text-cyber-yellow transition-colors">
            <i class="ri-message-3-line"></i><span>Contact</span>
          </a>
          <a href="inquiries.php" class="flex items-center space-x-3 font-tech text-white hover:text-cyber-yellow transition-colors">
            <i class="ri-question-line"></i><span>Inquire</span>
          </a>
          <a href="files/resume.pdf" target="_blank" 
             class="flex items-center space-x-3 neon-border px-4 py-2 rounded-lg font-tech text-cyber-yellow hover:bg-cyber-yellow hover:text-black transition-all duration-300">
            <i class="ri-file-text-line"></i><span>Resume</span>
          </a>
        </div>
      </div>
    </nav>
  </header>

  <script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
      const menu = document.getElementById('mobile-menu');
      const icon = this.querySelector('i');
      
      menu.classList.toggle('hidden');
      
      if (menu.classList.contains('hidden')) {
        icon.className = 'ri-menu-3-line';
      } else {
        icon.className = 'ri-close-line';
      }
    });
  </script>