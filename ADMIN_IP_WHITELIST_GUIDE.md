# Admin IP Whitelist Configuration Guide

## Overview

The admin panel is protected by IP whitelist to ensure only authorized IP addresses can access it. This adds an extra layer of security beyond username/password authentication.

## Configuration

### 1. Edit .env File

Add or update the `ADMIN_ALLOWED_IPS` variable in your `.env` file:

```env
# Single IP
ADMIN_ALLOWED_IPS=172.16.55.82

# Multiple IPs (comma-separated, no spaces)
ADMIN_ALLOWED_IPS=127.0.0.1,172.16.55.82,192.168.1.100

# Allow all IPs (leave empty - NOT RECOMMENDED for production)
ADMIN_ALLOWED_IPS=
```

### 2. Clear Config Cache

After updating `.env`, clear the config cache:

```bash
php artisan config:clear
```

## How It Works

1. When someone tries to access `/admin/*` routes, the system checks their IP address
2. If the IP is in the allowed list, access is granted
3. If the IP is NOT in the allowed list, they get a 403 Forbidden error
4. If no IPs are configured (empty), all IPs are allowed (for development only)

## Finding Your IP Address

### Local Network IP
```bash
# Windows
ipconfig

# Linux/Mac
ifconfig
# or
ip addr show
```

### Public IP (for remote access)
Visit: https://whatismyipaddress.com/

## Common IP Addresses

- `127.0.0.1` - Localhost (your computer)
- `172.16.x.x` - Private network (office/local network)
- `192.168.x.x` - Private network (home/office)
- `10.x.x.x` - Private network

## Production Setup

### Recommended Configuration

1. **Office Network**: Add your office's public IP
   ```env
   ADMIN_ALLOWED_IPS=203.123.45.67
   ```

2. **Multiple Locations**: Add all authorized IPs
   ```env
   ADMIN_ALLOWED_IPS=203.123.45.67,172.16.55.82,192.168.1.100
   ```

3. **VPN Access**: Add VPN server IP
   ```env
   ADMIN_ALLOWED_IPS=10.8.0.1
   ```

## Security Best Practices

1. ✅ **Always use IP whitelist in production**
2. ✅ **Use static IPs for admin access**
3. ✅ **Regularly review and update the IP list**
4. ✅ **Remove IPs when staff leaves**
5. ❌ **Never leave ADMIN_ALLOWED_IPS empty in production**
6. ❌ **Don't use dynamic IPs for admin access**

## Troubleshooting

### Error: "Access denied. Your IP address is not authorized"

**Solution:**
1. Check your current IP address
2. Add it to `.env` file: `ADMIN_ALLOWED_IPS=your.ip.address`
3. Run: `php artisan config:clear`
4. Try accessing admin again

### Can't Access Admin After Deployment

**Solution:**
1. Check server's IP configuration
2. If behind a proxy/load balancer, you may need to configure trusted proxies
3. Add your public IP to the whitelist

### Dynamic IP Issues

If your IP changes frequently:
- Use a VPN with static IP
- Set up a static IP with your ISP
- For development only: Leave `ADMIN_ALLOWED_IPS` empty

## Testing

### Test IP Restriction

1. Add only one IP to whitelist:
   ```env
   ADMIN_ALLOWED_IPS=172.16.55.82
   ```

2. Try accessing from different IP - should get 403 error

3. Try accessing from allowed IP - should work normally

## Disabling IP Restriction (Development Only)

To disable IP restriction temporarily:

```env
# Leave empty
ADMIN_ALLOWED_IPS=
```

Then clear config:
```bash
php artisan config:clear
```

⚠️ **WARNING**: Never deploy to production with empty IP whitelist!

## Advanced Configuration

### Using Config File Directly

Edit `config/admin.php`:

```php
'allowed_ips' => [
    '127.0.0.1',
    '172.16.55.82',
    '192.168.1.100',
],
```

### IP Ranges (Future Enhancement)

Currently supports individual IPs only. For IP ranges, you would need to modify the middleware.

## Support

For issues or questions:
1. Check your IP: `php artisan tinker` then `request()->ip()`
2. Verify config: `php artisan config:show admin`
3. Check logs: `storage/logs/laravel.log`
