# WordPress Site Repository

This repository contains the WordPress site configuration, custom plugins, and themes.

## Structure

- **wp-content/plugins/** - Custom and third-party plugins
- **wp-content/themes/** - Custom and third-party themes
- **wp-content/mu-plugins/** - Must-use plugins (if applicable)
- **index.php** - Front-end entry point
- **wp-config.php** - NOT tracked (see .gitignore)
- **wp/** - WordPress core (NOT tracked, install separately)

## Setup Instructions

### Local Development

1. Clone this repository
2. Install WordPress core: `wp core download` (using WP-CLI)
3. Configure `wp-config.php` based on your environment
4. Update database configuration
5. Import database or run WordPress setup

### Deployment to Hosting

1. Pull latest changes from git
2. Install/update plugins and themes: `composer install` (if applicable)
3. Run any migrations or database updates

## Environment Configuration

Create a local `wp-config.php` from `wp-config-sample.php`:
```bash
cp wp/wp-config-sample.php wp-config.php
```

Configure database credentials and other environment-specific settings.

## Syncing with Hosting

The hosting server (34sp.com) is configured to pull from this GitHub repository. To deploy:

```bash
# From hosting server
cd /path/to/wordpress
git pull origin main
```

## WordPress Core Updates

WordPress core should be updated separately via WP-CLI:

```bash
wp core update
wp core update-db
```

Then commit any necessary configuration changes to this repo.
