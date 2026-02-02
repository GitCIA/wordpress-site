#!/bin/bash
# WordPress Auto-Deploy Script
# Place this on hosting server and add to crontab
# Usage: */15 * * * * /path/to/deploy.sh >> /var/log/wordpress-deploy.log 2>&1

set -e

# Configuration
WORDPRESS_PATH="/home/user/public_html/wordpress"
LOG_FILE="/var/log/wordpress-deploy.log"
GIT_BRANCH="master"

# Logging function
log() {
    echo "[$(date +'%Y-%m-%d %H:%M:%S')] $1" >> "$LOG_FILE"
}

log "Starting WordPress deployment..."

# Navigate to WordPress directory
cd "$WORDPRESS_PATH" || exit 1

# Check if git is initialized
if [ ! -d .git ]; then
    log "ERROR: Git repository not found in $WORDPRESS_PATH"
    exit 1
fi

# Fetch latest changes from remote
git fetch origin

# Check if there are changes to pull
CURRENT=$(git rev-parse HEAD)
LATEST=$(git rev-parse origin/$GIT_BRANCH)

if [ "$CURRENT" != "$LATEST" ]; then
    log "Updates found, deploying..."
    
    # Reset to latest version
    git reset --hard origin/$GIT_BRANCH
    
    # Set correct permissions
    find wp-content -type d -exec chmod 755 {} \;
    find wp-content -type f -exec chmod 644 {} \;
    
    # Update WordPress database
    if command -v wp &> /dev/null; then
        wp core update-db --allow-root
        log "Database updated successfully"
    else
        log "WARNING: wp-cli not found, skipping database update"
    fi
    
    # Clear cache (if using W3 Total Cache or similar)
    if [ -d wp-content/plugins/w3-total-cache ]; then
        wp w3-total-cache flush all --allow-root 2>/dev/null || true
        log "W3 Total Cache cleared"
    fi
    
    log "Deployment completed successfully"
else
    log "No changes detected"
fi

exit 0
