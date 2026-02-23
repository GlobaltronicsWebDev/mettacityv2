# GitHub Webhook Auto-Deployment Setup

## Overview

This setup allows your Hostinger website to automatically update when you push code to GitHub.

## Step 1: Prepare Your Repository

### 1.1 Initialize Git (if not done)

```bash
git init
git add .
git commit -m "Initial commit"
```

### 1.2 Create GitHub Repository

1. Go to https://github.com/new
2. Create a new repository (e.g., `mettacity`)
3. Don't initialize with README (you already have code)

### 1.3 Push to GitHub

```bash
git remote add origin https://github.com/yourusername/mettacity.git
git branch -M main
git push -u origin main
```

---

## Step 2: Setup SSH Key on Hostinger

### 2.1 Generate SSH Key (via Hostinger SSH)

```bash
ssh-keygen -t ed25519 -C "your-email@example.com"
# Press Enter for all prompts (use default location)

# Display the public key
cat ~/.ssh/id_ed25519.pub
```

### 2.2 Add SSH Key to GitHub

1. Copy the SSH key output
2. Go to GitHub → Settings → SSH and GPG keys
3. Click "New SSH key"
4. Paste the key and save

### 2.3 Test SSH Connection

```bash
ssh -T git@github.com
# Should see: "Hi username! You've successfully authenticated"
```

### 2.4 Clone Repository on Hostinger

```bash
cd /home/u123456789/
git clone git@github.com:yourusername/mettacity.git
```

---

## Step 3: Setup Deployment Script

### 3.1 Upload deploy.php

Upload `deploy.php` to your `public_html` folder:

```
/home/u123456789/domains/yourdomain.com/public_html/deploy.php
```

### 3.2 Configure deploy.php

Edit the configuration in `deploy.php`:

```php
define('SECRET_TOKEN', 'your-random-secret-token-123456'); // Generate a random string
define('REPO_PATH', '/home/u123456789/mettacity');
define('BRANCH', 'main'); // or 'master'
```

**Generate a secure token:**
```bash
openssl rand -hex 32
```

### 3.3 Set Permissions

```bash
chmod 755 /home/u123456789/domains/yourdomain.com/public_html/deploy.php
chmod 755 /home/u123456789/mettacity
```

---

## Step 4: Configure GitHub Webhook

### 4.1 Add Webhook to GitHub

1. Go to your GitHub repository
2. Click **Settings** → **Webhooks** → **Add webhook**

### 4.2 Webhook Settings

- **Payload URL:** `https://yourdomain.com/deploy.php`
- **Content type:** `application/json`
- **Secret:** Your SECRET_TOKEN from deploy.php
- **Which events:** Select "Just the push event"
- **Active:** ✓ Check this box
- Click **Add webhook**

### 4.3 Test Webhook

1. GitHub will send a test ping
2. Check if it shows a green checkmark ✓
3. If red ✗, check the error message

---

## Step 5: Test Auto-Deployment

### 5.1 Make a Test Change

On your local machine:

```bash
# Make a small change (e.g., edit a comment in a file)
echo "// Test deployment" >> routes/web.php

# Commit and push
git add .
git commit -m "Test auto-deployment"
git push origin main
```

### 5.2 Check Deployment Log

Visit: `https://yourdomain.com/deploy.log`

You should see:
```
[2026-02-23 10:30:45] === Deployment Started ===
[2026-02-23 10:30:45] Branch: refs/heads/main
[2026-02-23 10:30:45] Pusher: yourusername
[2026-02-23 10:30:46] Git Pull Output:
[2026-02-23 10:30:46]   Updating abc1234..def5678
[2026-02-23 10:30:46] ✓ Git pull successful
[2026-02-23 10:30:47] Running: php artisan config:clear
[2026-02-23 10:30:47]   ✓ Success
[2026-02-23 10:30:48] === Deployment Completed Successfully ===
```

---

## Step 6: Workflow for Development

### 6.1 Local Development

```bash
# Make changes to your code
# Test locally: php artisan serve

# When ready to deploy:
git add .
git commit -m "Description of changes"
git push origin main
```

### 6.2 Automatic Deployment

- GitHub receives your push
- Webhook triggers deploy.php on Hostinger
- Server pulls latest code
- Laravel caches are cleared and rebuilt
- Website is updated automatically!

### 6.3 Check Deployment Status

- View logs: `https://yourdomain.com/deploy.log`
- Check GitHub webhook deliveries: Repository → Settings → Webhooks → Recent Deliveries

---

## Advanced Configuration

### Run Database Migrations Automatically

Edit `deploy.php` and add to the commands array:

```php
$commands = [
    'php artisan config:clear',
    'php artisan cache:clear',
    'php artisan route:clear',
    'php artisan view:clear',
    'php artisan migrate --force',  // Add this
    'php artisan config:cache',
    'php artisan route:cache',
    'php artisan view:cache',
];
```

### Install Composer Dependencies

Add before Laravel commands:

```php
exec('composer install --no-dev --optimize-autoloader 2>&1', $composer_output);
logMessage("Composer install completed");
```

### Run NPM Build

Add for frontend assets:

```php
exec('npm install && npm run build 2>&1', $npm_output);
logMessage("NPM build completed");
```

---

## Security Best Practices

### 1. Protect deploy.php

Add to `.htaccess` in public_html:

```apache
<Files "deploy.php">
    # Only allow GitHub IPs (optional)
    Order Deny,Allow
    Deny from all
    Allow from 140.82.112.0/20
    Allow from 143.55.64.0/20
    Allow from 185.199.108.0/22
    Allow from 192.30.252.0/22
</Files>
```

### 2. Protect deploy.log

Add to `.htaccess`:

```apache
<Files "deploy.log">
    Order Deny,Allow
    Deny from all
</Files>
```

### 3. Use Strong Secret Token

Always use a strong, random secret token:

```bash
openssl rand -hex 32
```

### 4. Monitor Deployments

Regularly check `deploy.log` for unauthorized access attempts.

---

## Troubleshooting

### Issue: Webhook shows 403 Forbidden

**Solution:**
- Check SECRET_TOKEN matches in both deploy.php and GitHub webhook
- Verify webhook signature validation

### Issue: Git pull fails with "Permission denied"

**Solution:**
```bash
# Set correct permissions
chmod -R 755 /home/u123456789/mettacity
chown -R u123456789:u123456789 /home/u123456789/mettacity
```

### Issue: Artisan commands fail

**Solution:**
```bash
# Check PHP path
which php
# Update deploy.php to use full PHP path
exec('/usr/bin/php artisan config:clear 2>&1', $output);
```

### Issue: Changes not appearing on website

**Solution:**
1. Check deploy.log for errors
2. Clear browser cache
3. Run manually: `php artisan config:clear && php artisan cache:clear`
4. Check file permissions

### Issue: Webhook not triggering

**Solution:**
1. Check GitHub webhook delivery status
2. Verify payload URL is correct
3. Check Hostinger firewall settings
4. Test deploy.php directly: `curl https://yourdomain.com/deploy.php`

---

## Monitoring & Maintenance

### View Recent Deployments

```bash
tail -n 50 /home/u123456789/domains/yourdomain.com/public_html/deploy.log
```

### Clear Old Logs

```bash
# Keep only last 100 lines
tail -n 100 deploy.log > deploy.log.tmp && mv deploy.log.tmp deploy.log
```

### Setup Log Rotation (Optional)

Create a cron job to rotate logs weekly:

```bash
0 0 * * 0 cd /home/u123456789/domains/yourdomain.com/public_html && tail -n 500 deploy.log > deploy.log.tmp && mv deploy.log.tmp deploy.log
```

---

## Complete Workflow Example

### Scenario: Update News Feature

**On Your Local Machine:**

```bash
# 1. Make changes
code resources/views/news.blade.php

# 2. Test locally
php artisan serve

# 3. Commit changes
git add resources/views/news.blade.php
git commit -m "Update news card styling"

# 4. Push to GitHub
git push origin main
```

**Automatic Process:**

1. GitHub receives push
2. Webhook triggers deploy.php
3. Server pulls latest code
4. Caches are cleared
5. Website updated in ~5-10 seconds!

**Verify:**

- Check website: Changes are live
- Check log: `https://yourdomain.com/deploy.log`
- Check GitHub: Webhook delivery shows success ✓

---

## Benefits

✅ **Instant Deployment** - Push code and it's live in seconds
✅ **No Manual FTP** - No need to upload files manually
✅ **Version Control** - Full Git history of all changes
✅ **Rollback Easy** - Revert to previous version anytime
✅ **Team Collaboration** - Multiple developers can work together
✅ **Automated Testing** - Can add tests before deployment
✅ **Professional Workflow** - Industry-standard deployment process

---

## Next Steps

1. ✓ Setup Git repository
2. ✓ Configure SSH keys
3. ✓ Upload deploy.php
4. ✓ Add GitHub webhook
5. ✓ Test deployment
6. ✓ Secure deploy.php and logs
7. ✓ Document your workflow
8. ✓ Train team members (if applicable)

---

## Support Resources

- **GitHub Webhooks Docs:** https://docs.github.com/en/webhooks
- **Hostinger SSH Guide:** https://support.hostinger.com/en/articles/1583245-how-to-use-ssh
- **Git Documentation:** https://git-scm.com/doc
- **Laravel Deployment:** https://laravel.com/docs/deployment

---

**Your deployment is now automated! 🚀**

Every time you push to GitHub, your website updates automatically!
