<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SecurityCheck extends Command
{
    protected $signature = 'security:check';
    protected $description = 'Run security checks on the application';

    public function handle()
    {
        $this->info('🔒 Running Security Checks...');
        $this->newLine();

        $issues = 0;

        // Check 1: APP_DEBUG
        if (config('app.debug') === true && config('app.env') === 'production') {
            $this->error('❌ APP_DEBUG is enabled in production!');
            $issues++;
        } else {
            $this->info('✅ APP_DEBUG is properly configured');
        }

        // Check 2: APP_KEY
        if (empty(config('app.key'))) {
            $this->error('❌ APP_KEY is not set!');
            $issues++;
        } else {
            $this->info('✅ APP_KEY is set');
        }

        // Check 3: Admin IP Whitelist
        $allowedIPs = config('admin.allowed_ips', []);
        if (empty($allowedIPs) && config('app.env') === 'production') {
            $this->warn('⚠️  Admin IP whitelist is empty in production!');
            $issues++;
        } else {
            $this->info('✅ Admin IP whitelist configured: ' . count($allowedIPs) . ' IPs');
        }

        // Check 4: HTTPS
        if (config('app.env') === 'production' && !config('session.secure')) {
            $this->warn('⚠️  Secure cookies not enabled for production!');
            $issues++;
        } else {
            $this->info('✅ Session security configured');
        }

        // Check 5: File Permissions
        $storageWritable = is_writable(storage_path());
        if (!$storageWritable) {
            $this->error('❌ Storage directory is not writable!');
            $issues++;
        } else {
            $this->info('✅ Storage directory is writable');
        }

        // Check 6: .env file
        if (!file_exists(base_path('.env'))) {
            $this->error('❌ .env file not found!');
            $issues++;
        } else {
            $this->info('✅ .env file exists');
        }

        // Check 7: Database connection
        try {
            \DB::connection()->getPdo();
            $this->info('✅ Database connection successful');
        } catch (\Exception $e) {
            $this->error('❌ Database connection failed!');
            $issues++;
        }

        $this->newLine();
        
        if ($issues === 0) {
            $this->info('🎉 All security checks passed!');
            return 0;
        } else {
            $this->error("⚠️  Found {$issues} security issue(s). Please review and fix.");
            return 1;
        }
    }
}
