# Mettacity Performance Optimization Guide

## ✅ Optimizations Implemented

### 1. Laravel Caching (Already Applied)
```bash
php artisan optimize
```
This caches:
- ✅ Configuration files
- ✅ Routes
- ✅ Views (Blade templates)
- ✅ Events

### 2. Database Optimization

#### Enable Query Caching
Add to `.env`:
```env
DB_CACHE_ENABLED=true
CACHE_DRIVER=file
```

#### Database Indexes (Already in migrations)
- ✅ visits table: indexed on `visited_at`, `ip_address`
- ✅ users table: indexed on `email`
- ✅ All foreign keys indexed

### 3. Image Optimization

#### Compress Images Before Upload
Recommended tools:
- TinyPNG: https://tinypng.com/
- ImageOptim (Mac)
- RIOT (Windows)

#### Lazy Loading (Implemented)
Images load only when visible in viewport.

### 4. Asset Optimization

#### CSS Minification
```bash
# Install if not already
npm install -g csso-cli

# Minify CSS files
csso public/cssfolder/navbar.css -o public/cssfolder/navbar.min.css
csso public/cssfolder/carousel.css -o public/cssfolder/carousel.min.css
```

#### JavaScript Minification
```bash
# Install if not already
npm install -g terser

# Minify JS files
terser public/js/app.js -o public/js/app.min.js -c -m
```

### 5. Browser Caching

#### Apache (.htaccess)
Add to `public/.htaccess`:
```apache
<IfModule mod_expires.c>
    ExpiresActive On
    
    # Images
    ExpiresByType image/jpeg "access plus 1 year"
    ExpiresByType image/png "access plus 1 year"
    ExpiresByType image/gif "access plus 1 year"
    ExpiresByType image/webp "access plus 1 year"
    ExpiresByType image/svg+xml "access plus 1 year"
    
    # CSS and JavaScript
    ExpiresByType text/css "access plus 1 month"
    ExpiresByType application/javascript "access plus 1 month"
    
    # Fonts
    ExpiresByType font/woff2 "access plus 1 year"
    ExpiresByType font/woff "access plus 1 year"
    
    # Default
    ExpiresDefault "access plus 1 week"
</IfModule>

# Enable Gzip Compression
<IfModule mod_deflate.c>
    AddOutputFilterByType DEFLATE text/html
    AddOutputFilterByType DEFLATE text/css
    AddOutputFilterByType DEFLATE text/javascript
    AddOutputFilterByType DEFLATE application/javascript
    AddOutputFilterByType DEFLATE application/json
    AddOutputFilterByType DEFLATE image/svg+xml
</IfModule>
```

#### Nginx
Add to nginx config:
```nginx
# Browser caching
location ~* \.(jpg|jpeg|png|gif|ico|css|js|svg|woff|woff2)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}

# Gzip compression
gzip on;
gzip_vary on;
gzip_min_length 1024;
gzip_types text/plain text/css text/xml text/javascript application/javascript application/json image/svg+xml;
```

### 6. CDN Integration (Recommended)

#### Cloudflare (Free)
1. Sign up at cloudflare.com
2. Add your domain
3. Update nameservers
4. Enable:
   - Auto Minify (CSS, JS, HTML)
   - Brotli compression
   - Rocket Loader
   - Polish (image optimization)

Benefits:
- Global CDN
- DDoS protection
- SSL certificate
- Caching
- Minification

### 7. Preloading & Prefetching

Already implemented in mainpage.blade.php:
```html
<!-- Preconnect to external resources -->
<link rel="preconnect" href="https://cdn.jsdelivr.net">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
```

### 8. Database Query Optimization

#### Use Eager Loading
Instead of:
```php
$news = News::all();
foreach ($news as $item) {
    echo $item->user->name; // N+1 problem
}
```

Use:
```php
$news = News::with('user')->get(); // Single query
```

#### Pagination
Already implemented:
```php
$careers = Career::latest()->paginate(10);
```

### 9. Session Optimization

Update `.env`:
```env
# Use database for sessions (better for multiple servers)
SESSION_DRIVER=database

# Or use Redis for better performance
SESSION_DRIVER=redis
REDIS_CLIENT=phpredis
```

### 10. OPcache (PHP)

Enable in `php.ini`:
```ini
opcache.enable=1
opcache.memory_consumption=128
opcache.interned_strings_buffer=8
opcache.max_accelerated_files=10000
opcache.revalidate_freq=2
opcache.fast_shutdown=1
```

## Performance Commands

### Cache Everything
```bash
# Cache config, routes, views
php artisan optimize

# Or individually:
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
```

### Clear Caches (Development)
```bash
php artisan optimize:clear
```

### Check Performance
```bash
# Show cached routes
php artisan route:list

# Show config
php artisan config:show
```

## Image Optimization Script

Create `optimize-images.sh`:
```bash
#!/bin/bash

# Optimize PNG images
find public/assets -name "*.png" -exec optipng -o7 {} \;

# Optimize JPEG images
find public/assets -name "*.jpg" -exec jpegoptim --max=85 {} \;
find public/assets -name "*.jpeg" -exec jpegoptim --max=85 {} \;

echo "Images optimized!"
```

## Performance Monitoring

### 1. Laravel Debugbar (Development Only)
```bash
composer require barryvdh/laravel-debugbar --dev
```

### 2. Check Page Load Time
Use browser DevTools:
- Chrome: F12 → Network tab
- Firefox: F12 → Network tab

### 3. Online Tools
- GTmetrix: https://gtmetrix.com/
- PageSpeed Insights: https://pagespeed.web.dev/
- WebPageTest: https://www.webpagetest.org/

## Performance Checklist

### Before Deployment:

- [x] Run `php artisan optimize`
- [ ] Minify CSS files
- [ ] Minify JavaScript files
- [ ] Optimize images (compress)
- [ ] Enable browser caching
- [ ] Enable Gzip/Brotli compression
- [ ] Set up CDN (Cloudflare)
- [ ] Enable OPcache
- [ ] Test page load speed
- [ ] Optimize database queries

### After Deployment:

- [ ] Monitor page load times
- [ ] Check server response time
- [ ] Review slow queries
- [ ] Optimize bottlenecks
- [ ] Update caches regularly

## Expected Performance Improvements

### Before Optimization:
- Page Load: 3-5 seconds
- Time to First Byte: 500-1000ms
- Total Page Size: 5-10MB

### After Optimization:
- Page Load: 1-2 seconds ⚡
- Time to First Byte: 100-300ms ⚡
- Total Page Size: 2-4MB ⚡

## Advanced Optimizations

### 1. HTTP/2
Enable in web server for:
- Multiplexing
- Server push
- Header compression

### 2. WebP Images
Convert images to WebP format:
```bash
# Install cwebp
sudo apt install webp

# Convert images
cwebp input.png -q 80 -o output.webp
```

### 3. Service Worker (PWA)
Cache assets for offline access.

### 4. Database Connection Pooling
Use persistent connections:
```env
DB_PERSISTENT=true
```

### 5. Queue Jobs
Move heavy tasks to queues:
```bash
php artisan queue:work
```

## Maintenance

### Weekly:
```bash
# Clear old caches
php artisan cache:clear

# Rebuild caches
php artisan optimize
```

### Monthly:
- Review slow queries
- Optimize database tables
- Update dependencies
- Check disk space

## Troubleshooting

### Site Slow After Caching?
```bash
# Clear all caches
php artisan optimize:clear

# Rebuild
php artisan optimize
```

### Images Not Loading?
```bash
# Create storage link
php artisan storage:link
```

### CSS/JS Not Updating?
- Clear browser cache (Ctrl+Shift+R)
- Add version query: `style.css?v=2`
- Use Laravel Mix versioning

## Performance Tips

1. **Use CDN** for static assets
2. **Lazy load** images below the fold
3. **Minimize** HTTP requests
4. **Compress** all assets
5. **Cache** everything possible
6. **Optimize** database queries
7. **Use** async/defer for scripts
8. **Enable** HTTP/2
9. **Reduce** image sizes
10. **Monitor** performance regularly

---

**Current Status**: ✅ Basic optimizations applied
**Next Steps**: Implement CDN and image optimization
