<?php include "includes/header.php"; ?>

<!-- Main Hero Section -->
<main class="relative pt-24 pb-20">
  <section class="container mx-auto px-6">
    <div class="grid lg:grid-cols-2 gap-12 items-center min-h-screen">
      
      <!-- Left Content -->
      <div class="space-y-8 animate__animated animate__fadeInLeft">
        
        <!-- Greeting with typing effect -->
        <div class="space-y-4">
          <div class="flex items-center space-x-3 mb-6">
            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
            <span class="font-tech text-cyber-yellow text-sm">SYSTEM.ONLINE</span>
          </div>
          
          <h1 class="text-5xl lg:text-7xl font-orbitron font-black leading-tight">
            <span class="text-gray-400">Hello, I'm</span><br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyber-yellow via-cyber-blue to-cyber-purple">
              <span id="typing-name">IAN PURIFICACION</span>
            </span>
            <br>
            <span class="text-2xl lg:text-3xl text-cyber-yellow font-tech">
              <span id="typing-role"></span>
            </span>
          </h1>
          
          <!-- Animated subtitle -->
          <div class="relative">
            <p class="text-xl text-gray-300 font-tech leading-relaxed">
              I'm a <span class="text-cyber-yellow font-bold">Computer Science student</span> passionate about building 
              <span class="text-cyber-blue font-bold">innovative systems</span> that solve 
              <span class="text-cyber-purple font-bold">real-world problems</span>. 
              Welcome to my <span class="text-cyber-yellow font-bold">digital portfolio</span>.
            </p>
            <div class="absolute -inset-2 bg-gradient-to-r from-cyber-yellow/10 via-transparent to-cyber-blue/10 blur-xl -z-10"></div>
          </div>
        </div>

        <!-- Typewriter CSS -->
        <style>
        .typewriter-cursor {
          border-right: 2px solid #ffd700;
          animation: blink-cursor 1s infinite;
        }

        @keyframes blink-cursor {
          0%, 50% { border-color: #ffd700; }
          51%, 100% { border-color: transparent; }
        }
        </style>

        <!-- Typewriter JavaScript -->
        <script>
        document.addEventListener('DOMContentLoaded', function() {
          const nameElement = document.getElementById('typing-name');
          const roleElement = document.getElementById('typing-role');
          
          const roles = [
            'Software Engineer',
            'Blockchain Architect', 
            'Red Team Operator',
            'Blue Team Analyst'
          ];
          
          let currentRoleIndex = 0;
          
          function typeText(element, text, speed = 100) {
            return new Promise((resolve) => {
              element.textContent = '';
              element.classList.add('typewriter-cursor');
              
              let i = 0;
              const timer = setInterval(() => {
                element.textContent += text.charAt(i);
                i++;
                
                if (i >= text.length) {
                  clearInterval(timer);
                  setTimeout(() => {
                    element.classList.remove('typewriter-cursor');
                    resolve();
                  }, 500);
                }
              }, speed);
            });
          }
          
          function deleteText(element, speed = 50) {
            return new Promise((resolve) => {
              const text = element.textContent;
              element.classList.add('typewriter-cursor');
              
              let i = text.length;
              const timer = setInterval(() => {
                element.textContent = text.substring(0, i - 1);
                i--;
                
                if (i <= 0) {
                  clearInterval(timer);
                  resolve();
                }
              }, speed);
            });
          }
          
          async function startNameTyping() {
            await typeText(nameElement, 'IAN PURIFICACION', 80);
            await new Promise(resolve => setTimeout(resolve, 1000));
            startRoleTyping();
          }
          
          async function startRoleTyping() {
            while (true) {
              await typeText(roleElement, roles[currentRoleIndex], 60);
              await new Promise(resolve => setTimeout(resolve, 2000));
              await deleteText(roleElement, 40);
              await new Promise(resolve => setTimeout(resolve, 300));
              currentRoleIndex = (currentRoleIndex + 1) % roles.length;
            }
          }
          
          // Start the typing animation
          startNameTyping();
        });
        </script>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-6">
          <a href="about.php" 
             class="group relative neon-border px-8 py-4 rounded-lg font-tech text-cyber-yellow hover:bg-cyber-yellow hover:text-black transition-all duration-300 transform hover:scale-105 text-center">
            <span class="relative z-10 flex items-center justify-center">
              <i class="ri-user-search-line mr-2"></i>
              Discover My Journey
            </span>
            <div class="absolute inset-0 bg-gradient-to-r from-cyber-yellow/20 to-cyber-blue/20 blur-sm opacity-0 group-hover:opacity-100 transition-opacity rounded-lg"></div>
          </a>
          
          <a href="services.php" 
             class="group relative glass-effect px-8 py-4 rounded-lg font-tech text-white hover:text-cyber-yellow border border-white/20 hover:border-cyber-yellow/50 transition-all duration-300 transform hover:scale-105 text-center">
            <span class="flex items-center justify-center">
              <i class="ri-rocket-2-line mr-2"></i>
              Explore Services
            </span>
          </a>
        </div>
        
        <!-- Tech Stack Preview -->
        <div class="glass-effect p-6 rounded-lg neon-border space-y-4">
          <h3 class="font-orbitron text-cyber-yellow text-lg flex items-center">
            <i class="ri-code-s-slash-line mr-2"></i>
            Current Tech Stack
          </h3>
          <div class="flex flex-wrap gap-3">
            <span class="px-3 py-1 bg-cyber-yellow/10 border border-cyber-yellow/30 rounded-full text-cyber-yellow font-tech text-sm">
              <i class="ri-html5-line mr-1"></i>HTML5
            </span>
            <span class="px-3 py-1 bg-cyber-blue/10 border border-cyber-blue/30 rounded-full text-cyber-blue font-tech text-sm">
              <i class="ri-css3-line mr-1"></i>CSS3
            </span>
            <span class="px-3 py-1 bg-cyber-purple/10 border border-cyber-purple/30 rounded-full text-cyber-purple font-tech text-sm">
              <i class="ri-javascript-line mr-1"></i>JavaScript
            </span>
            <span class="px-3 py-1 bg-green-500/10 border border-green-500/30 rounded-full text-green-400 font-tech text-sm">
              <i class="ri-database-2-line mr-1"></i>PHP
            </span>
            <span class="px-3 py-1 bg-red-500/10 border border-red-500/30 rounded-full text-red-400 font-tech text-sm">
              <i class="ri-git-branch-line mr-1"></i>Git
            </span>
          </div>
        </div>
      </div>
      
      <!-- Right Content - Hero Image -->
      <div class="relative animate__animated animate__fadeInRight">
        <div class="relative">
          
          <!-- Main Image Container -->
          <div class="relative glass-effect rounded-2xl p-8 neon-border">
            <div class="absolute inset-0 bg-gradient-to-br from-cyber-yellow/10 via-transparent to-cyber-blue/10 rounded-2xl"></div>
            
            <!-- Profile Image -->
            <div class="relative">
              <img src="img/ianp.png" alt="Ian Purificacion - Developer" 
                   class="w-full max-w-md mx-auto rounded-xl border-2 border-cyber-yellow/30 hover:border-cyber-yellow transition-all duration-300 transform hover:scale-105">
              
              <!-- Floating Elements -->
              <div class="absolute -top-4 -right-4 w-16 h-16 neon-border rounded-lg glass-effect flex items-center justify-center animate-float">
                <i class="ri-brain-line text-2xl text-cyber-yellow"></i>
              </div>
              
              <div class="absolute -bottom-4 -left-4 w-16 h-16 neon-border rounded-lg glass-effect flex items-center justify-center animate-float" style="animation-delay: 1s;">
                <i class="ri-terminal-box-line text-2xl text-cyber-blue"></i>
              </div>
            </div>
            
            <!-- Status Bar -->
            <div class="mt-6 glass-effect rounded-lg p-4 border border-cyber-yellow/20">
              <div class="flex justify-between items-center mb-2">
                <span class="font-tech text-cyber-yellow text-sm">Developer Status</span>
                <div class="flex items-center space-x-2">
                  <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                  <span class="font-tech text-green-400 text-xs">ACTIVE</span>
                </div>
              </div>
              
              <!-- Progress Bars -->
              <div class="space-y-2">
                <div class="flex justify-between text-xs font-tech text-gray-400">
                  <span>Learning Progress</span>
                  <span>85%</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                  <div class="bg-gradient-to-r from-cyber-yellow to-cyber-blue h-2 rounded-full animate-pulse" style="width: 85%"></div>
                </div>
                
                <div class="flex justify-between text-xs font-tech text-gray-400">
                  <span>Project Completion</span>
                  <span>92%</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                  <div class="bg-gradient-to-r from-cyber-blue to-cyber-purple h-2 rounded-full animate-pulse" style="width: 92%"></div>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Floating Code Snippets -->
          <div class="absolute -z-10 top-10 -left-10 glass-effect p-3 rounded-lg neon-border opacity-70 animate-float">
            <code class="font-tech text-cyber-yellow text-xs">
              console.log('Hello World');
            </code>
          </div>
          
          <div class="absolute -z-10 bottom-10 -right-10 glass-effect p-3 rounded-lg neon-border opacity-70 animate-float" style="animation-delay: 2s;">
            <code class="font-tech text-cyber-blue text-xs">
              &lt;/dream&gt;
            </code>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce">
      <div class="flex flex-col items-center space-y-2">
        <span class="font-tech text-cyber-yellow text-xs">SCROLL TO EXPLORE</span>
        <i class="ri-arrow-down-double-line text-cyber-yellow text-xl animate-pulse"></i>
      </div>
    </div>
  </section>
  
  <!-- Quick Stats Section -->
  <section class="container mx-auto px-6 mt-20">
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
      <div class="glass-effect p-6 rounded-lg neon-border text-center hover:scale-105 transition-transform duration-300">
        <i class="ri-code-line text-3xl text-cyber-yellow mb-2"></i>
        <h3 class="font-orbitron text-2xl font-bold text-white">50+</h3>
        <p class="font-tech text-gray-400 text-sm">Projects</p>
      </div>
      
      <div class="glass-effect p-6 rounded-lg neon-border text-center hover:scale-105 transition-transform duration-300">
        <i class="ri-time-line text-3xl text-cyber-blue mb-2"></i>
        <h3 class="font-orbitron text-2xl font-bold text-white">3+</h3>
        <p class="font-tech text-gray-400 text-sm">Years Learning</p>
      </div>
      
      <div class="glass-effect p-6 rounded-lg neon-border text-center hover:scale-105 transition-transform duration-300">
        <i class="ri-stack-line text-3xl text-cyber-purple mb-2"></i>
        <h3 class="font-orbitron text-2xl font-bold text-white">10+</h3>
        <p class="font-tech text-gray-400 text-sm">Technologies</p>
      </div>
      
      <div class="glass-effect p-6 rounded-lg neon-border text-center hover:scale-105 transition-transform duration-300">
        <i class="ri-lightbulb-line text-3xl text-cyber-yellow mb-2"></i>
        <h3 class="font-orbitron text-2xl font-bold text-white">∞</h3>
        <p class="font-tech text-gray-400 text-sm">Ideas</p>
      </div>
    </div>
  </section>
</main>

<?php include "includes/footer.php"; ?>