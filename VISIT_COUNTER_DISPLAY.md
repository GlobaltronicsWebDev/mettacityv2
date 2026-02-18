# Visit Counter Display on Main Website

## Overview

The total visits counter is now displayed on all public pages in the footer section, below the social media icons.

## Features

✅ **Live Counter** - Shows real-time total visit count
✅ **Animated Icon** - Eye icon with pulsing animation
✅ **Glowing Effect** - Cyan glow on the number for visual appeal
✅ **Responsive Design** - Adapts to mobile and desktop screens
✅ **Glassmorphism Style** - Modern frosted glass effect

## Display Location

The counter appears in the footer on these pages:
- Home (/)
- Enter Metta City
- Ticketing
- Plan Your Visit
- FAQs
- About Us
- News
- Careers

## Visual Design

```
┌─────────────────────────────────┐
│  [Eye Icon] 1,234 TOTAL VISITS  │
└─────────────────────────────────┘
```

**Styling:**
- Background: Frosted glass effect with blur
- Border: Subtle white border with transparency
- Icon: Cyan color with pulsing animation
- Number: Large, bold, cyan with glow effect
- Label: Uppercase, white with transparency

## How It Works

1. **Route Level:** Each public route fetches the total visit count from database
2. **Footer Component:** Displays the count if available
3. **CSS Styling:** Applies modern glassmorphism design
4. **Animation:** Eye icon pulses every 2 seconds

## Code Structure

### Routes (web.php)
```php
Route::get('/', function () {
    $totalVisits = \App\Models\Visit::count();
    return view('mainpage', compact('totalVisits'));
})->name('home');
```

### Footer (footer.blade.php)
```html
@if(isset($totalVisits))
<div class="footer-visit-counter">
  <i class="fa-solid fa-eye"></i>
  <span class="visit-count">{{ number_format($totalVisits) }}</span>
  <span class="visit-label">Total Visits</span>
</div>
@endif
```

### Styling (footer.css)
- Glassmorphism background
- Pulsing animation on icon
- Responsive sizing for mobile
- Cyan accent color (#00d4ff)

## Customization

### Change Color
Edit `footer.css`:
```css
.footer-visit-counter i,
.visit-count {
  color: #your-color; /* Change cyan to your color */
}
```

### Change Position
Edit `footer.blade.php` to move the counter to a different location in the footer.

### Hide Counter
Remove or comment out the counter section in `footer.blade.php`.

### Change Animation Speed
Edit `footer.css`:
```css
@keyframes pulse {
  /* Adjust timing for faster/slower pulse */
}
```

## Mobile Responsive

**Desktop:**
- Font size: 16px (label), 22px (count)
- Padding: 12px 25px
- Icon: 20px

**Mobile (≤425px):**
- Font size: 12px (label), 18px (count)
- Padding: 10px 20px
- Icon: 18px

## Testing

1. Visit any public page
2. Scroll to footer
3. Look for the visit counter below social icons
4. Counter shows formatted number (e.g., 1,234)
5. Eye icon should pulse gently

## Notes

- Counter only shows on public pages (not admin panel)
- Number is formatted with commas (1,234 instead of 1234)
- Updates on each page load
- Excludes admin users and bots from count
- Uses same data as admin dashboard

## Troubleshooting

### Counter not showing
- Check if `$totalVisits` is being passed to view
- Verify footer.blade.php has the counter code
- Check CSS file is loaded

### Number not formatted
- Ensure using `number_format($totalVisits)` in blade
- Check PHP number_format function is available

### Styling issues
- Clear browser cache
- Check footer.css is loaded
- Verify CSS classes match HTML

## Future Enhancements

Possible additions:
- Today's visits counter
- Animated number counting up
- Click to see more stats
- Different icons for different pages
- Visitor location map
