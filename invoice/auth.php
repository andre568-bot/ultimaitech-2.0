<?php
session_start();

// Load environment variables from .env file
function loadEnv($path) {
    if (!file_exists($path)) {
        return false;
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos($line, '=') !== false && strpos($line, '#') !== 0) {
            list($key, $value) = explode('=', $line, 2);
            $_ENV[trim($key)] = trim($value);
        }
    }
    return true;
}

loadEnv(__DIR__ . '/.env');

// Check if user is logging in
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    header('Content-Type: application/json');
    
    if ($_POST['action'] === 'login') {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        
        $validEmail = $_ENV['INVOICE_EMAIL'] ?? '';
        $validPassword = $_ENV['INVOICE_PASSWORD'] ?? '';
        
        if ($email === $validEmail && $password === $validPassword) {
            $_SESSION['invoice_logged_in'] = true;
            $_SESSION['invoice_user'] = $email;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Invalid credentials']);
        }
        exit;
    }
    
    if ($_POST['action'] === 'logout') {
        session_destroy();
        echo json_encode(['success' => true]);
        exit;
    }
    
    if ($_POST['action'] === 'check') {
        echo json_encode([
            'loggedIn' => isset($_SESSION['invoice_logged_in']) && $_SESSION['invoice_logged_in'],
            'user' => $_SESSION['invoice_user'] ?? null
        ]);
        exit;
    }
}

// Check authentication status
$isLoggedIn = isset($_SESSION['invoice_logged_in']) && $_SESSION['invoice_logged_in'];
$userEmail = $_SESSION['invoice_user'] ?? '';
?>
