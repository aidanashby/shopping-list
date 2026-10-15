# Plugin Check Report

**Plugin:** Shopping List
**Generated at:** 2026-10-14 15:46:32


## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Plugin\Package.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 124 | 26 | WARNING | WordPress.WP.I18n.LowLevelTranslationFunction | Use of the &quot;translate()&quot; function is reserved for low-level API usage. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 124 | 36 | ERROR | WordPress.WP.I18n.NonSingularStringLiteralText | The $text parameter must be a single text string literal. Found: $header['Name'] | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#basic-strings) |
| 124 | 53 | ERROR | WordPress.WP.I18n.NonSingularStringLiteralDomain | The $domain parameter must be a single text string literal. Found: $header['TextDomain'] | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#basic-strings) |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Plugin\Ui.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 56 | 43 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;updateChecker-&gt;getUniqueName(&#039;view_details_link&#039;)&quot;. |  |
| 56 | 101 | ERROR | WordPress.WP.I18n.MissingArgDomain | Missing $domain parameter in function call to __(). | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 68 | 37 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;updateChecker-&gt;getUniqueName(&#039;view_details_link_position&#039;)&quot;. |  |
| 79 | 42 | ERROR | WordPress.WP.I18n.MissingArgDomain | Missing $domain parameter in function call to __(). | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 79 | 42 | ERROR | WordPress.WP.I18n.MissingTranslatorsComment | A function call to __() with texts containing placeholders was found, but was not accompanied by a "translators:" comment on the line above to clarify the meaning of the placeholders. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#descriptions) |
| 129 | 21 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;updateChecker-&gt;getUniqueName(&#039;manual_check_link&#039;)&quot;. |  |
| 130 | 45 | ERROR | WordPress.WP.I18n.TextDomainMismatch | Mismatched text domain. Expected 'shopping-list' but got 'plugin-update-checker'. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 217 | 40 | ERROR | WordPress.WP.I18n.MissingTranslatorsComment | A function call to _x() with texts containing placeholders was found, but was not accompanied by a "translators:" comment on the line above to clarify the meaning of the placeholders. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#descriptions) |
| 217 | 95 | ERROR | WordPress.WP.I18n.TextDomainMismatch | Mismatched text domain. Expected 'shopping-list' but got 'plugin-update-checker'. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 219 | 40 | ERROR | WordPress.WP.I18n.MissingTranslatorsComment | A function call to _x() with texts containing placeholders was found, but was not accompanied by a "translators:" comment on the line above to clarify the meaning of the placeholders. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#descriptions) |
| 219 | 111 | ERROR | WordPress.WP.I18n.TextDomainMismatch | Mismatched text domain. Expected 'shopping-list' but got 'plugin-update-checker'. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 221 | 40 | ERROR | WordPress.WP.I18n.MissingTranslatorsComment | A function call to _x() with texts containing placeholders was found, but was not accompanied by a "translators:" comment on the line above to clarify the meaning of the placeholders. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#descriptions) |
| 221 | 119 | ERROR | WordPress.WP.I18n.TextDomainMismatch | Mismatched text domain. Expected 'shopping-list' but got 'plugin-update-checker'. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 227 | 40 | ERROR | WordPress.WP.I18n.MissingTranslatorsComment | A function call to __() with texts containing placeholders was found, but was not accompanied by a "translators:" comment on the line above to clarify the meaning of the placeholders. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/#descriptions) |
| 227 | 81 | ERROR | WordPress.WP.I18n.TextDomainMismatch | Mismatched text domain. Expected 'shopping-list' but got 'plugin-update-checker'. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 235 | 21 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;updateChecker-&gt;getUniqueName(&#039;manual_check_message&#039;)&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Vcs\PluginUpdateChecker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 67 | 21 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |
| 93 | 21 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |
| 113 | 91 | ERROR | WordPress.WP.I18n.TextDomainMismatch | Mismatched text domain. Expected 'shopping-list' but got 'plugin-update-checker'. | [Docs](https://developer.wordpress.org/plugins/internationalization/how-to-internationalize-your-plugin/) |
| 125 | 35 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getUniqueName(&#039;request_info_result&#039;)&quot;. |  |

## `.gitattributes`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | hidden_files | Hidden files are not permitted. |  |

## `shopping-list.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | plugin_header_no_license | Missing "License" in Plugin Header. Please update your Plugin Header with a valid GPLv2 (or later) compatible license. | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#no-gpl-compatible-license-declared) |
| 0 | 0 | ERROR | plugin_updater_detected | Including An Update Checker / Changing Updates functionality. Plugin Updater detected. Use of the Update URI header is not allowed in plugins hosted on WordPress.org. | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#update-checker) |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\admin\partials\admin-display.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 18 | 9 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$attr_str'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 26 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$always_include&quot;. |  |
| 27 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$not_needed&quot;. |  |
| 28 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$random_items&quot;. |  |
| 29 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$current_selection&quot;. |  |
| 30 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$social_template_intro&quot;. |  |
| 31 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$social_template_pair&quot;. |  |
| 34 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$formatted_items&quot;. |  |
| 35 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$social_texts&quot;. |  |
| 39 | 5 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$social_texts&quot;. |  |
| 46 | 10 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$i&quot;. |  |
| 47 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$start_index&quot;. |  |
| 48 | 9 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$pair_items&quot;. |  |
| 50 | 13 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$formatted_pair&quot;. |  |
| 51 | 13 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$social_texts&quot;. |  |
| 73 | 49 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$index&quot;. |  |
| 73 | 59 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$block&quot;. |  |
| 74 | 21 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$is_pair&quot;. |  |
| 75 | 21 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$template_field&quot;. |  |
| 80 | 118 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$index'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 82 | 62 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$index'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 99 | 56 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$i&quot;. |  |
| 99 | 62 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$value&quot;. |  |
| 101 | 79 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$i'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 123 | 52 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$i&quot;. |  |
| 123 | 58 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$value&quot;. |  |
| 125 | 79 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$i'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 148 | 50 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$r&quot;. |  |
| 148 | 56 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$row&quot;. |  |
| 150 | 65 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$r'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 152 | 53 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$c&quot;. |  |
| 152 | 59 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$value&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\includes\class-shopping-list-admin.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 51 | 9 | ERROR | PluginCheck.CodeAnalysis.SettingSanitization.register_settingMissing | Sanitization missing for register_setting(). | [Docs](https://developer.wordpress.org/reference/functions/register_setting/) |
| 52 | 9 | ERROR | PluginCheck.CodeAnalysis.SettingSanitization.register_settingMissing | Sanitization missing for register_setting(). | [Docs](https://developer.wordpress.org/reference/functions/register_setting/) |
| 53 | 9 | ERROR | PluginCheck.CodeAnalysis.SettingSanitization.register_settingMissing | Sanitization missing for register_setting(). | [Docs](https://developer.wordpress.org/reference/functions/register_setting/) |
| 78 | 90 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found 'SHOPPING_LIST_SLOTS'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 103 | 34 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 103 | 74 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 104 | 27 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 104 | 27 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;always_include&#039;] |  |
| 106 | 30 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 106 | 66 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 107 | 27 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 107 | 27 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;not_needed&#039;] |  |
| 109 | 32 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 109 | 70 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 110 | 27 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 110 | 27 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;random_items&#039;] |  |
| 115 | 41 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 116 | 27 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 116 | 27 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;social_template_intro&#039;] |  |
| 118 | 40 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 119 | 27 | WARNING | WordPress.Security.NonceVerification.Missing | Processing form data without nonce verification. |  |
| 119 | 27 | WARNING | WordPress.Security.ValidatedSanitizedInput.InputNotSanitized | Detected usage of a non-sanitized input variable: $_POST[&#039;social_template_pair&#039;] |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\includes\class-shopping-list-rss.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 47 | 25 | ERROR | WordPress.DateTime.RestrictedFunctions.date_date | date() is affected by runtime timezone changes which can cause date/time to be incorrectly displayed. Use gmdate() instead. |  |
| 68 | 34 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$list_html'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 69 | 38 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$list_html'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 71 | 78 | ERROR | WordPress.DateTime.RestrictedFunctions.date_date | date() is affected by runtime timezone changes which can cause date/time to be incorrectly displayed. Use gmdate() instead. |  |
| 107 | 22 | ERROR | WordPress.DateTime.RestrictedFunctions.date_date | date() is affected by runtime timezone changes which can cause date/time to be incorrectly displayed. Use gmdate() instead. |  |
| 122 | 34 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$list_html'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |
| 123 | 38 | ERROR | WordPress.Security.EscapeOutput.OutputNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$list_html'. | [Docs](https://developer.wordpress.org/apis/security/escaping/#escaping-functions) |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Vcs\BitBucketApi.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 26 | 93 | ERROR | WordPress.Security.EscapeOutput.ExceptionNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$repositoryUrl'. | [Docs](https://developer.wordpress.org/apis/security/escaping/) |
| 213 | 27 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |
| 234 | 23 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Vcs\GitHubApi.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 38 | 90 | ERROR | WordPress.Security.EscapeOutput.ExceptionNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$repositoryUrl'. | [Docs](https://developer.wordpress.org/apis/security/escaping/) |
| 248 | 27 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |
| 263 | 23 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Vcs\GitLabApi.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 63 | 98 | ERROR | WordPress.Security.EscapeOutput.ExceptionNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$repositoryUrl'. | [Docs](https://developer.wordpress.org/apis/security/escaping/) |
| 80 | 94 | ERROR | WordPress.Security.EscapeOutput.ExceptionNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$repositoryUrl'. | [Docs](https://developer.wordpress.org/apis/security/escaping/) |
| 265 | 27 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |
| 279 | 23 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Vcs\ReleaseFilteringFeature.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 41 | 21 | ERROR | WordPress.Security.EscapeOutput.ExceptionNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$maxReleases'. | [Docs](https://developer.wordpress.org/apis/security/escaping/) |
| 46 | 21 | ERROR | WordPress.Security.EscapeOutput.ExceptionNotEscaped | All output should be run through an escaping function (see the Security sections in the WordPress Developer Handbooks), found '$maxReleases'. | [Docs](https://developer.wordpress.org/apis/security/escaping/) |

## `plugin-update-checker/plugin-update-checker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | plugin_updater_detected | Plugin Updater detected. These are not permitted in WordPress.org hosted plugins. Detected: plugin-update-checker.php | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#update-checker) |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Plugin/Ui.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | plugin_updater_detected | Plugin Updater detected. These are not permitted in WordPress.org hosted plugins. Detected: 'plugin-update-checker' |  |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Plugin/Package.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | plugin_updater_detected | Plugin Updater detected. These are not permitted in WordPress.org hosted plugins. Detected: site_transient_update_plugins |  |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |
| 0 | 0 | WARNING | update_modification_detected | Plugin Updater detected. Detected code which may be altering WordPress update routines. Detected: _site_transient_update_plugins | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#update-checker) |

## `includes/class-shopping-list.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | plugin_updater_detected | Plugin Updater detected. These are not permitted in WordPress.org hosted plugins. Detected: YahnisElsts\PluginUpdateChecker |  |
| 0 | 0 | ERROR | plugin_updater_detected | Plugin Updater detected. These are not permitted in WordPress.org hosted plugins. Detected: PucFactory::buildUpdateChecker |  |

## `README.md`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_readme_header_tested | The "Tested up to" header is missing in the readme file. | [Docs](https://developer.wordpress.org/plugins/wordpress-org/how-your-readme-txt-works/#readme-header-information) |
| 0 | 0 | ERROR | no_license | Missing "License". Please update your readme with a valid GPLv2 (or later) compatible license. | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#no-gpl-compatible-license-declared) |
| 0 | 0 | ERROR | no_stable_tag | Invalid or missing Stable Tag. Your Stable Tag is meant to be the stable version of your plugin and it needs to be exactly the same with the Version in your main plugin file's header. Any mismatch can prevent users from downloading the correct plugin files from WordPress.org. | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#incorrect-stable-tag) |
| 0 | 0 | WARNING | readme_parser_warnings_trimmed_short_description | The "Short Description" section is too long and was truncated. A maximum of 150 characters is supported. |  |

## `plugin-update-checker/load-v5p7.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5/PucFactory.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Autoloader.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/DebugBar/Extension.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/DebugBar/Panel.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/DebugBar/PluginExtension.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/DebugBar/PluginPanel.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/DebugBar/ThemePanel.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/InstalledPackage.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Metadata.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/OAuthSignature.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Plugin/PluginInfo.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Plugin/Update.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Plugin/UpdateChecker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/PucFactory.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Scheduler.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/StateStore.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Theme/Package.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Theme/Update.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Theme/UpdateChecker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Update.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/UpdateChecker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/UpgraderStatus.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Utils.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/Api.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/BaseChecker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/BitBucketApi.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/GitHubApi.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/GitLabApi.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/PluginUpdateChecker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/Reference.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/ReleaseAssetSupport.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/ReleaseFilteringFeature.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/ThemeUpdateChecker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `plugin-update-checker/Puc/v5p7/Vcs/VcsCheckerMethods.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 0 | 0 | ERROR | missing_direct_file_access_protection | PHP file should prevent direct access. Add a check like: if ( ! defined( 'ABSPATH' ) ) exit; | [Docs](https://developer.wordpress.org/plugins/wordpress-org/common-issues/#direct-file-access) |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\DebugBar\Extension.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 56 | 13 | WARNING | WordPress.WP.EnqueuedResourceParameters.NotInFooter | In footer ($in_footer) is not set explicitly wp_enqueue_script; It is recommended to load scripts in the footer. Please set this value to \`true\` to load it in the footer, or explicitly \`false\` if it should be loaded in the header. |  |
| 153 | 4 | WARNING | PluginCheck.CodeAnalysis.PHPErrorReporting.DirectErrorReportingCall | Detected production-time change to PHP error reporting: error_reporting(). | [Docs](https://www.php.net/manual/en/function.error-reporting.php) |
| 155 | 5 | WARNING | PluginCheck.CodeAnalysis.PHPErrorReporting.IniDirectiveDisplay_errors | Detected production-time change to PHP error reporting: ini_set(). | [Docs](https://www.php.net/manual/en/function.error-reporting.php) |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\includes\class-shopping-list-cron.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 47 | 9 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |
| 56 | 9 | WARNING | WordPress.PHP.DevelopmentFunctions.error_log_error_log | error_log() found. Debug code should not normally be used in production. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\includes\class-shopping-list-frontend.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 1 | 1 | WARNING | Internal.LineEndings.Mixed | File has mixed line endings; this may cause incorrect results |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\load-v5p7.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 27 | 8 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$pucGeneralClass&quot;. |  |
| 27 | 28 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$pucVersionedClass&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Metadata.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 46 | 27 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |
| 54 | 27 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |
| 120 | 41 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getPrefixedFilter(&#039;retain_fields&#039;) . &#039;-&#039; . $from-&gt;slug&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Plugin\UpdateChecker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 56 | 41 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$slugCheckFilter&quot;. |  |
| 149 | 41 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getUniqueName(&#039;request_info_result&#039;)&quot;. |  |
| 196 | 41 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getUniqueName(&#039;pre_inject_info&#039;)&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\PucFactory.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 231 | 39 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_get_source_uri&quot;. |  |
| 276 | 34 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_get_vcs_service&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Scheduler.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 69 | 25 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;updateChecker-&gt;getUniqueName(&#039;first_check_time&#039;)&quot;. |  |
| 207 | 17 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;updateChecker-&gt;getUniqueName(&#039;check_now&#039;)&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\UpdateChecker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 138 | 17 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;plugin_locale&quot;. |  |
| 297 | 17 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getUniqueName(&#039;remove_from_default_update_checks&#039;)&quot;. |  |
| 441 | 37 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getUniqueName(&#039;request_update_result&#039;)&quot;. |  |
| 634 | 41 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getUniqueName(&#039;pre_inject_update&#039;)&quot;. |  |
| 767 | 17 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getUniqueName(&#039;autoupdate_field_allowed&#039;)&quot;. |  |
| 796 | 40 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getUniqueName($filterRoot . &#039;_query_args&#039;)&quot;. |  |
| 805 | 38 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getUniqueName($filterRoot . &#039;_options&#039;)&quot;. |  |
| 815 | 37 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;getUniqueName(&#039;request_metadata_http_result&#039;)&quot;. |  |
| 826 | 27 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Vcs\Api.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 110 | 21 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;strategyFilterName&quot;. |  |
| 345 | 42 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.DynamicHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$this-&gt;httpFilterName&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\plugin-update-checker\Puc\v5p7\Vcs\ThemeUpdateChecker.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 46 | 21 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound | Hook names invoked by a theme/plugin should start with the theme/plugin prefix. Found: &quot;puc_api_error&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\shopping-list.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 29 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;run_shopping_list&quot;. |  |
| 38 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;activate_shopping_list&quot;. |  |
| 54 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedFunctionFound | Functions declared in the global namespace by a theme/plugin should start with the theme/plugin prefix. Found: &quot;deactivate_shopping_list&quot;. |  |

## `C:\Users\aidan\Studio\divi-5\wp-content\plugins\shopping-list\uninstall.php`

| Line | Column | Type | Code | Message | Docs |
| --- | --- | --- | --- | --- | --- |
| 10 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$days&quot;. |  |
| 13 | 1 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$timestamp&quot;. |  |
| 18 | 20 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$day&quot;. |  |
| 19 | 5 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$hook&quot;. |  |
| 20 | 5 | WARNING | WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound | Global variables defined by a theme/plugin should start with the theme/plugin prefix. Found: &quot;$timestamp&quot;. |  |
