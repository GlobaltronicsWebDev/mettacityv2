<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MonitorSuspiciousActivity extends Command
{
    protected $signature = 'security:monitor';
    protected $description = 'Monitor logs for suspicious activity';

    public function handle()
    {
        $this->info('🔍 Monitoring for suspicious activity...');
        $this->newLine();
        
        $alerts = [];
        $logFile = storage_path('logs/laravel.log');
        
        if (!File::exists($logFile)) {
            $this->warn('No log file found.');
            return 0;
        }
        
        // Read last 1000 lines of log
        $lines = $this->tail($logFile, 1000);
        
        // Pattern matching for suspicious activity
        $patterns = [
            'SQL injection' => '/union.*select|drop.*table|exec.*xp_/i',
            'XSS attempts' => '/<script|javascript:|onerror=/i',
            'Path traversal' => '/\.\.\/|\.\.\\\/i',
            'Unauthorized access' => '/Unauthorized|403|Access denied/i',
            'Failed logins' => '/Failed login|Authentication failed/i',
            'Exception errors' => '/Exception|Error|Fatal/i',
        ];
        
        foreach ($patterns as $type => $pattern) {
            $matches = preg_grep($pattern, $lines);
            $count = count($matches);
            
            if ($count > 0) {
                $alerts[] = [
                    'type' => $type,
                    'count' => $count,
                    'severity' => $this->getSeverity($type, $count),
                ];
            }
        }
        
        // Report findings
        if (empty($alerts)) {
            $this->info('✅ No suspicious activity detected.');
        } else {
            $this->error('⚠️  Suspicious activity detected:');
            $this->newLine();
            
            foreach ($alerts as $alert) {
                $icon = $alert['severity'] === 'high' ? '🔴' : '🟡';
                $this->line("{$icon} {$alert['type']}: {$alert['count']} occurrences");
            }
            
            $this->newLine();
            $this->warn('Review logs at: ' . $logFile);
            
            // Send alert notification
            \Log::warning('Suspicious activity detected', ['alerts' => $alerts]);
        }
        
        return 0;
    }
    
    private function tail($file, $lines = 1000)
    {
        $handle = fopen($file, 'r');
        $buffer = 4096;
        $output = '';
        $chunk = '';
        
        fseek($handle, -1, SEEK_END);
        
        if (fread($handle, 1) != "\n") {
            $lines -= 1;
        }
        
        $output = '';
        while (ftell($handle) > 0 && $lines >= 0) {
            $seek = min(ftell($handle), $buffer);
            fseek($handle, -$seek, SEEK_CUR);
            $chunk = fread($handle, $seek);
            $output = $chunk . $output;
            fseek($handle, -mb_strlen($chunk, '8bit'), SEEK_CUR);
            $lines -= substr_count($chunk, "\n");
        }
        
        fclose($handle);
        
        return explode("\n", $output);
    }
    
    private function getSeverity($type, $count)
    {
        $highRisk = ['SQL injection', 'XSS attempts', 'Path traversal'];
        
        if (in_array($type, $highRisk) && $count > 5) {
            return 'high';
        }
        
        if ($count > 50) {
            return 'high';
        }
        
        return 'medium';
    }
}
