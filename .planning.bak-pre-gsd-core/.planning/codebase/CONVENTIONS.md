# Coding Conventions

**Analysis Date:** 2026-04-09

## Naming Patterns

**Files:**
- Classes: `class-shopping-list-{module}.php` (kebab-case, prefixed with `class-`)
- Entry point: `shopping-list.php` (plugin slug)
- Admin partials: `admin/partials/admin-display.php`
- Assets: `admin/css/admin.css`, `admin/js/admin.js`

**Classes:**
- PascalCase with underscore word separators: `Shopping_List_Database`, `Shopping_List_Admin`, `Shopping_List_Frontend`, `Shopping_List_Cron`, `Shopping_List_RSS`
- All classes prefixed with `Shopping_List_`

**Functions (procedural):**
- snake_case with plugin prefix: `run_shopping_list()`, `activate_shopping_list()`, `deactivate_shopping_list()`, `shopping_list_rss_init()`

**Methods:**
- snake_case: `create_default_options()`, `generate_random_selection()`, `add_admin_menu()`, `process_form_submission()`

**Variables:**
- snake_case: `$plugin_name`, `$always_include`, `$not_needed_filtered`, `$remaining_slots`

**Constants:**
- SCREAMING_SNAKE_CASE with plugin prefix: `SHOPPING_LIST_VERSION`, `SHOPPING_LIST_PLUGIN_DIR`, `SHOPPING_LIST_PLUGIN_URL`, `SHOPPING_LIST_GITHUB_REPO`

**WordPress options keys:**
- snake_case with plugin prefix: `shopping_list_always_include`, `shopping_list_not_needed`, `shopping_list_random_items`, `shopping_list_current_selection`

**Hook/action names:**
- snake_case with plugin prefix: `shopping_list_weekly_regenerate`, `shopping_list_settings`

## Method Visibility

- `public` for all externally-called methods and hook callbacks
- `private` for internal orchestration methods: `load_dependencies()`, `define_admin_hooks()`, `define_public_hooks()`, `define_cron_hooks()`, `process_form_submission()`
- `static` for stateless utility and data methods: all methods on `Shopping_List_Database`, `Shopping_List_Cron`, `Shopping_List_RSS`
- Instance methods used where object state ($plugin_name, $version) is needed: `Shopping_List_Admin`, `Shopping_List_Frontend`

## Code Style

**Formatting:**
- No linter or formatter configured (no `.editorconfig`, `.phpcs.xml`, `.prettierrc`)
- Indentation: inconsistent — mix of 4-space and tab indentation present (see `class-shopping-list.php` vs `class-shopping-list-database.php`)
- Braces: same-line opening brace on control structures and functions

**PHP version:**
- No explicit version constraint declared; uses `array_fill`, closures, `array_pad` — compatible with PHP 5.6+

## Import / Dependency Loading

- No autoloader; all dependencies loaded via `require_once` with `SHOPPING_LIST_PLUGIN_DIR` constant
- Dependencies loaded in `load_dependencies()` inside the main class constructor
- Activation/deactivation hooks load their own dependencies directly before use (defensive pattern)

## Security Patterns

- Direct access blocked in all files: `if (!defined('ABSPATH')) { exit; }`
- `uninstall.php` checks `WP_UNINSTALL_PLUGIN` constant
- Form submissions verified with `check_admin_referer('shopping_list_settings', 'shopping_list_nonce')`
- Capability check before admin page render: `current_user_can('manage_options')`
- All output escaped: `esc_html()` on item text, `esc_url()` on URLs
- All stored data sanitised via `sanitize_text_field()` before database write
- `$_POST` accessed with `isset()` guard and default fallback: `isset($_POST['key']) ? $_POST['key'] : array()`

## Error Handling

**Strategy:** Minimal; no try/catch blocks. Errors handled via:
- WordPress `add_settings_error()` for user-facing form feedback (success and error states)
- `error_log()` for cron events: `error_log('Shopping List: Weekly regeneration completed at ' . current_time('mysql'))`
- Guard clauses with early `return` for empty data states
- HTTP 404 status header returned for empty RSS feed: `status_header(404)`

**No exception handling** — PHP exceptions are not used anywhere in the codebase.

## Comments

**Style:**
- File/class-level: short docblock `/** Description */` above class declaration
- Inline: single-line `//` comments explaining non-obvious logic
- No `@param`, `@return` docblock annotations on methods

**Example pattern:**
```php
/**
 * Database operations class
 */
class Shopping_List_Database {

    public static function create_default_options() {
        // Always include items (8 slots)
        if (!get_option('shopping_list_always_include')) {
```

## WordPress Integration Patterns

**Hooks registered via:**
- `array($object, 'method')` for instance methods
- `array(__CLASS__, 'method')` for static methods called from within the class
- Procedural functions registered directly by name

**Settings API:**
- `register_setting()` + `add_settings_section()` used in `admin_init()`
- Custom form processing handled manually in `display_admin_page()` rather than relying solely on Settings API save flow

**Shortcodes:**
- Registered in `define_public_hooks()` via `add_shortcode()`
- Return HTML string (not echo) — correct shortcode pattern

**Enqueueing:**
- Scripts and styles enqueued in `enqueue_styles()` (misnamed — enqueues both)
- Version passed as cache-buster

## JavaScript Conventions

- jQuery used (WordPress bundled)
- `jQuery(document).ready(function($) { ... })` wrapper pattern
- Event delegation via `.on('click', handler)`
- DOM manipulation via jQuery methods
- No ES6+ syntax; no module system; single file `admin/js/admin.js`

---

*Convention analysis: 2026-04-09*
