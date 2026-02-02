# WordPress Git Setup Guide

## Status: Local Repository Ready ✓

Your local WordPress repository has been initialized with:
- ✓ Git repository initialized
- ✓ Proper `.gitignore` configured for WordPress
- ✓ Initial commit created (651e6dc)
- ✓ Remote origin configured: `github.com/GitCIA/wordpress-site.git`
- ✓ README.md documentation created

## What's Tracked vs Excluded

### Included in Git ✓
- `wp-content/` - Your themes and plugins (e.g., creative-garden-redesign)
- `index.php` - Frontend entry point
- `wp-load.php` - WordPress loader
- `wp-cli.yml` - WP-CLI configuration
- `.gitignore` - Git configuration
- `README.md` - Documentation

### Excluded from Git (per .gitignore) ✗
- `/wp/` - WordPress core (manage separately via composer/WP-CLI)
- `wp-config.php` - Sensitive database credentials
- `/wp-content/uploads/` - User uploaded media
- `/wp-content/cache/` - Cache files
- `/vendor/` - Composer dependencies
- Various temp/log files

## Next Steps: Complete GitHub Integration

### Option 1: Using SSH Key (Recommended)

1. **Generate SSH Key** (if you don't have one):
```bash
ssh-keygen -t ed25519 -C "your-email@example.com"
```

2. **Add SSH key to GitHub**:
   - Go to https://github.com/settings/keys
   - Click "New SSH key"
   - Paste your public key content

3. **Update remote to use SSH**:
```bash
cd /path/to/wordpress
git remote remove origin
git remote add origin git@github.com:GitCIA/wordpress-site.git
```

4. **Push to GitHub**:
```bash
git push -u origin master
```

### Option 2: Using GitHub CLI (Easiest)

1. **Install GitHub CLI**: https://cli.github.com/
2. **Authenticate**:
```bash
gh auth login
# Follow the prompts
```

3. **Create repository and push**:
```bash
cd /path/to/wordpress
gh repo create wordpress-site --public --source=. --remote=origin --push
```

### Option 3: Create Repository Manually

1. Go to https://github.com/new
2. Create repository named: `wordpress-site`
3. Run these commands:
```bash
cd /path/to/wordpress
git remote remove origin
git remote add origin https://github.com/GitCIA/wordpress-site.git
git branch -M main
git push -u origin main
```

---

## Setting Up Hosting Server (34sp.com)

Once GitHub repo is created and pushed, configure your hosting server:

### On Hosting Server

1. **SSH into hosting**:
```bash
ssh user@34sp.com
cd /path/to/wordpress
```

2. **Initialize git (if not already done)**:
```bash
git init
git config user.email "admin@34sp.com"
git config user.name "Hosting Admin"
```

3. **Add GitHub remote**:
```bash
# Option A: Using SSH (requires key setup)
git remote add origin git@github.com:GitCIA/wordpress-site.git

# Option B: Using token (less secure, use GitHub App tokens)
git remote add origin https://GitCIA:<token>@github.com/GitCIA/wordpress-site.git
```

4. **Pull codebase from GitHub**:
```bash
git fetch origin
git checkout -b master origin/master
# OR if using main branch:
git checkout -b main origin/main
```

5. **Set up auto-deployment (optional)**:
Create a post-receive hook to auto-pull on every push. Contact 34sp.com support for webhook setup or use a cron job:

```bash
# Create a deployment script at /home/user/deploy.sh
#!/bin/bash
cd /path/to/wordpress
git fetch origin
git reset --hard origin/master
# Run any post-deployment commands
wp core update-db
chmod -R 755 wp-content/
```

6. **Schedule the deployment script**:
```bash
# Run every 15 minutes
*/15 * * * * /home/user/deploy.sh >> /var/log/wordpress-deploy.log 2>&1
```

---

## Workflow: Local Development & Hosting Sync

### When You Make Changes Locally

1. **Make changes and commit**:
```bash
cd /path/to/local/wordpress
git add .
git commit -m "Your descriptive message"
```

2. **Push to GitHub**:
```bash
git push origin master
```

3. **Hosting server automatically pulls** (via cron or webhook)

### Common Git Commands

```bash
# Check status
git status

# View commit history
git log --oneline -10

# See what changed
git diff

# Create a feature branch
git checkout -b feature/my-feature

# Switch back to master
git checkout master

# Merge feature branch
git merge feature/my-feature

# View all branches
git branch -a
```

---

## Recommendations

1. **Use SSH Authentication** for both local and hosting for better security
2. **Create GitHub Deploy Keys** for hosting if you want restricted access
3. **Use Protected Branches** on GitHub to require reviews before merge
4. **Tag Releases**:
```bash
git tag v1.0.0
git push origin --tags
```

5. **WordPress Core Management**:
```bash
# Keep WordPress core updated separately
wp core update
wp core update-db
# Then commit any config changes if needed
git add wp-config.php
git commit -m "Updated WordPress core to [version]"
```

---

## Current Setup Summary

```
Local Repository
├── .git/
├── .gitignore (configured)
├── README.md
├── index.php
├── wp-load.php
├── wp-cli.yml
├── wp-content/
│   ├── plugins/
│   ├── themes/
│   │   └── creative-garden-redesign/ (tracked ✓)
│   └── uploads/ (ignored ✗)
└── wp/ (ignored, install separately ✗)

Remote: origin (github.com/GitCIA/wordpress-site.git)
Branch: master
Status: Ready to push ✓
```

---

## Support & References

- WordPress & Git Best Practices: https://www.digitalocean.com/community/tutorials/how-to-use-git-to-manage-your-user-data-on-a-vps
- GitHub Documentation: https://docs.github.com/
- WP-CLI Documentation: https://developer.wordpress.org/cli/
- 34sp.com Support: Contact your hosting provider for SSH/git access setup
