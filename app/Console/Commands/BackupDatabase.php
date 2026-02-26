<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class BackupDatabase extends Command
{
    protected $signature = 'db:backup {--keep=7 : Number of days to keep backups}';
    protected $description = 'Backup the database';

    public function handle()
    {
        $this->info('📦 Starting database backup...');
        
        $dbConnection = config('database.default');
        $dbConfig = config("database.connections.{$dbConnection}");
        
        $backupPath = storage_path('backups');
        
        // Create backups directory if it doesn't exist
        if (!File::exists($backupPath)) {
            File::makeDirectory($backupPath, 0755, true);
        }
        
        $timestamp = now()->format('Y-m-d_His');
        $filename = "backup_{$timestamp}.sql";
        $filepath = "{$backupPath}/{$filename}";
        
        try {
            if ($dbConfig['driver'] === 'mysql') {
                $this->backupMySQL($dbConfig, $filepath);
            } elseif ($dbConfig['driver'] === 'sqlite') {
                $this->backupSQLite($dbConfig, $filepath);
            } else {
                $this->error('Unsupported database driver: ' . $dbConfig['driver']);
                return 1;
            }
            
            $size = File::size($filepath);
            $sizeInMB = round($size / 1024 / 1024, 2);
            
            $this->info("✅ Backup created successfully!");
            $this->line("   File: {$filename}");
            $this->line("   Size: {$sizeInMB} MB");
            $this->line("   Path: {$filepath}");
            
            // Clean old backups
            $this->cleanOldBackups($backupPath, $this->option('keep'));
            
            // Log backup
            \Log::info('Database backup created', [
                'filename' => $filename,
                'size' => $sizeInMB . ' MB',
            ]);
            
            return 0;
            
        } catch (\Exception $e) {
            $this->error('❌ Backup failed: ' . $e->getMessage());
            \Log::error('Database backup failed', ['error' => $e->getMessage()]);
            return 1;
        }
    }
    
    private function backupMySQL($config, $filepath)
    {
        $host = $config['host'];
        $port = $config['port'];
        $database = $config['database'];
        $username = $config['username'];
        $password = $config['password'];
        
        $command = sprintf(
            'mysqldump -h%s -P%s -u%s -p%s %s > %s',
            escapeshellarg($host),
            escapeshellarg($port),
            escapeshellarg($username),
            escapeshellarg($password),
            escapeshellarg($database),
            escapeshellarg($filepath)
        );
        
        exec($command, $output, $returnCode);
        
        if ($returnCode !== 0) {
            throw new \Exception('mysqldump command failed');
        }
    }
    
    private function backupSQLite($config, $filepath)
    {
        $dbPath = $config['database'];
        
        if (!File::exists($dbPath)) {
            throw new \Exception('SQLite database file not found');
        }
        
        // For SQLite, just copy the file
        File::copy($dbPath, $filepath);
    }
    
    private function cleanOldBackups($backupPath, $keepDays)
    {
        $this->info("🧹 Cleaning backups older than {$keepDays} days...");
        
        $files = File::files($backupPath);
        $deleted = 0;
        
        foreach ($files as $file) {
            $fileAge = now()->diffInDays(File::lastModified($file));
            
            if ($fileAge > $keepDays) {
                File::delete($file);
                $deleted++;
            }
        }
        
        if ($deleted > 0) {
            $this->line("   Deleted {$deleted} old backup(s)");
        }
    }
}
