# Hostinger Laravel Deployment Guide

## Overview

This guide shows how to deploy your Laravel website on Hostinger while keeping your public folder structure intact.

## Hostinger Folder Structure

Typical Hostinger structure:
```
/home/u123456789/
├── domains/
│   └── yourdomain.com/
│       └── public_html/  ← This is your web root
├── your-laravel-app/     ← Upload Laravel here
│   ├── app/
│   ├── bootstrap/
│   ├── config/
│   ├── database/
│   ├── public/           ← Your assets folder
│   ├── resources/
│   ├── routes/
│   ├── storage/
│   └── vendor/
```

## Method 1: Symlink Method (Recommended - Keeps Everything Clean)

### Step 1: Upload Your Laravel Project

1. Upload your entire Laravel project to `/home/u123456789/your-laravel-app/`
2. **DO NOT** upload to `public_html` directly

### Step 2: Create .htaccess in public_html

Create `/home/u123456789/domains/yourdomain.com/public_html/.htaccess`:

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(.*)$ /home/u123456789/your-laravel-app/public/$1 [L]
</IfModule>
```

### Step 3: Create index.php in public_html

Create `/home/u123456789/domains/yourdomain.com/public_html/index.php`:

```php
<?php

// Define path to Laravel public folder
define('LARAVEL_PUBLIC', '/home/u123456789/your-laravel-app/public');

// Forward to Laravel's index.php
require LARAVEL_PUBLIC . '/index.php';
```

### Step 4: Set Permissions

```bash
chmod -R 755 /home/u123456789/your-laravel-app
chmod -R 775 /home/u123456789/your-laravel-app/storage
chmod -R 775 /home/u123456789/your-laravel-app/bootstrap/cache
```

---

## Method 2: Copy Public Contents (Your Current Need)

This method keeps your public folder intact and just points Laravel to it.

### Step 1: Upload Laravel Project Structure

Upload everything EXCEPT the public folder to a directory outside public_html:

```
/home/u123456789/mettacity/
├── app/
├── bootstrap/
├── config/
├── database/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env
└── artisan
```

### Step 2: Upload Public Folder Contents to public_html

Upload ONLY the contents of your `public` folder to `public_html`:

```
/home/u123456789/domains/yourdomain.com/public_html/
├── assets/              ← Your images folder
├── cssfolder/           ← Your CSS files
├── jsfolder/            ← Your JS files
├── storage/             ← Symlink (create later)
├── .htaccess            ← Laravel's htaccess
├── index.php            ← Laravel's index (needs modification)
├── favicon.ico
└── robots.txt
```

### Step 3: Modify index.php in public_html

Edit `/home/u123456789/domains/yourdomain.com/public_html/index.php`:

**Original:**
```php
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
```

**Change to:**
```php
require __DIR__.'/../../mettacity/vendor/autoload.php';
$app = require_once __DIR__.'/../../mettacity/bootstrap/app.php';
```

### Step 4: Update .htaccess (if needed)

Your existing `.htaccess` in public_html should work, but verify it has:

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

### Step 5: Create Storage Symlink

SSH into your server or use File Manager:

```bash
cd /home/u123456789/domains/yourdomain.com/public_html
ln -s /home/u123456789/mettacity/storage/app/public storage
```

Or create manually in File Manager:
- Create a symlink named `storage` 
- Point it to `/home/u123456789/mettacity/storage/app/public`

---

## Method 3: Subdirectory Installation

If you want Laravel in a subdirectory like `yourdomain.com/app`:

### Upload Structure:
```
public_html/
├── app/                 ← Laravel public folder contents here
│   ├── assets/
│   ├── cssfolder/
│   ├── index.php       ← Modified
│   └── .htaccess
├── other-files/         ← Your other website files
└── index.html           ← Your main site
```

### Modify app/index.php:
```php
require __DIR__.'/../../mettacity/vendor/autoload.php';
$app = require_once __DIR__.'/../../mettacity/bootstrap/app.php';
```

---

## Configuration Steps (All Methods)

### 1. Update .env File

```env
APP_NAME=Mettacity
APP_ENV=production
APP_KEY=base64:your-key-here
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=u123456789_mettacity
DB_USERNAME=u123456789_user
DB_PASSWORD=your-database-password

# Hostinger timezone
APP_TIMEZONE=Asia/Manila

# Admin IP Whitelist (add your IPs)
ADMIN_ALLOWED_IPS=127.0.0.1,your-office-ip,your-home-ip
```

### 2. Set Permissions

```bash
chmod -R 755 /home/u123456789/mettacity
chmod -R 775 /home/u123456789/mettacity/storage
chmod -R 775 /home/u123456789/mettacity/bootstrap/cache
```

### 3. Run Artisan Commands (via SSH)

```bash
cd /home/u123456789/mettacity

# Clear caches
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# Optimize for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Run migrations
php artisan migrate --force

# Seed admin accounts
php artisan db:seed --class=SuperAdminSeeder
php artisan db:seed --class=AdminUserSeeder

# Create storage link (if not done manually)
php artisan storage:link
```

### 4. Import Database

**Option A: Via phpMyAdmin**
1. Login to Hostinger phpMyAdmin
2. Create database: `u123456789_mettacity`
3. Import `mettacity_database.sql`

**Option B: Via SSH**
```bash
mysql -u u123456789_user -p u123456789_mettacity < mettacity_database.sql
```

---

## Troubleshooting

### Issue: 500 Internal Server Error

**Solution:**
1. Check `.env` file exists and has correct values
2. Run `php artisan config:clear`
3. Check file permissions (755 for folders, 644 for files)
4. Check error logs in Hostinger control panel

### Issue: Assets not loading (CSS, JS, Images)

**Solution:**
1. Verify paths in your views use `asset()` helper
2. Check `.htaccess` is in public_html
3. Verify `APP_URL` in `.env` matches your domain
4. Clear browser cache

### Issue: Storage images not showing

**Solution:**
1. Create storage symlink: `php artisan storage:link`
2. Or manually create symlink in public_html pointing to storage/app/public
3. Check permissions: `chmod -R 775 storage`

### Issue: Admin panel not accessible

**Solution:**
1. Check IP whitelist in `.env`
2. Add your current IP to `ADMIN_ALLOWED_IPS`
3. Or temporarily disable IP restriction for testing

### Issue: Database connection error

**Solution:**
1. Verify database credentials in `.env`
2. Check database exists in Hostinger panel
3. Ensure database user has permissions
4. Use `localhost` as DB_HOST (not 127.0.0.1)

---

## Security Checklist

- [ ] Set `APP_DEBUG=false` in production
- [ ] Set `APP_ENV=production`
- [ ] Generate new `APP_KEY`: `php artisan key:generate`
- [ ] Configure IP whitelist for admin panel
- [ ] Set proper file permissions (755/644)
- [ ] Enable HTTPS/SSL certificate
- [ ] Keep `.env` file outside public_html
- [ ] Remove `database_setup.sql` from public access
- [ ] Change default admin passwords

---

## Performance Optimization

```bash
# Cache everything
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Enable OPcache (ask Hostinger support)
# Add to php.ini or .user.ini:
opcache.enable=1
opcache.memory_consumption=128
opcache.max_accelerated_files=10000
opcache.revalidate_freq=60
```

---

## Quick Deployment Checklist

1. [ ] Upload Laravel files (except public) to `/home/u123456789/mettacity/`
2. [ ] Upload public folder contents to `public_html/`
3. [ ] Modify `public_html/index.php` paths
4. [ ] Upload `.env` file with production settings
5. [ ] Create database in Hostinger panel
6. [ ] Import `mettacity_database.sql`
7. [ ] Set file permissions (755/775)
8. [ ] Create storage symlink
9. [ ] Run artisan commands (cache, migrate, seed)
10. [ ] Test website and admin panel
11. [ ] Configure SSL certificate
12. [ ] Update DNS if needed

---

## Support

If you encounter issues:
1. Check Hostinger error logs
2. Enable debug temporarily: `APP_DEBUG=true`
3. Check Laravel logs: `storage/logs/laravel.log`
4. Contact Hostinger support for server-specific issues

---

## Recommended: Use Git for Deployment

For future updates:

```bash
# On your local machine
git init
git add .
git commit -m "Initial commit"
git push origin main

# On Hostinger (via SSH)
cd /home/u123456789/mettacity
git pull origin main
php artisan migrate --force
php artisan config:cache
```

This makes updates much easier!
