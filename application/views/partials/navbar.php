<style>
:root{--bs-brand:#5b4bdb;--bs-brand-2:#7c6cf3;--bs-ink:#182033;--bs-muted:#6b7280;--bs-line:#e7eaf0;--bs-soft:#f6f7fb;--bs-dark:#111827}
.book-navbar{position:sticky;top:0;z-index:1500;background:rgba(255,255,255,.96);backdrop-filter:blur(14px);border-bottom:1px solid var(--bs-line);font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}
.book-top{min-height:76px;display:flex;align-items:center;gap:16px;padding:0 4%;max-width:1440px;margin:auto}.book-menu-toggle{width:42px;height:42px;border:1px solid var(--bs-line);background:#fff;border-radius:12px;color:var(--bs-ink);display:grid;place-items:center;cursor:pointer;transition:.2s}.book-menu-toggle:hover{color:var(--bs-brand);border-color:#cfc9ff;background:#faf9ff}.book-logo{font-size:27px;font-weight:800;text-decoration:none;color:var(--bs-ink);letter-spacing:-.04em;white-space:nowrap}.book-logo span{color:var(--bs-brand)}.book-search{position:relative;flex:1;max-width:520px;margin-left:auto}.book-search input{width:100%;border:1px solid var(--bs-line);background:#f8f9fc;border-radius:14px;padding:12px 16px 12px 44px;font-size:13px;outline:none;transition:.2s;box-sizing:border-box}.book-search input:focus{border-color:#c8c2ff;background:#fff;box-shadow:0 0 0 4px rgba(91,75,219,.08)}.book-search i{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#8b93a5;font-size:14px}.book-actions{display:flex;align-items:center;gap:8px;margin-left:auto}.book-icon-link,.book-user-btn{position:relative;width:42px;height:42px;border:0;background:transparent;display:grid;place-items:center;color:#4b5563;text-decoration:none;border-radius:12px;cursor:pointer}.book-icon-link:hover,.book-user-btn:hover{background:#f4f2ff;color:var(--bs-brand)}.book-cart-count{position:absolute;top:0;right:-1px;background:#ef476f;color:#fff;border-radius:999px;font-size:9px;line-height:16px;min-width:16px;height:16px;text-align:center;border:2px solid #fff}.book-user{position:relative}.book-avatar{width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid #fff;box-shadow:0 2px 8px rgba(23,32,51,.12)}.book-avatar-fallback{background:#ece9ff;color:var(--bs-brand);display:grid;place-items:center;font-size:15px}.book-user-chevron{font-size:9px;margin-left:2px;color:#7a8495}.book-user-menu{display:none;position:absolute;right:0;top:50px;width:250px;background:#fff;border:1px solid var(--bs-line);border-radius:16px;box-shadow:0 22px 50px rgba(23,32,51,.16);padding:8px}.book-user-menu.show{display:block}.book-menu-head{display:flex;align-items:center;gap:11px;padding:11px 10px 13px;border-bottom:1px solid #eef0f4;margin-bottom:5px}.mini-avatar{width:40px;height:40px;border-radius:50%;object-fit:cover;background:#ece9ff;color:var(--bs-brand);display:grid;place-items:center}.book-menu-name{font-size:13px;font-weight:700;color:var(--bs-ink)}.book-menu-email{font-size:11px;color:var(--bs-muted);margin-top:2px;word-break:break-word}.book-menu-item{display:flex;align-items:center;gap:11px;color:#384152;text-decoration:none;padding:11px;border-radius:10px;font-size:13px}.book-menu-item:hover{background:var(--bs-soft);color:var(--bs-brand)}.book-menu-item.logout{color:#dc4c64;border-top:1px solid #eef0f4;border-radius:0 0 10px 10px;margin-top:4px;padding-top:13px}.book-nav{border-top:1px solid #f2f3f6}.book-nav-inner{display:flex;align-items:center;gap:30px;padding:0 4%;height:46px;max-width:1440px;margin:auto}.book-nav a{font-size:13px;font-weight:650;color:#667085;text-decoration:none;position:relative;height:46px;display:flex;align-items:center}.book-nav a:hover{color:var(--bs-brand)}.book-nav a:after{content:'';position:absolute;height:2px;width:0;left:0;bottom:0;background:var(--bs-brand);transition:.2s}.book-nav a:hover:after{width:100%}
.book-sidebar-overlay{position:fixed;inset:0;background:rgba(15,23,42,.45);opacity:0;visibility:hidden;transition:.25s;z-index:1550}.book-sidebar-overlay.show{opacity:1;visibility:visible}.book-sidebar{position:fixed;left:-320px;top:0;bottom:0;width:300px;background:linear-gradient(180deg,#ffffff 0%,#fbfbff 100%);border-right:1px solid var(--bs-line);box-shadow:20px 0 50px rgba(17,24,39,.1);z-index:1600;transition:left .28s ease;padding:22px 18px;box-sizing:border-box;overflow:auto}.book-sidebar.open{left:0}.sidebar-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}.sidebar-title{font-weight:800;font-size:20px;color:var(--bs-ink)}.sidebar-title span{color:var(--bs-brand)}.sidebar-close{width:36px;height:36px;border:1px solid var(--bs-line);background:#fff;border-radius:10px;color:#5f6673;cursor:pointer}.sidebar-close:hover{color:#fff;background:var(--bs-brand);border-color:var(--bs-brand)}.sidebar-profile{display:flex;gap:12px;align-items:center;padding:12px;background:#f4f2ff;border:1px solid #e7e2ff;border-radius:14px;margin-bottom:18px}.sidebar-profile .avatar{width:44px;height:44px;border-radius:50%;object-fit:cover;background:#ddd7ff;display:grid;place-items:center;color:var(--bs-brand);font-size:18px}.sidebar-profile strong{display:block;font-size:13px;color:var(--bs-ink)}.sidebar-profile span{display:block;font-size:11px;color:var(--bs-muted);margin-top:2px}.side-group{margin-top:18px}.side-label{text-transform:uppercase;font-size:10px;font-weight:800;letter-spacing:.12em;color:#9aa1af;padding:0 8px;margin-bottom:8px}.side-link{display:flex;align-items:center;gap:12px;padding:11px 12px;margin-bottom:4px;border-radius:11px;text-decoration:none;color:#475467;font-size:13px;font-weight:650}.side-link i{width:18px;text-align:center;color:#6f63dc}.side-link:hover{background:#f4f2ff;color:var(--bs-brand)}
@media(max-width:850px){.book-search{order:5;flex-basis:100%;max-width:none;margin:0}.book-top{flex-wrap:wrap;padding:12px 4%;min-height:auto}.book-nav-inner{overflow:auto;white-space:nowrap}.book-user-chevron{display:none}}
@media(max-width:520px){.book-logo{font-size:23px}.book-icon-link{display:none}.book-actions{margin-left:auto}.book-sidebar{width:86vw;max-width:320px}}
</style>
<header class="book-navbar">
    <div class="book-top">
        <button class="book-menu-toggle" id="bookSidebarToggle" type="button" aria-label="Open menu"><i class="fa-solid fa-bars"></i></button>
        <a href="<?= site_url('home'); ?>" class="book-logo">Book<span>Spot</span></a>
        <form action="<?= site_url('product/search'); ?>" method="GET" class="book-search"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="query" placeholder="Search books, authors..." required aria-label="Search books"></form>
        <div class="book-actions">
            <a href="<?= site_url('cart'); ?>" class="book-icon-link" aria-label="Shopping cart"><i class="fa-solid fa-bag-shopping"></i><span class="book-cart-count" id="cartCount"><?php echo isset($cartCount) ? htmlspecialchars($cartCount) : '0'; ?></span></a>
            <?php $nav_logged_in=(bool)$this->session->userdata('login'); $nav_user_name=(string)$this->session->userdata('name'); $nav_user_email=(string)$this->session->userdata('email'); $nav_user_image=(string)$this->session->userdata('image'); ?>
            <div class="book-user">
                <button class="book-user-btn" id="bookUserBtn" type="button" aria-label="Account menu">
                    <?php if($nav_logged_in && $nav_user_image): ?><img id="navProfileImage" src="<?= base_url('uploads/profile/'.rawurlencode($nav_user_image)); ?>" class="book-avatar" alt="Profile"><?php else: ?><span class="book-avatar book-avatar-fallback" id="navProfileIcon"><i class="fa-solid fa-user"></i></span><?php endif; ?><i class="fa-solid fa-chevron-down book-user-chevron"></i>
                </button>
                <div class="book-user-menu" id="bookUserMenu">
                    <?php if($nav_logged_in): ?>
                    <div class="book-menu-head">
                        <?php if($nav_user_image): ?><img class="mini-avatar" id="menuProfileImage" src="<?= base_url('uploads/profile/'.rawurlencode($nav_user_image)); ?>" alt="Profile"><?php else: ?><span class="mini-avatar" id="menuProfileIcon"><i class="fa-solid fa-user"></i></span><?php endif; ?>
                        <div><div class="book-menu-name" id="menuUserName"><?= html_escape($nav_user_name) ?></div><div class="book-menu-email"><?= html_escape($nav_user_email) ?></div></div>
                    </div>
                    <a class="book-menu-item" href="<?= site_url('profile'); ?>"><i class="fa-regular fa-id-card"></i> My Profile</a>
                    <a class="book-menu-item logout" href="<?= site_url('auth/logout'); ?>"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
                    <?php else: ?>
                    <a class="book-menu-item" href="<?= site_url('auth/login'); ?>"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                    <a class="book-menu-item" href="<?= site_url('auth/signup'); ?>"><i class="fa-solid fa-user-plus"></i> Create Account</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <nav class="book-nav"><div class="book-nav-inner"><a href="<?= site_url('home'); ?>">Home</a><a href="<?= site_url('category'); ?>">Categories</a><a href="<?= site_url('myebook'); ?>">eBooks</a><a href="<?= site_url('about'); ?>">About Us</a><a href="<?= site_url('contact'); ?>">Contact</a></div></nav>
</header>
<div class="book-sidebar-overlay" id="bookSidebarOverlay"></div>
<aside class="book-sidebar" id="bookSidebar" aria-label="Quick navigation">
    <div class="sidebar-head"><div class="sidebar-title">Book<span>Spot</span></div><button class="sidebar-close" id="bookSidebarClose" type="button" aria-label="Close menu"><i class="fa-solid fa-xmark"></i></button></div>
    <div class="sidebar-profile">
        <?php if($nav_logged_in && $nav_user_image): ?><img class="avatar" id="sidebarProfileImage" src="<?= base_url('uploads/profile/'.rawurlencode($nav_user_image)); ?>" alt="Profile"><?php else: ?><span class="avatar" id="sidebarProfileIcon"><i class="fa-solid fa-user"></i></span><?php endif; ?>
        <div><strong><?= $nav_logged_in ? html_escape($nav_user_name) : 'Welcome, Reader' ?></strong><span><?= $nav_logged_in ? 'Your BookSpot account' : 'Discover your next book' ?></span></div>
    </div>
    <div class="side-group"><div class="side-label">Explore</div>
        <a class="side-link" href="<?= site_url('home'); ?>"><i class="fa-solid fa-house"></i> Home</a>
        <a class="side-link" href="<?= site_url('category'); ?>"><i class="fa-solid fa-layer-group"></i> Categories</a>
        <a class="side-link" href="<?= site_url('myebook'); ?>"><i class="fa-solid fa-book"></i> eBooks</a>
        <a class="side-link" href="<?= site_url('product/search'); ?>"><i class="fa-solid fa-compass"></i> Discover Books</a>
    </div>
    <div class="side-group"><div class="side-label">Account</div>
        <?php if($nav_logged_in): ?><a class="side-link" href="<?= site_url('profile'); ?>"><i class="fa-regular fa-id-card"></i> My Profile</a><?php endif; ?>
        <a class="side-link" href="<?= site_url('cart'); ?>"><i class="fa-solid fa-bag-shopping"></i> Cart</a>
        <a class="side-link" href="<?= site_url('contact'); ?>"><i class="fa-regular fa-envelope"></i> Support</a>
    </div>
</aside>
<script>
document.addEventListener('DOMContentLoaded',function(){
 const b=document.getElementById('bookUserBtn'),m=document.getElementById('bookUserMenu');
 if(b&&m){b.addEventListener('click',function(e){e.stopPropagation();m.classList.toggle('show')});document.addEventListener('click',function(e){if(!e.target.closest('.book-user'))m.classList.remove('show')});}
 const sb=document.getElementById('bookSidebar'),bt=document.getElementById('bookSidebarToggle'),bc=document.getElementById('bookSidebarClose'),ov=document.getElementById('bookSidebarOverlay');
 function closeSide(){if(sb)sb.classList.remove('open');if(ov)ov.classList.remove('show');document.body.style.overflow='';}
 function openSide(){if(sb)sb.classList.add('open');if(ov)ov.classList.add('show');}
 if(bt)bt.addEventListener('click',openSide);if(bc)bc.addEventListener('click',closeSide);if(ov)ov.addEventListener('click',closeSide);
 document.querySelectorAll('.side-link').forEach(x=>x.addEventListener('click',closeSide));
});
</script>
