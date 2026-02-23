@echo off
echo ========================================
echo Syncing Changes to GitHub and Hostinger
echo ========================================
echo.

REM Add all changes
echo [1/4] Adding changes...
git add .

REM Check if there are changes to commit
git diff-index --quiet HEAD
if %errorlevel% equ 0 (
    echo No changes to commit.
    pause
    exit /b 0
)

REM Commit with timestamp
echo [2/4] Committing changes...
for /f "tokens=2-4 delims=/ " %%a in ('date /t') do (set mydate=%%c-%%a-%%b)
for /f "tokens=1-2 delims=/:" %%a in ('time /t') do (set mytime=%%a:%%b)
git commit -m "Update: %mydate% %mytime%"

REM Push to GitHub
echo [3/4] Pushing to GitHub...
git push origin main

REM Check webhook status
echo [4/4] Changes pushed! Webhook will auto-deploy to Hostinger.
echo.
echo Check deployment status at: https://mettacity.com.ph/deploy.php
echo View deployment log at: public_html/deploy.log
echo.
echo ========================================
echo Sync Complete!
echo ========================================
pause
