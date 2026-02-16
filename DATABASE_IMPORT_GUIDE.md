# Mettacity Database Import Guide

## Database Structure

This database includes the following tables:
- **users** - Admin and user accounts
- **news** - News articles management
- **careers** - Job postings
- **bookings** - Customer bookings
- **visits** - Website visit tracking
- **cache** - Application cache
- **jobs** - Queue jobs
- **migrations** - Migration history
- **sessions** - User sessions

## Import Methods

### Method 1: Using phpMyAdmin
1. Open phpMyAdmin in your browser
2. Create a new database named `mettacity`
3. Select the database
4. Click on "Import" tab
5. Choose the `mettacity_database.sql` file
6. Click "Go" to import

### Method 2: Using MySQL Command Line
```bash
# Create database
mysql -u root -p -e "CREATE DATABASE mettacity CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# Import SQL file
mysql -u root -p mettacity < mettacity_database.sql
```

### Method 3: Using Laravel Migrations (Recommended)
```bash
# Run migrations
php artisan migrate

# Seed admin accounts
php artisan db:seed --class=SuperAdminSeeder
php artisan db:seed --class=AdminUserSeeder
```

## Admin Accounts

After importing, you can login with these credentials:

### Regular Admin
- **Email:** admin@mettacity.com
- **Password:** admin123
- **Access:** Dashboard, Bookings, View Careers

### Super Admin
- **Email:** superadmin@mettacity.com
- **Password:** superadmin123
- **Access:** Full access (News, Careers, Users, Bookings)

## Environment Configuration

Make sure your `.env` file has the correct database settings:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mettacity
DB_USERNAME=root
DB_PASSWORD=your_password

APP_TIMEZONE=Asia/Manila
```

## Post-Import Steps

1. **Clear cache:**
   ```bash
   php artisan cache:clear
   php artisan config:clear
   php artisan view:clear
   ```

2. **Create storage link:**
   ```bash
   php artisan storage:link
   ```

3. **Set permissions (Linux/Mac):**
   ```bash
   chmod -R 775 storage bootstrap/cache
   ```

4. **Test the application:**
   ```bash
   php artisan serve
   ```
   Visit: http://127.0.0.1:8000

5. **Login to admin:**
   Visit: http://127.0.0.1:8000/admin/login

## Database Tables Overview

### users
- Stores admin and user accounts
- Fields: id, name, email, password, is_admin, is_super_admin

### news
- News articles for the website
- Fields: id, title, excerpt, content, image, published_date, facebook_link, is_active

### careers
- Job postings
- Fields: id, title, description, location, type, image, is_active

### bookings
- Customer booking requests
- Fields: id, name, email, phone, date, number_of_guests, message, status

### visits
- Website visit tracking
- Fields: id, ip_address, user_agent, page, visited_at

## Troubleshooting

### Error: "Access denied for user"
- Check your database credentials in `.env`
- Make sure MySQL service is running

### Error: "Database does not exist"
- Create the database first: `CREATE DATABASE mettacity;`

### Error: "Table already exists"
- Drop existing tables or use a fresh database
- Or run: `php artisan migrate:fresh`

### Password not working
- Passwords are hashed with bcrypt
- Default passwords: admin123 / superadmin123
- To reset: Use `php artisan tinker` and run:
  ```php
  $user = User::where('email', 'admin@mettacity.com')->first();
  $user->password = Hash::make('newpassword');
  $user->save();
  ```

## Backup Database

To backup your database:

```bash
# Using mysqldump
mysqldump -u root -p mettacity > backup_$(date +%Y%m%d).sql

# Using Laravel
php artisan db:backup
```

## Support

For issues or questions, refer to:
- Laravel Documentation: https://laravel.com/docs
- MySQL Documentation: https://dev.mysql.com/doc/
