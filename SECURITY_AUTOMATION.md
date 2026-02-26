# Security Automation Guide

## Automated Security Features

This application includes automated security monitoring, auditing, and backup systems.

## 1. Security Audit

Runs daily security checks on your application.

### Manual Run:
```bash
php artisan security:audit
```

### What it checks:
- Environment configuration (DEBUG, ENV)
- File permissions
- Outdated dependencies
- Session security settings
- Database security
- Admin IP whitelist
- HTTPS configuration
- Suspicious activity patterns

### Schedule:
- Runs automatically every day at 2:00 AM

## 2. Suspicious Activity Monitoring

Monitors logs for potential security threats.

### Manual Run:
```bash
php artisan security:monitor
```

### What it detects:
- SQL injection attempts
- XSS (Cross-Site Scripting) attempts
- Path traversal attacks
- Unauthorized access attempts
- Failed login attempts
- Application errors and exceptions

### Schedule:
- Runs automatically every hour

## 3. Database Backups

Automated database backups with retention policy.

### Manual Run:
```bash
# Daily backup (keeps 7 days)
php artisan db:backup

# Custom retention
php artisan db:backup --keep=30
```

### Features:
- Supports MySQL and SQLite
- Automatic cleanup of old backups
- Timestamped backup files
- Size reporting

### Schedule:
- Daily backup at 3:00 AM (keeps 7 days)
- Weekly full backup on Sundays at 4:00 AM (keeps 30 days)

### Backup Location:
```
storage/backups/backup_YYYY-MM-DD_HHMMSS.sql
```

## Setup on Production Server

### 1. Enable Laravel Scheduler

Add this to your crontab (via SSH):

```bash
crontab -e
```

Add this line:
```
* * * * * cd /home/u553953718/domains/mettacity.com.ph/public_html/mettacityv2 && php artisan schedule:run >> /dev/null 2>&1
```

### 2. Verify Scheduler is Running

```bash
php artisan schedule:list
```

You should see:
- `security:audit` - Daily at 02:00
- `security:monitor` - Hourly
- `db:backup` - Daily at 03:00
- `db:backup --keep=30` - Weekly on Sundays at 04:00

### 3. Test Commands Manually

```bash
# Test security audit
php artisan security:audit

# Test monitoring
php artisan security:monitor

# Test backup
php artisan db:backup
```

## Monitoring Alerts

All security events are logged to:
```
storage/logs/laravel.log
```

### View recent security logs:
```bash
tail -f storage/logs/laravel.log | grep -i "security\|suspicious\|backup"
```

## Email Notifications (Optional)

To receive email alerts for security issues, configure mail settings in `.env`:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your-email@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
```

## Best Practices

1. **Review logs weekly** - Check for patterns of suspicious activity
2. **Test backups monthly** - Verify backups can be restored
3. **Update dependencies** - Run `composer update` monthly
4. **Monitor disk space** - Backups can accumulate over time
5. **Rotate logs** - Archive old logs to prevent disk space issues

## Backup Restoration

### MySQL:
```bash
mysql -u username -p database_name < storage/backups/backup_YYYY-MM-DD_HHMMSS.sql
```

### SQLite:
```bash
cp storage/backups/backup_YYYY-MM-DD_HHMMSS.sql database/database.sqlite
```

## Troubleshooting

### Scheduler not running:
- Verify cron job is added
- Check cron logs: `grep CRON /var/log/syslog`
- Ensure PHP path is correct in crontab

### Backup fails:
- Check disk space: `df -h`
- Verify database credentials in `.env`
- Check file permissions on `storage/backups`

### No alerts received:
- Check `storage/logs/laravel.log` for entries
- Verify mail configuration
- Test with: `php artisan security:audit`

## Security Checklist

- [ ] Cron job configured for scheduler
- [ ] Backups tested and verified
- [ ] Log monitoring reviewed weekly
- [ ] Dependencies updated monthly
- [ ] Security audit passes all checks
- [ ] Email notifications configured (optional)
- [ ] Backup retention policy set appropriately
- [ ] Old logs archived regularly

## Support

For issues or questions, check the Laravel documentation:
- Scheduling: https://laravel.com/docs/scheduling
- Logging: https://laravel.com/docs/logging
- Backups: https://laravel.com/docs/database
