# Technology Stack

**Analysis Date:** 2026-04-09

## Languages

**Primary:**
- PHP - All plugin logic, class files, admin partials

**Secondary:**
- JavaScript - Admin UI interactions (`admin/js/admin.js`)
- CSS - Admin styling (`admin/css/admin.css`)

## Runtime

**Environment:**
- WordPress plugin (requires WordPress 5.0+)
- PHP (version not explicitly declared; compatible with WordPress 5.0+ minimum)

**Package Manager:**
- None — no Composer, no npm. No lockfile present.

## Frameworks

**Core:**
- WordPress Plugin API - Hooks, options API, cron, rewrite rules, transients

**Build/Dev:**
- None detected — no build pipeline, bundler, or task runner

## Key Dependencies

**Critical:**
- WordPress core — all functionality depends on WP APIs (options, cron, transients, rewrite, `wp_remote_get`)
- No third-party PHP libraries or Composer packages

**Infrastructure:**
- WordPress Options API — all data persistence (`shopping_list_always_include`, `shopping_list_not_needed`, `shopping_list_random_items`, `shopping_list_current_selection`)
- WordPress Cron (`wp-cron`) — weekly list regeneration via `shopping_list_weekly_regenerate` event
- WordPress Transients — GitHub release check cached for 12 hours (`shopping_list_github_release`)

## Configuration

**Environment:**
- No `.env` file — configuration is entirely via WordPress options and plugin constants
- Key constants defined in `shopping-list.php`:
  - `SHOPPING_LIST_VERSION` — plugin version string
  - `SHOPPING_LIST_PLUGIN_DIR` — absolute path to plugin directory
  - `SHOPPING_LIST_PLUGIN_URL` — URL to plugin directory
  - `SHOPPING_LIST_GITHUB_REPO` — GitHub repo slug for update checks (`aidanashby/shopping-list`)

**Build:**
- No build config files present

## Plugin Structure

**Entry point:** `shopping-list.php`

**Class files (all in `includes/`):**
- `class-shopping-list.php` — main plugin bootstrapper
- `class-shopping-list-database.php` — WordPress options read/write, list generation logic
- `class-shopping-list-cron.php` — WP Cron scheduling for weekly regeneration
- `class-shopping-list-rss.php` — on-demand RSS 2.0 feed generation at `/shopping-list-feed.rss`
- `class-shopping-list-updater.php` — GitHub Releases API update checker
- `class-shopping-list-admin.php` — admin UI registration
- `class-shopping-list-frontend.php` — frontend display

**Admin assets:**
- `admin/css/admin.css`
- `admin/js/admin.js`
- `admin/partials/admin-display.php`

## Platform Requirements

**Development:**
- Local WordPress installation (project owner uses `C:\Users\aidan\Studio\divi-5`)
- PHP with WordPress loaded

**Production:**
- WordPress 5.0+ hosted environment (Krystal shared hosting per platform docs)
- WP Cron must be active for weekly regeneration to fire

---

*Stack analysis: 2026-04-09*
