<?php

// Run this file directly: php fix_popup_video_table.php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    echo "Checking popup_video table...\n";
    
    // Check if video_file column exists
    if (!Schema::hasColumn('popup_video', 'video_file')) {
        echo "Adding video_file column...\n";
        DB::statement('ALTER TABLE popup_video ADD COLUMN video_file VARCHAR(255) NULL AFTER id');
        echo "✓ video_file column added successfully!\n";
    } else {
        echo "✓ video_file column already exists\n";
    }
    
    // Make video_url nullable
    echo "Making video_url nullable...\n";
    DB::statement('ALTER TABLE popup_video MODIFY COLUMN video_url VARCHAR(255) NULL');
    echo "✓ video_url is now nullable\n";
    
    echo "\nAll done! You can now upload videos.\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
