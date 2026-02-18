<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class OptimizeImages extends Command
{
    protected $signature = 'images:optimize';
    protected $description = 'Optimize images for better performance';

    public function handle()
    {
        $this->info('🖼️  Checking images for optimization...');
        $this->newLine();

        $assetsPath = public_path('assets');
        
        if (!File::exists($assetsPath)) {
            $this->error('Assets folder not found!');
            return 1;
        }

        $files = File::allFiles($assetsPath);
        $largeImages = [];
        $totalSize = 0;

        foreach ($files as $file) {
            if (in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                $size = $file->getSize();
                $totalSize += $size;
                
                if ($size > 500000) { // 500KB
                    $largeImages[] = [
                        'name' => $file->getFilename(),
                        'path' => $file->getRelativePath(),
                        'size' => $size,
                        'size_mb' => round($size / 1024 / 1024, 2)
                    ];
                }
            }
        }

        if (empty($largeImages)) {
            $this->info('✅ All images are optimized!');
            $this->info('Total images size: ' . round($totalSize / 1024 / 1024, 2) . ' MB');
            return 0;
        }

        $this->warn('Found ' . count($largeImages) . ' images that need optimization:');
        $this->newLine();

        foreach ($largeImages as $image) {
            $path = $image['path'] ? $image['path'] . '/' . $image['name'] : $image['name'];
            $this->line("  📷 {$path} - {$image['size_mb']} MB");
        }

        $this->newLine();
        $this->info('💡 Optimization Options:');
        $this->newLine();
        
        $this->line('1. Online Tools (Recommended):');
        $this->line('   • TinyPNG: https://tinypng.com/');
        $this->line('   • Squoosh: https://squoosh.app/');
        $this->newLine();
        
        $this->line('2. Desktop Tools:');
        $this->line('   • ImageOptim (Mac): https://imageoptim.com/');
        $this->line('   • RIOT (Windows): https://riot-optimizer.com/');
        $this->newLine();
        
        $this->line('3. Command Line (if installed):');
        $this->line('   • PNG: optipng -o7 image.png');
        $this->line('   • JPG: jpegoptim --max=85 image.jpg');
        $this->newLine();

        if ($this->confirm('Open TinyPNG in browser?', true)) {
            if (PHP_OS_FAMILY === 'Windows') {
                exec('start https://tinypng.com/');
            } elseif (PHP_OS_FAMILY === 'Darwin') {
                exec('open https://tinypng.com/');
            } else {
                exec('xdg-open https://tinypng.com/');
            }
            $this->info('✅ Opened TinyPNG in browser');
        }

        $this->newLine();
        $this->info('After optimizing, run: php artisan performance:check');

        return 0;
    }
}
