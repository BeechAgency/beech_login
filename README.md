# BEECH Agency - Login Plugin

A custom WordPress plugin that replaces the default WordPress login experience with a branded Beech login page and adds admin settings for login page styling, partner branding, dashboard messages, and GitHub-based plugin updates.

## Current Version

- **Version:** 4.1
- **Main plugin file:** `beech_login.php`

## Key Features

- Custom login page styling with brand logo, background images, color controls, and custom CSS.
- Optional login page latest posts section.
- Option to hide the language switcher and invert login page footer/logo colors.
- Admin settings screen under **Appearance > Update Login Page**.
- Hidden extra settings tab can be revealed by adding `?displayextraoptions=1` to the admin page URL.
- Dashboard widget with optional custom message and documentation link.
- Healthcheck REST endpoint at `/wp-json/beech/v1/health?token=...`.
- GitHub Releases-based plugin updater via `updater.php`.

## Installation

1. Copy the `beech_login` folder into `wp-content/plugins/`.
2. Activate the plugin in the WordPress admin.
3. Go to **Appearance > Update Login Page** to configure branding, background images, colors, and optional features.

## Admin Settings

The plugin supports the following settings:

- Login logo image
- Left panel image/style
- Right panel background image
- Primary and secondary colors
- Invert logo/footer colors
- Hide the language switcher
- Display latest posts on the login page
- Custom login page CSS
- Dashboard message box display
- Documentation link and custom dashboard message
- Partnership logo/message replacement
- Healthcheck API token

## Healthcheck API

A REST route is registered at `beech/v1/health`.

- URL: `/wp-json/beech/v1/health`
- Method: `GET`
- Required query param: `token`
- Token is stored in the option `BEECH_login_healthcheck_token`.

Example:

    https://example.com/wp-json/beech/v1/health?token=YOUR_TOKEN

## GitHub Releases Updater

This plugin supports auto-updates from GitHub releases using the release tag version and optional release assets.

### How it works

- `beech_login.php` initializes `BEECH_Updater` in `updater.php`.
- The updater fetches GitHub releases from `https://api.github.com/repos/BeechAgency/beech_login/releases`.
- The latest release `tag_name` is compared to the installed plugin version.
- If the release is newer, WordPress receives an update package URL.
- If the release includes assets, the first asset is used as the download package.

### Release workflow

Use this workflow when publishing a new plugin version:

1. Update the plugin header version in `beech_login.php`.
   - `Version: 4.1`
2. Commit your changes and push to GitHub.
3. Create a new GitHub release with:
   - Tag name matching the plugin version, e.g. `4.2`
   - Release title (e.g. `Beech Login 4.2`)
   - Release notes describing changes.
4. Attach a ZIP asset if you want the updater to download a dedicated release package.
   - If no asset is attached, the updater falls back to the GitHub zipball URL.
5. Publish the release.

### Notes

- The updater can use a private repo token via `authorize()` in `beech_login.php`.
- The release tag string is treated as the plugin version.
- If the release contains assets, the first asset becomes the download URL.

## Development Notes

- The admin page uses the WordPress media library to pick login images.
- The plugin registers many `register_setting()` options without sanitization.
- The custom login page output is injected via `login_enqueue_scripts`, `login_header`, and `login_footer`.
- If you update the plugin file version, ensure the GitHub release tag matches exactly.

## Known behavior

- The healthcheck endpoint only returns data when the `token` query parameter matches the stored option.
- The login page latest-posts panel is hidden unless the `Display Latest Posts on Login Page` setting is enabled.
- The plugin is not currently localized.

## Support

For help, contact Beech Agency at `hi@beech.agency`.
