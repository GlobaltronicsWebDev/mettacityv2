<?php
/**
 * Fix Storage Symlink for Hostinger
 * 
 * This script creates the storage symlink needed for uploaded images
 * Visit: https://mettacity.com.ph/fix-storage-link.php
 */

// Configuration
define('PROJECT_PATH', '/home/u553953718/domains/mettacity.com.ph/public_html/mettacityv2');
define('PUBLIC_PATH', PROJECT_PATH . '/public');
define('STORAGE_PATH', PROJECT_PATH . '/storage/app/public');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Fix Storage Link - Mettacity</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; }
        h1 { color: #333; }
        .success { color: green; padding: 15px; background: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; margin: 10px 0; }
        .error { color: red; padding: 15px; background: #f8d7da; border: 1px solid #f5c6cb; border-radius: 5px; margin: 10px 0; }
        .info { color: blue; padding: 15px; background: #d1ecf1; border: 1px solid #bee5eb; border-radius: 5px; margin: 10px 0; }
        .code { background: #f4f4f4; padding: 10px; border-radius: 5px; font-family: monospace; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>🔧 Fix Storage Symlink</h1>
    
    <?php
    
    $linkPath = PUBLIC_PATH . '/storage';
    $targetPath = STORAGE_PATH;
    
    echo "<div class='info'>";
    echo "<strong>Checking storage configuration...</strong><br>";
    echo "Link Path: " . $linkPath . "<br>";
    echo "Target Path: " . $targetPath . "<br>";
    echo "</div>";
    
    // Check if link already exists
    if (file_exists($linkPath)) {
        if (is_link($linkPath)) {
            $currentTarget = readlink($linkPath);
            echo "<div class='info'>";
            echo "✓ Symlink already exists<br>";
            echo "Current target: " . $currentTarget . "<br>";
            echo "</div>";
            
            if ($currentTarget === $targetPath) {
                echo "<div class='success'>";
                echo "<strong>✅ Storage symlink is correctly configured!</strong><br>";
                echo "Your uploaded images should work now.";
                echo "</div>";
            } else {
                echo "<div class='error'>";
                echo "⚠ Symlink exists but points to wrong location<br>";
                echo "Removing old symlink...";
                unlink($linkPath);
                echo " Done!<br>";
                echo "</div>";
            }
        } else {
            echo "<div class='error'>";
            echo "⚠ A file/folder exists at the symlink location but it's not a symlink<br>";
            echo "Please manually remove: " . $linkPath;
            echo "</div>";
            exit;
        }
    }
    
    // Create symlink if it doesn't exist or was removed
    if (!file_exists($linkPath)) {
        echo "<div class='info'>";
        echo "Creating symlink...<br>";
        echo "</div>";
        
        if (!file_exists($targetPath)) {
            echo "<div class='error'>";
            echo "❌ Error: Storage target directory doesn't exist: " . $targetPath . "<br>";
            echo "Please create it first or run: php artisan storage:link";
            echo "</div>";
            exit;
        }
        
        if (symlink($targetPath, $linkPath)) {
            echo "<div class='success'>";
            echo "<strong>✅ Storage symlink created successfully!</strong><br>";
            echo "Link: " . $linkPath . "<br>";
            echo "Target: " . $targetPath . "<br>";
            echo "<br>";
            echo "Your uploaded images should now work correctly!";
            echo "</div>";
        } else {
            echo "<div class='error'>";
            echo "❌ Failed to create symlink<br>";
            echo "Please run this command via SSH:<br>";
            echo "<div class='code'>cd " . PROJECT_PATH . " && php artisan storage:link</div>";
            echo "</div>";
        }
    }
    
    // Test image access
    echo "<div class='info'>";
    echo "<strong>Testing image access...</strong><br>";
    
    // Check if storage/app/public/news directory exists
    $newsDir = STORAGE_PATH . '/news';
    if (file_exists($newsDir)) {
        echo "✓ News images directory exists<br>";
        
        // List some images
        $images = glob($newsDir . '/*');
        if (count($images) > 0) {
            echo "✓ Found " . count($images) . " image(s) in news directory<br>";
            echo "<br><strong>Sample images:</strong><br>";
            foreach (array_slice($images, 0, 3) as $image) {
                $filename = basename($image);
                $webPath = '/storage/news/' . $filename;
                echo "• <a href='" . $webPath . "' target='_blank'>" . $filename . "</a><br>";
            }
        } else {
            echo "ℹ No images found in news directory yet<br>";
        }
    } else {
        echo "ℹ News images directory doesn't exist yet (will be created when you upload first image)<br>";
    }
    echo "</div>";
    
    ?>
    
    <div class="info">
        <strong>Next Steps:</strong><br>
        1. Go to Admin Panel → News Management<br>
        2. Upload a news image<br>
        3. Check if the image appears on the News page<br>
        4. If images still don't show, check file permissions
    </div>
    
    <div class="info">
        <strong>Alternative: Via SSH</strong><br>
        <div class="code">
            cd <?php echo PROJECT_PATH; ?><br>
            php artisan storage:link
        </div>
    </div>

</body>
</html>
