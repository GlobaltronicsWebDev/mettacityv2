# Fix Hostinger Synchronization - Step by Step

## Problem
Your changes sync to GitHub but not to Hostinger website.

## Solution: Use SSH to Pull Changes Manually

### Step 1: Login to Hostinger SSH
1. Go to Hostinger control panel
2. Click on "Advanced" → "SSH Access"
3. Copy your SSH credentials
4. Use PuTTY or terminal to connect

### Step 2: Navigate to Your Project
```bash
cd domains/mettacity.com.ph/public_html/mettacityv2
```

### Step 3: Pull Latest Changes from GitHub
```bash
git pull origin main
```

### Step 4: Clear All Laravel Caches
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear
```

### Step 5: Rebuild Caches (Optional but Recommended)
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### Step 6: Check Your Website
Visit https://mettacity.com.ph - your changes should now appear!

---

## Alternative: Fix the Webhook (One-Time Setup)

If you want automatic sync, you need to upload the fixed `deploy.php` file:

### Via File Manager:
1. Login to Hostinger control panel
2. Go to "Files" → "File Manager"
3. Navigate to `public_html` folder
4. Upload the `deploy.php` file from your project
5. Replace the existing one

### Via FTP:
1. Use FileZilla or any FTP client
2. Connect to your Hostinger FTP
3. Navigate to `public_html` folder
4. Upload `deploy.php` from your local project
5. Replace the existing file

### Test the Webhook:
After uploading, push a change to GitHub and check if it auto-deploys.

---

## Quick Reference: SSH Commands

**Pull changes + clear cache (copy-paste this):**
```bash
cd domains/mettacity.com.ph/public_html/mettacityv2 && git pull origin main && php artisan config:clear && php artisan cache:clear && php artisan view:clear && echo "✓ Deployment complete!"
```

**Check current Git status:**
```bash
cd domains/mettacity.com.ph/public_html/mettacityv2 && git status
```

**View last 20 lines of deploy log:**
```bash
tail -20 ~/domains/mettacity.com.ph/public_html/deploy.log
```

---

## Why This Happens

1. **Webhook not configured** - deploy.php needs to be uploaded to Hostinger
2. **Wrong repository path** - Fixed in the new deploy.php
3. **Laravel cache** - Even after pulling, Laravel caches old files
4. **Browser cache** - Your browser might show old CSS (press Ctrl+Shift+Delete)

---

## Recommended Workflow

**For now (until webhook is fixed):**
1. Edit files in your IDE
2. Run `sync-to-hostinger.bat` to push to GitHub
3. Login to Hostinger SSH
4. Run: `cd domains/mettacity.com.ph/public_html/mettacityv2 && git pull origin main && php artisan cache:clear`
5. Refresh your website

**After webhook is fixed:**
1. Edit files in your IDE
2. Run `sync-to-hostinger.bat` to push to GitHub
3. Wait 5-10 seconds
4. Refresh your website (changes auto-deploy!)
