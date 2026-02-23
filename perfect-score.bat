@echo off
echo ========================================
echo Mettacity Perfect Performance Score
echo ========================================
echo.

echo Step 1: Clearing all caches...
call php artisan optimize:clear
echo.

echo Step 2: Optimizing Laravel...
call php artisan optimize
echo.

echo Step 3: Checking current score...
call php artisan performance:check
echo.

echo ========================================
echo TO ACHIEVE PERFECT 10/10 SCORE:
echo ========================================
echo.

echo 1. DISABLE DEBUG MODE (Already done!)
echo    ✅ APP_DEBUG=false in .env
echo.

echo 2. OPTIMIZE IMAGES (59 images need optimization)
echo    Run: php artisan images:optimize
echo    Or manually: https://tinypng.com/
echo.

echo 3. ENABLE OPCACHE
echo    See: PHP_OPCACHE_SETUP.md
echo    Quick: Edit php.ini and enable opcache
echo.

echo ========================================
echo QUICK ACTIONS:
echo ========================================
echo.

set /p action="Choose action (1=Optimize Images, 2=Check Score, 3=Exit): "

if "%action%"=="1" (
    call php artisan images:optimize
) else if "%action%"=="2" (
    call php artisan performance:check
) else (
    echo Exiting...
)

echo.
pause
