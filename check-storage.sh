#!/bin/bash
# Storage Diagnostic Script for Mettacity

echo "========================================="
echo "Storage Diagnostic Check"
echo "========================================="
echo ""

PROJECT_PATH="/home/u553953718/domains/mettacity.com.ph/public_html/mettacityv2"

echo "1. Checking symlink..."
if [ -L "$PROJECT_PATH/public/storage" ]; then
    echo "✓ Symlink exists"
    echo "  Target: $(readlink $PROJECT_PATH/public/storage)"
else
    echo "✗ Symlink does NOT exist"
fi
echo ""

echo "2. Checking storage directories..."
if [ -d "$PROJECT_PATH/storage/app/public" ]; then
    echo "✓ storage/app/public exists"
else
    echo "✗ storage/app/public does NOT exist"
fi

if [ -d "$PROJECT_PATH/storage/app/public/news" ]; then
    echo "✓ storage/app/public/news exists"
    echo "  Files in news directory:"
    ls -lh "$PROJECT_PATH/storage/app/public/news" 2>/dev/null || echo "  (empty)"
else
    echo "✗ storage/app/public/news does NOT exist"
fi
echo ""

echo "3. Checking permissions..."
echo "storage/app/public permissions:"
ls -ld "$PROJECT_PATH/storage/app/public" 2>/dev/null || echo "  Directory not found"

if [ -d "$PROJECT_PATH/storage/app/public/news" ]; then
    echo "storage/app/public/news permissions:"
    ls -ld "$PROJECT_PATH/storage/app/public/news"
fi

echo "public/storage permissions:"
ls -ld "$PROJECT_PATH/public/storage" 2>/dev/null || echo "  Symlink not found"
echo ""

echo "4. Testing web access..."
echo "Try accessing: https://mettacity.com.ph/storage/news/"
echo ""

echo "5. Checking .htaccess..."
if [ -f "$PROJECT_PATH/public/.htaccess" ]; then
    echo "✓ .htaccess exists"
    echo "Checking for storage restrictions..."
    grep -i "storage" "$PROJECT_PATH/public/.htaccess" || echo "  No storage restrictions found"
else
    echo "✗ .htaccess not found"
fi
echo ""

echo "========================================="
echo "Diagnostic Complete"
echo "========================================="
