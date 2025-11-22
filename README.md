# Auto Confirm Email Signups

A Moodle local plugin that automatically confirms users who self-register using the Email-based self-registration plugin, allowing them immediate access to your site without requiring email confirmation.

## Why Use This Plugin?

By default, Moodle's email self-registration requires users to click a confirmation link sent to their email before they can access the site. This plugin bypasses that step by automatically confirming users upon registration, which is useful when:

- You want to reduce friction in the registration process
- You trust your user base and don't require email verification
- You're running a development or testing environment
- You have other verification mechanisms in place

## Prerequisites

- Moodle 3.7 or later
- Email-based self-registration must be enabled (`Site administration -> Plugins -> Authentication -> Manage authentication`)

## Installation

**Option 1: Via Moodle Admin Interface**
1. Download the plugin as a ZIP file
2. Go to `Site administration -> Plugins -> Install plugins`
3. Upload `local_autoconfirm.zip`
4. Click "Install plugin from the ZIP file"
5. Follow the on-screen prompts

**Option 2: Manual Installation**
1. Unzip the plugin into `moodle/local/autoconfirm/`
2. Visit `Site administration -> Notifications` to complete installation

## Configuration

No configuration needed! The plugin works automatically after installation. Once installed, it will:

- Monitor all new user registrations
- Automatically confirm users who register via email self-registration
- Redirect users to the login page immediately after registration
- Leave other authentication methods (LDAP, OAuth, etc.) unchanged

## How It Works

The plugin listens for Moodle's user creation events. When a new user registers:

1. The plugin detects the `user_created` event
2. It checks if the user registered via email self-registration (`auth = 'email'`)
3. If the user is unconfirmed, it automatically sets `confirmed = 1` in the database
4. A session flag is set to indicate auto-confirmation
5. The user is immediately redirected to the login page
6. The user can log in right away without clicking a confirmation email

## Important Notes

- ⚠️ **Email notifications**: This plugin does NOT prevent Moodle from sending confirmation emails. It only marks accounts as confirmed so users don't need to click the link.
- ⚠️ **Security**: Auto-confirming users means anyone can register with any email address (even if they don't own it). Use this only if you're comfortable with this security tradeoff.
- ⚠️ **Testing**: Always test on a staging site first before deploying to production.

## Compatibility

- **Tested with**: Moodle 3.7 - 4.x
- **Requires**: Moodle 3.7 or later
- **Supported authentication**: Email-based self-registration only

## License

This plugin is licensed under the GNU GPL v3 or later.

## Support

For issues, questions, or contributions, please create an issue in the project repository.
