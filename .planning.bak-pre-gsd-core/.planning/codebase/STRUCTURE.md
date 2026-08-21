# Codebase Structure

**Analysis Date:** 2026-04-09

## Directory Layout

```
shopping-list/
├── shopping-list.php          # Plugin entry point, constants, activation hooks
├── uninstall.php              # Cleanup on plugin deletion
├── licence                    # Licence file
├── includes/                  # All PHP classes (business logic)
│   ├── class-shopping-list.php               # Coordinator/bootstrapper
│   ├── class-shopping-list-admin.php         # Admin UI and form handling
│   ├── class-shopping-list-database.php      # Data access (static methods)
│   ├── class-shopping-list-frontend.php      # Shortcode rendering
│   ├── class-shopping-list-cron.php          # Scheduled task management
│   ├── class-shopping-list-rss.php           # RSS feed generation
│   └── class-shopping-list-updater.php       # GitHub-based auto-updater
├── admin/                     # Admin-only assets and templates
│   ├── css/
│   │   └── admin.css          # Admin page styles
│   ├── js/
│   │   └── admin.js           # Admin page JS (clipboard copy)
│   └── partials/
│       └── admin-display.php  # Admin settings page template
└── .planning/                 # GSD planning directory (not part of plugin)
    └── codebase/              # Codebase analysis documents
```

## Directory Purposes

**`includes/`:**
- Purpose: All plugin PHP classes — one file per class
- Contains: Business logic, data access, WordPress hook registration, external integrations
- Key files: `class-shopping-list.php` (coordinator), `class-shopping-list-database.php` (all data ops)

**`admin/`:**
- Purpose: Assets and templates used exclusively in the WordPress admin
- Contains: CSS, JS, and PHP partials for the settings page
- Key files: `admin/partials/admin-display.php` (settings page HTML), `admin/js/admin.js` (clipboard copy functionality)

**`admin/css/`:**
- Purpose: Stylesheets enqueued only on the plugin's admin page
- Generated: No
- Committed: Yes

**`admin/js/`:**
- Purpose: Scripts enqueued only on the plugin's admin page
- Generated: No
- Committed: Yes

**`admin/partials/`:**
- Purpose: PHP template files included by `Shopping_List_Admin::display_admin_page()`
- Note: Templates access data by calling `Shopping_List_Database` static methods directly at the top of the file, then render HTML

## Key File Locations

**Entry Points:**
- `shopping-list.php`: Plugin bootstrap, constants, activation/deactivation/RSS hooks

**Core Logic:**
- `includes/class-shopping-list-database.php`: All data read/write and list generation algorithm
- `includes/class-shopping-list.php`: Hook registration and class wiring

**Admin UI:**
- `includes/class-shopping-list-admin.php`: Form handling, settings registration, social copy formatting
- `admin/partials/admin-display.php`: Settings page HTML template

**Frontend Output:**
- `includes/class-shopping-list-frontend.php`: Shortcode handlers `[shop_list]` and `[noshop_list]`

**Automation:**
- `includes/class-shopping-list-cron.php`: WP-Cron scheduling and execution

**External Feed:**
- `includes/class-shopping-list-rss.php`: RSS feed at `/shopping-list-feed.rss`

**Plugin Lifecycle:**
- `uninstall.php`: Data cleanup on deletion

## Naming Conventions

**Files:**
- All class files: `class-{plugin-slug}-{concern}.php` in `includes/`
- Example: `class-shopping-list-database.php`
- Admin template partials: descriptive name, no class prefix — e.g., `admin-display.php`

**Classes:**
- PascalCase with underscore separators matching file name: `Shopping_List_Database`, `Shopping_List_Admin`
- Prefix all class names with `Shopping_List_` to avoid namespace collisions

**WordPress Options Keys:**
- Prefix: `shopping_list_`
- Pattern: `shopping_list_{descriptor}` — e.g., `shopping_list_always_include`, `shopping_list_current_selection`

**WordPress Hook Names:**
- Custom cron event: `shopping_list_weekly_regenerate`
- Settings group: `shopping_list_settings`
- Nonce: `shopping_list_settings` / `shopping_list_nonce`

**CSS/JS handles:**
- Enqueued using `$this->plugin_name` which resolves to `'shopping-list'`

## Where to Add New Code

**New data operation (read or write):**
- Add a `public static` method to `includes/class-shopping-list-database.php`
- Call it from whichever class needs it (Admin, Frontend, Cron, RSS)

**New admin section or setting:**
- Register setting in `Shopping_List_Admin::admin_init()` in `includes/class-shopping-list-admin.php`
- Add field rendering to `admin/partials/admin-display.php`
- Add processing logic to `Shopping_List_Admin::process_form_submission()`

**New shortcode:**
- Add method to `includes/class-shopping-list-frontend.php`
- Register it in `Shopping_List::define_public_hooks()` in `includes/class-shopping-list.php` via `add_shortcode()`

**New scheduled task:**
- Add scheduling and clearing methods to `includes/class-shopping-list-cron.php`
- Register the hook in `Shopping_List::define_cron_hooks()` in `includes/class-shopping-list.php`

**New admin asset (CSS or JS):**
- Place in `admin/css/` or `admin/js/`
- Enqueue in `Shopping_List_Admin::enqueue_styles()`

**New admin template partial:**
- Place in `admin/partials/`
- Include via `include_once` from the relevant method in `Shopping_List_Admin`

**New top-level class/concern:**
- Create `includes/class-shopping-list-{concern}.php`
- Add `require_once` in `Shopping_List::load_dependencies()`
- Add a `define_{concern}_hooks()` method in `Shopping_List` and call it from `__construct()`

## Special Directories

**`.planning/`:**
- Purpose: GSD workflow planning files (STATE.md, ROADMAP.md, codebase analysis)
- Generated: Partially (STATE.md updated by GSD commands)
- Committed: Yes (planning artefacts are version-controlled)
- Note: Not part of the WordPress plugin — excluded from plugin functionality

---

*Structure analysis: 2026-04-09*
