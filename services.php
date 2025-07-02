<?php include "includes/header.php"; ?>

<!-- Services Section -->
<main class="relative pt-24 pb-20">
  <section class="container mx-auto px-6">
    
    <!-- Header -->
    <div class="text-center mb-16 animate__animated animate__fadeInUp">
      <h1 class="text-5xl lg:text-6xl font-orbitron font-black text-transparent bg-clip-text bg-gradient-to-r from-cyber-yellow via-cyber-blue to-cyber-purple mb-6">
        My Services
      </h1>
      <div class="flex justify-center items-center space-x-4 mb-6">
        <div class="w-16 h-0.5 bg-gradient-to-r from-transparent to-cyber-yellow"></div>
        <i class="ri-service-line text-2xl text-cyber-yellow animate-pulse"></i>
        <div class="w-16 h-0.5 bg-gradient-to-l from-transparent to-cyber-yellow"></div>
      </div>
      <p class="font-tech text-xl text-gray-300 max-w-2xl mx-auto">
        Transforming ideas into <span class="text-cyber-yellow font-bold">digital reality</span> through cutting-edge technology solutions
      </p>
    </div>
    
    <!-- Services Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
      
      <!-- Web Development -->
      <div class="service-card group glass-effect p-8 rounded-lg neon-border hover:border-cyber-yellow/70 transition-all duration-300 transform hover:scale-105 cursor-pointer relative overflow-hidden animate__animated animate__fadeInUp"
           data-service="web" style="animation-delay: 0.1s;">
        <div class="absolute inset-0 bg-gradient-to-br from-cyber-yellow/5 via-transparent to-cyber-blue/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10">
          <div class="w-20 h-20 mx-auto mb-6 neon-border rounded-lg glass-effect flex items-center justify-center group-hover:animate-pulse">
            <i class="ri-code-s-slash-line text-3xl text-cyber-yellow"></i>
          </div>
          <h3 class="text-2xl font-orbitron font-bold text-white mb-4 text-center group-hover:text-cyber-yellow transition-colors">
            Web Development
          </h3>
          <p class="font-tech text-gray-400 text-center text-sm leading-relaxed">
            Crafting responsive, modern web experiences with cutting-edge technologies
          </p>
          <div class="flex justify-center mt-4">
            <span class="px-3 py-1 bg-cyber-yellow/10 border border-cyber-yellow/30 rounded-full text-cyber-yellow font-tech text-xs">
              Click to explore
            </span>
          </div>
        </div>
      </div>
      
      <!-- App Development -->
      <div class="service-card group glass-effect p-8 rounded-lg neon-border hover:border-cyber-blue/70 transition-all duration-300 transform hover:scale-105 cursor-pointer relative overflow-hidden animate__animated animate__fadeInUp"
           data-service="app" style="animation-delay: 0.2s;">
        <div class="absolute inset-0 bg-gradient-to-br from-cyber-blue/5 via-transparent to-cyber-purple/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10">
          <div class="w-20 h-20 mx-auto mb-6 neon-border rounded-lg glass-effect flex items-center justify-center group-hover:animate-pulse">
            <i class="ri-smartphone-line text-3xl text-cyber-blue"></i>
          </div>
          <h3 class="text-2xl font-orbitron font-bold text-white mb-4 text-center group-hover:text-cyber-blue transition-colors">
            App Development
          </h3>
          <p class="font-tech text-gray-400 text-center text-sm leading-relaxed">
            Building powerful mobile applications for iOS and Android platforms
          </p>
          <div class="flex justify-center mt-4">
            <span class="px-3 py-1 bg-cyber-blue/10 border border-cyber-blue/30 rounded-full text-cyber-blue font-tech text-xs">
              Click to explore
            </span>
          </div>
        </div>
      </div>
      
      <!-- Desktop Development -->
      <div class="service-card group glass-effect p-8 rounded-lg neon-border hover:border-cyber-purple/70 transition-all duration-300 transform hover:scale-105 cursor-pointer relative overflow-hidden animate__animated animate__fadeInUp"
           data-service="desktop" style="animation-delay: 0.3s;">
        <div class="absolute inset-0 bg-gradient-to-br from-cyber-purple/5 via-transparent to-cyber-yellow/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10">
          <div class="w-20 h-20 mx-auto mb-6 neon-border rounded-lg glass-effect flex items-center justify-center group-hover:animate-pulse">
            <i class="ri-computer-line text-3xl text-cyber-purple"></i>
          </div>
          <h3 class="text-2xl font-orbitron font-bold text-white mb-4 text-center group-hover:text-cyber-purple transition-colors">
            Desktop App Development
          </h3>
          <p class="font-tech text-gray-400 text-center text-sm leading-relaxed">
            Creating cross-platform desktop software with native performance
          </p>
          <div class="flex justify-center mt-4">
            <span class="px-3 py-1 bg-cyber-purple/10 border border-cyber-purple/30 rounded-full text-cyber-purple font-tech text-xs">
              Click to explore
            </span>
          </div>
        </div>
      </div>
      
      <!-- AI Integration -->
      <div class="service-card group glass-effect p-8 rounded-lg neon-border hover:border-green-400/70 transition-all duration-300 transform hover:scale-105 cursor-pointer relative overflow-hidden animate__animated animate__fadeInUp"
           data-service="ai" style="animation-delay: 0.4s;">
        <div class="absolute inset-0 bg-gradient-to-br from-green-400/5 via-transparent to-cyber-yellow/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10">
          <div class="w-20 h-20 mx-auto mb-6 neon-border rounded-lg glass-effect flex items-center justify-center group-hover:animate-pulse">
            <i class="ri-brain-line text-3xl text-green-400"></i>
          </div>
          <h3 class="text-2xl font-orbitron font-bold text-white mb-4 text-center group-hover:text-green-400 transition-colors">
            AI Integration
          </h3>
          <p class="font-tech text-gray-400 text-center text-sm leading-relaxed">
            Implementing intelligent systems with machine learning and automation
          </p>
          <div class="flex justify-center mt-4">
            <span class="px-3 py-1 bg-green-400/10 border border-green-400/30 rounded-full text-green-400 font-tech text-xs">
              Click to explore
            </span>
          </div>
        </div>
      </div>
      
      <!-- Blockchain -->
      <div class="service-card group glass-effect p-8 rounded-lg neon-border hover:border-orange-400/70 transition-all duration-300 transform hover:scale-105 cursor-pointer relative overflow-hidden animate__animated animate__fadeInUp"
           data-service="blockchain" style="animation-delay: 0.5s;">
        <div class="absolute inset-0 bg-gradient-to-br from-orange-400/5 via-transparent to-cyber-blue/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10">
          <div class="w-20 h-20 mx-auto mb-6 neon-border rounded-lg glass-effect flex items-center justify-center group-hover:animate-pulse">
            <i class="ri-links-line text-3xl text-orange-400"></i>
          </div>
          <h3 class="text-2xl font-orbitron font-bold text-white mb-4 text-center group-hover:text-orange-400 transition-colors">
            Blockchain Systems
          </h3>
          <p class="font-tech text-gray-400 text-center text-sm leading-relaxed">
            Developing decentralized applications and smart contract solutions
          </p>
          <div class="flex justify-center mt-4">
            <span class="px-3 py-1 bg-orange-400/10 border border-orange-400/30 rounded-full text-orange-400 font-tech text-xs">
              Click to explore
            </span>
          </div>
        </div>
      </div>
      
      <!-- Cybersecurity -->
      <div class="service-card group glass-effect p-8 rounded-lg neon-border hover:border-red-400/70 transition-all duration-300 transform hover:scale-105 cursor-pointer relative overflow-hidden animate__animated animate__fadeInUp"
           data-service="cyber" style="animation-delay: 0.6s;">
        <div class="absolute inset-0 bg-gradient-to-br from-red-400/5 via-transparent to-cyber-purple/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="relative z-10">
          <div class="w-20 h-20 mx-auto mb-6 neon-border rounded-lg glass-effect flex items-center justify-center group-hover:animate-pulse">
            <i class="ri-shield-check-line text-3xl text-red-400"></i>
          </div>
          <h3 class="text-2xl font-orbitron font-bold text-white mb-4 text-center group-hover:text-red-400 transition-colors">
            Cybersecurity
          </h3>
          <p class="font-tech text-gray-400 text-center text-sm leading-relaxed">
            Securing systems with advanced encryption and threat protection
          </p>
          <div class="flex justify-center mt-4">
            <span class="px-3 py-1 bg-red-400/10 border border-red-400/30 rounded-full text-red-400 font-tech text-xs">
              Click to explore
            </span>
          </div>
        </div>
      </div>
    </div>
    
    <!-- CTA Section -->
    <div class="text-center glass-effect p-12 rounded-lg neon-border animate__animated animate__fadeInUp" style="animation-delay: 0.7s;">
      <h2 class="text-3xl font-orbitron font-bold text-cyber-yellow mb-6">
        Ready to Build Something Amazing?
      </h2>
      <p class="font-tech text-gray-300 mb-8 max-w-2xl mx-auto">
        Let's collaborate to bring your vision to life with cutting-edge technology and innovative solutions.
      </p>
      <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-6">
        <a href="contact.php" 
           class="group relative neon-border px-8 py-4 rounded-lg font-tech text-cyber-yellow hover:bg-cyber-yellow hover:text-black transition-all duration-300 transform hover:scale-105">
          <span class="relative z-10 flex items-center">
            <i class="ri-message-3-line mr-2"></i>
            Get In Touch
          </span>
          <div class="absolute inset-0 bg-gradient-to-r from-cyber-yellow/20 to-cyber-blue/20 blur-sm opacity-0 group-hover:opacity-100 transition-opacity rounded-lg"></div>
        </a>
        
        <a href="inquiries.php" 
           class="group relative glass-effect px-8 py-4 rounded-lg font-tech text-white hover:text-cyber-blue border border-white/20 hover:border-cyber-blue/50 transition-all duration-300 transform hover:scale-105">
          <span class="flex items-center">
            <i class="ri-question-line mr-2"></i>
            Submit Inquiry
          </span>
        </a>
      </div>
    </div>
  </section>
</main>

<!-- Service Modal -->
<div id="serviceModal" class="fixed inset-0 bg-black/80 backdrop-blur-sm hidden items-center justify-center z-50 p-4">
  <div class="glass-effect max-w-2xl w-full rounded-2xl neon-border animate__animated animate__zoomIn">
    
    <!-- Modal Header -->
    <div class="flex justify-between items-center p-6 border-b border-cyber-yellow/20">
      <h2 id="modalTitle" class="text-3xl font-orbitron font-bold text-cyber-yellow"></h2>
      <button id="closeModal" class="text-white hover:text-cyber-yellow transition-colors text-2xl">
        <i class="ri-close-line"></i>
      </button>
    </div>
    
    <!-- Modal Body -->
    <div class="p-8 text-center">
      <div id="modalIcon" class="w-24 h-24 mx-auto mb-6 neon-border rounded-lg glass-effect flex items-center justify-center">
        <!-- Icon will be inserted here -->
      </div>
      
      <p id="modalDescription" class="font-tech text-gray-300 text-lg leading-relaxed mb-6"></p>
      
      <div class="glass-effect p-6 rounded-lg neon-border mb-6">
        <h3 class="font-orbitron text-cyber-blue mb-3 text-xl">Real-World Example</h3>
        <p id="modalExample" class="font-tech text-gray-400 italic"></p>
      </div>
      
      <!-- Technologies Used -->
      <div class="mb-6">
        <h3 class="font-orbitron text-cyber-purple mb-4 text-lg">Technologies & Tools</h3>
        <div id="modalTech" class="flex flex-wrap justify-center gap-2">
          <!-- Tech stack will be inserted here -->
        </div>
      </div>
      
      <!-- Action Button -->
      <a href="contact.php" 
         class="inline-flex items-center neon-border px-8 py-3 rounded-lg font-tech text-cyber-yellow hover:bg-cyber-yellow hover:text-black transition-all duration-300 transform hover:scale-105">
        <i class="ri-rocket-2-line mr-2"></i>
        Start a Project
      </a>
    </div>
  </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", () => {
  const modal = document.getElementById("serviceModal");
  const modalTitle = document.getElementById("modalTitle");
  const modalIcon = document.getElementById("modalIcon");
  const modalDescription = document.getElementById("modalDescription");
  const modalExample = document.getElementById("modalExample");
  const modalTech = document.getElementById("modalTech");
  const closeBtn = document.getElementById("closeModal");
  
  const services = {
    web: {
      title: "Web Development",
      icon: "ri-code-s-slash-line",
      color: "cyber-yellow",
      description: "I specialize in creating modern, responsive websites using the latest web technologies. From simple landing pages to complex web applications, I ensure your digital presence stands out with cutting-edge design and functionality.",
      example: "Recently built a dynamic e-commerce platform with real-time inventory management, secure payment processing, and mobile-optimized shopping experience that increased client sales by 150%.",
      tech: ["HTML5", "CSS3", "JavaScript", "React", "Vue.js", "Node.js", "PHP", "MySQL", "MongoDB"]
    },
    app: {
      title: "Mobile App Development",
      icon: "ri-smartphone-line",
      color: "cyber-blue",
      description: "Creating powerful native and cross-platform mobile applications that deliver exceptional user experiences. I focus on performance, security, and intuitive design to make your app stand out in the marketplace.",
      example: "Developed a fitness tracking app with AI-powered workout recommendations, social features, and wearable device integration, reaching 50K+ downloads in the first month.",
      tech: ["React Native", "Flutter", "Swift", "Kotlin", "Firebase", "SQLite", "REST APIs", "Push Notifications"]
    },
    desktop: {
      title: "Desktop Applications",
      icon: "ri-computer-line",
      color: "cyber-purple",
      description: "Building robust desktop applications for Windows, macOS, and Linux platforms. I create software solutions that enhance productivity and provide seamless user experiences across different operating systems.",
      example: "Built a comprehensive project management desktop suite for a construction company, featuring Gantt charts, resource allocation, and real-time collaboration tools.",
      tech: ["Electron", "Python", "C#", ".NET", "Java", "Qt", "WPF", "Cross-platform Development"]
    },
    ai: {
      title: "AI & Machine Learning",
      icon: "ri-brain-line",
      color: "green-400",
      description: "Integrating artificial intelligence and machine learning capabilities into your applications. From chatbots to predictive analytics, I help businesses leverage AI to automate processes and gain valuable insights.",
      example: "Implemented an AI-powered customer service chatbot that reduced response times by 80% and improved customer satisfaction scores by 35% for a tech startup.",
      tech: ["TensorFlow", "PyTorch", "Python", "OpenAI API", "Natural Language Processing", "Computer Vision", "Data Analytics"]
    },
    blockchain: {
      title: "Blockchain Development",
      icon: "ri-links-line",
      color: "orange-400",
      description: "Developing secure blockchain solutions and smart contracts for various industries. I create decentralized applications (DApps) that ensure transparency, security, and eliminate the need for intermediaries.",
      example: "Created a supply chain tracking system using blockchain technology for a pharmaceutical company, ensuring drug authenticity and reducing counterfeiting by 90%.",
      tech: ["Solidity", "Web3.js", "Ethereum", "Smart Contracts", "IPFS", "Truffle", "Ganache", "DeFi Protocols"]
    },
    cyber: {
      title: "Cybersecurity Solutions",
      icon: "ri-shield-check-line",
      color: "red-400",
      description: "Protecting your digital assets with comprehensive security solutions. I implement robust security measures, conduct vulnerability assessments, and ensure your systems are protected against modern cyber threats.",
      example: "Conducted a security audit for a fintech company and implemented multi-layered security protocols, reducing security incidents by 95% and achieving PCI DSS compliance.",
      tech: ["Penetration Testing", "Network Security", "Encryption", "OWASP", "Security Auditing", "Firewall Configuration", "SSL/TLS"]
    }
  };
  
  // Service card click handlers
  document.querySelectorAll('.service-card').forEach(card => {
    card.addEventListener('click', () => {
      const serviceType = card.getAttribute('data-service');
      const service = services[serviceType];
      
      modalTitle.textContent = service.title;
      modalIcon.innerHTML = `<i class="${service.icon} text-4xl text-${service.color}"></i>`;
      modalDescription.textContent = service.description;
      modalExample.textContent = service.example;
      
      // Clear and populate tech stack
      modalTech.innerHTML = '';
      service.tech.forEach(tech => {
        const techSpan = document.createElement('span');
        techSpan.className = 'px-3 py-1 bg-cyber-gray rounded-full text-cyber-yellow font-tech text-xs border border-cyber-yellow/30';
        techSpan.textContent = tech;
        modalTech.appendChild(techSpan);
      });
      
      modal.classList.remove('hidden');
      modal.classList.add('flex');
    });
  });
  
  // Close modal handlers
  closeBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
    modal.classList.remove('flex');
  });
  
  modal.addEventListener('click', (e) => {
    if (e.target === modal) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  });
  
  // Escape key to close modal
  document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && !modal.classList.contains('hidden')) {
      modal.classList.add('hidden');
      modal.classList.remove('flex');
    }
  });
});
</script>

<?php include "includes/footer.php"; ?>