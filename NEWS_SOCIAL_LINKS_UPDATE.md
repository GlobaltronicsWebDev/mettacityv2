# News Social Links Update

## What's New
Added support for multiple social media links in News Management:
- Facebook Link
- Twitter Link
- Instagram Link
- Custom Link (for YouTube, TikTok, or any other URL)

## Changes Made

### Database
- Added 3 new columns to `news` table:
  - `twitter_link` (nullable)
  - `instagram_link` (nullable)
  - `custom_link` (nullable)

### Admin Panel
- Updated Create News form with 4 link fields
- Updated Edit News form with 4 link fields
- All links are optional and validated as URLs

### News Page
- Social media icons now display below news excerpt
- Icons are clickable and open in new tab
- Styled with gradient blue buttons
- Responsive design for mobile

## Deployment Steps

### 1. Sync to GitHub
```bash
sync-to-hostinger.bat
```

### 2. Deploy to Hostinger
Visit: https://mettacity.com.ph/manual-deploy.php

### 3. Run Migration via SSH
```bash
cd /home/u553953718/domains/mettacity.com.ph/public_html/mettacityv2
php artisan migrate
```

The migration will add the new columns to your live database.

### 4. Test
1. Go to Admin Panel → News Management
2. Create or edit a news item
3. Add social media links (Facebook, Twitter, Instagram, or Custom)
4. Save and check the News page
5. Verify icons appear and links work

## Features
- All links are optional
- URL validation on form submission
- Font Awesome icons for each platform
- Hover effects on social icons
- Mobile responsive
- Opens links in new tab

## Icons Used
- Facebook: `fab fa-facebook`
- Twitter: `fab fa-twitter`
- Instagram: `fab fa-instagram`
- Custom Link: `fas fa-link`

## Files Modified
- `database/migrations/2026_02_24_110629_add_social_links_to_news_table.php` (new)
- `app/Models/News.php`
- `app/Http/Controllers/Admin/NewsController.php`
- `resources/views/admin/news/create.blade.php`
- `resources/views/admin/news/edit.blade.php`
- `resources/views/news.blade.php`
- `public/cssfolder/news.css`
