<?php
session_start();
require_once 'db.php';

if (isset($_SESSION['admin_logged_in'])) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_POST) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($admin && password_verify($password, $admin['hashed_password'])) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $admin['username'];
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Click by Nica</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex items-center justify-center">
    <div class="bg-white rounded-xl shadow-2xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
            <div class="bg-indigo-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-user-shield text-indigo-600 text-2xl"></i>
            </div>
            <h1 class="text-3xl font-bold text-gray-800">Admin Login</h1>
            <p class="text-gray-600 mt-2">Click by Nica Management</p>
        </div>
        
        <?php if ($error): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i><?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-user mr-2"></i>Username
                </label>
                <input 
                    type="text" 
                    name="username" 
                    required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Enter username"
                    value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>"
                >
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    <i class="fas fa-lock mr-2"></i>Password
                </label>
                <input 
                    type="password" 
                    name="password" 
                    required 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                    placeholder="Enter password"
                >
            </div>
            
            <button 
                type="submit" 
                class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg hover:bg-indigo-700 transition duration-200 font-medium"
            >
                <i class="fas fa-sign-in-alt mr-2"></i>Login
            </button>
        </form>
        
        <div class="text-center mt-6 text-sm text-gray-500">
            Default: admin / password
        </div>
    </div>
</body>
</html>