<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class PerformanceCheck extends Command
{
    protected $signature = 'performance:check';
    protected $description = 'Check application performance optimizations';

    public function handle()
    {
        $this->info('⚡ Checking Performance Optimizations...');
        $this->newLine();

        $score = 0;
        $maxScore = 10;

        // Check 1: Config cached
        if (File::exists(base_path('bootstrap/cache/config.php'))) {
            $this->info('✅ Config is cached');
            $score++;
        } else {
            $this->warn('⚠️  Config not cached. Run: php artisan config:cache');
        }

        // Check 2: Routes cached
        if (File::exists(base_path('bootstrap/cache/routes-v7.php'))) {
            $this->info('✅ Routes are cached');
            $score++;
        } else {
            $this->warn('⚠️  Routes not cached. Run: php artisan route:cache');
        }

        // Check 3: Views cached
        $viewsPath = storage_path('framework/views');
        if (File::exists($viewsPath) && count(File::files($viewsPath)) > 0) {
            $this->info('✅ Views are compiled');
            $score++;
        } else {
            $this->warn('⚠️  Views not compiled. Run: php artisan view:cache');
        }

        // Check 4: APP_DEBUG
        if (config('app.debug') === false) {
            $this->info('✅ Debug mode is disabled');
            $score++;
        } else {
            $this->warn('⚠️  Debug mode is enabled (slower in production)');
        }

        // Check 5: Cache driver
        $cacheDriver = config('cache.default');
        if (in_array($cacheDriver, ['redis', 'memcached', 'database'])) {
            $this->info("✅ Cache driver: {$cacheDriver}");
            $score++;
        } else {
            $this->warn("⚠️  Cache driver is '{$cacheDriver}'. Consider redis or database");
        }

        // Check 6: Session driver
        $sessionDriver = config('session.driver');
        if (in_array($sessionDriver, ['redis', 'database'])) {
            $this->info("✅ Session driver: {$sessionDriver}");
            $score++;
        } else {
            $this->warn("⚠️  Session driver is '{$sessionDriver}'. Consider database or redis");
        }

        // Check 7: Storage link
        if (File::exists(public_path('storage'))) {
            $this->info('✅ Storage link exists');
            $score++;
        } else {
            $this->warn('⚠️  Storage link missing. Run: php artisan storage:link');
        }

        // Check 8: .htaccess exists
        if (File::exists(public_path('.htaccess'))) {
            $this->info('✅ .htaccess file exists');
            $score++;
        } else {
            $this->warn('⚠️  .htaccess file missing');
        }

        // Check 9: Large image files
        $assetsPath = public_path('assets');
        $largeImages = 0;
        if (File::exists($assetsPath)) {
            $files = File::allFiles($assetsPath);
            foreach ($files as $file) {
                if (in_array($file->getExtension(), ['jpg', 'jpeg', 'png', 'gif'])) {
                    if ($file->getSize() > 500000) { // 500KB
                        $largeImages++;
                    }
                }
            }
        }
        
        if ($largeImages === 0) {
            $this->info('✅ No large unoptimized images found');
            $score++;
        } else {
            $this->warn("⚠️  Found {$largeImages} images over 500KB. Consider optimizing.");
        }

        // Check 10: OPcache (if available)
        if (function_exists('opcache_get_status')) {
            $opcache = opcache_get_status();
            if ($opcache && $opcache['opcache_enabled']) {
                $this->info('✅ OPcache is enabled');
                $score++;
            } else {
                $this->warn('⚠️  OPcache is disabled');
            }
        } else {
            $this->warn('⚠️  OPcache not available');
        }

        $this->newLine();
        
        // Calculate percentage
        $percentage = ($score / $maxScore) * 100;
        
        if ($percentage >= 80) {
            $this->info("🎉 Performance Score: {$score}/{$maxScore} ({$percentage}%) - Excellent!");
        } elseif ($percentage >= 60) {
            $this->warn("⚡ Performance Score: {$score}/{$maxScore} ({$percentage}%) - Good, but can improve");
        } else {
            $this->error("⚠️  Performance Score: {$score}/{$maxScore} ({$percentage}%) - Needs optimization");
        }

        $this->newLine();
        $this->info('💡 Quick optimization: php artisan optimize');

        return 0;
    }
}
