<?php
// inquiries.php
include "includes/header.php";
?>

<!-- Main Inquiry Section -->
<main class="relative pt-24 pb-20">
  <section class="container mx-auto px-6">
    
    <!-- Header -->
    <div class="text-center mb-16 animate__animated animate__fadeInUp">
      <h1 class="text-5xl lg:text-6xl font-orbitron font-black text-transparent bg-clip-text bg-gradient-to-r from-cyber-purple via-cyber-yellow to-cyber-blue mb-6">
        Submit Inquiry
      </h1>
      <div class="flex justify-center items-center space-x-4 mb-6">
        <div class="w-16 h-0.5 bg-gradient-to-r from-transparent to-cyber-purple"></div>
        <i class="ri-questionnaire-line text-2xl text-cyber-purple animate-pulse"></i>
        <div class="w-16 h-0.5 bg-gradient-to-l from-transparent to-cyber-purple"></div>
      </div>
      <p class="font-tech text-xl text-gray-300 max-w-3xl mx-auto">
        Need detailed assistance? Submit a comprehensive inquiry with all your project requirements. 
        <span class="text-cyber-purple font-bold">Let's build something amazing together</span>
      </p>
    </div>

    <!-- Main Form -->
    <div class="max-w-4xl mx-auto">
      <div class="glass-effect p-8 lg:p-12 rounded-lg neon-border animate__animated animate__fadeInUp">
        <div class="flex items-center mb-8">
          <i class="ri-file-text-line text-3xl text-cyber-purple mr-4"></i>
          <h2 class="text-3xl font-orbitron font-bold text-cyber-purple">Inquiry Form</h2>
        </div>

        <form method="POST" action="inquiries_submit.php" enctype="multipart/form-data">
          <div class="grid lg:grid-cols-2 gap-8">
            
            <!-- Left Column -->
            <div class="space-y-6">
              <!-- Full Name -->
              <div class="space-y-2">
                <label for="fullname" class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                  <i class="ri-user-line mr-2"></i>Full Name *
                </label>
                <input type="text" id="fullname" name="fullname" 
                       class="w-full bg-black/50 border border-cyber-yellow/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-yellow focus:ring-2 focus:ring-cyber-yellow/20 focus:outline-none transition-all duration-300 glass-effect"
                       placeholder="Enter your full name" required>
              </div>

              <!-- Email -->
              <div class="space-y-2">
                <label for="email" class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                  <i class="ri-mail-line mr-2"></i>Email Address *
                </label>
                <input type="email" id="email" name="email" 
                       class="w-full bg-black/50 border border-cyber-yellow/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-yellow focus:ring-2 focus:ring-cyber-yellow/20 focus:outline-none transition-all duration-300 glass-effect"
                       placeholder="your.email@domain.com" required>
              </div>

              <!-- Phone -->
              <div class="space-y-2">
                <label for="phone" class="block font-tech text-cyber-blue text-sm uppercase tracking-wider">
                  <i class="ri-phone-line mr-2"></i>Phone Number
                </label>
                <input type="tel" id="phone" name="phone" 
                       class="w-full bg-black/50 border border-cyber-blue/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-blue focus:ring-2 focus:ring-cyber-blue/20 focus:outline-none transition-all duration-300 glass-effect"
                       placeholder="+63 (990) 121-0001">
              </div>

              <!-- Category -->
              <div class="space-y-2">
                <label for="category" class="block font-tech text-cyber-purple text-sm uppercase tracking-wider">
                  <i class="ri-bookmark-line mr-2"></i>Project Category *
                </label>
                <select id="category" name="category" 
                        class="w-full bg-black/50 border border-cyber-purple/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-purple focus:ring-2 focus:ring-cyber-purple/20 focus:outline-none transition-all duration-300 glass-effect" required>
                  <option value="" disabled selected>Select a category</option>
                  <option value="development">Web Development</option>
                  <option value="devops">DevOps / Infrastructure</option>
                  <option value="qa">Quality Assurance</option>
                  <option value="support">Technical Support</option>
                  <option value="security">Security Consultation</option>
                  <option value="feedback">Product Feedback</option>
                </select>
              </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
              <!-- Subject -->
              <div class="space-y-2">
                <label for="subject" class="block font-tech text-cyber-blue text-sm uppercase tracking-wider">
                  <i class="ri-bookmark-3-line mr-2"></i>Subject
                </label>
                <input type="text" id="subject" name="subject" 
                       class="w-full bg-black/50 border border-cyber-blue/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-blue focus:ring-2 focus:ring-cyber-blue/20 focus:outline-none transition-all duration-300 glass-effect"
                       placeholder="Brief project title">
              </div>

              <!-- Preferred Contact -->
              <div class="space-y-3">
                <label class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                  <i class="ri-contacts-line mr-2"></i>Preferred Contact Method
                </label>
                <div class="flex space-x-6">
                  <label class="flex items-center space-x-3 cursor-pointer group">
                    <input type="radio" name="preferred_contact" value="email" 
                           class="w-4 h-4 text-cyber-yellow bg-black border-cyber-yellow focus:ring-cyber-yellow focus:ring-2" checked>
                    <span class="font-tech text-white group-hover:text-cyber-yellow transition-colors">
                      <i class="ri-mail-line mr-1"></i>Email
                    </span>
                  </label>
                  <label class="flex items-center space-x-3 cursor-pointer group">
                    <input type="radio" name="preferred_contact" value="phone" 
                           class="w-4 h-4 text-cyber-blue bg-black border-cyber-blue focus:ring-cyber-blue focus:ring-2">
                    <span class="font-tech text-white group-hover:text-cyber-blue transition-colors">
                      <i class="ri-phone-line mr-1"></i>Phone
                    </span>
                  </label>
                </div>
              </div>

              <!-- Image Upload -->
              <div class="space-y-2">
                <label for="image" class="block font-tech text-cyber-purple text-sm uppercase tracking-wider">
                  <i class="ri-image-line mr-2"></i>Project Reference (Optional)
                </label>
                <div class="relative">
                  <input type="file" id="image" name="image" accept="image/*"
                         class="w-full bg-black/50 border border-cyber-purple/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-purple focus:ring-2 focus:ring-cyber-purple/20 focus:outline-none transition-all duration-300 glass-effect file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:bg-cyber-purple file:text-black file:font-tech file:text-sm">
                </div>
                <p class="font-tech text-xs text-gray-500">Upload mockups, references, or inspiration images (JPG, PNG, GIF)</p>
              </div>

              <!-- Priority Level -->
              <div class="space-y-2">
                <label for="priority" class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                  <i class="ri-alarm-warning-line mr-2"></i>Priority Level
                </label>
                <select id="priority" name="priority" 
                        class="w-full bg-black/50 border border-cyber-yellow/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-yellow focus:ring-2 focus:ring-cyber-yellow/20 focus:outline-none transition-all duration-300 glass-effect">
                  <option value="low">🟢 Low - Standard Response</option>
                  <option value="medium" selected>🟡 Medium - Expedited Response</option>
                  <option value="high">🟠 High - Priority Response</option>
                  <option value="urgent">🔴 Urgent - Immediate Attention</option>
                </select>
              </div>
            </div>
          </div>

          <!-- Full Width Message -->
          <div class="mt-8 space-y-2">
            <label for="message" class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
              <i class="ri-message-2-line mr-2"></i>Detailed Message *
            </label>
            <textarea id="message" name="message" rows="8"
                      class="w-full bg-black/50 border border-cyber-yellow/30 rounded-lg px-4 py-3 text-white font-tech focus:border-cyber-yellow focus:ring-2 focus:ring-cyber-yellow/20 focus:outline-none transition-all duration-300 glass-effect resize-none"
                      placeholder="Provide detailed information about your project, requirements, timeline, budget, and any specific features you need..." required></textarea>
            <p class="font-tech text-xs text-gray-500">Include project scope, timeline, budget range, and any specific requirements</p>
          </div>

          <!-- Submit Button -->
          <div class="mt-10 flex justify-center">
            <button type="submit" 
                    class="group relative px-12 py-4 bg-gradient-to-r from-cyber-purple to-cyber-yellow text-black font-orbitron font-bold text-lg rounded-lg hover:scale-105 transform transition-all duration-300 neon-border animate-glow">
              <span class="relative z-10 flex items-center">
                <i class="ri-send-plane-line mr-3 text-xl"></i>
                Submit Inquiry
                <i class="ri-arrow-right-line ml-3 group-hover:translate-x-1 transition-transform"></i>
              </span>
              <div class="absolute inset-0 bg-gradient-to-r from-cyber-yellow to-cyber-purple opacity-0 group-hover:opacity-100 transition-opacity rounded-lg"></div>
            </button>
          </div>

          <!-- Form Footer -->
          <div class="mt-8 p-6 glass-effect rounded-lg border border-cyber-blue/20">
            <div class="flex items-start space-x-4">
              <i class="ri-information-line text-cyber-blue text-2xl mt-1"></i>
              <div>
                <h3 class="font-orbitron text-cyber-blue font-bold mb-2">What happens next?</h3>
                <ul class="font-tech text-gray-300 text-sm space-y-1">
                  <li>• <span class="text-cyber-yellow">Instant confirmation</span> - You'll receive a confirmation email immediately</li>
                  <li>• <span class="text-cyber-yellow">Review process</span> - Our team will review your inquiry within 24 hours</li>
                  <li>• <span class="text-cyber-yellow">Personalized response</span> - Detailed proposal or consultation scheduled</li>
                  <li>• <span class="text-cyber-yellow">Project kickoff</span> - Once approved, we begin planning your solution</li>
                </ul>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Additional Info Cards -->
    <div class="grid md:grid-cols-3 gap-6 mt-16 max-w-6xl mx-auto">
      
      <!-- Response Time Card -->
      <div class="glass-effect p-6 rounded-lg neon-border hover:border-cyber-yellow/50 transition-all duration-300 group">
        <div class="text-center">
          <div class="inline-block p-4 bg-cyber-yellow/10 rounded-full mb-4 group-hover:bg-cyber-yellow/20 transition-colors">
            <i class="ri-time-line text-3xl text-cyber-yellow"></i>
          </div>
          <h3 class="font-orbitron text-cyber-yellow font-bold text-xl mb-2">Quick Response</h3>
          <p class="font-tech text-gray-300 text-sm">
            We typically respond to inquiries within <span class="text-cyber-yellow font-bold">24 hours</span>. 
            Urgent requests are handled immediately.
          </p>
        </div>
      </div>

      <!-- Free Consultation Card -->
      <div class="glass-effect p-6 rounded-lg neon-border hover:border-cyber-blue/50 transition-all duration-300 group">
        <div class="text-center">
          <div class="inline-block p-4 bg-cyber-blue/10 rounded-full mb-4 group-hover:bg-cyber-blue/20 transition-colors">
            <i class="ri-chat-3-line text-3xl text-cyber-blue"></i>
          </div>
          <h3 class="font-orbitron text-cyber-blue font-bold text-xl mb-2">Free Consultation</h3>
          <p class="font-tech text-gray-300 text-sm">
            Initial consultation is <span class="text-cyber-blue font-bold">completely free</span>. 
            No commitment required to discuss your project.
          </p>
        </div>
      </div>

      <!-- Secure Process Card -->
      <div class="glass-effect p-6 rounded-lg neon-border hover:border-cyber-purple/50 transition-all duration-300 group">
        <div class="text-center">
          <div class="inline-block p-4 bg-cyber-purple/10 rounded-full mb-4 group-hover:bg-cyber-purple/20 transition-colors">
            <i class="ri-shield-check-line text-3xl text-cyber-purple"></i>
          </div>
          <h3 class="font-orbitron text-cyber-purple font-bold text-xl mb-2">100% Secure</h3>
          <p class="font-tech text-gray-300 text-sm">
            Your information is <span class="text-cyber-purple font-bold">encrypted</span> and protected. 
            We never share your details with third parties.
          </p>
        </div>
      </div>
    </div>

  </section>
</main>

<?php include "includes/footer.php"; ?>