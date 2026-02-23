@echo off
echo ========================================
echo Clearing All Caches
echo ========================================
echo.

echo [1/5] Clearing Laravel config cache...
php artisan config:clear

echo [2/5] Clearing Laravel cache...
php artisan cache:clear

echo [3/5] Clearing Laravel route cache...
php artisan route:clear

echo [4/5] Clearing Laravel view cache...
php artisan view:clear

echo [5/5] Clearing Laravel compiled files...
php artisan clear-compiled

echo.
echo ========================================
echo Cache Cleared Successfully!
echo ========================================
echo.
echo Now push changes to sync with Hostinger:
echo 1. Run sync-to-hostinger.bat
echo 2. Then clear browser cache (Ctrl+Shift+Delete)
echo.
pause
