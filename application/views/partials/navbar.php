<style>
/* Local icon fallback: public pages remain usable even when Font Awesome CDN is blocked. */
.fa-solid,.fa-regular,.fab{font-family:"Segoe UI Symbol","Arial Unicode MS",sans-serif!important;font-style:normal!important;font-weight:700!important;display:inline-block;line-height:1}
.fa-bars::before{content:"☰"}.fa-magnifying-glass::before{content:"⌕"}.fa-bag-shopping::before{content:"🛍"}.fa-user::before{content:"●"}.fa-chevron-down::before{content:"⌄"}.fa-id-card::before{content:"▣"}.fa-right-from-bracket::before{content:"↪"}.fa-right-to-bracket::before{content:"→"}.fa-user-plus::before{content:"+"}.fa-xmark::before{content:"×"}.fa-house::before{content:"⌂"}.fa-layer-group::before{content:"▤"}.fa-book::before{content:"▤"}.fa-compass::before{content:"◉"}.fa-envelope::before{content:"✉"}.fa-star::before{content:"★"}.fa-heart::before{content:"♡"}.fa-cart-shopping::before{content:"🛒"}.fa-check::before{content:"✓"}.fa-arrow-right::before{content:"→"}.fa-bolt::before{content:"⚡"}.fa-book-open::before{content:"▤"}.fa-book-open-reader::before{content:"▤"}.fa-shield-halved::before{content:"◆"}.fa-truck-fast::before{content:"▸"}.fa-headset::before{content:"◉"}.fa-camera::before{content:"◉"}.fa-chevron-down::before{content:"⌄"}.fa-lock::before{content:"◆"}.fa-arrow-left::before{content:"←"}.fa-trash-can::before{content:"⌫"}.fa-circle-check::before{content:"✓"}.fa-chevron-up::before{content:"⌃"}.fa-calendar::before{content:"□"}
:root{--bs-brand:#5b4bdb;--bs-brand-2:#7c6cf3;--bs-ink:#182033;--bs-muted:#6b7280;--bs-line:#e7eaf0;--bs-soft:#f6f7fb;--bs-dark:#111827}
.book-navbar{position:sticky;top:0;z-index:1500;background:rgba(255,255,255,.96);backdrop-filter:blur(14px);border-bottom:1px solid var(--bs-line);font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif}
.book-top{min-height:76px;display:flex;align-items:center;gap:16px;padding:0 4%;max-width:1440px;margin:auto}.book-menu-toggle{width:42px;height:42px;border:1px solid var(--bs-line);background:#fff;border-radius:12px;color:var(--bs-ink);display:grid;place-items:center;cursor:pointer;transition:.2s}.book-menu-toggle:hover{color:var(--bs-brand);border-color:#cfc9ff;background:#faf9ff}.book-logo{font-size:27px;font-weight:800;text-decoration:none;color:var(--bs-ink);letter-spacing:-.04em;white-space:nowrap}.book-logo span{color:var(--bs-brand)}.book-search{position:relative;flex:1;max-width:520px;margin-left:auto}.book-search input{width:100%;border:1px solid var(--bs-line);background:#f8f9fc;border-radius:14px;padding:12px 16px 12px 44px;font-size:13px;outline:none;transition:.2s;box-sizing:border-box}.book-search input:focus{border-color:#c8c2ff;background:#fff;box-shadow:0 0 0 4px rgba(91,75,219,.08)}.book-search i{position:absolute;left:16px;top:50%;transform:translateY(-50%);color:#8b93a5;font-size:14px}.book-actions{display:flex;align-items:center;gap:8px;margin-left:auto}.book-icon-link,.book-user-btn{position:relative;width:42px;height:42px;border:0;background:transparent;display:grid;place-items:center;color:#4b5563;text-decoration:none;border-radius:12px;cursor:pointer}.book-icon-link:hover,.book-user-btn:hover{background:#f4f2ff;color:var(--bs-brand)}.book-cart-count{position:absolute;top:0;right:-1px;background:#ef476f;color:#fff;border-radius:999px;font-size:9px;line-height:16px;min-width:16px;height:16px;text-align:center;border:2px solid #fff}.book-user{position:relative}.book-avatar{width:36px;height:36px;border-radius:50%;object-fit:cover;border:2px solid #fff;box-shadow:0 2px 8px rgba(23,32,51,.12)}.book-avatar-fallback{background:#ece9ff;color:var(--bs-brand);display:grid;place-items:center;font-size:15px}.book-user-chevron{font-size:9px;margin-left:2px;color:#7a8495}.book-user-menu{display:none;position:absolute;right:0;top:50px;width:250px;background:#fff;border:1px solid var(--bs-line);border-radius:16px;box-shadow:0 22px 50px rgba(23,32,51,.16);padding:8px}.book-user-menu.show{display:block}.book-menu-head{display:flex;align-items:center;gap:11px;padding:11px 10px 13px;border-bottom:1px solid #eef0f4;margin-bottom:5px}.mini-avatar{width:40px;height:40px;border-radius:50%;object-fit:cover;background:#ece9ff;color:var(--bs-brand);display:grid;place-items:center}.book-menu-name{font-size:13px;font-weight:700;color:var(--bs-ink)}.book-menu-email{font-size:11px;color:var(--bs-muted);margin-top:2px;word-break:break-word}.book-menu-item{display:flex;align-items:center;gap:11px;color:#384152;text-decoration:none;padding:11px;border-radius:10px;font-size:13px}.book-menu-item:hover{background:var(--bs-soft);color:var(--bs-brand)}.book-menu-item.logout{color:#dc4c64;border-top:1px solid #eef0f4;border-radius:0 0 10px 10px;margin-top:4px;padding-top:13px}.book-nav{border-top:1px solid #f2f3f6}.book-nav-inner{display:flex;align-items:center;gap:30px;padding:0 4%;height:46px;max-width:1440px;margin:auto}.book-nav a{font-size:13px;font-weight:650;color:#667085;text-decoration:none;position:relative;height:46px;display:flex;align-items:center}.book-nav a:hover{color:var(--bs-brand)}.book-nav a:after{content:'';position:absolute;height:2px;width:0;left:0;bottom:0;background:var(--bs-brand);transition:.2s}.book-nav a:hover:after{width:100%}
.book-sidebar-overlay{position:fixed;inset:0;background:rgba(15,23,42,.45);opacity:0;visibility:hidden;transition:.25s;z-index:1550}.book-sidebar-overlay.show{opacity:1;visibility:visible}.book-sidebar{position:fixed;left:-320px;top:0;bottom:0;width:300px;background:linear-gradient(180deg,#ffffff 0%,#fbfbff 100%);border-right:1px solid var(--bs-line);box-shadow:20px 0 50px rgba(17,24,39,.1);z-index:1600;transition:left .28s ease;padding:22px 18px;box-sizing:border-box;overflow:auto}.book-sidebar.open{left:0}.sidebar-head{display:flex;align-items:center;justify-content:space-between;margin-bottom:18px}.sidebar-title{font-weight:800;font-size:20px;color:var(--bs-ink)}.sidebar-title span{color:var(--bs-brand)}.sidebar-close{width:36px;height:36px;border:1px solid var(--bs-line);background:#fff;border-radius:10px;color:#5f6673;cursor:pointer}.sidebar-close:hover{color:#fff;background:var(--bs-brand);border-color:var(--bs-brand)}.sidebar-profile{display:flex;gap:12px;align-items:center;padding:12px;background:#f4f2ff;border:1px solid #e7e2ff;border-radius:14px;margin-bottom:18px}.sidebar-profile .avatar{width:44px;height:44px;border-radius:50%;object-fit:cover;background:#ddd7ff;display:grid;place-items:center;color:var(--bs-brand);font-size:18px}.sidebar-profile strong{display:block;font-size:13px;color:var(--bs-ink)}.sidebar-profile span{display:block;font-size:11px;color:var(--bs-muted);margin-top:2px}.side-group{margin-top:18px}.side-label{text-transform:uppercase;font-size:10px;font-weight:800;letter-spacing:.12em;color:#9aa1af;padding:0 8px;margin-bottom:8px}.side-link{display:flex;align-items:center;gap:12px;padding:11px 12px;margin-bottom:4px;border-radius:11px;text-decoration:none;color:#475467;font-size:13px;font-weight:650}.side-link i{width:18px;text-align:center;color:#6f63dc}.side-link:hover{background:#f4f2ff;color:var(--bs-brand)}
@media(max-width:850px){.book-search{order:5;flex-basis:100%;max-width:none;margin:0}.book-top{flex-wrap:wrap;padding:12px 4%;min-height:auto}.book-nav-inner{overflow:auto;white-space:nowrap}.book-user-chevron{display:none}}
@media(max-width:520px){.book-logo{font-size:23px}.book-icon-link{display:none}.book-actions{margin-left:auto}.book-sidebar{width:86vw;max-width:320px}}
</style>
<link rel="stylesheet" href="<?= base_url('assets/css/icons-fallback.css'); ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/store-pages.css'); ?>"><style id="bookspot-local-icons">
i.bs-icon-ready{display:inline-flex!important;align-items:center;justify-content:center;font-size:0!important;line-height:1!important;width:1.35em!important;height:1.35em!important;font-style:normal!important;vertical-align:-.16em!important}
i.bs-icon-ready::before{display:none!important;content:none!important}
.bs-menu-svg{width:22px!important;height:22px!important;display:block!important;stroke:currentColor!important;fill:none!important;stroke-width:2!important;stroke-linecap:round!important;stroke-linejoin:round!important}
i.bs-icon-ready .bs-local-icon{width:1em!important;height:1em!important;display:block!important;stroke:currentColor!important;fill:none!important;stroke-width:1.9!important;stroke-linecap:round!important;stroke-linejoin:round!important}
/* Larger, clearer icons on the two primary surfaces. */
.book-navbar i.bs-icon-ready{width:1.55em!important;height:1.55em!important}
.book-navbar .book-icon-link i.bs-icon-ready,.book-navbar .book-menu-item i.bs-icon-ready,.book-navbar .side-link i.bs-icon-ready{font-size:19px!important}
.sidebar-links a i.bs-icon-ready{font-size:23px!important;width:27px!important;height:24px!important}
.sidebar-toggle i.bs-icon-ready,.tool-btn i.bs-icon-ready,.theme-toggle i.bs-icon-ready{font-size:23px!important;width:25px!important;height:22px!important}
.ops-icon i.bs-icon-ready,.panel-head>i.bs-icon-ready{font-size:24px!important;width:27px!important;height:23px!important}
.admin-avatar i.bs-icon-ready{font-size:24px!important;width:28px!important;height:25px!important}
.trust-icon i.bs-icon-ready,.promo-chip i.bs-icon-ready,.promo-point i.bs-icon-ready{font-size:21px!important;width:24px!important;height:20px!important}
@media(max-width:575px){.book-navbar .book-icon-link i.bs-icon-ready{font-size:20px!important}}
</style><script>
/* BookSpot local icons: renders clean inline SVGs so icons never depend on CDN fonts. */
(function(){
const paths={
'user':'<circle cx="12" cy="8" r="3.2"/><path d="M5 20c.7-3.2 3.2-5 7-5s6.3 1.8 7 5"/>',
'users':'<circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3.5 20c.6-3.2 2.4-5 5.5-5s4.9 1.8 5.5 5M14 15c2.7 0 4.5 1.6 5 4"/>',
'user-plus':'<circle cx="9" cy="8" r="3"/><path d="M3.5 20c.6-3.2 2.4-5 5.5-5s4.9 1.8 5.5 5M18 8v6M15 11h6"/>',
'home':'<path d="m3 10 9-7 9 7"/><path d="M5 9v11h14V9M9 20v-6h6v6"/>',
'house':'<path d="m3 10 9-7 9 7"/><path d="M5 9v11h14V9M9 20v-6h6v6"/>',
'book':'<path d="M5 4.5A2.5 2.5 0 0 1 7.5 2H20v17H7.5A2.5 2.5 0 0 0 5 21z"/><path d="M5 4.5V21M8 6h8"/>',
'book-open':'<path d="M4 5.5A3.5 3.5 0 0 1 7.5 2H12v18H7.5A3.5 3.5 0 0 0 4 23zM20 5.5A3.5 3.5 0 0 0 16.5 2H12v18h4.5A3.5 3.5 0 0 1 20 23z"/>',
'search':'<circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 5 5"/>',
'magnifying-glass':'<circle cx="10.8" cy="10.8" r="6.8"/><path d="m16 16 5 5"/>',
'heart':'<path d="M20.8 8.7c0 5-8.8 10.3-8.8 10.3S3.2 13.7 3.2 8.7A4.7 4.7 0 0 1 12 6.2a4.7 4.7 0 0 1 8.8 2.5Z"/>',
'star':'<path d="m12 3 2.8 5.7 6.2.9-4.5 4.4 1.1 6.2-5.6-3-5.6 3 1.1-6.2L3 9.6l6.2-.9z"/>',
'cart-shopping':'<circle cx="9" cy="20" r="1.4"/><circle cx="18" cy="20" r="1.4"/><path d="M3 4h2l2.2 11h10.5L20 7H6"/>',
'bag-shopping':'<path d="M5 8h14l-1 13H6z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
'basket-shopping':'<path d="M4 10h16l-1.5 10H5.5z"/><path d="M8 10 10 4M16 10l-2-6"/>',
'camera':'<path d="M4 7h4l1.4-2h5.2L16 7h4v12H4z"/><circle cx="12" cy="13" r="3.5"/>',
'lock':'<rect x="5" y="10" width="14" height="11" rx="2"/><path d="M8 10V7a4 4 0 0 1 8 0v3"/>',
'envelope':'<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m4 7 8 6 8-6"/>',
'calendar':'<rect x="3" y="5" width="18" height="16" rx="2"/><path d="M8 3v4M16 3v4M3 10h18"/>',
'clock':'<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/>',
'check':'<path d="m5 12 4 4L19 6"/>',
'circle-check':'<circle cx="12" cy="12" r="9"/><path d="m8 12 2.5 2.5L16 9"/>',
'circle-xmark':'<circle cx="12" cy="12" r="9"/><path d="m9 9 6 6M15 9l-6 6"/>',
'xmark':'<path d="m6 6 12 12M18 6 6 18"/>',
'bars':'<path d="M4 6h16M4 12h16M4 18h16"/>',
'chevron-down':'<path d="m6 9 6 6 6-6"/>',
'arrow-right':'<path d="M4 12h15M13 6l6 6-6 6"/>',
'arrow-trend-up':'<path d="m4 16 5-5 4 3 7-8"/><path d="M15 6h5v5"/>',
'plus':'<path d="M12 5v14M5 12h14"/>',
'cloud-arrow-up':'<path d="M7 18a5 5 0 0 1 0-10 6 6 0 0 1 11-1 4.5 4.5 0 0 1 0 9H7"/><path d="M12 16V10M9.5 12.5 12 10l2.5 2.5"/>',
'download':'<path d="M12 3v12M7 10l5 5 5-5M5 21h14"/>',
'print':'<path d="M7 8V3h10v5M6 17H4V9h16v8h-2"/><path d="M7 14h10v7H7z"/>',
'phone':'<path d="M7 3h3l1 5-2 1c1 3 3 5 6 6l1-2 5 1v3c0 1.1-.9 2-2 2C10.3 19 5 13.7 5 7c0-1.1.9-2 2-2Z"/>',
'location-dot':'<path d="M12 21s7-6.1 7-11a7 7 0 1 0-14 0c0 4.9 7 11 7 11Z"/><circle cx="12" cy="10" r="2.2"/>',
'shield-halved':'<path d="M12 3 19 6v5c0 5-3.2 8.2-7 10-3.8-1.8-7-5-7-10V6z"/><path d="M12 3v18"/>',
'shield-heart':'<path d="M12 3 19 6v5c0 5-3.2 8.2-7 10-3.8-1.8-7-5-7-10V6z"/><path d="M8.8 11.2c0-1.5 1.8-2.2 3.2-.8 1.4-1.4 3.2-.7 3.2.8 0 1.7-3.2 3.5-3.2 3.5s-3.2-1.8-3.2-3.5Z"/>',
'headset':'<path d="M4 13v-1a8 8 0 0 1 16 0v1"/><path d="M4 13h3v6H5a2 2 0 0 1-1-1.7zM20 13h-3v6h2a2 2 0 0 0 1-1.7z"/><path d="M17 19c0 2-2 3-5 3"/>',
'right-from-bracket':'<path d="M14 4h6v16h-6M11 12h9M16 8l4 4-4 4M4 4v16"/>',
'right-to-bracket':'<path d="M10 4H4v16h6M8 12h12M16 8l4 4-4 4"/>',
'compass':'<circle cx="12" cy="12" r="9"/><path d="m15.5 8.5-2.2 4.8-4.8 2.2 2.2-4.8z"/>',
'layer-group':'<path d="m3 8 9-5 9 5-9 5zM3 12l9 5 9-5M3 16l9 5 9-5"/>',
'box':'<path d="m4 7 8-4 8 4-8 4zM4 7v10l8 4 8-4V7M12 11v10"/>',
'boxes-stacked':'<path d="m4 5 6-3 6 3-6 3zM4 5v7l6 3 6-3V5M14 9l6-3 1 1v9l-6 3-1-.5"/>',
'file-lines':'<path d="M6 3h8l4 4v14H6zM14 3v5h4M9 12h6M9 16h6"/>',
'file-pdf':'<path d="M6 3h8l4 4v14H6zM14 3v5h4M9 17c2-3 2-6 2-8M9 17c2 0 5-1 6-3"/>',
'file-excel':'<path d="M6 3h8l4 4v14H6zM14 3v5h4M9 11l4 6M13 11l-4 6"/>',
'receipt':'<path d="M6 3h12v18l-3-2-3 2-3-2-3 2zM9 8h6M9 12h6M9 16h3"/>',
'chart-column':'<path d="M5 20V10M12 20V5M19 20v-8"/>',
'chart-simple':'<path d="M5 19V13M12 19V7M19 19V10"/>',
'paper-plane':'<path d="m3 11 18-8-8 18-2-7zM11 14l10-11"/>',
'bell':'<path d="M18 9a6 6 0 0 0-12 0c0 7-3 7-3 9h18c0-2-3-2-3-9M10 21h4"/>',
'file-csv':'<path d="M6 3h8l4 4v14H6zM14 3v5h4M9 12h6M9 16h6"/>',
'copy':'<rect x="8" y="8" width="11" height="12" rx="2"/><path d="M16 8V5a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h3"/>',
'moon':'<path d="M20 15.5A8.5 8.5 0 0 1 8.5 4 8.5 8.5 0 1 0 20 15.5Z"/>',
'sun':'<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M2 12h2M20 12h2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M19.1 4.9l-1.4 1.4M6.3 17.7l-1.4 1.4"/>',
'palette':'<path d="M12 3a9 9 0 0 0 0 18h1.5a1.5 1.5 0 0 0 0-3H12a1.5 1.5 0 0 1 0-3h2a7 7 0 0 0 0-14Z"/><circle cx="7.5" cy="10" r="1"/><circle cx="10" cy="6.5" r="1"/><circle cx="14.5" cy="6.5" r="1"/>',
'truck-fast':'<path d="M3 6h11v10H3zM14 10h4l3 3v3h-7z"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/>', 'triangle-exclamation':'<path d="M12 4 21 20H3z"/><path d="M12 9v5M12 17h.01"/>', 'user-group':'<circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3.5 20c.6-3.2 2.4-5 5.5-5s4.9 1.8 5.5 5M14 15c2.7 0 4.5 1.6 5 4"/>', 'cubes-stacked':'<path d="m4 7 8-4 8 4-8 4zM4 7v10l8 4 8-4V7M12 11v10"/>', 'message':'<path d="M4 5h16v11H8l-4 4z"/><path d="M8 9h8M8 12h5"/>', 'envelope-open':'<path d="M3 7 12 13 21 7"/><path d="M4 5h16v14H4z"/>', 'circle-info':'<circle cx="12" cy="12" r="9"/><path d="M12 10v6M12 7h.01"/>', 'filter':'<path d="M4 6h16M7 12h10M10 18h4"/>', 'eye':'<path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/><circle cx="12" cy="12" r="2.5"/>', 'circle-exclamation':'<circle cx="12" cy="12" r="9"/><path d="M12 7v6M12 16h.01"/>', 'circle-plus':'<circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/>', 'dollar-sign':'<path d="M12 3v18M16 7c-.8-1-2.1-1.5-4-1.5-2.4 0-4 1.2-4 3s1.4 2.7 4 3.2 4 1.3 4 3.3-1.6 3.5-4 3.5-3.7-.7-4.5-1.8"/>', 'circle-user':'<circle cx="12" cy="12" r="9"/><circle cx="12" cy="9" r="2.5"/><path d="M7.5 18c.8-2.5 2.3-3.7 4.5-3.7s3.7 1.2 4.5 3.7"/>', 'pen':'<path d="m4 20 4.5-1 10-10a2.1 2.1 0 0 0-3-3l-10 10z"/><path d="m13.5 7.5 3 3"/>', 'trash':'<path d="M4 7h16M9 7V4h6v3M7 7l1 14h8l1-14M10 11v6M14 11v6"/>','spinner':'<path d="M12 3a9 9 0 1 0 9 9"/>', 'facebook-f':'<path d="M14 8h3V4h-3c-2.8 0-5 2.2-5 5v3H6v4h3v4h4v-4h3l1-4h-4V9c0-.6.4-1 1-1Z"/>', 'instagram':'<rect x="3" y="3" width="18" height="18" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/>', 'linkedin-in':'<path d="M5 9v10M5 5v.01M9 19V9M9 13c0-2.2 1.3-4 3.5-4S16 10.8 16 13v6M16 19v-5"/>'
};
function key(el){return [...el.classList].find(c=>c.startsWith('fa-')&&!['fa-solid','fa-regular','fa-brands'].includes(c))?.slice(3)||''}
function render(){document.querySelectorAll('i.fa-solid,i.fa-regular,i.fab').forEach(el=>{if(el.classList.contains('bs-icon-ready'))return;const k=key(el);const d=paths[k]||paths['circle-check'];el.innerHTML='<svg class="bs-local-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">'+d+'</svg>';el.classList.add('bs-icon-ready');});}
if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',render);else render();
if(window.MutationObserver){new MutationObserver(function(){render();}).observe(document.documentElement,{childList:true,subtree:true});}
window.BookSpotIcons={render};
})();
</script>
<header class="book-navbar">
    <div class="book-top">
        <button class="book-menu-toggle" id="bookSidebarToggle" type="button" aria-label="Open menu"><svg class="bs-menu-svg" viewBox="0 0 24 24" aria-hidden="true"><path d="M4 6h16M4 12h16M4 18h16"></path></svg></button>
        <a href="<?= site_url('home'); ?>" class="book-logo">Book<span>Spot</span></a>
        <form action="<?= site_url('product/search'); ?>" method="GET" class="book-search"><i class="fa-solid fa-magnifying-glass"></i><input type="text" name="query" placeholder="Search books, authors..." required aria-label="Search books"></form>
        <div class="book-actions">
            <a href="<?= site_url('cart'); ?>" class="book-icon-link" aria-label="Shopping cart"><i class="fa-solid fa-bag-shopping"></i><span class="book-cart-count" id="cartCount"><?php echo isset($cartCount) ? htmlspecialchars($cartCount) : '0'; ?></span></a>
            <?php $nav_logged_in=(bool)$this->session->userdata('login'); $nav_user_name=(string)$this->session->userdata('name'); $nav_user_email=(string)$this->session->userdata('email'); $nav_user_image=(string)$this->session->userdata('image'); ?>
            <div class="book-user">
                <button class="book-user-btn" id="bookUserBtn" type="button" aria-label="Account menu">
                    <?php if($nav_logged_in && $nav_user_image): ?><img id="navProfileImage" src="<?= profile_image_url($nav_user_image); ?>" class="book-avatar" alt="Profile" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/profile-placeholder.svg'); ?>';"><?php else: ?><span class="book-avatar book-avatar-fallback" id="navProfileIcon"><i class="fa-solid fa-user"></i></span><?php endif; ?><i class="fa-solid fa-chevron-down book-user-chevron"></i>
                </button>
                <div class="book-user-menu" id="bookUserMenu">
                    <?php if($nav_logged_in): ?>
                    <div class="book-menu-head">
                        <?php if($nav_user_image): ?><img class="mini-avatar" id="menuProfileImage" src="<?= profile_image_url($nav_user_image); ?>" alt="Profile" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/profile-placeholder.svg'); ?>';"><?php else: ?><span class="mini-avatar" id="menuProfileIcon"><i class="fa-solid fa-user"></i></span><?php endif; ?>
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
        <?php if($nav_logged_in && $nav_user_image): ?><img class="avatar" id="sidebarProfileImage" src="<?= profile_image_url($nav_user_image); ?>" alt="Profile" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/profile-placeholder.svg'); ?>';"><?php else: ?><span class="avatar" id="sidebarProfileIcon"><i class="fa-solid fa-user"></i></span><?php endif; ?>
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
