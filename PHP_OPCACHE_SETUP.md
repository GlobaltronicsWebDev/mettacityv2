# PHP OPcache Setup Guide

## What is OPcache?

OPcache improves PHP performance by storing precompiled script bytecode in memory, eliminating the need for PHP to load and parse scripts on each request.

**Performance Improvement**: 2-3x faster PHP execution!

## Enable OPcache

### Windows (XAMPP/WAMP)

1. **Find php.ini file:**
   - XAMPP: `C:\xampp\php\php.ini`
   - WAMP: `C:\wamp64\bin\php\php8.x\php.ini`

2. **Edit php.ini:**
   ```ini
   [opcache]
   ; Enable OPcache
   zend_extension=opcache
   opcache.enable=1
   opcache.enable_cli=1
   
   ; Memory settings
   opcache.memory_consumption=128
   opcache.interned_strings_buffer=8
   opcache.max_accelerated_files=10000
   
   ; Revalidation
   opcache.revalidate_freq=2
   opcache.validate_timestamps=1
   
   ; Performance
   opcache.fast_shutdown=1
   opcache.enable_file_override=1
   
   ; Development (set to 0 in production)
   opcache.revalidate_freq=0
   ```

3. **Restart Apache/Nginx:**
   - XAMPP: Stop and start Apache
   - WAMP: Restart services

### Linux (Ubuntu/Debian)

1. **Install OPcache:**
   ```bash
   sudo apt-get update
   sudo apt-get install php-opcache
   ```

2. **Edit configuration:**
   ```bash
   sudo nano /etc/php/8.2/apache2/conf.d/10-opcache.ini
   ```

3. **Add configuration:**
   ```ini
   [opcache]
   opcache.enable=1
   opcache.enable_cli=1
   opcache.memory_consumption=128
   opcache.interned_strings_buffer=8
   opcache.max_accelerated_files=10000
   opcache.revalidate_freq=2
   opcache.validate_timestamps=1
   opcache.fast_shutdown=1
   ```

4. **Restart web server:**
   ```bash
   sudo systemctl restart apache2
   # or
   sudo systemctl restart nginx
   sudo systemctl restart php8.2-fpm
   ```

### macOS (Homebrew)

1. **Install OPcache:**
   ```bash
   brew install php
   ```

2. **Edit php.ini:**
   ```bash
   nano /usr/local/etc/php/8.2/php.ini
   ```

3. **Add OPcache settings** (same as above)

4. **Restart PHP-FPM:**
   ```bash
   brew services restart php
   ```

## Verify OPcache is Enabled

### Method 1: Command Line
```bash
php -i | grep opcache
```

Should show:
```
opcache.enable => On => On
```

### Method 2: Create PHP Info File

1. Create `public/phpinfo.php`:
   ```php
   <?php
   phpinfo();
   ```

2. Visit: `http://localhost/phpinfo.php`

3. Search for "opcache" - should show enabled

4. **Delete the file after checking!** (security risk)

### Method 3: Laravel Command
```bash
php artisan performance:check
```

Should show: ✅ OPcache is enabled

## OPcache Settings Explained

```ini
; Enable OPcache
opcache.enable=1                          # Enable for web requests
opcache.enable_cli=1                      # Enable for CLI (artisan commands)

; Memory
opcache.memory_consumption=128            # Memory for OPcache (MB)
opcache.interned_strings_buffer=8         # Memory for strings (MB)
opcache.max_accelerated_files=10000       # Max cached files

; Revalidation
opcache.revalidate_freq=2                 # Check for changes every 2 seconds
opcache.validate_timestamps=1             # Check if files changed

; Performance
opcache.fast_shutdown=1                   # Faster shutdown
opcache.enable_file_override=1            # Optimize file_exists() calls
```

## Production vs Development

### Development Settings
```ini
; Check files frequently for changes
opcache.revalidate_freq=0
opcache.validate_timestamps=1
```

### Production Settings
```ini
; Don't check files (better performance)
opcache.revalidate_freq=60
opcache.validate_timestamps=0
```

## Clear OPcache

### Method 1: Restart Web Server
```bash
# Apache
sudo systemctl restart apache2

# Nginx + PHP-FPM
sudo systemctl restart php8.2-fpm
```

### Method 2: PHP Function
```php
opcache_reset();
```

### Method 3: Laravel Command
```bash
php artisan optimize:clear
```

## Troubleshooting

### OPcache Not Working?

1. **Check if installed:**
   ```bash
   php -m | grep opcache
   ```

2. **Check php.ini location:**
   ```bash
   php --ini
   ```

3. **Verify settings:**
   ```bash
   php -i | grep opcache
   ```

4. **Restart web server**

### Code Changes Not Reflecting?

1. **Clear OPcache:**
   ```bash
   sudo systemctl restart apache2
   ```

2. **Or disable in development:**
   ```ini
   opcache.enable=0
   ```

## Performance Impact

### Before OPcache:
- Request time: 100-200ms
- Memory usage: Higher
- CPU usage: Higher

### After OPcache:
- Request time: 30-50ms ⚡ (2-3x faster)
- Memory usage: Lower
- CPU usage: Lower

## Monitoring OPcache

### Check OPcache Status

Create `opcache-status.php`:
```php
<?php
$status = opcache_get_status();
echo "OPcache Enabled: " . ($status['opcache_enabled'] ? 'Yes' : 'No') . "\n";
echo "Cache Full: " . ($status['cache_full'] ? 'Yes' : 'No') . "\n";
echo "Cached Scripts: " . $status['opcache_statistics']['num_cached_scripts'] . "\n";
echo "Memory Used: " . round($status['memory_usage']['used_memory'] / 1024 / 1024, 2) . " MB\n";
echo "Hit Rate: " . round($status['opcache_statistics']['opcache_hit_rate'], 2) . "%\n";
```

Run:
```bash
php opcache-status.php
```

## Quick Setup (Copy-Paste)

### For XAMPP (Windows)

1. Open: `C:\xampp\php\php.ini`
2. Find `;zend_extension=opcache` and remove `;`
3. Add at the end:
   ```ini
   opcache.enable=1
   opcache.memory_consumption=128
   opcache.max_accelerated_files=10000
   ```
4. Restart Apache from XAMPP Control Panel

### For Linux Production

```bash
# Install
sudo apt-get install php-opcache

# Configure
echo "opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.revalidate_freq=60" | sudo tee /etc/php/8.2/apache2/conf.d/99-opcache.ini

# Restart
sudo systemctl restart apache2
```

## Verify Perfect Score

After enabling OPcache:

```bash
php artisan performance:check
```

Should show:
```
✅ OPcache is enabled
🎉 Performance Score: 10/10 (100%) - Excellent!
```

---

**Note**: OPcache is included in PHP 5.5+ by default, just needs to be enabled!
