<?php
// Calculate BASE_URL dynamically
$admin_includes_dir = __DIR__;  // Directory of config.php
$admin_dir = realpath(dirname($admin_includes_dir));  // Parent directory, i.e., admin/
$doc_root = realpath($_SERVER['DOCUMENT_ROOT']);
if (strpos($admin_dir, $doc_root) === 0) {
    $base_path = substr($admin_dir, strlen($doc_root));
    $base_path = str_replace('\\', '/', $base_path);
    define('BASE_URL', $base_path . '/');
} else {
    // Fallback: assume admin is directly under document root
    define('BASE_URL', '/admin/');
}

// Database configuration
define('DB_HOST', 'localhost');
define('DB_NAME', 'ianp');
define('DB_USER', 'root');
define('DB_PASS', '');

session_start();
?>