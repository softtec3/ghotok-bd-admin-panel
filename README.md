# Ghotok BD — Admin Panel

**Project Overview**

- **Name:** `ghotok-bd-admin-panel` — A lightweight PHP admin panel for managing biodata and transactions.
- **Purpose:** Provide administrators a simple web UI and PHP endpoints to manage advertise, user biodata, transactions, and uploads for a classifieds-style site.

**Key Features**

- **Advert Management:** Create, list and change status of advertisements via `php/add_advertise.php`, `php/all_advertise.php`, and `php/change_ad_status.php`.
- **Biodata Management:** View and moderate user biodata via `php/all_biodata.php`, `php/change_bio_status.php`, and `php/single_bio.php`.
- **Transactions:** List transactions via `php/all_transactions.php`.
- **Authentication:** Simple admin login using `login.php` and session checks in `php/is_logged_in.php`.
- **File Uploads:** Central `uploads/` folder for user-submitted files.
- **Utilities:** Database table creation helper `php/create_tables.php` and DB connection helper `php/db_connect.php`.

**Requirements**

- **Server:** PHP 7.2+ (or compatible PHP 8.x). Works on Apache/IIS/nginx with PHP support.
- **Database:** MySQL / MariaDB (used by `php/db_connect.php`).
- **Environment:** Windows, macOS, Linux supported for local dev; production requires a web server + PHP.

**Quick Start (Development)**

- **Clone repository:** `git clone <repo-url> ghotok-bd-admin-panel`
- **Install PHP:** Ensure `php` is on your `PATH` (verify with `php -v`).
- **Create database:** Create an empty MySQL database for the app.
- **Configure DB connection:**
  - Open `php/db_connect.php` and update the connection variables (`$servername`, `$username`, `$password`, `$dbname`) to match your database credentials.
- **Create tables:** Run the table setup helper (via browser or CLI):
  - CLI: `php .\php\create_tables.php` (PowerShell) or `php php/create_tables.php` (bash)
  - Browser: navigate to `http://localhost/path-to-repo/php/create_tables.php` if using a local webserver.
- **Start server:** If you want a quick PHP built-in server (for development):
  - `php -S localhost:8000` from the repository root and open `http://localhost:8000`.

**Configuration Notes**

- **Database credentials:** Stored in `php/db_connect.php`. For production, move credentials to a non-public config file or environment variables and restrict file permissions.
- **Uploads directory:** `uploads/` should be writable by the web server. Restrict direct execution and validate file types before use.

**File & Folder Map**

- **Root files:** `index.php`, `login.php`, `admin.php` (JavaScript/CSS: `admin.js`, `admin.css`, `login.css`).
- **PHP endpoints (in `php/`):**
  - `add_advertise.php` — Handler to add new adverts.
  - `all_advertise.php` — Lists all adverts for admin view.
  - `all_biodata.php` — Lists all user biodata records.
  - `all_transactions.php` — Lists transactions.
  - `change_ad_status.php` — Toggle/change advert status.
  - `change_bio_status.php` — Toggle/change biodata status.
  - `create_tables.php` — Creates necessary DB tables (run once during setup).
  - `db_connect.php` — Central DB connection helper used across endpoints.
  - `delete_user.php` — Removes a user entry.
  - `is_logged_in.php` — Session / authentication guard for admin pages.
  - `login.php` — Processes admin login.
  - `logout.php` — Logs out admin users.
  - `single_bio.php` — Displays a single biodata record.
- **Uploads:** `uploads/` — stores uploaded files (images, attachments).

**Usage & Admin Flow**

- **Login:** Open `login.php` and authenticate as admin. The project uses the session-checking helper `php/is_logged_in.php` on protected pages.
- **Manage adverts/biodata:** Use the admin UI (likely `index.php` or `admin.php`) to navigate to adverts, biodata, and transactions. Server-side handlers are in `php/`.
- **Moderation:** Use `php/change_ad_status.php` and `php/change_bio_status.php` to approve/reject content.

**Security Considerations**

- **Do not use default DB credentials in production.** Move credentials out of webroot or use environment variables.
- **Sanitize and validate inputs:** Ensure that any user-supplied data passed to SQL is parameterized (use prepared statements) to prevent SQL injection. Review `php/*.php` files and replace raw query concatenation with prepared statements if necessary.
- **Session handling:** Regenerate session IDs on login and use secure cookie flags in production (set `session.cookie_secure` and `session.cookie_httponly`).
- **File uploads:** Validate MIME types, check file size, and store uploads outside of public-executable paths or block execution via web server config (e.g., `.htaccess` rules for Apache).

**Troubleshooting**

- **DB connection errors:** Confirm credentials in `php/db_connect.php` and that MySQL server is running. Use `php -r "require 'php/db_connect.php';"` to test include errors.
- **Missing tables:** Run `php/create_tables.php` to recreate required tables.
- **Permission issues with uploads:** Ensure `uploads/` is writable by the webserver user (on Windows adjust folder permissions, on Linux use `chown`/`chmod`).

**Testing Locally**

- Start a PHP dev server: `php -S localhost:8000` and point your browser to `http://localhost:8000`.
- Alternatively, use XAMPP/WAMP and place the repository in your webserver `htdocs` folder.

**Contribution & Maintenance**

- **Issues & PRs:** Open issues for bugs or feature requests and submit pull requests for fixes. Keep changes small and focused.
- **Code hygiene:** Prefer using prepared statements for DB access and add input validation where missing.
- **Add tests:** There are no automated tests in this repo yet; consider adding PHPUnit tests for critical PHP helpers.

**Useful Commands (PowerShell)**

- Run DB creation script: `php .\php\create_tables.php`
- Start dev server: `php -S localhost:8000`

**Next Steps & Recommendations**

- Move DB credentials out of `php/db_connect.php` into environment variables or a protected config file.
- Harden file uploads by validating MIME types and enforcing size limits.
- Add CSRF protection to forms (include and verify token on POST requests).
- Add logging for admin actions and failed login attempts.

**License & Contact**

- **License:** (Not specified) — Add a `LICENSE` file to declare the project's license.
- **Maintainer / Contact:** Update this section to include your name, email, or project contact details. Contact with admin to get database sql file.
