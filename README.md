# Shopping List

A WordPress plugin that generates and manages randomised item displays with weekly automated regeneration, simple administrative controls, and RSS feeds for external automation.

## Features

- Randomised item selection logic with configurable behaviour.
- Automatic weekly regeneration of item lists every Monday at 6:00am.
- Admin interface for managing items and regeneration options.
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

shopping-list/  
&nbsp;&nbsp;admin/  
&nbsp;&nbsp;includes/  
&nbsp;&nbsp;shopping-list.php

## Usage

- Use the admin page to manage items and weekly regeneration settings.
- Extend behaviour through standard WordPress actions and filters provided by the plugin.

## Contributing

Issues and pull requests are welcome. Please open an issue before submitting major changes.

## License

This project is released under the MIT License. See LICENSE for details.

## Changelog

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
