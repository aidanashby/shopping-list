# Roadmap: Shopping List

## Overview

This milestone resolves all known bugs and code quality concerns in the Shopping List plugin. The codebase has working core features but significant integrity issues — a corrupted database class, a dead updater, a version mismatch, and several admin-layer problems. Work proceeds from critical (breaks functionality) through logical (incorrect behaviour) to quality (maintainability). No new features.

## Phases

- [ ] **Phase 1: Database Integrity** — Audit and fix class-shopping-list-database.php; resolve always-include duplicate bug
- [ ] **Phase 2: Bootstrap Integrity** — Fix duplicate constructor, version mismatch, delete orphan cron file
- [ ] **Phase 3: Admin Quality** — Scope admin assets, harden form submission, add over-capacity notice
- [ ] **Phase 4: Code Quality** — Named constants for slot counts, final lint pass

## Phase Details

### Phase 1: Database Integrity
**Goal**: Ensure `class-shopping-list-database.php` is syntactically valid, all methods present and correctly bounded, and the always-include/random-selection deduplication works correctly
**Depends on**: Nothing (first phase)
**Requirements**: Database file fix, always-include duplicate bug
**Success Criteria** (what must be TRUE):
  1. `php -l includes/class-shopping-list-database.php` passes with no errors
  2. All four getter methods exist: `get_always_include_items()`, `get_not_needed_items()`, `get_random_items()`, `get_current_selection()`
  3. No orphaned code exists outside method bodies in the class
  4. `[shop_list]` output never contains an item that also appears in the Always Include list via the random selection path
  5. `generate_random_selection()` has exactly one implementation

Plans:
- [ ] 01-01: Audit — run `php -l`, map actual method presence and file structure, document what is orphaned and what is missing
- [ ] 01-02: Fix — remove orphaned code, add any missing getter methods, ensure single correct `generate_random_selection()` with always-include exclusion
- [ ] 01-03: Verify — `php -l` clean, manual test confirms no duplicate items in `[shop_list]` output

### Phase 2: Bootstrap Integrity
**Goal**: Fix silent failures in the plugin bootstrap — dead updater, version constant collision, and orphan cron file confusion
**Depends on**: Phase 1
**Requirements**: Duplicate constructor fix, version mismatch fix, orphan cron deletion
**Success Criteria** (what must be TRUE):
  1. `class-shopping-list.php` contains exactly one `__construct` calling all five `define_*` methods (`define_admin_hooks`, `define_public_hooks`, `define_cron_hooks`, `define_update_hooks`, `load_dependencies`)
  2. `SHOPPING_LIST_VERSION` constant is defined once, after the plugin header, with value matching the `Version:` header field (0.6.0)
  3. WordPress plugin list shows version 0.6.0
  4. `includes/includesclass-shopping-list-cron.php` no longer exists
  5. `php -l` passes on all modified files

Plans:
- [ ] 02-01: Fix duplicate `__construct` in `class-shopping-list.php` — merge into single constructor calling all five `define_*` methods; remove duplicate `load_dependencies()` and `define_cron_hooks()` definitions
- [ ] 02-02: Fix version mismatch in `shopping-list.php` — remove the three premature `define()` calls before the plugin header block; set `SHOPPING_LIST_VERSION`, `SHOPPING_LIST_PLUGIN_FILE`, `SHOPPING_LIST_GITHUB_REPO` after the header; align version to `0.6.0` in both header and constant
- [ ] 02-03: Delete `includes/includesclass-shopping-list-cron.php`; verify canonical `includes/class-shopping-list-cron.php` schedules Monday 6 AM

### Phase 3: Admin Quality
**Goal**: Fix admin-layer bugs — globally-loaded assets, misleading method name, fragile POST handling, and silent over-capacity behaviour
**Depends on**: Phase 2
**Requirements**: Asset scoping, enqueue rename, POST sanitisation, over-capacity notice
**Success Criteria** (what must be TRUE):
  1. Admin CSS and JS load only on the plugin settings page (`settings_page_shopping-list-settings`), not on all wp-admin screens
  2. The hook-registered method is named `enqueue_admin_assets()` (not `enqueue_styles`)
  3. `$_POST['always_include']`, `$_POST['not_needed']`, and `$_POST['random_items']` are cast to array and sanitised immediately on read in `process_form_submission()`, before being passed to any database method
  4. When the number of non-empty always-include items is 8 or more, a dismissible admin notice warns the admin that random items will not be added to the list

Plans:
- [ ] 03-01: Scope assets and rename method — add `$hook` parameter to `enqueue_admin_assets()`, add `settings_page_shopping-list-settings` guard, update `add_action` registration in `class-shopping-list.php`
- [ ] 03-02: Harden `process_form_submission()` — sanitise and type-enforce `$_POST` reads at the point of assignment before passing to database methods
- [ ] 03-03: Add over-capacity admin notice — after regeneration, if always-include count ≥ 8, display a dismissible `admin_notice` warning that random items are suppressed

### Phase 4: Code Quality
**Goal**: Eliminate hard-coded magic numbers and confirm the codebase lints clean end-to-end
**Depends on**: Phase 3
**Requirements**: Named slot constants, lint cleanliness
**Success Criteria** (what must be TRUE):
  1. `SHOPPING_LIST_SLOTS` (8), `SHOPPING_LIST_RANDOM_ROWS` (40), `SHOPPING_LIST_RANDOM_COLS` (4) defined as constants in `shopping-list.php`
  2. No literal `8`, `40`, or `4` used in context of slot/row/column counts anywhere in `includes/` — all reference the constants
  3. `php -l` passes on every PHP file in the plugin

Plans:
- [ ] 04-01: Define constants in `shopping-list.php`; replace all hard-coded slot/row/column values in `class-shopping-list-database.php` and `class-shopping-list-admin.php`
- [ ] 04-02: Final `php -l` pass across all PHP files; confirm no regressions

## Progress

| Phase | Plans Complete | Status | Completed |
|-------|----------------|--------|-----------|
| 1. Database Integrity | 0/3 | Not started | - |
| 2. Bootstrap Integrity | 0/3 | Not started | - |
| 3. Admin Quality | 0/3 | Not started | - |
| 4. Code Quality | 0/2 | Not started | - |
