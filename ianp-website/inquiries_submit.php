<?php
// inquiries_submit.php
session_start();

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    // If not a POST request, show message and redirect option
    include "includes/header.php";
    ?>
    <main class="relative pt-24 pb-20">
        <section class="container mx-auto px-6">
            <div class="max-w-2xl mx-auto text-center">
                <div class="glass-effect p-8 rounded-lg neon-border">
                    <i class="ri-error-warning-line text-6xl text-cyber-yellow mb-6"></i>
                    <h1 class="text-3xl font-orbitron font-bold text-cyber-yellow mb-4">Access Denied</h1>
                    <p class="font-tech text-gray-300 mb-8">Please submit a form to access this page.</p>
                    <a href="inquiries.php" 
                       class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-cyber-purple to-cyber-blue text-white font-orbitron font-bold rounded-lg hover:scale-105 transform transition-all duration-300 neon-border">
                        <i class="ri-arrow-left-line mr-2"></i>
                        Go to Inquiry Form
                    </a>
                </div>
            </div>
        </section>
    </main>
    <?php
    include "includes/footer.php";
    exit();
}

// Include database connection
// Assuming you have a database connection file
include "includes/db.php"; // Adjust path as needed

// Initialize variables
$success = false;
$error_message = "";
$form_data = [];

try {
    // Get form data
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);
    $category = $_POST['category'];
    $preferred_contact = $_POST['preferred_contact'];
    $priority = $_POST['priority']; // Note: priority is not in the DB schema, but we'll store it temporarily
    
    // Handle file upload
    $image_filename = null;
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/inquiries/';
        
        // Create directory if it doesn't exist
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }
        
        $file_info = pathinfo($_FILES['image']['name']);
        $file_extension = strtolower($file_info['extension']);
        
        // Validate file type
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($file_extension, $allowed_types)) {
            // Generate unique filename
            $image_filename = 'inquiry_' . time() . '_' . uniqid() . '.' . $file_extension;
            $upload_path = $upload_dir . $image_filename;
            
            if (!move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $image_filename = null;
            }
        }
    }
    
    $status = 'pending';

    $sql = "INSERT INTO inquire (fullname, email, phone, subject, message, category, preferred_contact, priority, image, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssss", $fullname, $email, $phone, $subject, $message, $category, $preferred_contact, $priority, $image_filename, $status);

    $stmt->execute();
    

    // Store form data for display (temporary)
    $form_data = [
        'fullname' => $fullname,
        'email' => $email,
        'phone' => $phone,
        'subject' => $subject,
        'message' => $message,
        'category' => $category,
        'preferred_contact' => $preferred_contact,
        'priority' => $priority,
        'image' => $image_filename,
        'submission_time' => date('Y-m-d H:i:s')
    ];
    
    $success = true;
    
} catch (Exception $e) {
    $error_message = "Error processing your inquiry. Please try again.";
    // Log the actual error for debugging
    error_log("Inquiry submission error: " . $e->getMessage());
}

include "includes/header.php";
?>

<main class="relative pt-24 pb-20">
    <section class="container mx-auto px-6">
        
        <?php if ($success): ?>
            <!-- Success Message -->
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-8 animate__animated animate__fadeInUp">
                    <div class="inline-block p-4 bg-green-500/10 rounded-full mb-4">
                        <i class="ri-check-line text-6xl text-green-500"></i>
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-orbitron font-black text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-cyber-blue mb-4">
                        Inquiry Submitted Successfully!
                    </h1>
                    <p class="font-tech text-xl text-gray-300">
                        Thank you for your inquiry. We'll get back to you soon.
                    </p>
                </div>

                <!-- Submission Summary -->
                <div class="glass-effect p-8 lg:p-12 rounded-lg neon-border animate__animated animate__fadeInUp">
                    <div class="flex items-center mb-8">
                        <i class="ri-file-check-line text-3xl text-green-500 mr-4"></i>
                        <h2 class="text-3xl font-orbitron font-bold text-green-500">Submission Summary</h2>
                    </div>

                    <div class="grid lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <div class="space-y-2">
                                <label class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                                    <i class="ri-user-line mr-2"></i>Full Name
                                </label>
                                <p class="font-tech text-white text-lg"><?php echo htmlspecialchars($form_data['fullname']); ?></p>
                            </div>

                            <div class="space-y-2">
                                <label class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                                    <i class="ri-mail-line mr-2"></i>Email Address
                                </label>
                                <p class="font-tech text-white text-lg"><?php echo htmlspecialchars($form_data['email']); ?></p>
                            </div>

                            <?php if (!empty($form_data['phone'])): ?>
                            <div class="space-y-2">
                                <label class="block font-tech text-cyber-blue text-sm uppercase tracking-wider">
                                    <i class="ri-phone-line mr-2"></i>Phone Number
                                </label>
                                <p class="font-tech text-white text-lg"><?php echo htmlspecialchars($form_data['phone']); ?></p>
                            </div>
                            <?php endif; ?>

                            <div class="space-y-2">
                                <label class="block font-tech text-cyber-purple text-sm uppercase tracking-wider">
                                    <i class="ri-bookmark-line mr-2"></i>Project Category
                                </label>
                                <p class="font-tech text-white text-lg capitalize"><?php echo htmlspecialchars($form_data['category']); ?></p>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <?php if (!empty($form_data['subject'])): ?>
                            <div class="space-y-2">
                                <label class="block font-tech text-cyber-blue text-sm uppercase tracking-wider">
                                    <i class="ri-bookmark-3-line mr-2"></i>Subject
                                </label>
                                <p class="font-tech text-white text-lg"><?php echo htmlspecialchars($form_data['subject']); ?></p>
                            </div>
                            <?php endif; ?>

                            <div class="space-y-2">
                                <label class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                                    <i class="ri-contacts-line mr-2"></i>Preferred Contact
                                </label>
                                <p class="font-tech text-white text-lg capitalize">
                                    <i class="ri-<?php echo $form_data['preferred_contact'] === 'email' ? 'mail' : 'phone'; ?>-line mr-2"></i>
                                    <?php echo htmlspecialchars($form_data['preferred_contact']); ?>
                                </p>
                            </div>

                            <div class="space-y-2">
                                <label class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                                    <i class="ri-alarm-warning-line mr-2"></i>Priority Level
                                </label>
                                <p class="font-tech text-white text-lg capitalize">
                                    <?php
                                    $priority_icons = [
                                        'low' => '🟢',
                                        'medium' => '🟡',
                                        'high' => '🟠',
                                        'urgent' => '🔴'
                                    ];
                                    echo $priority_icons[$form_data['priority']] . ' ' . ucfirst($form_data['priority']);
                                    ?>
                                </p>
                            </div>

                            <?php if (!empty($form_data['image'])): ?>
                            <div class="space-y-2">
                                <label class="block font-tech text-cyber-purple text-sm uppercase tracking-wider">
                                    <i class="ri-image-line mr-2"></i>Uploaded Image
                                </label>
                                <div class="flex items-center space-x-3">
                                    <img src="uploads/inquiries/<?php echo htmlspecialchars($form_data['image']); ?>" 
                                         alt="Uploaded reference" 
                                         class="w-16 h-16 object-cover rounded-lg border border-cyber-purple/30">
                                    <p class="font-tech text-white text-sm"><?php echo htmlspecialchars($form_data['image']); ?></p>
                                </div>
                            </div>
                            <?php endif; ?>

                            <div class="space-y-2">
                                <label class="block font-tech text-cyber-blue text-sm uppercase tracking-wider">
                                    <i class="ri-time-line mr-2"></i>Submitted At
                                </label>
                                <p class="font-tech text-white text-lg"><?php echo date('F j, Y - g:i A', strtotime($form_data['submission_time'])); ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Message -->
                    <div class="mt-8 space-y-2">
                        <label class="block font-tech text-cyber-yellow text-sm uppercase tracking-wider">
                            <i class="ri-message-2-line mr-2"></i>Your Message
                        </label>
                        <div class="bg-black/30 border border-cyber-yellow/20 rounded-lg p-4">
                            <p class="font-tech text-white leading-relaxed whitespace-pre-wrap"><?php echo htmlspecialchars($form_data['message']); ?></p>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="inquiries.php" 
                           class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-cyber-purple to-cyber-blue text-white font-orbitron font-bold rounded-lg hover:scale-105 transform transition-all duration-300 neon-border">
                            <i class="ri-arrow-left-line mr-2"></i>
                            Submit Another Inquiry
                        </a>
                        <a href="index.php" 
                           class="inline-flex items-center justify-center px-8 py-3 bg-gradient-to-r from-cyber-yellow to-cyber-purple text-black font-orbitron font-bold rounded-lg hover:scale-105 transform transition-all duration-300 neon-border">
                            <i class="ri-home-line mr-2"></i>
                            Back to Home
                        </a>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="mt-8 p-6 glass-effect rounded-lg border border-green-500/20">
                    <div class="flex items-start space-x-4">
                        <i class="ri-information-line text-green-500 text-2xl mt-1"></i>
                        <div>
                            <h3 class="font-orbitron text-green-500 font-bold mb-2">What's Next?</h3>
                            <ul class="font-tech text-gray-300 text-sm space-y-1">
                                <li>• <span class="text-green-400">Confirmation email sent</span> - Check your inbox for a confirmation email</li>
                                <li>• <span class="text-green-400">Review in progress</span> - Our team will review your inquiry within 24 hours</li>
                                <li>• <span class="text-green-400">Personal response</span> - You'll receive a detailed response via your preferred contact method</li>
                                <li>• <span class="text-green-400">Project discussion</span> - We'll schedule a consultation if needed</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <!-- Error Message -->
            <div class="max-w-2xl mx-auto text-center">
                <div class="glass-effect p-8 rounded-lg neon-border">
                    <i class="ri-error-warning-line text-6xl text-red-500 mb-6"></i>
                    <h1 class="text-3xl font-orbitron font-bold text-red-500 mb-4">Submission Failed</h1>
                    <p class="font-tech text-gray-300 mb-8"><?php echo htmlspecialchars($error_message); ?></p>
                    <a href="inquiries.php" 
                       class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-cyber-purple to-cyber-blue text-white font-orbitron font-bold rounded-lg hover:scale-105 transform transition-all duration-300 neon-border">
                        <i class="ri-arrow-left-line mr-2"></i>
                        Try Again
                    </a>
                </div>
            </div>
        <?php endif; ?>

    </section>
</main>

<?php include "includes/footer.php"; ?>