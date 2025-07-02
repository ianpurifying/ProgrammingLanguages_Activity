<?php include "includes/header.php"; ?>

<!-- About Section -->
<main class="relative pt-24 pb-20">
  <section class="container mx-auto px-6">
    
    <!-- Header -->
    <div class="text-center mb-16 animate__animated animate__fadeInUp">
      <h1 class="text-5xl lg:text-6xl font-orbitron font-black text-transparent bg-clip-text bg-gradient-to-r from-cyber-yellow via-cyber-blue to-cyber-purple mb-6">
        About Me
      </h1>
      <div class="flex justify-center items-center space-x-4">
        <div class="w-16 h-0.5 bg-gradient-to-r from-transparent to-cyber-yellow"></div>
        <i class="ri-user-3-line text-2xl text-cyber-yellow animate-pulse"></i>
        <div class="w-16 h-0.5 bg-gradient-to-l from-transparent to-cyber-yellow"></div>
      </div>
    </div>
    
    <div class="grid lg:grid-cols-2 gap-16 items-center">
      
      <!-- Left Content - Image -->
      <div class="relative animate__animated animate__fadeInLeft">
        <div class="relative glass-effect rounded-2xl p-8 neon-border">
          <div class="absolute inset-0 bg-gradient-to-br from-cyber-yellow/10 via-transparent to-cyber-blue/10 rounded-2xl"></div>
          
          <!-- Main Image -->
          <div class="relative">
            <img src="img/img_about.jpg" alt="Ian Purificacion Portrait" 
                 class="w-full rounded-xl border-2 border-cyber-yellow/30 hover:border-cyber-yellow transition-all duration-300 transform hover:scale-105">
            
            <!-- Floating Tech Icons -->
            <div class="absolute -top-6 -right-6 w-16 h-16 neon-border rounded-lg glass-effect flex items-center justify-center animate-float">
              <i class="ri-cpu-line text-2xl text-cyber-yellow"></i>
            </div>
            
            <div class="absolute -bottom-6 -left-6 w-16 h-16 neon-border rounded-lg glass-effect flex items-center justify-center animate-float" style="animation-delay: 1s;">
              <i class="ri-book-open-line text-2xl text-cyber-blue"></i>
            </div>
            
            <div class="absolute top-1/2 -right-8 w-12 h-12 neon-border rounded-lg glass-effect flex items-center justify-center animate-float" style="animation-delay: 2s;">
              <i class="ri-lightbulb-line text-lg text-cyber-purple"></i>
            </div>
          </div>
          
          <!-- Status Display -->
          <div class="mt-6 glass-effect rounded-lg p-4 border border-cyber-yellow/20">
            <div class="flex justify-between items-center mb-3">
              <span class="font-tech text-cyber-yellow">Student Profile</span>
              <div class="flex items-center space-x-2">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="font-tech text-green-400 text-xs">ACTIVE</span>
              </div>
            </div>
            
            <div class="space-y-2 text-sm font-tech">
              <div class="flex justify-between">
                <span class="text-gray-400">Location:</span>
                <span class="text-cyber-blue">Quezon, Philippines</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-400">Year:</span>
                <span class="text-cyber-yellow">3rd Year</span>
              </div>
              <div class="flex justify-between">
                <span class="text-gray-400">Status:</span>
                <span class="text-green-400">Learning</span>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <!-- Right Content - Text -->
      <div class="space-y-8 animate__animated animate__fadeInRight">
        
        <!-- Greeting -->
        <div class="glass-effect p-8 rounded-lg neon-border relative overflow-hidden">
          <div class="absolute inset-0 bg-gradient-to-r from-cyber-yellow/5 via-transparent to-cyber-blue/5"></div>
          <div class="relative z-10">
            <h2 class="text-3xl font-orbitron font-bold text-cyber-yellow mb-6 flex items-center">
              <i class="ri-hand-heart-line mr-3 text-4xl"></i>
              Greetings, Human!
            </h2>
            
            <div class="space-y-4 font-tech text-gray-300 leading-relaxed">
              <p>
                <span class="text-cyber-yellow font-bold">Hi! I'm Ian Purificacion</span>, 
                a third-year Computer Science student at 
                <span class="text-cyber-blue font-bold">Colegio de Santo Cristo de Burgos</span>.
              </p>
              
              <p>
                I'm passionate about <span class="text-cyber-purple font-bold">technology</span>, 
                <span class="text-cyber-yellow font-bold">problem-solving</span>, and using my skills 
                to create <span class="text-cyber-blue font-bold">real-world solutions</span>.
              </p>
              
              <p>
                Currently based in <span class="text-cyber-yellow font-bold">Quezon, Philippines</span>, 
                I've been honing my craft through academic work and 
                <span class="text-cyber-purple font-bold">personal growth</span>.
              </p>
            </div>
          </div>
        </div>
        
        <!-- Skills & Interests -->
        <div class="glass-effect p-8 rounded-lg neon-border relative overflow-hidden">
          <div class="absolute inset-0 bg-gradient-to-r from-cyber-blue/5 via-transparent to-cyber-purple/5"></div>
          <div class="relative z-10">
            <h3 class="text-2xl font-orbitron font-bold text-cyber-blue mb-6 flex items-center">
              <i class="ri-brain-line mr-3 text-3xl"></i>
              My Interests
            </h3>
            
            <div class="space-y-4 font-tech text-gray-300 leading-relaxed">
              <p>
                I'm always exploring <span class="text-cyber-yellow font-bold">new tools and frameworks</span>, 
                and I love challenging myself to <span class="text-cyber-blue font-bold">grow and innovate</span>.
              </p>
              
              <p>
                In my free time, you'll find me <span class="text-cyber-purple font-bold">reading books</span> 
                or exploring how <span class="text-cyber-yellow font-bold">tech can make lives better</span>.
              </p>
            </div>
            
            <!-- Interest Tags -->
            <div class="flex flex-wrap gap-3 mt-6">
              <span class="px-4 py-2 bg-cyber-yellow/10 border border-cyber-yellow/30 rounded-full text-cyber-yellow font-tech text-sm">
                <i class="ri-book-2-line mr-2"></i>Learning
              </span>
              <span class="px-4 py-2 bg-cyber-blue/10 border border-cyber-blue/30 rounded-full text-cyber-blue font-tech text-sm">
                <i class="ri-lightbulb-line mr-2"></i>Innovation
              </span>
              <span class="px-4 py-2 bg-cyber-purple/10 border border-cyber-purple/30 rounded-full text-cyber-purple font-tech text-sm">
                <i class="ri-heart-line mr-2"></i>Problem Solving
              </span>
            </div>
          </div>
        </div>
        
        <!-- Current Focus -->
        <div class="glass-effect p-8 rounded-lg neon-border relative overflow-hidden">
          <div class="absolute inset-0 bg-gradient-to-r from-cyber-purple/5 via-transparent to-cyber-yellow/5"></div>
          <div class="relative z-10">
            <h3 class="text-2xl font-orbitron font-bold text-cyber-purple mb-6 flex items-center">
              <i class="ri-focus-3-line mr-3 text-3xl"></i>
              Current Focus
            </h3>
            
            <div class="grid md:grid-cols-2 gap-4">
              <div class="space-y-3">
                <h4 class="font-tech text-cyber-yellow">Academic Goals</h4>
                <ul class="space-y-2 font-tech text-gray-300 text-sm">
                  <li class="flex items-center"><i class="ri-arrow-right-s-line text-cyber-yellow mr-2"></i>Advanced Algorithms</li>
                  <li class="flex items-center"><i class="ri-arrow-right-s-line text-cyber-yellow mr-2"></i>Software Engineering</li>
                  <li class="flex items-center"><i class="ri-arrow-right-s-line text-cyber-yellow mr-2"></i>AI & Machine Learning</li>
                </ul>
              </div>
              
              <div class="space-y-3">
                <h4 class="font-tech text-cyber-blue">Personal Projects</h4>
                <ul class="space-y-2 font-tech text-gray-300 text-sm">
                  <li class="flex items-center"><i class="ri-arrow-right-s-line text-cyber-blue mr-2"></i>Web Applications</li>
                  <li class="flex items-center"><i class="ri-arrow-right-s-line text-cyber-blue mr-2"></i>Mobile Development</li>
                  <li class="flex items-center"><i class="ri-arrow-right-s-line text-cyber-blue mr-2"></i>Open Source Contributions</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
        
        <!-- CTA Button -->
        <div class="text-center">
          <a href="services.php" 
             class="group relative inline-flex items-center neon-border px-8 py-4 rounded-lg font-tech text-cyber-yellow hover:bg-cyber-yellow hover:text-black transition-all duration-300 transform hover:scale-105">
            <span class="relative z-10 flex items-center">
              <i class="ri-rocket-2-line mr-2"></i>
              Explore My Services
            </span>
            <div class="absolute inset-0 bg-gradient-to-r from-cyber-yellow/20 to-cyber-blue/20 blur-sm opacity-0 group-hover:opacity-100 transition-opacity rounded-lg"></div>
          </a>
        </div>
      </div>
    </div>
    
    <!-- Timeline Section -->
    <div class="mt-20">
      <h2 class="text-4xl font-orbitron font-bold text-center text-transparent bg-clip-text bg-gradient-to-r from-cyber-yellow to-cyber-blue mb-12">
        My Journey
      </h2>
      
      <div class="relative">
        <!-- Timeline Line -->
        <div class="absolute left-1/2 transform -translate-x-1/2 w-0.5 h-full bg-gradient-to-b from-cyber-yellow via-cyber-blue to-cyber-purple"></div>
        
        <div class="space-y-12">
          <!-- Timeline Item 1 -->
          <div class="flex items-center justify-center">
            <div class="w-1/2 pr-8 text-right">
              <div class="glass-effect p-6 rounded-lg neon-border">
                <h3 class="font-orbitron text-cyber-yellow text-xl mb-2">Started CS Journey</h3>
                <p class="font-tech text-gray-300 text-sm">Began my Computer Science studies, discovering my passion for coding</p>
                <span class="font-tech text-cyber-blue text-xs">2022</span>
              </div>
            </div>
            <div class="w-4 h-4 bg-cyber-yellow rounded-full border-4 border-cyber-dark relative z-10"></div>
            <div class="w-1/2 pl-8"></div>
          </div>
          
          <!-- Timeline Item 2 -->
          <div class="flex items-center justify-center">
            <div class="w-1/2 pr-8"></div>
            <div class="w-4 h-4 bg-cyber-blue rounded-full border-4 border-cyber-dark relative z-10"></div>
            <div class="w-1/2 pl-8">
              <div class="glass-effect p-6 rounded-lg neon-border">
                <h3 class="font-orbitron text-cyber-blue text-xl mb-2">First Projects</h3>
                <p class="font-tech text-gray-300 text-sm">Built my first web applications and discovered my love for problem-solving</p>
                <span class="font-tech text-cyber-yellow text-xs">2023</span>
              </div>
            </div>
          </div>
          
          <!-- Timeline Item 3 -->
          <div class="flex items-center justify-center">
            <div class="w-1/2 pr-8 text-right">
              <div class="glass-effect p-6 rounded-lg neon-border">
                <h3 class="font-orbitron text-cyber-purple text-xl mb-2">Advanced Learning</h3>
                <p class="font-tech text-gray-300 text-sm">Diving deeper into advanced concepts and building complex systems</p>
                <span class="font-tech text-cyber-blue text-xs">2024</span>
              </div>
            </div>
            <div class="w-4 h-4 bg-cyber-purple rounded-full border-4 border-cyber-dark relative z-10"></div>
            <div class="w-1/2 pl-8"></div>
          </div>
          
          <!-- Timeline Item 4 -->
          <div class="flex items-center justify-center">
            <div class="w-1/2 pr-8"></div>
            <div class="w-4 h-4 bg-gradient-to-r from-cyber-yellow to-cyber-blue rounded-full border-4 border-cyber-dark relative z-10 animate-pulse"></div>
            <div class="w-1/2 pl-8">
              <div class="glass-effect p-6 rounded-lg neon-border">
                <h3 class="font-orbitron text-cyber-yellow text-xl mb-2">Present Day</h3>
                <p class="font-tech text-gray-300 text-sm">Continuously learning and building innovative solutions for tomorrow</p>
                <span class="font-tech text-cyber-purple text-xs">2025</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<?php include "includes/footer.php"; ?>