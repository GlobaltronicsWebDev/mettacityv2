# How to Sync Your Changes to Hostinger

## Quick Method (Recommended)

1. Make your changes in the IDE
2. Double-click `sync-to-hostinger.bat`
3. Wait for the script to complete
4. Your changes will automatically deploy to https://mettacity.com.ph

## Manual Method

If you prefer to do it manually:

```bash
# Step 1: Add all changes
git add .

# Step 2: Commit with a message
git commit -m "Your change description"

# Step 3: Push to GitHub
git push origin main
```

## How It Works

1. **You edit files** in your IDE (VS Code, Kiro, etc.)
2. **Run sync-to-hostinger.bat** to commit and push to GitHub
3. **GitHub webhook triggers** deploy.php on your server
4. **deploy.php automatically pulls** the latest code to Hostinger
5. **Your website updates** at https://mettacity.com.ph

## Verify Deployment

- Check webhook status: https://mettacity.com.ph/deploy.php
- View deployment log via SSH: `cat public_html/deploy.log`
- Or via FTP: Download `public_html/deploy.log`

## Troubleshooting

### Changes not appearing on website?

**Method 1: Manual Deployment (Easiest)**
1. Upload `manual-deploy.php` to your Hostinger `public_html` folder
2. Visit: https://mettacity.com.ph/manual-deploy.php
3. This will pull latest changes and clear all caches
4. Check if your changes appear

**Method 2: Via SSH**
1. Login to Hostinger SSH
2. Run these commands:
   ```bash
   cd public_html/mettacityv2
   git pull origin main
   php artisan config:clear
   php artisan cache:clear
   php artisan view:clear
   ```

**Method 3: Check Webhook**
1. Verify webhook is configured in GitHub:
   - Go to: https://github.com/GlobaltronicsWebDev/mettacityv2/settings/hooks
   - Payload URL: https://mettacity.com.ph/deploy.php
   - Content type: application/json
   - Secret: mettacity2026webhook7d9b5163b3cd92044be1ae169dc91534
   - Events: Just the push event
2. Check Recent Deliveries tab for errors
3. Upload the fixed `deploy.php` file to `public_html` folder

**Method 4: Clear Browser Cache**
- Press Ctrl+Shift+Delete
- Clear cached images and files
- Or use Incognito/Private mode to test

### Webhook not working?

1. Verify webhook is configured in GitHub:
   - Go to: https://github.com/GlobaltronicsWebDev/mettacityv2/settings/hooks
   - Payload URL: https://mettacity.com.ph/deploy.php
   - Content type: application/json
   - Secret: mettacity2026webhook7d9b5163b3cd92044be1ae169dc91534
   - Events: Just the push event

2. Check Recent Deliveries tab in webhook settings for errors

### Git conflicts?

Run `complete-merge.bat` to resolve conflicts automatically.

## Important Notes

- Always commit and push your changes for them to sync
- The webhook deploys within 5-10 seconds after push
- Changes to .env file require manual update on server (not synced via Git)
- Database changes require manual migration on server
