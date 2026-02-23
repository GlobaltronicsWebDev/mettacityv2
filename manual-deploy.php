<?php
/**
 * Manual Deployment Script
 * Visit this URL to manually trigger deployment: https://mettacity.com.ph/manual-deploy.php
 * 
 * Upload this file to public_html folder on Hostinger
 */

define('REPO_PATH', '/home/u553953718/domains/mettacity.com.ph/public_html/mettacityv2');
define('BRANCH', 'main');
define('LOG_FILE', __DIR__ . '/deploy.log');

function logMessage($message) {
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents(LOG_FILE, "[$timestamp] $message\n", FILE_APPEND);
    echo "<p>[$timestamp] $message</p>";
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Manual Deployment - Mettacity</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        h1 { color: #333; }
        .success { color: green; }
        .error { color: red; }
        .info { color: blue; }
        pre { background: #f4f4f4; padding: 15px; border-radius: 5px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>🚀 Manual Deployment</h1>
    
<?php

echo "<div class='info'>";
logMessage("=== Manual Deployment Started ===");
logMessage("Repository: " . REPO_PATH);
logMessage("Branch: " . BRANCH);
echo "</div>";

// Change to repository directory
if (!chdir(REPO_PATH)) {
    echo "<div class='error'>";
    logMessage("✗ Failed to change to repository directory");
    echo "</div>";
    exit;
}

echo "<div class='info'>";
logMessage("✓ Changed to repository directory");
echo "</div>";

// Execute git pull
$output = [];
$return_var = 0;

echo "<h2>Git Pull</h2>";
echo "<pre>";
exec('git pull origin ' . BRANCH . ' 2>&1', $output, $return_var);

foreach ($output as $line) {
    logMessage("  " . $line);
}
echo "</pre>";

if ($return_var === 0) {
    echo "<div class='success'>";
    logMessage("✓ Git pull successful");
    echo "</div>";
    
    // Run Laravel commands
    echo "<h2>Laravel Cache Clear</h2>";
    $commands = [
        'php artisan config:clear',
        'php artisan cache:clear',
        'php artisan route:clear',
        'php artisan view:clear',
        'php artisan config:cache',
        'php artisan route:cache',
        'php artisan view:cache',
    ];
    
    echo "<pre>";
    foreach ($commands as $command) {
        $cmd_output = [];
        $cmd_return = 0;
        exec($command . ' 2>&1', $cmd_output, $cmd_return);
        
        logMessage("Running: $command");
        if ($cmd_return === 0) {
            echo "<span class='success'>✓ $command</span>\n";
            logMessage("  ✓ Success");
        } else {
            echo "<span class='error'>✗ $command</span>\n";
            logMessage("  ✗ Failed: " . implode("\n", $cmd_output));
            foreach ($cmd_output as $line) {
                echo "  $line\n";
            }
        }
    }
    echo "</pre>";
    
    echo "<div class='success'>";
    logMessage("=== Deployment Completed Successfully ===");
    echo "<h2>✅ Deployment Complete!</h2>";
    echo "<p>Your website has been updated with the latest changes from GitHub.</p>";
    echo "<p><a href='https://mettacity.com.ph'>View Website</a> | <a href='https://mettacity.com.ph/admin'>Admin Panel</a></p>";
    echo "</div>";
    
} else {
    echo "<div class='error'>";
    logMessage("✗ Git pull failed");
    logMessage("=== Deployment Failed ===");
    echo "<h2>❌ Deployment Failed</h2>";
    echo "<p>Check the output above for errors.</p>";
    echo "</div>";
}

logMessage("");

?>

</body>
</html>
