# Changelog

## [0.10.0] - 2026-10-02
- Pasting multi-line text into Always Include, Not Needed, or the randomly-selected grid now fills one field per line down the column, skipping blank lines. New rows are inserted wherever the next field is already filled, so existing entries are never overwritten.
- Added a "Clear all" button beside "+ Add row"/"+ Add column" that empties the randomly-selected grid (with a confirmation).

## [0.9.2] - 2026-09-28
- Updates now come through the bundled Plugin Update Checker library instead of the plugin's own updater. The automatic updates toggle now works, and an update no longer deletes the plugin folder before installing the new one.
- Added a plugin icon on the Plugins and Updates screens.
- Added an `Update URI` header, so WordPress.org can't offer an unrelated plugin called "Shopping List" as an update.
- Uninstall now also removes the update checker's stored data.

## [0.9.1] - 2026-09-22
- Always Include, Not Needed, and the randomly-selected grid are no longer fixed-size — rows (and, for the grid, columns) can be added or removed freely, with a floor of 3 (3×3 for the grid) that a brand-new install now starts at, instead of the old fixed 8 / 40×4. Existing sites with more rows already stored keep them all.
- The clear (×) button on every field now also deletes: for Always Include/Not Needed it removes the row outright (falling back to just clearing at the 3-row floor); for the grid it removes the row or column when this is the only thing left in it, or when the row/column is entirely blank — otherwise it just clears the field.
- Social media post templates are now editable in place (Edit/Reset next to Copy), using an `[items]` token. The whole-week post and the daily posts each have their own template; the daily posts share one template between them.
- Added a "Settings" link to the plugin's entry on the Plugins screen.
- Fixed `uninstall.php` to also remove the 7 per-day RSS snapshot options and their scheduled cron events — previously only the 4 core options were cleaned up, leaving orphaned data and cron jobs behind after a full uninstall.
- Guarded the GitHub updater against a null-array warning when the release API call fails or hits its rate limit.
- Redesigned the settings page: card-style sections, section icons, and consistent spacing, using WordPress's built-in Dashicons — no new dependencies.

## [0.8.0] - 2026-05-01
- Added 7 day-specific RSS feeds, one per day of the week.
- Each feed takes a weekly snapshot at 6:00am (Monday at 6:01am to follow list regeneration).
- Snapshots store a fixed `pubDate` of "that day at 06:00:00" in WP timezone — suitable for time-triggered automations.
- Feeds fall back to the current list with a computed pubDate if no snapshot exists yet.
- All 7 snapshots initialised on plugin activation so feeds are immediately usable.

## [0.7.0] - 2026-04-09
- Code quality and integrity fixes across all includes.
- Removed dead `update_rss_feed()` method.
- Hardened updater; guarded constants.
