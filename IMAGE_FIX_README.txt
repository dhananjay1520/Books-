BOOKSPOT IMAGE FIX

1. Keep this project directly inside:
   C:\xampp\htdocs\book\

2. The project root must contain:
   index.php
   application\
   system\
   assets\
   uploads\
   .htaccess

3. Open:
   http://localhost/book/

4. Do NOT open application/ directly. It is intentionally protected.

Image fixes included:
- Auto-detected base URL for localhost subfolders.
- Product images resolve from legacy assets/uploads category folders.
- Profile/admin images resolve from uploads/profile and uploads/admin_profile.
- Category page no longer prints raw database image paths.
- Missing images fall back to local placeholder-book.svg.
- Root .htaccess no longer contains a hard-coded RewriteBase.
