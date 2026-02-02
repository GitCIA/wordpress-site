# Quick Git Reference for WordPress

## Local Development - Push to GitHub

```bash
# 1. FIRST TIME ONLY: Fix GitHub authentication
# Option A: SSH (Recommended)
ssh-keygen -t ed25519 -C "your-email@example.com"
# Add public key to: github.com/settings/keys

git remote remove origin
git remote add origin git@github.com:GitCIA/wordpress-site.git
git push -u origin master

# Option B: GitHub CLI
gh auth login
gh repo create wordpress-site --public --source=. --remote=origin --push

# Option C: Manual - create repo at github.com/new then:
git remote remove origin
git remote add origin https://github.com/GitCIA/wordpress-site.git
git push -u origin master
```

## Daily Workflow

```bash
# After making changes to theme/plugins:
git add .
git commit -m "Your descriptive message"
git push origin master

# Check status
git status

# View recent commits
git log --oneline -5

# See what changed
git diff

# Undo last commit (if not pushed)
git reset --soft HEAD~1
```

## Hosting Server Setup (34sp.com)

```bash
# SSH into hosting
ssh user@34sp.com
cd /path/to/wordpress

# FIRST TIME: Initialize git
git init
git config user.email "admin@34sp.com"
git config user.name "Hosting Admin"

# Add GitHub remote
git remote add origin git@github.com:GitCIA/wordpress-site.git
# OR with token:
# git remote add origin https://GitCIA:<token>@github.com/GitCIA/wordpress-site.git

# Pull code from GitHub
git fetch origin
git checkout -b master origin/master
# (or: git checkout -b main origin/main if using main branch)

# Set permissions
chmod -R 755 wp-content/
find wp-content -type f -exec chmod 644 {} \;

# Update WordPress database
wp core update-db

# Add deployment script to crontab (auto-pull every 15 minutes)
crontab -e
# Add this line:
# */15 * * * * /path/to/deploy.sh >> /var/log/wordpress-deploy.log 2>&1
```

## Keeping Both in Sync

```bash
# From LOCAL:
git add .
git commit -m "Your changes"
git push origin master

# From HOSTING (automatic via cron or manual):
git pull origin master
wp core update-db
# Clear cache if applicable:
wp w3-total-cache flush all
```

## Common Scenarios

### Undo local changes (not committed)
```bash
git restore .
# or
git checkout -- .
```

### Undo last commit (not pushed)
```bash
git reset --soft HEAD~1
```

### See what will be committed
```bash
git status
```

### Commit only specific files
```bash
git add path/to/file.php
git add wp-content/plugins/my-plugin/
git commit -m "Updated my plugin"
```

### Create feature branch
```bash
git checkout -b feature/new-theme-section
# Make changes
git commit -m "Added new section"
git push origin feature/new-theme-section
# On GitHub: create Pull Request
# After review and merge to master:
git checkout master
git pull origin master
```

### Update WordPress core
```bash
wp core download  # or manual download
wp core update
wp core update-db

# Commit config changes if needed
git add wp-config.php
git commit -m "Updated WordPress to X.X.X"
git push origin master
```

## Important Rules

✅ DO:
- Commit theme changes from `wp-content/themes/`
- Commit plugin changes from `wp-content/plugins/`
- Commit `wp-config.php` if structure changes (but not credentials)
- Use clear, descriptive commit messages
- Push regularly

❌ DON'T:
- Commit `/wp/` directory (WordPress core)
- Commit `wp-config.php` with real database credentials
- Commit `/wp-content/uploads/` (user media)
- Commit `/wp-content/cache/` (temporary files)
- Commit `.env` with real passwords
- Force push to master without good reason

## Troubleshooting

### Push fails with authentication error
```bash
# Check remote
git remote -v

# For SSH: Verify SSH key is added to GitHub
ssh -T git@github.com

# For HTTPS: Use GitHub token, not password
# Get token from: github.com/settings/tokens
```

### Large file error
```bash
# If you accidentally committed large file:
git rm --cached path/to/large/file
echo "path/to/large/file" >> .gitignore
git commit -m "Remove large file and add to gitignore"
git push
```

### Hosting out of sync with GitHub
```bash
# On hosting server
cd /path/to/wordpress
git fetch origin
git status  # check what differs
git reset --hard origin/master  # CAREFUL: overwrites local
```

---

**Need more help?** See full documentation in:
- `GIT_SETUP.md` - Complete setup guide
- `SETUP_COMPLETE.md` - Project overview
- `README.md` - Basic structure
