#!/bin/bash

# Default values
DEFAULT_PROJECT_DIR="/home/k1host/web/app.kia-mall.com/public_html"
DEFAULT_BRANCH="main"
DEFAULT_WEB_USER="k1host"

# Ask for inputs or use defaults
read -p "Enter project directory (default: $DEFAULT_PROJECT_DIR): " PROJECT_DIR
PROJECT_DIR=${PROJECT_DIR:-$DEFAULT_PROJECT_DIR}

read -p "Enter branch name (default: $DEFAULT_BRANCH): " BRANCH
BRANCH=${BRANCH:-$DEFAULT_BRANCH}

read -p "Enter web user (default: $DEFAULT_WEB_USER): " WEB_USER
WEB_USER=${WEB_USER:-$DEFAULT_WEB_USER}

# Exit immediately if a command exits with a non-zero status
set -e

echo "Starting deployment process..."
echo "Using project directory: $PROJECT_DIR"
echo "Using branch: $BRANCH"
echo "Using web user: $WEB_USER"

# Navigate to the project directory
cd "$PROJECT_DIR"

# Fetch and reset the latest changes from Git
echo "Fetching and resetting to the latest changes from Git..."
git fetch origin
git reset --hard origin/$BRANCH
git clean -fd

# Set correct ownership
echo "Setting correct ownership..."
sudo chown -R $WEB_USER:$WEB_USER "$PROJECT_DIR"

# Set correct permissions
echo "Setting correct permissions..."
sudo chmod -R 775 "$PROJECT_DIR/storage"
sudo chmod -R 775 "$PROJECT_DIR/bootstrap/cache"

# Install PHP dependencies
echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

# Clear and cache configurations
echo "Clearing and caching Laravel configurations..."
php artisan cache:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Install Node.js dependencies
echo "Installing Node.js dependencies..."
npm install

# Build frontend assets
echo "Building frontend assets..."
npm run build

# Finalize deployment
echo "Deployment completed successfully!"
