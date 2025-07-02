<?php 
    include "includes/header.php"; 
    include "includes/db.php";

    $successMessage = "";
    $errorMessage = "";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $name    = trim($_POST['name']);
        $email   = trim($_POST['email']);
        $message = trim($_POST['message']);

        // Basic validation
        if (empty($name) || empty($email) || empty($message)) {
            $errorMessage = "All fields are required!";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMessage = "Please enter a valid email address!";
        } else {
            $sql = "INSERT INTO contact (name, email, message, created_at) VALUES (?, ?, ?, NOW())";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $name, $email, $message);
            
            if ($stmt->execute()) {
                $successMessage = "Message sent successfully! I'll get back to you soon.";
                // Clear form data
                $name = $email = $message = "";
            } else {
                $errorMessage = "Database error. Please try again later.";
            }
            
            $stmt->close();
        }
        $conn->close();
    }
?>

<!-- Main Contact Section -->
<main class="relative pt-24 pb-20">
  <section class="container mx-auto px-6">
    
    <!-- Header -->
    <div class="text-center mb-16 animate__animated animate__fadeInUp">
      <h1 class="text-5xl lg:text-6xl font-orbitron font-black text-transparent bg-clip-text bg-gradient-to-r from-cyber-yellow via-cyber-blue to-cyber-purple mb-6">
        Get In Touch
      </h1>
      <div class="flex justify-center items-center space-x-4 mb-6">
        <div class="w-16 h-0.5 bg-gradient-to-r from-transparent to-cyber-yellow"></div>
        <i class="ri-message-3-line text-2xl text-cyber-yellow animate-pulse"></i>
        <div class="w-16 h-0.5 bg-gradient-to-l from-transparent to-cyber-yellow"></div>
      </div>
      <p class="font-tech text-xl text-gray-300 max-w-2xl mx-auto">
        Ready to start your next project? Let's connect and bring your <span class="text-cyber-yellow font-bold">vision to life</span>
      </p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12 items-start">
      
      <!-- Contact Information -->
      <div class="space-y-8 animate__animated animate__fadeInLeft">
        <div class="glass-effect p-8 rounded-lg neon-border">
          <h2 class="text-3xl font-orbitron font-bold text-cyber-yellow mb-6">
            <i class="ri-communication-line mr-3"></i>
            Let's Connect
          </h2>
          <p class="font-tech text-gray-300 text-lg leading-relaxed mb-8">
            I'm always excited to work on new projects and collaborate with innovative minds. Whether you have a question, project idea, or just want to say hello, I'd love to hear from you.
          </p>
          
          <!-- Contact Details -->
          <div class="space-y-6">
            <div class="flex items-center space-x-4 group">
              <div class="w-12 h-12 neon-border rounded-lg glass-effect flex items-center justify-center group-hover:animate-pulse">
                <i class="ri-map-pin-line text-cyber-yellow text-xl"></i>
              </div>
              <div>
                <h3 class="font-orbitron text-white font-semibold">Location</h3>
                <p class="font-tech text-gray-400">Brgy. Sampaloc 1, Sariaya Quezon, Philippines, 4322</p>
              </div>
            </div>
            
            <div class="flex items-center space-x-4 group">
              <div class="w-12 h-12 neon-border rounded-lg glass-effect flex items-center justify-center group-hover:animate-pulse">
                <i class="ri-mail-line text-cyber-blue text-xl"></i>
              </div>
              <div>
                <h3 class="font-orbitron text-white font-semibold">Email</h3>
                <a href="mailto:ianpurificacion2002@gmail.com" class="font-tech text-cyber-blue hover:text-cyber-yellow transition-colors">
                  ianpurificacion2002@gmail.com
                </a>
              </div>
            </div>
            
            <div class="flex items-center space-x-4 group">
              <div class="w-12 h-12 neon-border rounded-lg glass-effect flex items-center justify-center group-hover:animate-pulse">
                <i class="ri-time-line text-cyber-purple text-xl"></i>
              </div>
              <div>
                <h3 class="font-orbitron text-white font-semibold">Response Time</h3>
                <p class="font-tech text-gray-400">Usually within 24 hours</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Social Links -->
        <div class="glass-effect p-8 rounded-lg neon-border">
          <h3 class="font-orbitron text-cyber-yellow mb-6 text-xl">
            <i class="ri-share-line mr-2"></i>
            Connect on Social
          </h3>
          <div class="flex space-x-4">
            <a href="https://web.facebook.com/ianpurifying" target="_blank" 
               class="group relative w-16 h-16 neon-border rounded-lg flex items-center justify-center hover:bg-cyber-yellow hover:text-black transition-all duration-300 transform hover:scale-110">
              <i class="ri-facebook-fill text-2xl"></i>
              <div class="absolute -inset-1 bg-gradient-to-r from-cyber-yellow/20 to-blue-600/20 blur-sm opacity-0 group-hover:opacity-100 transition-opacity -z-10"></div>
            </a>
            
            <a href="https://x.com/elonmusk" target="_blank" 
               class="group relative w-16 h-16 neon-border rounded-lg flex items-center justify-center hover:bg-cyber-yellow hover:text-black transition-all duration-300 transform hover:scale-110">
              <i class="ri-twitter-x-fill text-2xl"></i>
              <div class="absolute -inset-1 bg-gradient-to-r from-cyber-yellow/20 to-gray-400/20 blur-sm opacity-0 group-hover:opacity-100 transition-opacity -z-10"></div>
            </a>
            
            <a href="https://www.linkedin.com/" target="_blank" 
               class="group relative w-16 h-16 neon-border rounded-lg flex items-center justify-center hover:bg-cyber-yellow hover:text-black transition-all duration-300 transform hover:scale-110">
              <i class="ri-linkedin-fill text-2xl"></i>
              <div class="absolute -inset-1 bg-gradient-to-r from-cyber-yellow/20 to-blue-500/20 blur-sm opacity-0 group-hover:opacity-100 transition-opacity -z-10"></div>
            </a>
          </div>
        </div>
      </div>
      
      <!-- Contact Form -->
      <div class="animate__animated animate__fadeInRight">
        <div class="glass-effect p-8 rounded-lg neon-border">
          <h2 class="text-3xl font-orbitron font-bold text-cyber-blue mb-6">
            <i class="ri-send-plane-line mr-3"></i>
            Send Message
          </h2>
          
          <!-- Success/Error Messages -->
          <?php if (!empty($successMessage)): ?>
            <div class="mb-6 p-4 bg-green-500/10 border border-green-500/30 rounded-lg animate__animated animate__fadeInDown">
              <div class="flex items-center">
                <i class="ri-checkbox-circle-line text-green-400 text-xl mr-3"></i>
                <span class="font-tech text-green-400"><?php echo $successMessage; ?></span>
              </div>
            </div>
          <?php endif; ?>
          
          <?php if (!empty($errorMessage)): ?>
            <div class="mb-6 p-4 bg-red-500/10 border border-red-500/30 rounded-lg animate__animated animate__shake">
              <div class="flex items-center">
                <i class="ri-error-warning-line text-red-400 text-xl mr-3"></i>
                <span class="font-tech text-red-400"><?php echo $errorMessage; ?></span>
              </div>
            </div>
          <?php endif; ?>
          
          <form method="POST" action="contact.php" class="space-y-6">
            <div class="space-y-2">
              <label for="name" class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                <i class="ri-user-line mr-2"></i>Full Name
              </label>
              <input type="text" id="name" name="name" 
                     value="<?php echo isset($name) ? htmlspecialchars($name) : ''; ?>"
                     class="w-full bg-black/50 border border-cyber-yellow/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-yellow focus:ring-2 focus:ring-cyber-yellow/20 focus:outline-none transition-all duration-300 glass-effect"
                     placeholder="Enter your full name" required>
            </div>
            
            <div class="space-y-2">
              <label for="email" class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                <i class="ri-mail-line mr-2"></i>Email Address
              </label>
              <input type="email" id="email" name="email" 
                     value="<?php echo isset($email) ? htmlspecialchars($email) : ''; ?>"
                     class="w-full bg-black/50 border border-cyber-yellow/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-yellow focus:ring-2 focus:ring-cyber-yellow/20 focus:outline-none transition-all duration-300 glass-effect"
                     placeholder="your.email@domain.com" required>
            </div>
            
            <div class="space-y-2">
              <label for="message" class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                <i class="ri-message-2-line mr-2"></i>Message
              </label>
              <textarea id="message" name="message" rows="6"
                        class="w-full bg-black/50 border border-cyber-yellow/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-yellow focus:ring-2 focus:ring-cyber-yellow/20 focus:outline-none transition-all duration-300 glass-effect resize-none"
                        placeholder="Tell me about your project or inquiry..." required><?php echo isset($message) ? htmlspecialchars($message) : ''; ?></textarea>
            </div>
            
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-cyber-yellow to-cyber-blue hover:from-cyber-blue hover:to-cyber-yellow text-black font-orbitron font-bold py-4 px-8 rounded-lg transition-all duration-300 transform hover:scale-105 animate-glow shadow-lg">
              <i class="ri-send-plane-2-line mr-2"></i>
              Send Message
            </button>
          </form>
        </div>
        
        <!-- Quick Contact Options -->
        <div class="glass-effect p-6 rounded-lg neon-border mt-8">
          <h3 class="font-orbitron text-cyber-purple mb-4 text-lg">
            <i class="ri-flashlight-line mr-2"></i>
            Quick Actions
          </h3>
          <div class="grid grid-cols-2 gap-4">
            <a href="mailto:contact@ianp.dev" 
               class="flex items-center justify-center space-x-2 bg-black/30 hover:bg-cyber-yellow/10 border border-cyber-yellow/30 hover:border-cyber-yellow rounded-lg py-3 px-4 transition-all duration-300 group">
              <i class="ri-mail-send-line text-cyber-yellow group-hover:animate-pulse"></i>
              <span class="font-tech text-sm text-white">Direct Email</span>
            </a>
            
            <a href="inquiries.php" 
               class="flex items-center justify-center space-x-2 bg-black/30 hover:bg-cyber-blue/10 border border-cyber-blue/30 hover:border-cyber-blue rounded-lg py-3 px-4 transition-all duration-300 group">
              <i class="ri-questionnaire-line text-cyber-blue group-hover:animate-pulse"></i>
              <span class="font-tech text-sm text-white">Full Inquiry</span>
            </a>
          </div>
        </div>
      </div>
    </div>
    
    <!-- Tech Stats -->
    <div class="mt-20 grid grid-cols-2 md:grid-cols-4 gap-6">
      <div class="glass-effect p-6 rounded-lg neon-border text-center group hover:animate-pulse">
        <i class="ri-time-line text-3xl text-cyber-yellow mb-3"></i>
        <h3 class="font-orbitron text-2xl font-bold text-white">24h</h3>
        <p class="font-tech text-sm text-gray-400">Response Time</p>
      </div>
      
      <div class="glass-effect p-6 rounded-lg neon-border text-center group hover:animate-pulse">
        <i class="ri-user-smile-line text-3xl text-cyber-blue mb-3"></i>
        <h3 class="font-orbitron text-2xl font-bold text-white">100%</h3>
        <p class="font-tech text-sm text-gray-400">Client Satisfaction</p>
      </div>
      
      <div class="glass-effect p-6 rounded-lg neon-border text-center group hover:animate-pulse">
        <i class="ri-rocket-2-line text-3xl text-cyber-purple mb-3"></i>
        <h3 class="font-orbitron text-2xl font-bold text-white">50+</h3>
        <p class="font-tech text-sm text-gray-400">Projects Completed</p>
      </div>
      
      <div class="glass-effect p-6 rounded-lg neon-border text-center group hover:animate-pulse">
        <i class="ri-global-line text-3xl text-cyber-yellow mb-3"></i>
        <h3 class="font-orbitron text-2xl font-bold text-white">24/7</h3>
        <p class="font-tech text-sm text-gray-400">Available Online</p>
      </div>
    </div>
  </section>
</main>

<?php include "includes/footer.php"; ?>