# Shopping List

A WordPress plugin that generates and manages randomised item displays with weekly automated regeneration, simple administrative controls, and RSS feeds for external automation.

## Features

- Randomised item selection logic with configurable behaviour.
- Automatic weekly regeneration of item lists every Monday at 6:00am.
- Admin interface for managing items and regeneration options, with freely resizable lists (add or remove rows/columns, no fixed limits) and a settings link on the Plugins screen.
- Editable social media post templates — one for the whole-week post, one shared template for the daily posts — using an `[items]` token to insert the current list.
- Live RSS feed at `/shopping-list-feed.rss` reflecting the current list.
- Day-specific RSS feeds (`/shopping-list-feed-monday.rss` through `/shopping-list-feed-sunday.rss`), each updated at 6:00am on its named day with a fixed `pubDate` — suitable for time-triggered automations in tools like MailerLite.
- Clean, modular structure using admin and includes components.

## Requirements

- WordPress 5.0 or higher
- PHP 7.4 or higher

## Installation

1. Upload the shopping-list folder to /wp-content/plugins/ or install via ZIP upload.
2. Activate the plugin through the Plugins screen in WordPress.
3. Go to Settings > Permalinks and save to flush rewrite rules (required for RSS feed URLs to resolve).
4. Configure settings under the plugin's admin menu.

## RSS Feeds

| URL | Updates |
|-----|---------|
| `/shopping-list-feed.rss` | Live — always reflects the current list |
| `/shopping-list-feed-monday.rss` | Mondays at 6:01am |
| `/shopping-list-feed-tuesday.rss` | Tuesdays at 6:00am |
| `/shopping-list-feed-wednesday.rss` | Wednesdays at 6:00am |
| `/shopping-list-feed-thursday.rss` | Thursdays at 6:00am |
| `/shopping-list-feed-friday.rss` | Fridays at 6:00am |
| `/shopping-list-feed-saturday.rss` | Saturdays at 6:00am |
| `/shopping-list-feed-sunday.rss` | Sundays at 6:00am |

Monday's feed updates at 6:01am to guarantee the weekly list regeneration (6:00am) runs first.

Each day feed stores a snapshot with a fixed `pubDate` of "that day at 06:00:00" in the site timezone. The pubDate does not change between requests — only when the day's cron fires.

## Folder Structure

shopping-list/ &nbsp;&nbsp;admin/ &nbsp;&nbsp;includes/ &nbsp;&nbsp;shopping-list.php

## Usage

- Use the admin page to manage items and weekly regeneration settings.
- Always Include, Not Needed, and the randomly-selected grid each start at a minimum of 3 rows (3 columns for the grid) and can be freely expanded with "+ Add row"/"+ Add column" — the × on a field clears it, or removes the row/column outright once it's the last thing left in it (or entirely blank).
- Click "Edit" next to a social media post to change its underlying template; the daily posts share one template, so editing any of them updates the rest. "Reset to default" restores the built-in wording.
- Extend behaviour through standard WordPress actions and filters provided by the plugin.

## Contributing

Issues and pull requests are welcome. Please open an issue before submitting major changes.

## License

This project is released under the MIT License. See LICENSE for details.

## Changelog

### 0.9.1
- Always Include, Not Needed, and the randomly-selected grid are no longer fixed-size — rows (and, for the grid, columns) can be added or removed freely, with a floor of 3 (3×3 for the grid) that a brand-new install now starts at, instead of the old fixed 8 / 40×4. Existing sites with more rows already stored keep them all.
- The clear (×) button on every field now also deletes: for Always Include/Not Needed it removes the row outright (falling back to just clearing at the 3-row floor); for the grid it removes the row or column when this is the only thing left in it, or when the row/column is entirely blank — otherwise it just clears the field.
- Social media post templates are now editable in place (Edit/Reset next to Copy), using an `[items]` token. The whole-week post and the daily posts each have their own template; the daily posts share one template between them.
- Added a "Settings" link to the plugin's entry on the Plugins screen.
- Fixed `uninstall.php` to also remove the 7 per-day RSS snapshot options and their scheduled cron events — previously only the 4 core options were cleaned up, leaving orphaned data and cron jobs behind after a full uninstall.
- Guarded the GitHub updater against a null-array warning when the release API call fails or hits its rate limit.
- Redesigned the settings page: card-style sections, section icons, and consistent spacing, using WordPress's built-in Dashicons — no new dependencies.

### 0.8.0
- Added 7 day-specific RSS feeds, one per day of the week.
- Each feed takes a weekly snapshot at 6:00am (Monday at 6:01am to follow list regeneration).
- Snapshots store a fixed `pubDate` of "that day at 06:00:00" in WP timezone — suitable for time-triggered automations.
- Feeds fall back to the current list with a computed pubDate if no snapshot exists yet.
- All 7 snapshots initialised on plugin activation so feeds are immediately usable.

### 0.7.0
- Code quality and integrity fixes across all includes.
- Removed dead `update_rss_feed()` method.
- Hardened updater; guarded constants.
