# External Integrations

**Analysis Date:** 2026-04-09

## APIs & External Services

**GitHub Releases API:**
- Purpose: Plugin auto-update checks. Fetches latest release from `https://api.github.com/repos/aidanashby/shopping-list/releases/latest`
- SDK/Client: Native WordPress `wp_remote_get()` — no SDK
- Auth: None (unauthenticated public API call)
- Caching: WordPress transient `shopping_list_github_release`, TTL 12 hours
- Implementation: `includes/class-shopping-list-updater.php`
- Hooks into: `pre_set_site_transient_update_plugins`, `plugins_api`, `upgrader_post_install`

## Data Storage

**Databases:**
- WordPress Options table (MySQL/MariaDB via WordPress)
  - `shopping_list_always_include` — array of up to 8 items always shown
  - `shopping_list_not_needed` — array of up to 8 excluded items
  - `shopping_list_random_items` — 40-row × 4-column matrix of candidate items
  - `shopping_list_current_selection` — array of currently active list items (up to 8)
  - All reads/writes via `get_option()` / `update_option()` / `add_option()`
  - Implementation: `includes/class-shopping-list-database.php`

**File Storage:**
- None — RSS feed is generated on-demand, not written to disk

**Caching:**
- WordPress transients (stored in options table) for GitHub API response only

## Authentication & Identity

**Auth Provider:**
- WordPress native — admin UI restricted to users with WordPress capabilities (managed by WP itself)
- No custom auth layer

## Scheduled Jobs

**WordPress Cron:**
- Event: `shopping_list_weekly_regenerate`
- Schedule: Weekly, first run next Monday at 06:00
- Action: Calls `Shopping_List_Database::generate_random_selection()`
- Implementation: `includes/class-shopping-list-cron.php`

## Monitoring & Observability

**Error Tracking:**
- None — no external error tracking service

**Logs:**
- `error_log()` used in `Shopping_List_Cron::regenerate_list()` to log weekly regeneration timestamp to PHP error log

## CI/CD & Deployment

**Hosting:**
- Krystal shared hosting (per platform docs)

**CI Pipeline:**
- None detected

**Update mechanism:**
- GitHub Releases — plugin self-updates via WordPress update API integration in `class-shopping-list-updater.php`
- Repo: `aidanashby/shopping-list`

## Webhooks & Callbacks

**Incoming:**
- None

**Outgoing:**
- None — GitHub API call is a pull (GET), not a webhook push

## RSS Feed

**Endpoint:** `/shopping-list-feed.rss`
- Format: RSS 2.0 with `content:encoded` namespace
- Generated: On-demand via WordPress rewrite rule and `template_redirect` hook
- Language declared: `en-GB`
- Implementation: `includes/class-shopping-list-rss.php`
- Consumer: Intended for MailerLite or similar RSS-to-email automation

## Environment Configuration

**Required env vars:**
- None — all configuration is stored in WordPress options; no environment variables required

**Secrets:**
- None — GitHub API calls are unauthenticated (public repo)

---

*Integration audit: 2026-04-09*
