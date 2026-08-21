# Architecture

**Analysis Date:** 2026-04-09

## Pattern Overview

**Overall:** WordPress plugin using a class-per-concern OOP pattern with a central orchestrator class.

**Key Characteristics:**
- Single plugin entry point delegates to a coordinator class (`Shopping_List`) that wires all other classes together via WordPress hooks
- All data stored exclusively in the WordPress options table (no custom DB tables)
- Stateless static methods on `Shopping_List_Database` act as the data access layer, callable from any class
- Frontend output is purely shortcode-based — no page templates or REST endpoints

## Layers

**Entry Point / Bootstrap:**
- Purpose: Register WordPress hooks, define constants, bootstrap the plugin
- Location: `shopping-list.php`
- Contains: Plugin header, constants, activation/deactivation hooks, `run_shopping_list()` loader, RSS init hook
- Depends on: All `includes/` classes (loaded on demand)
- Used by: WordPress core

**Coordinator:**
- Purpose: Wire all subsystems together via WordPress action/filter hooks
- Location: `includes/class-shopping-list.php`
- Contains: `Shopping_List` class with `load_dependencies()`, `define_admin_hooks()`, `define_public_hooks()`, `define_cron_hooks()`, `define_update_hooks()`
- Depends on: All other classes in `includes/`
- Used by: `shopping-list.php` via `run_shopping_list()`

**Data Layer:**
- Purpose: All read/write operations against WordPress options; list generation logic
- Location: `includes/class-shopping-list-database.php`
- Contains: `Shopping_List_Database` — entirely static methods
- Depends on: WordPress options API (`get_option`, `update_option`, `add_option`)
- Used by: Admin, Frontend, Cron, RSS classes

**Admin Layer:**
- Purpose: WordPress admin UI, settings registration, form processing, social media copy generation
- Location: `includes/class-shopping-list-admin.php`, `admin/partials/admin-display.php`, `admin/css/admin.css`, `admin/js/admin.js`
- Contains: `Shopping_List_Admin` class; template partial for the settings page
- Depends on: `Shopping_List_Database` (static calls), WordPress Settings API
- Used by: WordPress `admin_menu`, `admin_init`, `admin_enqueue_scripts` hooks

**Frontend Layer:**
- Purpose: Render shortcodes on public-facing pages
- Location: `includes/class-shopping-list-frontend.php`
- Contains: `Shopping_List_Frontend` — `display_shopping_list()` and `display_not_needed_list()`
- Depends on: `Shopping_List_Database` (static calls)
- Used by: WordPress shortcode system (`[shop_list]`, `[noshop_list]`)

**Automation Layer:**
- Purpose: Schedule and execute weekly list regeneration
- Location: `includes/class-shopping-list-cron.php`
- Contains: `Shopping_List_Cron` — schedule, clear, and execute cron events
- Depends on: `Shopping_List_Database::generate_random_selection()`
- Used by: WordPress cron hook `shopping_list_weekly_regenerate`

**RSS Layer:**
- Purpose: Serve an on-demand RSS feed of the current shopping list
- Location: `includes/class-shopping-list-rss.php`
- Contains: `Shopping_List_RSS` — rewrite rules, query var registration, feed generation
- Depends on: `Shopping_List_Database::get_current_selection()`
- Used by: WordPress `init` and `template_redirect` hooks; feed URL `/shopping-list-feed.rss`

**Updater Layer:**
- Purpose: Self-update the plugin from GitHub releases via the WordPress plugin update mechanism
- Location: `includes/class-shopping-list-updater.php`
- Contains: `Shopping_List_Updater` — hooks into `pre_set_site_transient_update_plugins`, `plugins_api`, `upgrader_post_install`
- Depends on: GitHub API (`https://api.github.com/repos/aidanashby/shopping-list/releases/latest`), WordPress HTTP API
- Used by: WordPress update system

## Data Flow

**Weekly List Generation:**
1. `Shopping_List_Cron::regenerate_list()` fires on `shopping_list_weekly_regenerate` cron event (Mondays 6 AM)
2. Calls `Shopping_List_Database::generate_random_selection()`
3. Reads `shopping_list_always_include`, `shopping_list_random_items`, `shopping_list_not_needed` from options
4. Builds selection: always-include items first (up to 8 total), remainder filled from one random item per row of the 40×4 random item matrix, excluding not-needed items
5. Writes result to `shopping_list_current_selection` option

**Admin Save → Immediate Regeneration:**
1. Admin submits settings form (POST with nonce)
2. `Shopping_List_Admin::process_form_submission()` sanitises and calls `Shopping_List_Database::update_*` methods
3. On any update, `Shopping_List_Database::generate_random_selection()` runs immediately
4. New selection stored to options; settings error/success notice displayed

**Frontend Display:**
1. WordPress encounters `[shop_list]` or `[noshop_list]` shortcode
2. `Shopping_List_Frontend` reads `shopping_list_current_selection` or `shopping_list_not_needed` from options
3. Returns escaped HTML string (no template files — inline HTML construction)

**RSS Feed:**
1. Request arrives at `/shopping-list-feed.rss`
2. WordPress rewrite rule maps to `?shopping_list_rss=1`
3. `Shopping_List_RSS::handle_rss_request()` fires on `template_redirect`
4. Reads `shopping_list_current_selection`, outputs RSS XML directly and exits

**State Management:**
- All state stored in WordPress options table under four keys:
  - `shopping_list_always_include` — array of 8 strings
  - `shopping_list_not_needed` — array of 8 strings
  - `shopping_list_random_items` — 40×4 array of strings
  - `shopping_list_current_selection` — array of up to 8 strings (the active list)
- No transients used for list data; GitHub release check cached in `shopping_list_github_release` site transient (12 hours)

## Key Abstractions

**Shopping_List_Database:**
- Purpose: Single source of truth for all data access — all other classes call this, never options API directly
- Location: `includes/class-shopping-list-database.php`
- Pattern: Static utility class (no instantiation); all methods are `public static`

**Shopping_List (Coordinator):**
- Purpose: Wires subsystems to WordPress hooks; nothing else
- Location: `includes/class-shopping-list.php`
- Pattern: Coordinator/bootstrapper — instantiates other classes and registers hook callbacks

## Entry Points

**Plugin Bootstrap:**
- Location: `shopping-list.php`
- Triggers: WordPress `plugins_loaded` action
- Responsibilities: Define constants, register activation/deactivation hooks, call `run_shopping_list()`

**Activation:**
- Location: `shopping-list.php` → `activate_shopping_list()`
- Triggers: Plugin activation in wp-admin
- Responsibilities: Create default options, schedule cron, generate initial list, flush rewrite rules

**Deactivation:**
- Location: `shopping-list.php` → `deactivate_shopping_list()`
- Triggers: Plugin deactivation in wp-admin
- Responsibilities: Clear scheduled cron events

**Uninstall:**
- Location: `uninstall.php`
- Triggers: Plugin deletion in wp-admin
- Responsibilities: Remove all four options, clear cron, flush object cache

## Error Handling

**Strategy:** Minimal — relies on WordPress built-in sanitisation and options API return values.

**Patterns:**
- Direct access blocked with `if (!defined('ABSPATH')) exit` in all PHP files
- Nonce verification on admin form submission (`check_admin_referer`)
- Capability check (`current_user_can('manage_options')`) before admin page render
- Output escaped with `esc_html()` and `esc_attr()` throughout
- GitHub API errors return `null`; caller silently skips update
- Cron regeneration logs completion via `error_log()`

## Cross-Cutting Concerns

**Logging:** `error_log()` only — used in `Shopping_List_Cron::regenerate_list()` for cron completion
**Validation:** Input sanitised via `sanitize_text_field()` in `Shopping_List_Database::update_*` methods; arrays padded/sliced to fixed sizes
**Authentication:** WordPress `manage_options` capability gate on all admin operations

---

*Architecture analysis: 2026-04-09*
