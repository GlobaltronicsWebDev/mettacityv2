@echo off
echo ========================================
echo Mettacity Image Optimization Script
echo ========================================
echo.

echo This script will help you optimize images for better performance.
echo.
echo RECOMMENDED TOOLS:
echo.
echo 1. TinyPNG (Online - Free)
echo    https://tinypng.com/
echo    - Drag and drop up to 20 images
echo    - Reduces file size by 50-80%%
echo.
echo 2. ImageOptim (Mac)
echo    https://imageoptim.com/
echo.
echo 3. RIOT (Windows)
echo    https://riot-optimizer.com/
echo.
echo 4. Squoosh (Online - Free)
echo    https://squoosh.app/
echo.
echo ========================================
echo CURRENT STATUS:
echo ========================================
echo.

cd public\assets

echo Checking image sizes...
echo.

for %%f in (*.png *.jpg *.jpeg) do (
    if %%~zf GTR 500000 (
        echo [LARGE] %%f - %%~zf bytes
    )
)

echo.
echo ========================================
echo OPTIMIZATION STEPS:
echo ========================================
echo.
echo 1. Go to https://tinypng.com/
echo 2. Upload images from public/assets folder
echo 3. Download optimized images
echo 4. Replace original files
echo 5. Run: php artisan performance:check
echo.
echo Press any key to open TinyPNG in browser...
pause > nul

start https://tinypng.com/

echo.
echo After optimizing, run: php artisan performance:check
echo.
pause
