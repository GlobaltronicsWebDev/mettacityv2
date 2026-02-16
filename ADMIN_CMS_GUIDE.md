# Mettacity Admin CMS Guide

## Admin Access Levels

### Regular Admin
- **Email:** admin@mettacity.com
- **Password:** admin123
- **Access:**
  - Dashboard (view all statistics)
  - Bookings Management (view, update status, delete)
  - Careers (view only - cannot create, edit, or delete)

### Super Admin
- **Email:** superadmin@mettacity.com
- **Password:** superadmin123
- **Access:**
  - Everything Regular Admin can access
  - News Management (create, edit, delete)
  - Careers Management (create, edit, delete)
  - User Management (create, edit, delete admin accounts)

## Features

### Dashboard
- Total Visits (all-time)
- Today's Visits
- Yesterday's Visits
- Total Bookings (with pending count)
- Careers Count (All Admins)
- News Count (Super Admin only)
- Users Count (Super Admin only)

### Bookings Management (All Admins)
- View all bookings
- Update booking status (Pending, Confirmed, Cancelled, Completed)
- Delete bookings
- View booking details

### Careers (All Admins - View Only)
- View all career postings
- See job details (title, description, location, type)
- Check active/inactive status
- Regular admins cannot create, edit, or delete

### News Management (Super Admin Only)
- Create news articles
- Upload images
- Set publish date
- Add Facebook link
- Activate/Deactivate news
- Edit and delete news

### Careers Management (Super Admin Only - Full Access)
- Post job openings
- Add job details (title, description, location, type)
- Upload images
- Activate/Deactivate careers
- Edit and delete careers

### User Management (Super Admin Only)
- Create new admin accounts
- Edit existing users
- Change user roles (Admin / Super Admin)
- Reset user passwords
- Delete users (cannot delete yourself)
- View all users with their roles

## User Roles

### User (No Admin Access)
- Regular website visitor
- Can make bookings

### Admin
- Access to admin dashboard
- Can manage bookings
- Can view careers (read-only)
- Cannot access News or User Management
- Cannot create/edit/delete careers

### Super Admin
- Full access to all features
- Can manage News and Careers
- Can create and manage other admin accounts
- Can promote/demote users to admin roles

## Dark Mode
- Toggle button in bottom-right corner
- Preference saved in browser
- Available on all admin pages

## Notes
- Ticket Management has been removed
- Only Super Admin can manage News and Users
- Only Super Admin can create/edit/delete Careers
- Regular Admin can view Careers but cannot modify them
- Regular Admin can only manage Bookings
- Visit tracking works on all public pages
- Super Admin can create multiple admin accounts with different access levels

## 🎉 Admin Panel Successfully Created!

Your Mettacity website now has a complete Content Management System (CMS) with admin dashboard.

## 📋 Features

✅ **Admin Authentication**
- Secure login/logout system
- Admin-only access control
- Personalized greetings (Good Morning/Afternoon/Evening)

✅ **Dashboard**
- Overview of total news and tickets
- Quick action buttons
- Easy navigation

✅ **News Management**
- Create, edit, and delete news articles
- Upload/replace news images
- Set Facebook links for each news item
- Activate/deactivate news
- Set published dates

✅ **Ticket Management**
- Create, edit, and delete tickets
- Upload/replace ticket images
- Set prices and descriptions
- Control display order
- Activate/deactivate tickets

✅ **Sidebar Navigation**
- Dashboard
- News Management
- Ticket Management
- View Main Site
- Back to Main Site button
- Logout button

## 🔐 Admin Login Credentials

**URL:** `http://your-domain.com/admin/login`

**Email:** `admin@mettacity.com`  
**Password:** `admin123`

⚠️ **IMPORTANT:** Change these credentials after first login!

## 🚀 How to Access

1. Go to: `http://localhost:8000/admin/login` (or your domain)
2. Enter the credentials above
3. You'll be redirected to the admin dashboard

## 📁 File Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   └── Admin/
│   │       ├── AuthController.php
│   │       ├── DashboardController.php
│   │       ├── NewsController.php
│   │       └── TicketController.php
│   └── Middleware/
│       └── IsAdmin.php
├── Models/
│   ├── News.php
│   └── Ticket.php

resources/views/admin/
├── layout.blade.php (Main admin layout with sidebar)
├── login.blade.php
├── dashboard.blade.php
├── news/
│   ├── index.blade.php
│   ├── create.blade.php
│   └── edit.blade.php
└── tickets/
    ├── index.blade.php
    ├── create.blade.php
    └── edit.blade.php

database/migrations/
├── 2026_02_16_061510_create_news_table.php
├── 2026_02_16_061511_create_tickets_table.php
└── 2026_02_16_061513_add_is_admin_to_users_table.php
```

## 🎨 Admin Panel Features

### Dashboard
- Shows total count of news and tickets
- Quick action buttons to add news/tickets
- Link to view main website

### News Management
- **List View:** See all news with images, titles, dates, and status
- **Create:** Add new news with image upload
- **Edit:** Update existing news and replace images
- **Delete:** Remove news (with confirmation)
- **Status:** Toggle active/inactive

### Ticket Management
- **List View:** See all tickets with images, names, prices, and status
- **Create:** Add new tickets with image upload
- **Edit:** Update existing tickets and replace images
- **Delete:** Remove tickets (with confirmation)
- **Order:** Control display order
- **Status:** Toggle active/inactive

## 🔧 Technical Details

### Routes
- `/admin/login` - Admin login page
- `/admin/dashboard` - Admin dashboard (protected)
- `/admin/news` - News management (protected)
- `/admin/tickets` - Ticket management (protected)
- `/admin/logout` - Logout (POST)

### Middleware
- `IsAdmin` middleware protects all admin routes
- Checks if user is authenticated and has `is_admin = true`

### Image Storage
- Images are stored in `storage/app/public/`
- Accessible via `public/storage/` (symlink created)
- News images: `storage/app/public/news/`
- Ticket images: `storage/app/public/tickets/`

## 📝 How to Use

### Adding News
1. Go to News Management
2. Click "Add News"
3. Fill in title, excerpt, upload image
4. Add Facebook link (optional)
5. Set published date
6. Check "Active" to make it visible
7. Click "Create News"

### Adding Tickets
1. Go to Ticket Management
2. Click "Add Ticket"
3. Fill in name, description, price
4. Upload ticket image
5. Set display order
6. Check "Active" to make it visible
7. Click "Create Ticket"

### Editing Content
1. Click the edit (pencil) icon on any item
2. Update the information
3. Upload new image to replace (optional)
4. Click "Update"

### Deleting Content
1. Click the delete (trash) icon
2. Confirm deletion
3. Item and its image will be removed

## 🔒 Security Notes

1. **Change Default Password:** Immediately change the admin password after first login
2. **Admin Access:** Only users with `is_admin = true` can access admin panel
3. **Image Validation:** Only image files up to 2MB are accepted
4. **CSRF Protection:** All forms are protected with CSRF tokens

## 🎯 Next Steps

1. **Change Admin Password:**
   - Create a profile/settings page
   - Or update directly in database

2. **Add More Admins:**
   ```php
   User::create([
       'name' => 'New Admin',
       'email' => 'newadmin@mettacity.com',
       'password' => Hash::make('password'),
       'is_admin' => true,
   ]);
   ```

3. **Customize:**
   - Update colors in `resources/views/admin/layout.blade.php`
   - Add more management sections as needed
   - Integrate with front-end news/ticket displays

## 🐛 Troubleshooting

**Can't login?**
- Check credentials are correct
- Ensure user has `is_admin = true` in database

**Images not showing?**
- Run: `php artisan storage:link`
- Check file permissions

**404 on admin routes?**
- Run: `php artisan route:clear`
- Check routes/web.php

## 📞 Support

For issues or questions, check the Laravel documentation or contact your developer.

---

**Enjoy your new CMS! 🎉**
