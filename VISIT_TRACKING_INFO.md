# Visit Tracking System

## How It Works

The visit tracking system monitors real visitor traffic on your public pages and displays statistics in the admin dashboard.

## What Gets Tracked

- **Page:** Which page was visited (home, news, careers, etc.)
- **IP Address:** Visitor's IP address
- **User Agent:** Browser and device information
- **Timestamp:** When the visit occurred

## What Gets Excluded

The system automatically excludes:

1. **Admin Users:** When you're logged in as admin, your visits are NOT counted
2. **Bots & Crawlers:** Search engine bots (Google, Bing, etc.) are filtered out
3. **Admin Panel:** Admin routes are never tracked

### Bot Detection

The following patterns are excluded:
- bot
- crawl
- spider
- slurp
- mediapartners
- googlebot
- bingbot
- yahoo
- baiduspider

## Dashboard Statistics

The admin dashboard shows:

- **Total Visits:** All-time visitor count
- **Today's Visits:** Visits from today (12:00 AM to now)
- **Yesterday's Visits:** Visits from yesterday (full day)

## Tracked Pages

Visit tracking is enabled on these public pages:
- Home (/)
- Enter Metta City
- Ticketing
- Plan Your Visit
- FAQs
- About Us
- News
- Careers

## Clear Visit Data

To reset visit counts (before going live):

```bash
php artisan visits:clear
```

This will delete all visit records and reset counters to 0.

## Technical Details

### Middleware
- **File:** `app/Http/Middleware/TrackVisit.php`
- **Applied to:** Public routes only
- **Checks:** Admin authentication, bot detection

### Database
- **Table:** visits
- **Timezone:** Asia/Manila (Philippines)
- **Storage:** SQLite (can be changed to MySQL)

## Testing

To test if visits are being tracked:

1. **Logout** from admin panel
2. Visit public pages (home, news, careers)
3. **Login** to admin panel
4. Check dashboard - visits should increase

Your own visits while logged in as admin will NOT be counted.

## Production Notes

- Visit tracking works automatically when deployed online
- No additional configuration needed
- Admin users can browse without inflating visit counts
- Bot traffic is automatically filtered
- Real visitor data only

## Troubleshooting

### Visits not counting
- Make sure you're logged out when testing
- Check if TrackVisit middleware is applied to routes
- Verify database connection

### Too many visits
- Check if bot filtering is working
- Review IP addresses in visits table
- Look for unusual user agents

### Reset counts
```bash
php artisan visits:clear
```

## Privacy

- IP addresses are stored for analytics
- No personal information is collected
- Complies with basic privacy standards
- Consider adding privacy policy for GDPR compliance
