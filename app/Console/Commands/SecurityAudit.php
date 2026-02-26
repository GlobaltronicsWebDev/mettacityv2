<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class SecurityAudit extends Command
{
    protected $signature = 'security:audit';
    protected $description = 'Run automated security audit checks';

    public function handle()
    {
        $this->info('🔒 Running Security Audit...');
        $this->newLine();
        
        $issues = [];
        
        // Check 1: Environment Configuration
        $this->info('Checking environment configuration...');
        if (config('app.debug') === true) {
            $issues[] = '⚠️  APP_DEBUG is enabled - should be false in production';
        }
        if (config('app.env') !== 'production') {
            $issues[] = '⚠️  APP_ENV is not set to production';
        }
        
        // Check 2: File Permissions
        $this->info('Checking file permissions...');
        $storagePerms = substr(sprintf('%o', fileperms(storage_path())), -4);
        if ($storagePerms !== '0755' && $storagePerms !== '0775') {
            $issues[] = "⚠️  Storage directory has insecure permissions: {$storagePerms}";
        }
        
        // Check 3: Outdated Dependencies
        $this->info('Checking for outdated dependencies...');
        if (File::exists(base_path('composer.lock'))) {
            $lockAge = now()->diffInDays(File::lastModified(base_path('composer.lock')));
            if ($lockAge > 30) {
                $issues[] = "⚠️  Dependencies not updated in {$lockAge} days - run 'composer update'";
            }
        }
        
        // Check 4: Session Security
        $this->info('Checking session security...');
        if (!config('session.http_only')) {
            $issues[] = '⚠️  SESSION_HTTP_ONLY should be true';
        }
        if (!config('session.encrypt')) {
            $issues[] = '⚠️  SESSION_ENCRYPT should be true';
        }
        
        // Check 5: Database Security
        $this->info('Checking database security...');
        try {
            $users = DB::table('users')->where('password', 'LIKE', '%password%')->count();
            if ($users > 0) {
                $issues[] = "⚠️  Found {$users} users with weak passwords";
            }
        } catch (\Exception $e) {
            // Skip if table doesn't exist
        }
        
        // Check 6: Admin IP Whitelist
        $this->info('Checking admin IP whitelist...');
        $allowedIPs = config('admin.allowed_ips', []);
        if (empty($allowedIPs)) {
            $issues[] = '⚠️  No IP whitelist configured for admin access';
        }
        
        // Check 7: HTTPS Configuration
        $this->info('Checking HTTPS configuration...');
        if (!config('session.secure')) {
            $issues[] = '⚠️  SESSION_SECURE_COOKIE should be true for HTTPS';
        }
        
        // Check 8: Failed Login Attempts
        $this->info('Checking for suspicious activity...');
        $recentFailedLogins = DB::table('sessions')
            ->where('last_activity', '>', now()->subHours(24)->timestamp)
            ->count();
        if ($recentFailedLogins > 100) {
            $issues[] = "⚠️  High number of sessions in last 24h: {$recentFailedLogins} - possible attack";
        }
        
        $this->newLine();
        
        // Report Results
        if (empty($issues)) {
            $this->info('✅ All security checks passed!');
        } else {
            $this->error('❌ Security issues found:');
            $this->newLine();
            foreach ($issues as $issue) {
                $this->line($issue);
            }
            $this->newLine();
            $this->warn('Please address these issues immediately.');
        }
        
        // Log audit
        \Log::info('Security audit completed', [
            'issues_found' => count($issues),
            'issues' => $issues,
        ]);
        
        return empty($issues) ? 0 : 1;
    }
}
