# Mettacity Security Implementation Guide

## Security Measures Implemented

### 1. ✅ Already Implemented

#### Authentication & Authorization
- ✅ Password hashing (bcrypt)
- ✅ Admin role-based access control
- ✅ Super Admin permissions
- ✅ IP whitelist for admin panel
- ✅ CSRF protection (Laravel default)
- ✅ Session security

#### Database Security
- ✅ SQL injection protection (Eloquent ORM)
- ✅ Prepared statements
- ✅ Input validation

### 2. 🔒 Additional Security Measures to Implement

## Required Security Configurations

### A. Environment Security

**1. Update .env for Production:**
```env
APP_ENV=production
APP_DEBUG=false
APP_KEY=base64:YOUR_UNIQUE_KEY_HERE

# Database (use strong credentials)
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_DATABASE=mettacity
DB_USERNAME=mettacity_user
DB_PASSWORD=STRONG_PASSWORD_HERE

# Session Security
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict

# Admin IP Whitelist (REQUIRED)
ADMIN_ALLOWED_IPS=172.16.55.82,YOUR_OFFICE_IP
```

**2. Generate New APP_KEY:**
```bash
php artisan key:generate
```

### B. File Permissions (Linux/Mac)

```bash
# Set proper permissions
chmod -R 755 storage bootstrap/cache
chmod -R 644 .env

# Protect sensitive files
chmod 600 .env
chmod 600 config/database.php

# Make storage writable
chown -R www-data:www-data storage bootstrap/cache
```

### C. Web Server Configuration

#### Apache (.htaccess)
Already included in Laravel, but verify:
- Disable directory listing
- Protect .env file
- Force HTTPS

#### Nginx (add to config)
```nginx
# Protect sensitive files
location ~ /\.env {
    deny all;
}

location ~ /\.git {
    deny all;
}

# Force HTTPS
if ($scheme != "https") {
    return 301 https://$server_name$request_uri;
}

# Security headers
add_header X-Frame-Options "SAMEORIGIN" always;
add_header X-Content-Type-Options "nosniff" always;
add_header X-XSS-Protection "1; mode=block" always;
add_header Referrer-Policy "strict-origin-when-cross-origin" always;
```

### D. SSL/HTTPS Certificate

**Required for Production:**

1. **Free SSL (Let's Encrypt):**
```bash
# Install Certbot
sudo apt-get install certbot python3-certbot-nginx

# Get certificate
sudo certbot --nginx -d yourdomain.com -d www.yourdomain.com
```

2. **Or use Cloudflare** (Recommended):
   - Free SSL certificate
   - DDoS protection
   - CDN
   - Firewall

### E. Database Security

**1. Create Dedicated Database User:**
```sql
CREATE USER 'mettacity_user'@'localhost' IDENTIFIED BY 'STRONG_PASSWORD';
GRANT SELECT, INSERT, UPDATE, DELETE ON mettacity.* TO 'mettacity_user'@'localhost';
FLUSH PRIVILEGES;
```

**2. Disable Remote MySQL Access:**
```bash
# Edit MySQL config
sudo nano /etc/mysql/mysql.conf.d/mysqld.cnf

# Add or verify:
bind-address = 127.0.0.1
```

### F. Rate Limiting

**Already Implemented in Laravel:**
- API rate limiting: 60 requests/minute
- Login throttling: 5 attempts/minute

**To customize, edit:** `app/Http/Kernel.php`

### G. Backup Strategy

**1. Database Backup (Daily):**
```bash
# Create backup script
nano /home/backup-db.sh
```

```bash
#!/bin/bash
DATE=$(date +%Y%m%d_%H%M%S)
mysqldump -u root -p mettacity > /backups/mettacity_$DATE.sql
# Keep only last 7 days
find /backups -name "mettacity_*.sql" -mtime +7 -delete
```

**2. File Backup:**
```bash
# Backup uploads and storage
tar -czf /backups/storage_$DATE.tar.gz storage/app/public
```

**3. Automated Backup (Cron):**
```bash
# Edit crontab
crontab -e

# Add daily backup at 2 AM
0 2 * * * /home/backup-db.sh
```

## Security Checklist for Production

### Before Going Live:

- [ ] Set `APP_ENV=production`
- [ ] Set `APP_DEBUG=false`
- [ ] Generate new `APP_KEY`
- [ ] Configure IP whitelist
- [ ] Install SSL certificate
- [ ] Set strong database password
- [ ] Configure firewall
- [ ] Set proper file permissions
- [ ] Enable HTTPS redirect
- [ ] Configure security headers
- [ ] Set up automated backups
- [ ] Test admin IP restriction
- [ ] Remove test/demo data
- [ ] Clear all caches

### Server Security:

```bash
# Update system
sudo apt update && sudo apt upgrade -y

# Install firewall
sudo apt install ufw
sudo ufw allow 22/tcp
sudo ufw allow 80/tcp
sudo ufw allow 443/tcp
sudo ufw enable

# Install fail2ban (brute force protection)
sudo apt install fail2ban
sudo systemctl enable fail2ban
sudo systemctl start fail2ban
```

## Monitoring & Maintenance

### 1. Log Monitoring

**Check logs regularly:**
```bash
# Laravel logs
tail -f storage/logs/laravel.log

# Web server logs
tail -f /var/log/nginx/error.log
tail -f /var/log/apache2/error.log
```

### 2. Security Updates

```bash
# Update Laravel dependencies
composer update

# Update system packages
sudo apt update && sudo apt upgrade
```

### 3. Database Maintenance

```bash
# Optimize tables
php artisan optimize

# Clear old sessions
php artisan session:gc
```

## Common Security Threats & Protection

### 1. SQL Injection
✅ **Protected:** Using Eloquent ORM with prepared statements

### 2. XSS (Cross-Site Scripting)
✅ **Protected:** Laravel Blade auto-escapes output

### 3. CSRF (Cross-Site Request Forgery)
✅ **Protected:** CSRF tokens on all forms

### 4. Brute Force Attacks
✅ **Protected:** 
- Login throttling
- IP whitelist for admin
- Fail2ban (server level)

### 5. File Upload Attacks
✅ **Protected:**
- File type validation
- Size limits (2MB)
- Stored outside web root

### 6. Session Hijacking
✅ **Protected:**
- Secure cookies
- HTTP-only cookies
- Session regeneration

### 7. DDoS Attacks
🔒 **Recommended:** Use Cloudflare

## Emergency Response

### If Site is Compromised:

1. **Immediate Actions:**
```bash
# Take site offline
php artisan down

# Check for malicious files
find . -name "*.php" -mtime -1

# Review logs
tail -100 storage/logs/laravel.log

# Check database for suspicious activity
mysql -u root -p mettacity
SELECT * FROM users ORDER BY created_at DESC LIMIT 10;
```

2. **Recovery:**
```bash
# Restore from backup
mysql -u root -p mettacity < /backups/latest_backup.sql

# Clear all sessions
php artisan session:flush

# Reset admin passwords
php artisan tinker
User::where('is_admin', 1)->update(['password' => Hash::make('NEW_SECURE_PASSWORD')]);

# Bring site back online
php artisan up
```

## Security Best Practices

### Passwords:
- ✅ Minimum 8 characters
- ✅ Use password manager
- ✅ Change regularly
- ✅ Never share credentials

### Admin Access:
- ✅ Use IP whitelist
- ✅ Strong passwords
- ✅ Limit admin accounts
- ✅ Monitor login attempts

### Code Security:
- ✅ Keep Laravel updated
- ✅ Review dependencies
- ✅ Use HTTPS everywhere
- ✅ Validate all inputs

### Server Security:
- ✅ Keep OS updated
- ✅ Use firewall
- ✅ Disable unused services
- ✅ Regular backups

## Testing Security

### 1. Test Admin IP Restriction
```bash
# Try accessing from unauthorized IP
curl -I https://yourdomain.com/admin/login
# Should return 403 Forbidden
```

### 2. Test HTTPS Redirect
```bash
# Try HTTP
curl -I http://yourdomain.com
# Should redirect to HTTPS
```

### 3. Test SQL Injection
Try entering in forms:
```
' OR '1'='1
```
Should be safely escaped.

### 4. Test XSS
Try entering in forms:
```html
<script>alert('XSS')</script>
```
Should be escaped and displayed as text.

## Support & Resources

- Laravel Security: https://laravel.com/docs/security
- OWASP Top 10: https://owasp.org/www-project-top-ten/
- SSL Test: https://www.ssllabs.com/ssltest/
- Security Headers: https://securityheaders.com/

## Regular Maintenance Schedule

### Daily:
- Monitor error logs
- Check failed login attempts

### Weekly:
- Review user accounts
- Check backup integrity
- Update dependencies

### Monthly:
- Security audit
- Password rotation
- Review access logs
- Update system packages

---

**Remember:** Security is an ongoing process, not a one-time setup!
