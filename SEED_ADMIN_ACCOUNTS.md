# Seed Admin Accounts Guide

## Quick Setup

Run this command to seed both admin accounts:

```bash
php artisan db:seed
```

This will create:

### Super Admin Account
- **Email:** superadmin@mettacity.com
- **Password:** Globaltronics@2026!
- **Access:** Full access to everything

### Regular Admin Account
- **Email:** admin@mettacity.com
- **Password:** Globaltronics@2026!
- **Access:** Dashboard, Bookings, View Careers

## Individual Seeders

If you want to seed them separately:

```bash
# Seed Super Admin only
php artisan db:seed --class=SuperAdminSeeder

# Seed Regular Admin only
php artisan db:seed --class=AdminUserSeeder
```

## Reset and Reseed

If accounts already exist and you want to update them:

```bash
# The seeders use updateOrCreate, so running them again will update existing accounts
php artisan db:seed
```

## Fresh Start

If you want to completely reset the database and seed:

```bash
# WARNING: This will delete ALL data
php artisan migrate:fresh --seed
```

## Verify Accounts

After seeding, you can verify the accounts were created:

```bash
php artisan tinker
```

Then run:
```php
User::where('email', 'superadmin@mettacity.com')->first();
User::where('email', 'admin@mettacity.com')->first();
```

## Login

Visit: http://localhost:8000/admin/login

Use either account to login with the password: `Globaltronics@2026!`

## Notes

- Both accounts use the same password for consistency
- The password includes special characters for security
- Super Admin has full access to News, Careers, and User Management
- Regular Admin can only manage Bookings and view Careers
- Passwords are hashed with bcrypt for security
