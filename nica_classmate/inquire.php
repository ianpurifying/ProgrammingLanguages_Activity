<?php 
include 'db.php';

// Initialize variables
$success_message = '';
$error_message = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Get form data and sanitize
        $name = trim($_POST['name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $budget = $_POST['budget'] ?? '';
        $service_type = $_POST['service_type'] ?? '';
        $event_date = $_POST['event_date'] ?? null;
        $location = trim($_POST['location'] ?? '');
        $message = trim($_POST['message'] ?? '');
        $referral = $_POST['referral'] ?? '';
        
        // Handle additional services (checkbox array)
        $additional_services = '';
        if (isset($_POST['additional_services']) && is_array($_POST['additional_services'])) {
            $additional_services = implode(', ', $_POST['additional_services']);
        }
        
        // Validate required fields
        if (empty($name) || empty($email) || empty($service_type) || empty($message)) {
            throw new Exception('Please fill in all required fields.');
        }
        
        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception('Please enter a valid email address.');
        }
        
        // Convert empty event_date to NULL for database
        $event_date = empty($event_date) ? null : $event_date;
        
        // Prepare SQL statement
        $sql = "INSERT INTO inquire (name, email, phone, budget, service_type, event_date, location, additional_services, message, referral) 
                VALUES (:name, :email, :phone, :budget, :service_type, :event_date, :location, :additional_services, :message, :referral)";
        
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':budget', $budget);
        $stmt->bindParam(':service_type', $service_type);
        $stmt->bindParam(':event_date', $event_date);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':additional_services', $additional_services);
        $stmt->bindParam(':message', $message);
        $stmt->bindParam(':referral', $referral);
        
        // Execute the statement
        if ($stmt->execute()) {
            $success_message = "Thank you for your inquiry! We'll get back to you within 24 hours.";
            
            // Optional: Send email notification (uncomment if needed)
            /*
            $to = "comianicaa@gmail.com";
            $subject = "New Photography Inquiry from " . $name;
            $email_message = "New inquiry received:\n\n";
            $email_message .= "Name: " . $name . "\n";
            $email_message .= "Email: " . $email . "\n";
            $email_message .= "Phone: " . $phone . "\n";
            $email_message .= "Service: " . $service_type . "\n";
            $email_message .= "Message: " . $message . "\n";
            
            mail($to, $subject, $email_message);
            */
        } else {
            throw new Exception('Failed to save inquiry. Please try again.');
        }
        
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
include 'header.php';
?>

<!-- Success/Error Messages -->
<?php if (!empty($success_message)): ?>
<div class="fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50">
    <div class="flex items-center">
        <i class="fas fa-check-circle mr-2"></i>
        <?php echo htmlspecialchars($success_message); ?>
    </div>
</div>
<script>
    setTimeout(function() {
        document.querySelector('.bg-green-500').style.display = 'none';
    }, 5000);
</script>
<?php endif; ?>

<?php if (!empty($error_message)): ?>
<div class="fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50">
    <div class="flex items-center">
        <i class="fas fa-exclamation-circle mr-2"></i>
        <?php echo htmlspecialchars($error_message); ?>
    </div>
</div>
<script>
    setTimeout(function() {
        document.querySelector('.bg-red-500').style.display = 'none';
    }, 5000);
</script>
<?php endif; ?>

<!-- Inquiry Section -->
<section class="pt-24 pb-16 bg-gradient-to-br from-slate-50 to-gray-100">
  <div class="container mx-auto px-6">
    <!-- Header -->
    <div class="text-center mb-16">
      <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Make an Inquiry</h1>
      <div class="w-24 h-1 bg-indigo-600 mx-auto rounded-full mb-6"></div>
      <p class="text-xl text-gray-600 max-w-3xl mx-auto">
        Let's bring your vision to life! Share a few details about your photography needs and I'll get back to you as soon as possible.
      </p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
      <!-- Form Section -->
      <div class="bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tell Me About Your Project</h2>
        
        <form method="post" class="space-y-6">
          <!-- Personal Information -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name *</label>
              <input 
                type="text" 
                id="name" 
                name="name" 
                required
                value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none"
                placeholder="Your full name"
              >
            </div>
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address *</label>
              <input 
                type="email" 
                id="email" 
                name="email" 
                required
                value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none"
                placeholder="your.email@example.com"
              >
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
              <input 
                type="tel" 
                id="phone" 
                name="phone"
                value="<?php echo htmlspecialchars($_POST['phone'] ?? ''); ?>"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none"
                placeholder="63 9** **** ***"
              >
            </div>
            <div>
              <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">Budget Range</label>
              <select 
                id="budget" 
                name="budget"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none"
              >
                <option value="">Select budget range</option>
                <option value="under-500" <?php echo (($_POST['budget'] ?? '') === 'under-500') ? 'selected' : ''; ?>>Under $500</option>
                <option value="500-1000" <?php echo (($_POST['budget'] ?? '') === '500-1000') ? 'selected' : ''; ?>>$500 - $1,000</option>
                <option value="1000-2500" <?php echo (($_POST['budget'] ?? '') === '1000-2500') ? 'selected' : ''; ?>>$1,000 - $2,500</option>
                <option value="2500-5000" <?php echo (($_POST['budget'] ?? '') === '2500-5000') ? 'selected' : ''; ?>>$2,500 - $5,000</option>
                <option value="5000-plus" <?php echo (($_POST['budget'] ?? '') === '5000-plus') ? 'selected' : ''; ?>>$5,000+</option>
              </select>
            </div>
          </div>

          <!-- Photography Service Type -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">Photography Service *</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
              <label class="flex items-center space-x-3 cursor-pointer">
                <input type="radio" name="service_type" value="wedding" <?php echo (($_POST['service_type'] ?? '') === 'wedding') ? 'checked' : ''; ?> class="text-indigo-600 focus:ring-indigo-600">
                <span class="text-gray-700">Wedding Photography</span>
              </label>
              <label class="flex items-center space-x-3 cursor-pointer">
                <input type="radio" name="service_type" value="portrait" <?php echo (($_POST['service_type'] ?? '') === 'portrait') ? 'checked' : ''; ?> class="text-indigo-600 focus:ring-indigo-600">
                <span class="text-gray-700">Portrait Session</span>
              </label>
              <label class="flex items-center space-x-3 cursor-pointer">
                <input type="radio" name="service_type" value="event" <?php echo (($_POST['service_type'] ?? '') === 'event') ? 'checked' : ''; ?> class="text-indigo-600 focus:ring-indigo-600">
                <span class="text-gray-700">Event Photography</span>
              </label>
              <label class="flex items-center space-x-3 cursor-pointer">
                <input type="radio" name="service_type" value="commercial" <?php echo (($_POST['service_type'] ?? '') === 'commercial') ? 'checked' : ''; ?> class="text-indigo-600 focus:ring-indigo-600">
                <span class="text-gray-700">Commercial/Business</span>
              </label>
              <label class="flex items-center space-x-3 cursor-pointer">
                <input type="radio" name="service_type" value="family" <?php echo (($_POST['service_type'] ?? '') === 'family') ? 'checked' : ''; ?> class="text-indigo-600 focus:ring-indigo-600">
                <span class="text-gray-700">Family Photography</span>
              </label>
              <label class="flex items-center space-x-3 cursor-pointer">
                <input type="radio" name="service_type" value="other" <?php echo (($_POST['service_type'] ?? '') === 'other') ? 'checked' : ''; ?> class="text-indigo-600 focus:ring-indigo-600">
                <span class="text-gray-700">Other</span>
              </label>
            </div>
          </div>

          <!-- Event Date -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label for="event_date" class="block text-sm font-medium text-gray-700 mb-2">Preferred Date</label>
              <input 
                type="date" 
                id="event_date" 
                name="event_date"
                value="<?php echo htmlspecialchars($_POST['event_date'] ?? ''); ?>"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none"
              >
            </div>
            <div>
              <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
              <input 
                type="text" 
                id="location" 
                name="location"
                value="<?php echo htmlspecialchars($_POST['location'] ?? ''); ?>"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none"
                placeholder="City, State or Venue"
              >
            </div>
          </div>

          <!-- Additional Services -->
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-3">Additional Services (Check all that apply)</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
              <?php 
              $selected_services = $_POST['additional_services'] ?? [];
              $services = [
                'engagement' => 'Engagement Session',
                'photo_album' => 'Photo Album',
                'prints' => 'Professional Prints',
                'digital_gallery' => 'Digital Gallery',
                'rush_delivery' => 'Rush Delivery',
                'video' => 'Video Services'
              ];
              
              foreach ($services as $value => $label): ?>
              <label class="flex items-center space-x-3 cursor-pointer">
                <input type="checkbox" name="additional_services[]" value="<?php echo $value; ?>" <?php echo in_array($value, $selected_services) ? 'checked' : ''; ?> class="text-indigo-600 focus:ring-indigo-600 rounded">
                <span class="text-gray-700"><?php echo $label; ?></span>
              </label>
              <?php endforeach; ?>
            </div>
          </div>

          <!-- Project Details -->
          <div>
            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Project Details *</label>
            <textarea 
              id="message" 
              name="message" 
              rows="5" 
              required
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none resize-none"
              placeholder="Tell me more about your vision, special requests, number of guests (if applicable), and any other important details..."
            ><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
          </div>

          <!-- How did you hear about us -->
          <div>
            <label for="referral" class="block text-sm font-medium text-gray-700 mb-2">How did you hear about us?</label>
            <select 
              id="referral" 
              name="referral"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-600 focus:border-transparent transition-all duration-300 outline-none"
            >
              <option value="">Please select</option>
              <option value="google" <?php echo (($_POST['referral'] ?? '') === 'google') ? 'selected' : ''; ?>>Google Search</option>
              <option value="social-media" <?php echo (($_POST['referral'] ?? '') === 'social-media') ? 'selected' : ''; ?>>Social Media</option>
              <option value="referral" <?php echo (($_POST['referral'] ?? '') === 'referral') ? 'selected' : ''; ?>>Friend/Family Referral</option>
              <option value="wedding-venue" <?php echo (($_POST['referral'] ?? '') === 'wedding-venue') ? 'selected' : ''; ?>>Wedding Venue</option>
              <option value="previous-client" <?php echo (($_POST['referral'] ?? '') === 'previous-client') ? 'selected' : ''; ?>>Previous Client</option>
              <option value="advertisement" <?php echo (($_POST['referral'] ?? '') === 'advertisement') ? 'selected' : ''; ?>>Advertisement</option>
              <option value="other" <?php echo (($_POST['referral'] ?? '') === 'other') ? 'selected' : ''; ?>>Other</option>
            </select>
          </div>

          <!-- Submit Button -->
          <div class="pt-4">
            <button 
              type="submit" 
              class="w-full bg-indigo-600 text-white py-4 px-8 rounded-lg font-semibold text-lg hover:bg-indigo-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl focus:outline-none focus:ring-2 focus:ring-indigo-600 focus:ring-offset-2"
            >
              <i class="fas fa-paper-plane mr-2"></i>
              Send Inquiry
            </button>
          </div>
        </form>
      </div>

      <!-- Information Section -->
      <div class="space-y-8">
        <!-- Contact Information Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
          <h3 class="text-2xl font-bold text-gray-800 mb-6">Get in Touch</h3>
          
          <div class="space-y-6">
            <div class="flex items-start space-x-4">
              <div class="bg-indigo-100 p-3 rounded-full">
                <i class="fas fa-envelope text-indigo-600"></i>
              </div>
              <div>
                <h4 class="font-semibold text-gray-800">Email</h4>
                <p class="text-gray-600">comianicaa@gmail.com</p>
              </div>
            </div>
            
            <div class="flex items-start space-x-4">
              <div class="bg-indigo-100 p-3 rounded-full">
                <i class="fas fa-phone text-indigo-600"></i>
              </div>
              <div>
                <h4 class="font-semibold text-gray-800">Phone</h4>
                <p class="text-gray-600">63 949 8774 107</p>
              </div>
            </div>
            
            <div class="flex items-start space-x-4">
              <div class="bg-indigo-100 p-3 rounded-full">
                <i class="fas fa-clock text-indigo-600"></i>
              </div>
              <div>
                <h4 class="font-semibold text-gray-800">Response Time</h4>
                <p class="text-gray-600">Within 24 hours</p>
              </div>
            </div>
            
            <div class="flex items-start space-x-4">
              <div class="bg-indigo-100 p-3 rounded-full">
                <i class="fas fa-map-marker-alt text-indigo-600"></i>
              </div>
              <div>
                <h4 class="font-semibold text-gray-800">Service Area</h4>
                <p class="text-gray-600">Available nationwide<br>
                <span class="text-sm text-gray-500">Travel fees may apply</span></p>
              </div>
            </div>
          </div>
        </div>

        <!-- What to Expect Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
          <h3 class="text-2xl font-bold text-gray-800 mb-6">What to Expect</h3>
          
          <div class="space-y-4">
            <div class="flex items-start space-x-3">
              <div class="bg-indigo-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mt-1">1</div>
              <div>
                <h4 class="font-semibold text-gray-800">Quick Response</h4>
                <p class="text-gray-600 text-sm">I'll get back to you within 24 hours with a personalized response.</p>
              </div>
            </div>
            
            <div class="flex items-start space-x-3">
              <div class="bg-indigo-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mt-1">2</div>
              <div>
                <h4 class="font-semibold text-gray-800">Consultation Call</h4>
                <p class="text-gray-600 text-sm">We'll schedule a call to discuss your vision and requirements in detail.</p>
              </div>
            </div>
            
            <div class="flex items-start space-x-3">
              <div class="bg-indigo-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mt-1">3</div>
              <div>
                <h4 class="font-semibold text-gray-800">Custom Proposal</h4>
                <p class="text-gray-600 text-sm">You'll receive a detailed proposal tailored to your specific needs.</p>
              </div>
            </div>
            
            <div class="flex items-start space-x-3">
              <div class="bg-indigo-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mt-1">4</div>
              <div>
                <h4 class="font-semibold text-gray-800">Book Your Session</h4>
                <p class="text-gray-600 text-sm">Once approved, we'll secure your date and begin planning your perfect shoot.</p>
              </div>
            </div>
          </div>
        </div>

        <!-- FAQ Card -->
        <div class="bg-white rounded-2xl shadow-xl p-8">
          <h3 class="text-2xl font-bold text-gray-800 mb-6">Quick FAQ</h3>
          
          <div class="space-y-4">
            <div>
              <h4 class="font-semibold text-gray-800 mb-2">How far in advance should I book?</h4>
              <p class="text-gray-600 text-sm">For weddings, I recommend booking 6-12 months in advance. Other sessions can typically be scheduled 2-4 weeks ahead.</p>
            </div>
            
            <div>
              <h4 class="font-semibold text-gray-800 mb-2">Do you travel for shoots?</h4>
              <p class="text-gray-600 text-sm">Yes! I'm available for destination shoots nationwide. Travel fees will be discussed during our consultation.</p>
            </div>
            
            <div>
              <h4 class="font-semibold text-gray-800 mb-2">What's included in your packages?</h4>
              <p class="text-gray-600 text-sm">Each package is customized to your needs. Generally includes consultation, shooting time, editing, and digital gallery delivery.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php include "footer.php"; ?>