# Shopping List

## What This Is

A private WordPress plugin for North Bristol & South Gloucestershire Foodbank that manages and displays a weekly shopping list of urgent donation needs. Site admins maintain three item lists in a settings page; the plugin generates a current selection on save and on a weekly cron, exposes it via two shortcodes and an RSS feed, and produces ready-to-copy social media post text at the top of the settings page.

## Core Value

Admins can update the food bank's urgent needs in one place and have that update flow automatically to the website, RSS-to-email automation, and social media copy — without touching code.

## Requirements

### Validated

<!-- Shipped and relied upon in the live plugin. -->

- ✓ `[shop_list]` shortcode — displays always-include items plus one random item per row from the random items matrix, capped at 8 total
- ✓ `[noshop_list]` shortcode — displays the Not Needed Items list in order
- ✓ Admin settings page with three input lists: Always Include (8 slots), Randomly Selected Needed Items (40 rows × 4 columns), Not Needed Items (8 slots)
- ✓ Immediate list regeneration on admin save
- ✓ Weekly automated regeneration via WP-Cron (Mondays 6 AM)
- ✓ RSS 2.0 feed at `/shopping-list-feed.rss` serving the current selection (en-GB, for MailerLite RSS-to-email)
- ✓ Social media copy blocks at top of settings page — one Monday-morning post + per-pair posts for each 2-item chunk; copy-to-clipboard buttons
- ✓ GitHub Releases auto-update mechanism (hooks into WordPress plugin update API)
- ✓ Clean uninstall (removes all options on plugin deletion)

### Active

<!-- Known work to be done. Inferred from codebase concerns — confirm/revise with user. -->

- [ ] Fix duplicate `__construct` in `class-shopping-list.php` — PHP silently uses the second constructor, dropping `define_update_hooks()`; auto-updates never fire
- [ ] Fix version mismatch — `SHOPPING_LIST_VERSION` constant set to `0.6.0` before plugin header, then re-defined as `0.5.3` after; `define()` cannot redefine, so constant holds `0.6.0` while WP reads `0.5.3` from header; suppresses update notifications
- [ ] Fix `class-shopping-list-database.php` — orphaned code at lines 36–66 outside any method body; `get_not_needed_items()` and `get_random_items()` getter methods may be missing; newer `generate_random_selection()` correctly excludes always-include items from random picks (fixing the duplicate-item bug) but needs to be the sole implementation running
- [ ] Fix always-include/random-selection duplicate: if an item appears in both Always Include and Randomly Selected lists it can currently appear twice in `[shop_list]` output — resolved by database file fix (newer `generate_random_selection()` already has the exclusion; old orphaned code does not)
- [ ] Delete orphan cron file `includes/includesclass-shopping-list-cron.php` (malformed path, Sunday schedule instead of Monday, references non-existent `Shopping_List_RSS::update_rss_feed()`, not loaded anywhere)
- [ ] Scope admin CSS/JS to plugin settings page only — currently enqueued on every wp-admin screen; add `$hook` check against `settings_page_shopping-list-settings`
- [ ] Rename `enqueue_styles()` → `enqueue_admin_assets()` — method also enqueues JS, name is misleading; update hook registration in `class-shopping-list.php`
- [ ] Harden `process_form_submission()` — sanitise `$_POST` arrays at point of reading, before passing to database methods (currently sanitised inside database methods; fragile if that step is ever moved)
- [ ] Add admin notice when always-include item count reaches or exceeds 8 slots — currently silently drops random items with no warning to admin
- [ ] Extract hard-coded slot counts (8, 40, 4) to named constants (`SHOPPING_LIST_SLOTS`, `SHOPPING_LIST_RANDOM_ROWS`, `SHOPPING_LIST_RANDOM_COLS`) in `shopping-list.php`

### Out of Scope

- Multi-site support — single-site plugin for NBSG Foodbank only
- Front-end styling — shortcodes output unstyled HTML; theming is the theme's responsibility
- User-configurable social post templates — templates are hardcoded PHP strings; making them editable in admin is not planned unless requested
- Public distribution / WordPress.org submission — private plugin, no i18n requirements beyond existing text domain stub

## Context

- **Org:** North Bristol & South Gloucestershire Foodbank (NBSG Foodbank) — Trussell community food bank serving North Bristol & South Gloucestershire
- **Stack:** WordPress + Divi 5, PHP, hosted on Krystal shared hosting
- **Author/repo:** Aidan Ashby — `aidanashby/shopping-list` on GitHub
- **Plugin architecture:** Single entry point (`shopping-list.php`), six classes in `includes/`, admin assets in `admin/`, no Composer dependencies, no autoloader
- **Data storage:** WordPress options table only — four keys (`shopping_list_always_include`, `shopping_list_not_needed`, `shopping_list_random_items`, `shopping_list_current_selection`)
- **RSS consumer:** MailerLite RSS-to-email automation reads `/shopping-list-feed.rss`
- **Current codebase state:** Core features work but the codebase has several critical integrity issues (see Active requirements) that risk silent failures in auto-updates and list generation

## Constraints

- **Tech stack:** PHP only, no Composer, no npm — keep dependencies to zero; all WordPress APIs
- **Hosting:** Krystal shared hosting — no CLI access in production; deployments via local → Git → manual or FTP
- **Compatibility:** Must work on current WordPress + Divi 5; no minimum PHP version formally declared (target PHP 7.4+)
- **Scope:** Private plugin — no need to follow WordPress.org guidelines, but WordPress coding standards are the style baseline

## Key Decisions

| Decision | Rationale | Outcome |
|----------|-----------|---------|
| Static methods on `Shopping_List_Database` | Simple data layer; no need for instance state when all data lives in WP options | — Pending review |
| Social copy templates hardcoded in PHP | Templates are NBSG-specific and rarely change; admin UI for them adds complexity without clear benefit | — Pending |
| RSS feed on-demand (not cached to disk) | Avoids file permission issues on shared hosting; feed is low-traffic | ✓ Good |
| GitHub Releases for auto-update | Private plugin not on WordPress.org; GitHub releases gives a lightweight update channel | ⚠️ Revisit — updater currently broken due to duplicate constructor |

## Evolution

This document evolves at phase transitions and milestone boundaries.

**After each phase transition** (via `/gsd-transition`):
1. Requirements invalidated? → Move to Out of Scope with reason
2. Requirements validated? → Move to Validated with phase reference
3. New requirements emerged? → Add to Active
4. Decisions to log? → Add to Key Decisions
5. "What This Is" still accurate? → Update if drifted

**After each milestone** (via `/gsd-complete-milestone`):
1. Full review of all sections
2. Core Value check — still the right priority?
3. Audit Out of Scope — reasons still valid?
4. Update Context with current state

---
*Last updated: 2026-04-09 — revised after full code review; confirmed Monday cron, always-include duplicate bug, database file state*
