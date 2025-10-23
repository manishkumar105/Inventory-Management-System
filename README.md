
# Features i used here
- Manage products with name, SKU, quantity, and price.
- Record stock in/out transactions and view history.
- Low stock notifications alert.
- Roles & permissions: Admin (full access), Inventory Staff (Create,View & Update), Viewer (read-only).
- Access control enforced via "Spatie Laravel Permission".


# Default Users
- Admin: admin@manish.com / 1234567890
- Inventory Staff: staff@manish.com / 1234567890
- Newly registered users get Viewer role by default.

# User Registration Welcome Email:
- Users receive a welcome email immediately after registering
- Used Laravel Events (UserRegistered) and Listeners (SendWelcomeEmail) to trigger emails.
- Emails are queued using Laravel’s database queue for better performance.
- Implemented ShouldQueue on both listener and mailable for async processing.
- Queue worker processes emails without blocking user registration flow.
- Email template uses Blade Markdown components for a clean, responsive design.

# Technologies version Used
- Laravel 10
- PHP 8.2
- Spatie Laravel Permission(latest:6+)

# Don't forget to run migration & Seeder and Newly registered users get Viewer role by default
 

