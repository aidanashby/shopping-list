# Shopping List plugin

WordPress plugin for North Bristol & South Glos Foodbank's weekly shopping list.

## Email platform
- The foodbank uses **Mailchimp** RSS campaigns to send the list. It no longer uses MailerLite.
- Mailchimp reads the plugin's RSS feeds: `/shopping-list-feed.rss` and the day feeds `/shopping-list-feed-<day>.rss`.

## Schedule (site timezone, set in Settings → General)
- The random items regenerate at 12:00am every Monday (`shopping_list_weekly_regenerate`).
- Each day feed snapshots at 12:00am on its day, with a fixed `pubDate` of 00:00:00. Monday's runs at 12:01am so it follows regeneration.
- `Shopping_List_Cron::realign_events()` runs on `init` and moves events back to these times after a clock change.

## Releasing
Bump the version in the plugin header and `SHOPPING_LIST_VERSION`, add a `## [x.y.z] - date` section to `CHANGELOG.md`, merge to `main`, then push a `vX.Y.Z` tag. `.github/workflows/release.yml` builds the zip that sites update from.
