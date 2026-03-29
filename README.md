# Proservis Expres — Site Backup

Backup of the WordPress site for **proservisexpres.cz** — an appliance repair service.

## Structure

```
site_backup/home/proserv5/public_html/
├── wp-content/
│   ├── themes/proservis-theme/   # Custom theme (Montserrat + Staatliches, no page builders)
│   ├── plugins/                  # Elementor, SiteSEO, GTranslate, Chaty, LiteSpeed Cache, etc.
│   └── languages/                # Russian (ru_RU) translations
└── …                             # Core WP files (excluded from git via .gitignore)
```

## What's Tracked

- Custom **Proservis** theme (`proservis-theme/`)
- Plugin files (Elementor, SiteSEO, SiteSEO Pro, GTranslate, Chaty, LiteSpeed Cache, Backuply, Nitropack, Akismet)
- Language files and translations
- Root WP config sample and `.htaccess`
- `site_backup.tar.gz` — full site archive (~89 MB)

## What's Ignored

- `wp-admin/`, `wp-includes/` (WordPress core)
- `wp-content/uploads/` (media files)
- `wp-config.php` (contains credentials)
- `.DS_Store` and IDE files
