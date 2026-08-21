# Testing Patterns

**Analysis Date:** 2026-04-09

## Test Framework

**Runner:** None configured

**Assertion Library:** None

**Test Files:** None found in codebase

**Run Commands:** None defined

## Test File Organization

No test files exist. No `tests/` directory. No `*.test.php`, `*.spec.php`, or PHPUnit configuration files detected.

## Current Test Coverage

**Coverage: 0%**

No automated tests of any kind are present:
- No unit tests
- No integration tests
- No browser/E2E tests
- No WordPress-specific test setup (no `phpunit.xml`, no `bootstrap.php`, no use of `WP_UnitTestCase`)

## Testable Surface

These are the logical units that would benefit from test coverage if tests were introduced:

**`Shopping_List_Database` (`includes/class-shopping-list-database.php`):**
- `generate_random_selection()` — core business logic; shuffles and filters items across three data sources
- `update_always_include_items()` / `update_not_needed_items()` / `update_random_items()` — sanitisation and padding logic
- `create_default_options()` — idempotency (should not overwrite existing options)

**`Shopping_List_Admin` (`includes/class-shopping-list-admin.php`):**
- `format_items_for_social()` — pure function; formats item array to human-readable string; no WordPress dependencies; highest priority for unit testing
- `process_form_submission()` — POST handling and delegation

**`Shopping_List_Frontend` (`includes/class-shopping-list-frontend.php`):**
- `display_shopping_list()` — HTML output with `esc_html` escaping
- `display_not_needed_list()` — filtering and HTML output

**`Shopping_List_Cron` (`includes/class-shopping-list-cron.php`):**
- `schedule_weekly_regeneration()` — scheduling idempotency
- `clear_scheduled_events()` — cleanup on deactivation

**`Shopping_List_RSS` (`includes/class-shopping-list-rss.php`):**
- `generate_rss_feed()` — XML output validity

## Recommended Test Approach (if introducing tests)

**Framework:** PHPUnit with WordPress test suite (`wp-phpunit`)

**Setup:**
```bash
composer require --dev phpunit/phpunit wp-phpunit/wp-phpunit
```

**Bootstrap pattern for WordPress tests:**
```php
// tests/bootstrap.php
$_tests_dir = getenv('WP_TESTS_DIR') ?: '/tmp/wordpress-tests-lib';
require_once $_tests_dir . '/includes/functions.php';
require_once $_tests_dir . '/includes/bootstrap.php';
```

**Highest-value first test (no WordPress dependency):**
```php
// tests/test-admin.php
class Test_Shopping_List_Admin extends WP_UnitTestCase {

    public function test_format_items_for_social_single_item() {
        $result = Shopping_List_Admin::format_items_for_social(['Tinned Tomatoes']);
        $this->assertEquals('tinned tomatoes', $result);
    }

    public function test_format_items_for_social_multiple_items() {
        $result = Shopping_List_Admin::format_items_for_social(['Pasta', 'Rice', 'Beans']);
        $this->assertEquals('pasta, rice and beans', $result);
    }

    public function test_format_items_for_social_empty_returns_empty_string() {
        $result = Shopping_List_Admin::format_items_for_social([]);
        $this->assertEquals('', $result);
    }
}
```

**Database logic test pattern:**
```php
class Test_Shopping_List_Database extends WP_UnitTestCase {

    public function setUp(): void {
        parent::setUp();
        Shopping_List_Database::create_default_options();
    }

    public function test_update_always_include_pads_to_eight_items() {
        Shopping_List_Database::update_always_include_items(['Pasta']);
        $result = Shopping_List_Database::get_always_include_items();
        $this->assertCount(8, $result);
    }

    public function test_generate_random_selection_excludes_not_needed_items() {
        // Setup: put 'pasta' in not needed, 'pasta' in always include
        Shopping_List_Database::update_not_needed_items(['Pasta']);
        Shopping_List_Database::update_always_include_items(['Pasta']);
        $selection = Shopping_List_Database::generate_random_selection();
        $this->assertNotContains('Pasta', $selection);
    }
}
```

## Mocking

No mocking framework in use. For WordPress function mocking, the recommended approach when tests are introduced is **Brain Monkey** (for isolated unit tests without a full WordPress install):

```bash
composer require --dev brain/monkey
```

## Coverage

**Requirements:** None enforced

**Target when tests introduced:** Focus first on `format_items_for_social()` (pure function) and `generate_random_selection()` (core business logic with branching paths).

## Notes on Current Quality Assurance

In the absence of automated tests, the only quality checks in place are:
- PHP syntax validation (`php -l`) applied manually
- WordPress nonce verification on form submissions
- Input sanitisation via `sanitize_text_field()` before all writes
- Output escaping via `esc_html()` / `esc_url()` before all display

---

*Testing analysis: 2026-04-09*
