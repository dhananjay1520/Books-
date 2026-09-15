# BookSpot — Errors Fixed (Summary)

Maine project ko actual PHP + MySQL server pe chalake test kiya (sirf code
padh ke nahi) aur ye real errors mile, jo ab fix ho chuke hain:

## 1. Homepage crash — sabse bada issue
`application/controllers/Home.php` `build_wishlist_status()` naam ka method
call kar raha tha jo kahin define hi nahi tha. Isse **har baar homepage
kholte hi Fatal Error** aata tha (navbar/footer bhi isi controller se load
hote hain, isliye ye site-wide issue jaisa lagta tha). **Fixed**: missing
method add kar diya.

## 2. Category / Filter page query error
`application/models/Filter_model.php` products table ke column ko
`category` bata raha tha, jabki asal column `pr_cate` hai (jaisa Product
model aur admin panel dono mein use hota hai). Isse category select karte
hi DB error aata tha. **Fixed**: `pr_cate` use karne ke liye update kiya.

## 3. Contact form ka data admin panel mein missing
"Send a message" form `contact_messages` table mein save hota tha, lekin
admin ka Messages page `contact_form_submissions` (ya `messages`) table
padhta tha — matlab customer ke messages admin ko kabhi dikhte hi nahi the.
**Fixed**: dono ek hi table use karte hain ab. Naya migration file
`database_contact_messages.sql` add kiya hai — ise apne DB mein run kar lein.

## 4. Har page pe ugly "A PHP Error was encountered" boxes
PHP 8.1+ pe purana CodeIgniter 3 core "Creation of dynamic property ...
deprecated" jaise harmless warnings deta hai — ye asli bug nahi hain, bas
framework ka noise hai jo har page ke upar badsurat error box dikhata tha.
**Fixed**: `index.php` mein error display adjust kiya taaki ye chhup jayein,
lekin agar koi real error/fatal issue ho to wo ab bhi turant dikhega.

## 5. Images not visible on ALL pages (root cause)
`application/config/config.php` mein `base_url` **hardcoded** tha:
`http://localhost/book/`. Har image, CSS aur JS file isi ek value se
banti hai — agar aapki site is exact address pe na ho (folder ka naam
alag, live domain, alag port, etc.) to **har page pe har image, aur
poora design bhi, break ho jata hai**. Yahi asli wajah thi.
**Fixed**: ab `base_url` current request se **automatically detect**
hota hai (safe tarike se, sirf host + script path se — koi bhi
user-controlled header trust nahi kiya). Ab site kahin bhi (XAMPP,
live server, koi bhi folder/domain) bina manual config ke turant
sahi images/CSS/JS load karegi.

## 6. Design cleanup
`cart/index.php` teen alag-alag purane CSS class-systems ek saath stack
kar raha tha (`store-page bs-cart-page bs-cart-page-v2`), jo ek AI se
baar-baar regenerate hui cart design ka leftover tha — isse styling
thodi inconsistent ho sakti thi. Maine sirf sabse polished/complete
system (`bs-cart-page-v2`) rakha aur baaki clean kar diya.
Base typography, colors, buttons (`assets/css/style.css`) ko bhi polish
kiya — consistent accent color (purple/indigo, jo already baaki site
mein use ho raha tha), better font stack, spacing aur button hover
states.

## Zaroori server setting (aapki hosting/XAMPP mein check karein)
- PHP ka `mysqli` extension **enabled** hona chahiye — agar disabled hoga
  to poori site down ho jayegi (koi bhi page load nahi hoga), kyunki
  har DB query mysqli driver use karti hai.
- PHP `gd` extension bhi hona chahiye (product/profile image upload ke liye).

## Setup steps
1. `application/config/database.php` mein apna DB hostname/username/password
   check kar lein (currently `root` / blank password / db `project`).
2. In SQL files ko apne `project` database mein import karein (agar pehle
   se nahi kiye hain):
   - `database_admin_mvc.sql`
   - `database_admin_profile_safe.sql`
   - `database_contact_messages.sql` (naya)
3. Admin login: `/index.php/admin/login` — username `admin`, password
   `admin123` (pehli baar login karte hi password automatically hash ho
   jayega).

## Verify kiya gaya (end-to-end, real requests se)
- Home page, Category/Filter page, Product details, Search
- Signup / Login / Forgot password
- Wishlist add/remove, Cart add/update/remove, Checkout, Rent
- Profile view + update + photo upload
- Admin: login, dashboard, Products (add with image upload verified),
  Users, eBooks, Messages, Orders, Reports, Profile

Sab pages ab bina kisi error ke load ho rahe hain, aur upload ki hui image
turant admin list + public homepage dono jagah sahi se dikh rahi hai.
