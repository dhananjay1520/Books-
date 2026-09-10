# BookSpot CI3 MVC Admin

## Admin URLs
- `/index.php/admin/login`
- `/index.php/admin`
- `/index.php/admin/users`
- `/index.php/admin/products`
- `/index.php/admin/ebooks`
- `/index.php/admin/messages`
- `/index.php/admin/orders`
- `/index.php/admin/reports`
- `/index.php/admin/profile`

## Local admin login
- Username: `admin`
- Password: `admin123`

## Important database notes
1. Run `database_admin_mvc.sql` in the `project` database.
2. Run `database_admin_profile_safe.sql` only when the `admin_login` profile columns (`name`, `email`, `image`) are not already present.
3. The existing `users.address` column is preserved. Do not add `address` a second time.

## UI
- Collapsed sidebar by default on desktop.
- Three-line sidebar toggle; no arrow toggle.
- Light/dark mode with persistent browser storage.
- Accent themes: Indigo, Emerald, Ocean, Rose.
- User dropdown contains My Profile, Orders, and Logout.
- DataTables provide page length, Export, Columns Visibility, Search, ordering, responsive layout, record info, and pagination.
