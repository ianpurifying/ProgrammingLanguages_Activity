<?php
require_once 'db.php';

$success_message = '';
$error_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $subject = trim($_POST['subject'] ?? '');
    $message = trim($_POST['message'] ?? '');
    
    $errors = [];
    
    if (empty($name)) {
        $errors[] = 'Name is required';
    }
    
    if (empty($email)) {
        $errors[] = 'Email is required';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format';
    }
    
    if (empty($subject)) {
        $errors[] = 'Subject is required';
    }
    
    if (empty($message)) {
        $errors[] = 'Message is required';
    }
    
    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("INSERT INTO contact (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $subject, $message]);
            
            header('Location: contact.php?success=1');
            exit;
        } catch (PDOException $e) {
            $error_message = 'An error occurred while sending your message. Please try again.';
        }
    } else {
        $error_message = implode('<br>', $errors);
    }
}

if (isset($_GET['success'])) {
    $success_message = 'Thank you for your message! I\'ll get back to you soon.';
}

include 'header.php';
?>

<section class="pt-24 pb-16 bg-gradient-to-br from-slate-50 to-gray-100">
  <div class="container mx-auto px-6">
    <div class="text-center mb-16">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Contact Me</h1>
      <div class="w-24 h-1 bg-indigo-600 mx-auto rounded-full mb-6"></div>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Ready to capture your special moments? Let's connect and discuss how we can bring your vision to life.
      </p>
    </div>

    <?php if ($success_message): ?>
    <div class="max-w-6xl mx-auto mb-8">
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl shadow-lg">
        <div class="flex items-center">
          <i class="fas fa-check-circle mr-3"></i>
          <span><?php echo htmlspecialchars($success_message); ?></span>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <?php if ($error_message): ?>
    <div class="max-w-6xl mx-auto mb-8">
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl shadow-lg">
        <div class="flex items-center">
          <i class="fas fa-exclamation-circle mr-3"></i>
          <span><?php echo $error_message; ?></span>
        </div>
      </div>
    </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
      <div class="space-y-8">
        <div>
          <h2 class="text-3xl font-bold text-gray-800 mb-6">Get in Touch</h2>
          <p class="text-lg text-gray-600 mb-8">
            Have a project in mind or want to book a shoot? I'd love to hear from you! Whether it's a quick question or a detailed discussion about your photography needs, don't hesitate to reach out.
          </p>
        </div>

        <div class="space-y-6">
          <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 group">
            <div class="flex items-center">
              <div class="w-14 h-14 bg-indigo-100 rounded-full flex items-center justify-center mr-4 group-hover:bg-indigo-600 transition-colors duration-300">
                <i class="fas fa-envelope text-indigo-600 text-xl group-hover:text-white"></i>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Email Address</h3>
                <a href="mailto:comianicaa@gmail.com" class="text-indigo-600 hover:text-indigo-700 font-medium">
                  comianicaa@gmail.com
                </a>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 group">
            <div class="flex items-center">
              <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center mr-4 group-hover:bg-green-600 transition-colors duration-300">
                <i class="fas fa-phone text-green-600 text-xl group-hover:text-white"></i>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Phone Number</h3>
                <a href="tel:09498774107" class="text-green-600 hover:text-green-700 font-medium">
                  09498774107
                </a>
              </div>
            </div>
          </div>

          <div class="bg-white rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 group">
            <div class="flex items-center">
              <div class="w-14 h-14 bg-red-100 rounded-full flex items-center justify-center mr-4 group-hover:bg-red-600 transition-colors duration-300">
                <i class="fas fa-map-marker-alt text-red-600 text-xl group-hover:text-white"></i>
              </div>
              <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-1">Location</h3>
                <p class="text-red-600 font-medium">4323 Candelaria, Quezon Province</p>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl p-6 shadow-lg">
          <h3 class="text-xl font-semibold text-gray-800 mb-4">Follow Me</h3>
          <div class="flex space-x-4">
            <a href="#" class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="#" class="w-12 h-12 bg-blue-600 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
              <i class="fab fa-facebook"></i>
            </a>
            <a href="#" class="w-12 h-12 bg-blue-400 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="mailto:comianicaa@gmail.com" class="w-12 h-12 bg-red-500 rounded-full flex items-center justify-center text-white hover:scale-110 transition-transform duration-300">
              <i class="fas fa-envelope"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Send Me a Message</h2>
        <p class="text-gray-600 mb-8">
          I'd love to hear from you! Whether it's a booking inquiry, collaboration, or just a message—drop it below.
        </p>

        <form method="post" class="space-y-6">
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
            <input 
              type="text" 
              id="name" 
              name="name" 
              required
              value="<?php echo htmlspecialchars($name ?? ''); ?>"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none"
              placeholder="Enter your full name"
            >
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Your Email</label>
            <input 
              type="email" 
              id="email" 
              name="email" 
              required
              value="<?php echo htmlspecialchars($email ?? ''); ?>"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none"
              placeholder="Enter your email address"
            >
          </div>

          <div>
            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
            <select 
              id="subject" 
              name="subject" 
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none"
            >
              <option value="">Select a subject</option>
              <option value="general" <?php echo isset($subject) && $subject === 'general' ? 'selected' : ''; ?>>General Inquiry</option>
              <option value="booking" <?php echo isset($subject) && $subject === 'booking' ? 'selected' : ''; ?>>Booking Request</option>
              <option value="collaboration" <?php echo isset($subject) && $subject === 'collaboration' ? 'selected' : ''; ?>>Collaboration</option>
              <option value="pricing" <?php echo isset($subject) && $subject === 'pricing' ? 'selected' : ''; ?>>Pricing Information</option>
              <option value="other" <?php echo isset($subject) && $subject === 'other' ? 'selected' : ''; ?>>Other</option>
            </select>
          </div>

          <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Your Message</label>
            <textarea 
              id="message" 
              name="message" 
              rows="6" 
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none resize-none"
              placeholder="Tell me about your project or ask any questions..."
            ><?php echo htmlspecialchars($message ?? ''); ?></textarea>
          </div>

          <button 
            type="submit" 
            class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-4 rounded-lg font-semibold text-lg hover:from-indigo-700 hover:to-purple-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl"
          >
            <i class="fas fa-paper-plane mr-2"></i>Send Message
          </button>
        </form>
      </div>
    </div>
  </div>
</section>

<section class="py-16 bg-white">
  <div class="container mx-auto px-6">
    <div class="text-center mb-16">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Frequently Asked Questions</h2>
      <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        Quick answers to common questions about my photography services
      </p>
    </div>

    <div class="max-w-4xl mx-auto space-y-6">
      <div class="bg-gray-50 rounded-xl p-6 hover:bg-gray-100 transition-colors duration-300">
        <div class="flex items-start">
          <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center mr-4 mt-1">
            <i class="fas fa-question text-white text-sm"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">How far in advance should I book?</h3>
            <p class="text-gray-600">I recommend booking at least 2-3 weeks in advance, especially for events and special occasions. However, I try to accommodate last-minute requests when possible.</p>
          </div>
        </div>
      </div>

      <div class="bg-gray-50 rounded-xl p-6 hover:bg-gray-100 transition-colors duration-300">
        <div class="flex items-start">
          <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center mr-4 mt-1">
            <i class="fas fa-question text-white text-sm"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">What's included in the photo packages?</h3>
            <p class="text-gray-600">All packages include professional editing, high-resolution digital files, and an online gallery. Specific details vary by package - check the Services page for complete information.</p>
          </div>
        </div>
      </div>

      <div class="bg-gray-50 rounded-xl p-6 hover:bg-gray-100 transition-colors duration-300">
        <div class="flex items-start">
          <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center mr-4 mt-1">
            <i class="fas fa-question text-white text-sm"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Do you travel for shoots?</h3>
            <p class="text-gray-600">Yes, I'm available for shoots throughout Quezon Province and nearby areas. Travel fees may apply for locations outside my local area.</p>
          </div>
        </div>
      </div>

      <div class="bg-gray-50 rounded-xl p-6 hover:bg-gray-100 transition-colors duration-300">
        <div class="flex items-start">
          <div class="w-8 h-8 bg-indigo-600 rounded-full flex items-center justify-center mr-4 mt-1">
            <i class="fas fa-question text-white text-sm"></i>
          </div>
          <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">How long does it take to receive my photos?</h3>
            <p class="text-gray-600">Turnaround time is typically 1-2 weeks for regular sessions and 2-3 weeks for events, depending on the scope of work and editing requirements.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-16 bg-gradient-to-r from-indigo-600 to-purple-700">
  <div class="container mx-auto px-6 text-center">
    <h2 class="text-3xl md:text-4xl font-bold text-white mb-6">Ready to Start Your Photography Journey?</h2>
    <p class="text-xl text-indigo-100 mb-8 max-w-2xl mx-auto">
      Don't wait to capture those special moments. Let's discuss your vision and create something beautiful together.
    </p>
    <a href="inquire.php" class="inline-block bg-white text-indigo-600 px-8 py-4 rounded-full font-semibold text-lg hover:bg-gray-100 transform hover:scale-105 transition-all duration-300 shadow-lg">
      <i class="fas fa-calendar-plus mr-2"></i>Book Your Session Now
    </a>
  </div>
</section>

<?php include 'footer.php'; ?>