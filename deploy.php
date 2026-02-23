<?php

/**
 * GitHub Webhook Auto-Deployment Script for Hostinger
 * 
 * This script automatically pulls changes from GitHub when you push code
 * Place this file in your public_html folder
 * URL: https://yourdomain.com/deploy.php
 */

// Configuration
define('SECRET_TOKEN', 'your-secret-webhook-token-here'); // Change this to a random string
define('REPO_PATH', '/home/u123456789/mettacity'); // Your Laravel project path
define('BRANCH', 'main'); // or 'master'
define('LOG_FILE', __DIR__ . '/deploy.log');

// Get the payload from GitHub
$payload = file_get_contents('php://input');
$signature = $_SERVER['HTTP_X_HUB_SIGNATURE_256'] ?? '';

// Verify the webhook signature (security)
if (!empty(SECRET_TOKEN)) {
    $hash = 'sha256=' . hash_hmac('sha256', $payload, SECRET_TOKEN);
    if (!hash_equals($hash, $signature)) {
        http_response_code(403);
        die('Invalid signature');
    }
}

// Parse the payload
$data = json_decode($payload, true);

// Log the deployment
function logMessage($message) {
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents(LOG_FILE, "[$timestamp] $message\n", FILE_APPEND);
}

logMessage("=== Deployment Started ===");
logMessage("Branch: " . ($data['ref'] ?? 'unknown'));
logMessage("Pusher: " . ($data['pusher']['name'] ?? 'unknown'));

// Check if it's the correct branch
if (isset($data['ref']) && $data['ref'] === 'refs/heads/' . BRANCH) {
    
    // Change to repository directory
    chdir(REPO_PATH);
    
    // Execute git pull
    $output = [];
    $return_var = 0;
    
    // Git pull command
    exec('git pull origin ' . BRANCH . ' 2>&1', $output, $return_var);
    
    logMessage("Git Pull Output:");
    foreach ($output as $line) {
        logMessage("  " . $line);
    }
    
    if ($return_var === 0) {
        logMessage("✓ Git pull successful");
        
        // Run Laravel commands
        $commands = [
            'php artisan config:clear',
            'php artisan cache:clear',
            'php artisan route:clear',
            'php artisan view:clear',
            'php artisan config:cache',
            'php artisan route:cache',
            'php artisan view:cache',
        ];
        
        foreach ($commands as $command) {
            exec($command . ' 2>&1', $cmd_output, $cmd_return);
            logMessage("Running: $command");
            if ($cmd_return === 0) {
                logMessage("  ✓ Success");
            } else {
                logMessage("  ✗ Failed: " . implode("\n", $cmd_output));
            }
        }
        
        logMessage("=== Deployment Completed Successfully ===");
        echo json_encode(['status' => 'success', 'message' => 'Deployment completed']);
        
    } else {
        logMessage("✗ Git pull failed");
        logMessage("=== Deployment Failed ===");
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Git pull failed']);
    }
    
} else {
    logMessage("Skipped: Not the target branch");
    echo json_encode(['status' => 'skipped', 'message' => 'Not the target branch']);
}

logMessage("");
