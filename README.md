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

shopping-list/ &nbsp;&nbsp;admin/ &nbsp;&nbsp;assets/ &nbsp;&nbsp;includes/ &nbsp;&nbsp;plugin-update-checker/ &nbsp;&nbsp;shopping-list.php &nbsp;&nbsp;uninstall.php

`plugin-update-checker/` is the bundled library that installs updates from this repo's GitHub releases. `assets/` holds the icons shown on the Plugins and Updates screens.

## Usage

- Use the admin page to manage items and weekly regeneration settings.
- Always Include, Not Needed, and the randomly-selected grid each start at a minimum of 3 rows (3 columns for the grid) and can be freely expanded with "+ Add row"/"+ Add column" — the × on a field clears it, or removes the row/column outright once it's the last thing left in it (or entirely blank). Saving also removes any blank rows (and, for the grid, blank columns), down to that minimum.
- Pasting text with several lines into any list field puts one line in each field, going down the column. Blank lines are skipped, and a new row is added wherever the next field down is already filled (or there is no next row), so nothing is overwritten.
- "Clear all" under the randomly-selected grid empties every field in the grid after a confirmation. The rows and columns stay, and nothing is saved until you click Save.
- Click "Edit" next to a social media post to change its underlying template; the daily posts share one template, so editing any of them updates the rest. "Reset to default" restores the built-in wording.
- Extend behaviour through standard WordPress actions and filters provided by the plugin.

## Contributing

Issues and pull requests are welcome. Please open an issue before submitting major changes.

## License

This project is released under the MIT License. See LICENSE for details.

## Changelog

See [CHANGELOG.md](CHANGELOG.md).
