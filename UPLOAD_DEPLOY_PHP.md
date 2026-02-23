# How to Upload deploy.php to Hostinger

## Method 1: Using Hostinger File Manager (Easiest)

### Step 1: Login to Hostinger
1. Go to https://hpanel.hostinger.com
2. Login with your credentials
3. Select your website (mettacity.com.ph)

### Step 2: Open File Manager
1. Click on "Files" in the left sidebar
2. Click "File Manager"
3. A new tab will open with your files

### Step 3: Navigate to public_html
1. You should see folders like: `mettacityv2`, `cgi-bin`, etc.
2. Stay in the `public_html` folder (don't go inside mettacityv2)

### Step 4: Upload deploy.php
1. Click the "Upload Files" button (top right)
2. Select `deploy.php` from your project folder: `C:\Users\mestoesta\Desktop\METTACITY MAIN\mettacityv2\deploy.php`
3. Wait for upload to complete
4. If there's an existing `deploy.php`, replace it

### Step 5: Verify Upload
1. You should see `deploy.php` in the file list
2. Right-click on it → "Edit" to verify the content
3. Check that it has the correct path: `/home/u553953718/domains/mettacity.com.ph/public_html/mettacityv2`

### Step 6: Test the Webhook
1. Make a small change in your IDE (like add a comment in a CSS file)
2. Run `sync-to-hostinger.bat`
3. Wait 10 seconds
4. Check if changes appear on https://mettacity.com.ph

---

## Method 2: Using FTP (Alternative)

### Step 1: Get FTP Credentials
1. In Hostinger panel, go to "Files" → "FTP Accounts"
2. Copy your FTP credentials:
   - Host: ftp.mettacity.com.ph
   - Username: (your FTP username)
   - Password: (your FTP password)
   - Port: 21

### Step 2: Connect with FileZilla
1. Download FileZilla if you don't have it
2. Open FileZilla
3. Enter FTP credentials at the top
4. Click "Quickconnect"

### Step 3: Upload File
1. On the left side: Navigate to your local project folder
2. On the right side: You should see `public_html` folder
3. Drag `deploy.php` from left to right into `public_html`
4. Replace if asked

---

## Method 3: Using SSH (Advanced)

### Step 1: Login to SSH
```bash
ssh u553953718@mettacity.com.ph
```

### Step 2: Navigate to public_html
```bash
cd domains/mettacity.com.ph/public_html
```

### Step 3: Create/Edit deploy.php
```bash
nano deploy.php
```

### Step 4: Copy Content
1. Open `deploy.php` from your local project
2. Copy all the content (Ctrl+A, Ctrl+C)
3. Paste into nano (Right-click in PuTTY)
4. Save: Ctrl+X, then Y, then Enter

---

## Verify Webhook is Working

### Check 1: View deploy.log
After pushing changes, check the log:
```bash
cat ~/domains/mettacity.com.ph/public_html/deploy.log
```

You should see entries like:
```
[2026-02-23 14:30:15] === Deployment Started ===
[2026-02-23 14:30:15] Branch: refs/heads/main
[2026-02-23 14:30:16] ✓ Git pull successful
[2026-02-23 14:30:17] === Deployment Completed Successfully ===
```

### Check 2: GitHub Webhook Deliveries
1. Go to: https://github.com/GlobaltronicsWebDev/mettacityv2/settings/hooks
2. Click on your webhook
3. Click "Recent Deliveries" tab
4. You should see successful deliveries (green checkmark)

---

## Troubleshooting

**404 Not Found when accessing deploy.php:**
- File is not uploaded to `public_html` folder
- Upload it using Method 1 or 2 above

**Webhook not triggering:**
- Check GitHub webhook settings
- Make sure Secret matches: `mettacity2026webhook7d9b5163b3cd92044be1ae169dc91534`
- Check Recent Deliveries for errors

**Changes still not appearing:**
- Clear browser cache (Ctrl+Shift+Delete)
- Clear Laravel cache via SSH:
  ```bash
  cd domains/mettacity.com.ph/public_html/mettacityv2
  php artisan cache:clear
  php artisan view:clear
  ```
