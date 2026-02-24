#!/bin/bash
# Fix Storage Symlink Script

PROJECT_PATH="/home/u553953718/domains/mettacity.com.ph/public_html/mettacityv2"

echo "Fixing storage symlink..."
echo ""

# Remove existing symlink if it exists
if [ -L "$PROJECT_PATH/public/storage" ]; then
    echo "Removing existing symlink..."
    rm "$PROJECT_PATH/public/storage"
    echo "✓ Removed"
fi

# Remove if it's a directory (shouldn't be, but just in case)
if [ -d "$PROJECT_PATH/public/storage" ] && [ ! -L "$PROJECT_PATH/public/storage" ]; then
    echo "Warning: 'storage' is a directory, not a symlink. Removing..."
    rm -rf "$PROJECT_PATH/public/storage"
    echo "✓ Removed"
fi

# Create the symlink
echo "Creating new symlink..."
ln -s "$PROJECT_PATH/storage/app/public" "$PROJECT_PATH/public/storage"

if [ -L "$PROJECT_PATH/public/storage" ]; then
    echo "✓ Symlink created successfully!"
    echo ""
    echo "Symlink details:"
    ls -l "$PROJECT_PATH/public/storage"
    echo ""
    echo "Target directory contents:"
    ls -la "$PROJECT_PATH/storage/app/public/"
else
    echo "✗ Failed to create symlink"
fi
