<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= html_escape(isset($title) ? $title : 'Admin Panel') ?> | BookSpot</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/2.3.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/buttons/3.2.6/css/buttons.bootstrap5.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/3.0.4/css/responsive.bootstrap5.min.css" rel="stylesheet">
<style id="bookspot-local-icons">
i.bs-icon-ready{display:inline-flex!important;align-items:center;justify-content:center;font-size:0!important;line-height:1!important;width:1.35em!important;height:1.35em!important;font-style:normal!important;vertical-align:-.16em!important}
i.bs-icon-ready::before{display:none!important;content:none!important}
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
'truck-fast':'<path d="M3 6h11v10H3zM14 10h4l3 3v3h-7z"/><circle cx="7" cy="18" r="2"/><circle cx="17" cy="18" r="2"/>', 'triangle-exclamation':'<path d="M12 4 21 20H3z"/><path d="M12 9v5M12 17h.01"/>', 'user-group':'<circle cx="9" cy="8" r="3"/><circle cx="17" cy="9" r="2.5"/><path d="M3.5 20c.6-3.2 2.4-5 5.5-5s4.9 1.8 5.5 5M14 15c2.7 0 4.5 1.6 5 4"/>', 'cubes-stacked':'<path d="m4 7 8-4 8 4-8 4zM4 7v10l8 4 8-4V7M12 11v10"/>', 'message':'<path d="M4 5h16v11H8l-4 4z"/><path d="M8 9h8M8 12h5"/>', 'envelope-open':'<path d="M3 7 12 13 21 7"/><path d="M4 5h16v14H4z"/>', 'circle-info':'<circle cx="12" cy="12" r="9"/><path d="M12 10v6M12 7h.01"/>', 'filter':'<path d="M4 6h16M7 12h10M10 18h4"/>', 'eye':'<path d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"/><circle cx="12" cy="12" r="2.5"/>', 'circle-exclamation':'<circle cx="12" cy="12" r="9"/><path d="M12 7v6M12 16h.01"/>', 'circle-plus':'<circle cx="12" cy="12" r="9"/><path d="M12 8v8M8 12h8"/>', 'dollar-sign':'<path d="M12 3v18M16 7c-.8-1-2.1-1.5-4-1.5-2.4 0-4 1.2-4 3s1.4 2.7 4 3.2 4 1.3 4 3.3-1.6 3.5-4 3.5-3.7-.7-4.5-1.8"/>', 'circle-user':'<circle cx="12" cy="12" r="9"/><circle cx="12" cy="9" r="2.5"/><path d="M7.5 18c.8-2.5 2.3-3.7 4.5-3.7s3.7 1.2 4.5 3.7"/>', 'pen':'<path d="m4 20 4.5-1 10-10a2.1 2.1 0 0 0-3-3l-10 10z"/><path d="m13.5 7.5 3 3"/>', 'trash':'<path d="M4 7h16M9 7V4h6v3M7 7l1 14h8l1-14M10 11v6M14 11v6"/>','spinner':'<path d="M12 3a9 9 0 1 0 9 9"/>'
};
function key(el){return [...el.classList].find(c=>c.startsWith('fa-')&&!['fa-solid','fa-regular','fa-brands'].includes(c))?.slice(3)||''}
function render(){document.querySelectorAll('i.fa-solid,i.fa-regular,i.fab').forEach(el=>{if(el.classList.contains('bs-icon-ready'))return;const k=key(el);const d=paths[k]||paths['circle-check'];el.innerHTML='<svg class="bs-local-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false">'+d+'</svg>';el.classList.add('bs-icon-ready');});}
if(document.readyState==='loading')document.addEventListener('DOMContentLoaded',render);else render();
if(window.MutationObserver){new MutationObserver(function(){render();}).observe(document.documentElement,{childList:true,subtree:true});}
window.BookSpotIcons={render};
})();
</script>
<style>
:root{
 --sidebar:#dce7f6;--sidebar-deep:#c8d9ee;--sidebar-text:#41577f;--sidebar-muted:#8294b4;
 --accent:#5b54ea;--accent-2:#7a73ff;--accent-soft:#efefff;--accent-ring:rgba(91,84,234,.16);
 --bg:#f5f7fb;--card:#fff;--text:#20293a;--muted:#7f8ba0;--border:#e4e8f0;
 --success:#17a673;--warning:#e7a42d;--danger:#de5a70;--info:#2996d8;
 --shadow:0 14px 38px rgba(31,45,73,.07)
}
*{box-sizing:border-box} html,body{margin:0;min-height:100%;font-family:Inter,system-ui,-apple-system,BlinkMacSystemFont,"Segoe UI",sans-serif;background:var(--bg);color:var(--text)} body{overflow-x:hidden}
a{text-decoration:none;color:inherit}.admin-shell{min-height:100vh}
/* Sidebar */
.sidebar{position:fixed;inset:0 auto 0 0;width:82px;z-index:1050;padding:15px 10px 18px;display:flex;flex-direction:column;overflow:visible;background:linear-gradient(180deg,#e7eef9 0%,#cfe0f3 100%);color:var(--sidebar-text);border-right:1px solid rgba(64,87,125,.08);box-shadow:6px 0 26px rgba(54,78,113,.08);transition:width .25s ease,transform .25s ease,box-shadow .25s ease}
.sidebar.is-open{width:256px}.brand{height:58px;display:flex;align-items:center;justify-content:center;padding:0 8px;margin-bottom:8px;color:#334b7c;white-space:nowrap}.brand-mark{width:42px;height:42px;border-radius:13px;display:grid;place-items:center;background:#fff;color:var(--accent);font-size:19px;font-weight:800;box-shadow:0 7px 16px rgba(54,78,113,.10);flex:0 0 42px}.brand-full{font-size:21px;font-weight:800;letter-spacing:-.04em;display:none;margin-left:9px}.brand-full span{color:var(--accent)}
.sidebar.is-open .brand-full{display:block}.sidebar.is-open .brand{justify-content:flex-start;padding-left:4px}.sidebar.is-open .brand-mark{background:transparent;box-shadow:none}
.account-block{display:flex;align-items:center;justify-content:center;gap:10px;padding:9px 4px 13px;border-bottom:1px solid rgba(66,88,127,.13);margin:0 0 7px}.account-avatar{width:44px;height:44px;flex:0 0 44px;border-radius:50%;display:grid;place-items:center;overflow:hidden;background:#fff;color:var(--accent);border:2px solid rgba(255,255,255,.9);box-shadow:0 5px 12px rgba(54,78,116,.12)}.account-avatar img{width:100%;height:100%;object-fit:cover}.account-copy{display:none;min-width:0;flex:1}.sidebar.is-open .account-copy{display:block}.account-name{font-size:12.5px;font-weight:800;color:#30436e;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.account-email{font-size:10px;color:#8392ad;margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.account-badge{display:none;margin-left:auto;padding:3px 7px;border-radius:999px;background:var(--accent);color:#fff;font-size:8px;font-weight:800;box-shadow:0 5px 12px var(--accent-ring)}.sidebar.is-open .account-badge{display:inline-block}
.sidebar-menu-title{display:none;font-size:9px;font-weight:800;text-transform:uppercase;letter-spacing:.14em;color:#8190aa;padding:12px 9px 6px}.sidebar.is-open .sidebar-menu-title{display:block}.sidebar-links{list-style:none;padding:0;margin:0}.sidebar-links li{margin:2px 0}.sidebar-links a{position:relative;display:flex;align-items:center;justify-content:center;gap:12px;height:42px;padding:0 12px;border-radius:11px;color:#4b6088;font-size:12.5px;font-weight:650;white-space:nowrap;overflow:hidden;transition:background .16s,color .16s,transform .16s}.sidebar-links a span{display:block;min-width:0;transition:opacity .15s,width .15s}.sidebar.is-open .sidebar-links a{justify-content:flex-start}.sidebar-links a i{width:21px;flex:0 0 21px;text-align:center;font-size:14px}.sidebar-links a:hover{background:rgba(255,255,255,.56);color:#334b80}.sidebar-links a.active{background:#efefff;color:#5049df;box-shadow:inset 3px 0 0 var(--accent)}.sidebar-links a.active i{color:var(--accent)}
/* Collapsed sidebar must show icons only — never clipped text. */
.sidebar:not(.is-open) .brand-full,
.sidebar:not(.is-open) .account-copy,
.sidebar:not(.is-open) .account-badge,
.sidebar:not(.is-open) .sidebar-menu-title,
.sidebar:not(.is-open) .sidebar-links a span{display:none!important}
.sidebar:not(.is-open) .sidebar-links a{justify-content:center!important;padding-left:10px;padding-right:10px}
.sidebar:not(.is-open) .sidebar-links a i{margin:0 auto}
.sidebar:not(.is-open) .account-block{justify-content:center}
.sidebar:not(.is-open) .brand{justify-content:center}

.sidebar:not(.is-open) .sidebar-links a::after{content:attr(data-label);position:absolute;left:calc(100% + 10px);top:50%;transform:translateY(-50%) translateX(-6px);opacity:0;visibility:hidden;padding:8px 11px;border:1px solid rgba(255,255,255,.08);border-radius:9px;background:#25324b;color:#fff;font-size:11px;font-weight:700;line-height:1;white-space:nowrap;box-shadow:0 10px 24px rgba(17,25,39,.22);transition:opacity .15s ease,transform .15s ease,visibility .15s ease;pointer-events:none;z-index:2000}.sidebar:not(.is-open) .sidebar-links a:hover::after,.sidebar:not(.is-open) .sidebar-links a:focus-visible::after{opacity:1;visibility:visible;transform:translateY(-50%) translateX(0)}
.sidebar-bottom-note{display:none}.sidebar-spacer{flex:1}
/* Main + topbar */
.main{min-height:100vh;margin-left:82px;transition:margin-left .25s ease}.sidebar.is-open~.main{margin-left:256px}.topbar{height:72px;background:rgba(255,255,255,.96);backdrop-filter:blur(12px);border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;padding:0 24px;position:sticky;top:0;z-index:1030}.topbar-left{display:flex;align-items:center;gap:13px;min-width:0}.sidebar-toggle{width:42px;height:42px;border:1px solid #dfe4ed;background:#fff;color:#53617a;display:grid;place-items:center;border-radius:11px;box-shadow:0 4px 12px rgba(31,43,69,.06);cursor:pointer}.sidebar-toggle:hover{color:var(--accent);border-color:#cfd5e3;background:#fbfcff}.sidebar-toggle i{font-size:17px}.top-title{font-size:18px;font-weight:750;letter-spacing:-.02em;white-space:nowrap}.topbar-tools{display:flex;align-items:center;gap:8px}.tool-btn{width:40px;height:40px;border:1px solid var(--border);background:#fff;color:#5a667b;border-radius:10px;display:grid;place-items:center;cursor:pointer}.tool-btn:hover{color:var(--accent);background:#f8f9fc}.theme-toggle{min-width:86px;height:40px;border:1px solid var(--border);background:#fff;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;gap:7px;color:var(--text);cursor:pointer;font-size:12px;font-weight:700;padding:0 10px}.theme-toggle:hover{background:#f6f7fb}.admin-account{position:relative}.admin-user-btn{border:1px solid var(--border);background:#fff;display:flex;align-items:center;gap:9px;padding:4px 8px;border-radius:11px;color:var(--text);box-shadow:0 2px 8px rgba(25,34,52,.03)}.admin-user-btn:hover{background:#fbfcfe}.admin-avatar{width:36px;height:36px;border-radius:50%;background:var(--accent-soft);color:var(--accent);display:grid;place-items:center;overflow:hidden}.admin-avatar img{width:100%;height:100%;object-fit:cover}.admin-user-menu,.notice-menu,.theme-menu{position:absolute;right:0;top:51px;background:var(--card);border:1px solid var(--border);border-radius:14px;box-shadow:0 18px 45px rgba(25,34,52,.14);padding:8px;display:none;z-index:1100}.admin-user-menu.show,.notice-menu.show,.theme-menu.show{display:block}.admin-user-menu{width:230px}.notice-menu{width:300px}.theme-menu{width:225px}.menu-title{font-size:11px;font-weight:800;text-transform:uppercase;letter-spacing:.08em;color:var(--muted);padding:7px 9px}.admin-user-menu a,.notice-item{display:flex;align-items:center;gap:10px;padding:10px 12px;border-radius:9px;color:#394458;font-size:13px}.admin-user-menu a:hover,.notice-item:hover{background:#f4f6ff;color:var(--accent)}.admin-user-menu .logout{color:var(--danger);border-top:1px solid #f0f1f4;margin-top:5px;padding-top:12px}.notice-item{align-items:flex-start}.notice-dot{width:8px;height:8px;border-radius:50%;background:var(--accent);margin-top:5px;flex:0 0 8px}.notice-item strong{display:block;font-size:12px}.notice-item span{display:block;font-size:10.5px;color:var(--muted);margin-top:2px}
.theme-options{display:grid;grid-template-columns:1fr 1fr;gap:7px;padding:4px}.theme-option{border:1px solid var(--border);background:var(--card);border-radius:10px;padding:8px;cursor:pointer;display:flex;align-items:center;gap:7px;font-size:11px;font-weight:700;color:var(--text)}.theme-dot{width:18px;height:18px;border-radius:6px;display:block}.dot-indigo{background:#5b54ea}.dot-emerald{background:#12a574}.dot-ocean{background:#1987d1}.dot-rose{background:#db5b77}
/* Shared content */
.content{padding:28px}.page-heading{font-size:25px;font-weight:700;margin:0}.page-subtitle{color:var(--muted);font-size:13px;margin-top:5px}.card{border:1px solid var(--border);box-shadow:var(--shadow);border-radius:16px;background:var(--card)}.stat{position:relative;overflow:hidden}.stat:after{content:'';position:absolute;right:-18px;bottom:-18px;width:86px;height:86px;border-radius:50%;background:linear-gradient(135deg,#eef2ff,#f5f3ff)}
.table-card{padding:0;overflow:hidden}.table-responsive{border-radius:16px}.admin-table{width:100%!important}.admin-table thead th{font-size:11px;text-transform:uppercase;letter-spacing:.05em;font-weight:700;color:#6d778a;background:#fafbfc;border-bottom:1px solid var(--border);padding:14px 13px;white-space:nowrap}.admin-table tbody td{padding:13px;font-size:13.5px;vertical-align:middle;border-color:#eef0f4}.admin-table tbody tr:hover{background:#fcfcff}.thumb,.table-thumb{width:44px;height:44px;border-radius:10px;object-fit:cover;border:1px solid #edf0f4}
/* DataTables */
.dt-container{font-size:13px}.dt-layout-row{padding:10px 16px}.dt-layout-row:first-child{margin:0;padding:16px 18px 10px}.dt-layout-row:last-child{padding:10px 18px 16px}.dt-layout-cell.dt-layout-start{display:flex;align-items:center;gap:10px;flex-wrap:wrap}.dt-layout-cell.dt-layout-end{display:flex;align-items:center;justify-content:flex-end}.dt-length{display:flex;align-items:center;gap:7px;color:#5f6b7d;font-size:13px;white-space:nowrap}.dt-length label{margin:0}.dt-length select{min-width:70px;border:1px solid #dfe3ea!important;border-radius:8px!important;padding:7px 26px 7px 9px!important;box-shadow:none!important}.dt-buttons{display:flex;gap:6px;flex-wrap:wrap}.dt-buttons .dt-button{border:1px solid #dfe3ea!important;background:#fff!important;color:#4e5b70!important;border-radius:8px!important;padding:7px 11px!important;font-size:12.5px!important;box-shadow:none!important}.dt-buttons .dt-button:hover{background:#f7f8fb!important;color:var(--text)!important}.dt-search{display:flex;align-items:center;justify-content:flex-end;gap:7px}.dt-search label{color:#6d778a;font-size:12px}.dt-search input{width:220px!important;border:1px solid #dfe3ea!important;border-radius:8px!important;padding:8px 11px!important;outline:0;box-shadow:none!important}.dt-search input:focus{border-color:#aeb5ef!important;box-shadow:0 0 0 3px var(--accent-ring)!important}.dt-info{font-size:12.5px;color:#748096}.dt-paging .dt-paging-button{min-width:36px;height:36px;border-radius:7px!important;border:1px solid #dfe3ea!important;background:#fff!important;color:#5a6577!important;margin:0 3px!important;padding:6px 9px!important}.dt-paging .dt-paging-button:hover:not(.disabled){background:#f2f4f8!important;color:#283244!important}.dt-paging .dt-paging-button.current{background:var(--accent)!important;border-color:var(--accent)!important;color:#fff!important}.dt-paging .dt-paging-button.disabled{opacity:.52}.dt-column-order{opacity:.65}
.btn-primary{background:var(--accent);border-color:var(--accent)}.btn-primary:hover{background:#4039d0;border-color:#4039d0}.form-control,.form-select{border-radius:10px;border-color:#dfe3ea;padding:.68rem .8rem}.form-control:focus,.form-select:focus{border-color:#aeb5ef;box-shadow:0 0 0 3px var(--accent-ring)}
/* Theme presets */
.theme-emerald{--accent:#0f9f73;--accent-2:#22b889;--accent-soft:#e8fbf4;--accent-ring:rgba(15,159,115,.16)}
.theme-ocean{--accent:#147fbe;--accent-2:#2d9cdb;--accent-soft:#e8f5fd;--accent-ring:rgba(20,127,190,.16)}
.theme-rose{--accent:#c94e6c;--accent-2:#e86d8a;--accent-soft:#fff0f4;--accent-ring:rgba(201,78,108,.16)}
.theme-violet{--accent:#7337d7;--accent-2:#8955eb;--accent-soft:#f3edff;--accent-ring:rgba(115,55,215,.16)}
.theme-amber{--accent:#c66c05;--accent-2:#eb950d;--accent-soft:#fff6e5;--accent-ring:rgba(198,108,5,.16)}
.dot-indigo{background:#5b54ea}.dot-emerald{background:#0f9f73}.dot-ocean{background:#147fbe}.dot-rose{background:#c94e6c}.dot-violet{background:#7337d7}.dot-amber{background:#c66c05}
.theme-dark{--bg:#0b1220;--card:#111a2a;--text:#edf3fb;--muted:#9aa9bf;--border:#27344a;--sidebar:#111c30;--sidebar-text:#c8d3e6;--sidebar-muted:#8ea0bc;--shadow:0 14px 38px rgba(0,0,0,.24);color-scheme:dark}
.theme-dark .topbar{background:rgba(11,18,32,.96);border-bottom-color:#263246}
.theme-dark .sidebar{background:linear-gradient(180deg,#111c30 0%,#0d1729 100%);border-right-color:#25334a;color:#c8d3e6;box-shadow:8px 0 28px rgba(0,0,0,.22)}
.theme-dark .brand,.theme-dark .account-name{color:#f3f6fb}.theme-dark .brand-mark{background:#172238;color:var(--accent);box-shadow:none}
.theme-dark .account-email,.theme-dark .sidebar-menu-title{color:#93a3bd}.theme-dark .sidebar-links a{color:#b9c6da}.theme-dark .sidebar-links a:hover{background:rgba(255,255,255,.06);color:#fff}
.theme-dark .sidebar-links a.active{background:color-mix(in srgb,var(--accent) 18%,transparent);color:#fff;box-shadow:inset 3px 0 0 var(--accent)}
.theme-dark .sidebar:not(.is-open) .sidebar-links a::after{background:#f4f7fb;color:#172033;border-color:#dce3ee;box-shadow:0 12px 28px rgba(0,0,0,.35)}
.theme-dark .sidebar-toggle,.theme-dark .admin-user-btn,.theme-dark .theme-toggle,.theme-dark .tool-btn{background:#121c2d;color:#edf3fb;border-color:#2a3850}
.theme-dark .sidebar-toggle:hover,.theme-dark .admin-user-btn:hover,.theme-dark .theme-toggle:hover,.theme-dark .tool-btn:hover{background:#172338;border-color:#34445e}
.theme-dark .admin-user-menu,.theme-dark .notice-menu,.theme-dark .theme-menu{background:#121c2d;border-color:#2b3a51;box-shadow:0 20px 50px rgba(0,0,0,.35)}
.theme-dark .admin-user-menu a,.theme-dark .notice-item{color:#dbe4f2}.theme-dark .admin-user-menu a:hover,.theme-dark .notice-item:hover{background:#19253a;color:#fff}.theme-dark .admin-user-menu .logout{border-top-color:#29374c}
.theme-dark .admin-table thead th{background:#101927;color:#b9c5d8;border-color:#27344a}.theme-dark .admin-table tbody td{border-color:#243149;color:#dce5f0}.theme-dark .admin-table tbody tr:hover{background:#131f31}
.theme-dark .dt-buttons .dt-button,.theme-dark .dt-search input,.theme-dark .dt-length select,.theme-dark .dt-paging .dt-paging-button{background:#121c2d!important;color:#d8e1ef!important;border-color:#2b3a51!important}
.theme-dark .dt-buttons .dt-button:hover,.theme-dark .dt-paging .dt-paging-button:hover:not(.disabled){background:#1a2840!important;color:#fff!important}
.theme-dark .dt-search label,.theme-dark .dt-length,.theme-dark .dt-info{color:#a7b4c8}.theme-dark .form-control,.theme-dark .form-select{background:#0f1827;color:#edf3fb;border-color:#2b3a51}.theme-dark .form-control::placeholder{color:#7f8da3}
.theme-dark .card,.theme-dark .table-card,.theme-dark .modal-content,.theme-dark .dropdown-menu{background:#111a2a;border-color:#28364b;color:#edf3fb}
.theme-dark .page-subtitle,.theme-dark .text-muted{color:#98a7bd!important}.theme-dark .text-dark{color:#edf3fb!important}.theme-dark .bg-white{background:#111a2a!important}.theme-dark .border{border-color:#29374c!important}
.theme-dark h1,.theme-dark h2,.theme-dark h3,.theme-dark h4,.theme-dark h5,.theme-dark h6,.theme-dark label,.theme-dark .form-label{color:#edf3fb}
.theme-dark .list-group-item{background:#111a2a;color:#dce5f0;border-color:#29374c}.theme-dark .alert{background:#162236;color:#dce5f0;border-color:#2b3b53}
.sidebar-overlay{display:none}
@media(max-width:991.98px){.sidebar{width:256px;transform:translateX(-100%);box-shadow:8px 0 28px rgba(20,31,49,.18)}.sidebar.is-open{width:256px;transform:translateX(0)}.main,.sidebar.is-open~.main{margin-left:0}.topbar{padding:0 16px}.hello-text{display:none}.content{padding:18px}.dt-search{justify-content:flex-start;margin-top:5px}.dt-search input{width:100%!important;max-width:260px}.sidebar-overlay{position:fixed;inset:0;background:rgba(11,18,30,.42);z-index:1040}.sidebar-overlay.show{display:block}.sidebar .brand-full,.sidebar .sidebar-menu-title,.sidebar .account-copy,.sidebar .account-badge{display:block}.sidebar .brand{justify-content:flex-start;padding-left:4px}.sidebar .sidebar-links a{justify-content:flex-start}.sidebar .sidebar-links a::after{display:none}.sidebar .brand-mark{background:transparent;box-shadow:none}}
@media(max-width:575.98px){.content{padding:14px}.top-title{font-size:16px}.theme-toggle{min-width:40px;width:40px;padding:0}.theme-toggle-label{display:none}.topbar-tools{gap:5px}.notice-menu{right:-55px;width:280px}.dt-layout-row{display:flex;flex-wrap:wrap;gap:8px}.dt-length,.dt-search{width:100%}.dt-search input{max-width:none!important}}

/* Offline icon fallback: Font Awesome can be unavailable on local/XAMPP setups. */
.fa-solid::before,.fa-regular::before{font-family:"Segoe UI Symbol","Arial Unicode MS",sans-serif!important;font-weight:700!important}
.fa-house::before{content:"⌂"}.fa-book-open::before{content:"▤"}.fa-file-lines::before{content:"▥"}.fa-receipt::before{content:"▧"}.fa-chart-column::before{content:"▥"}.fa-users::before{content:"♟"}.fa-envelope::before{content:"✉"}.fa-id-card::before{content:"▣"}.fa-bars::before{content:"☰"}.fa-bell::before{content:"♢"}.fa-moon::before{content:"☾"}.fa-chevron-down::before{content:"⌄"}.fa-right-from-bracket::before{content:"↪"}.fa-user::before{content:"●"}.fa-check::before{content:"✓"}.fa-camera::before{content:"◉"}.fa-lock::before{content:"◆"}.fa-plus::before{content:"+"}.fa-trash::before{content:"×"}.fa-pen::before{content:"✎"}.fa-search::before{content:"⌕"}.fa-heart::before{content:"♡"}.fa-cart-shopping::before{content:"🛒"}.fa-star::before{content:"★"}.fa-arrow-right::before{content:"→"}.fa-user-plus::before{content:"+"}.fa-right-to-bracket::before{content:"→"}
</style>
<link rel="stylesheet" href="<?= base_url('assets/css/icons-fallback.css'); ?>">

<style id="bookspot-admin-polish">
.product-thumb img,.book-cover img{width:100%!important;height:100%!important;object-fit:contain!important;padding:7px!important;background:#fff!important}
.ops-icon{width:48px!important;height:48px!important}
.ops-icon i{font-size:21px!important}
.admin-table .btn i,.table-card .btn i{font-size:17px!important}
</style>
</head>
<body>
<div class="sidebar-overlay" id="sidebarOverlay"></div>
<div class="admin-shell">
<?php $adminImage=(string)$this->session->userdata('admin_image'); $adminEmail=(string)$this->session->userdata('admin_email'); ?>
<aside class="sidebar" id="adminSidebar">
  <a href="<?= site_url('admin') ?>" class="brand" aria-label="BookSpot">
    <span class="brand-mark">B</span><span class="brand-full">Book<span>Spot</span></span>
  </a>
  <div class="account-block">
    <span class="account-avatar"><?php if($adminImage): ?><img id="sidebarAdminImage" src="<?= profile_image_url($adminImage, TRUE) ?>" alt="Admin profile" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/profile-placeholder.svg'); ?>';"><?php else: ?><i class="fa-solid fa-user"></i><?php endif; ?></span>
    <div class="account-copy"><div class="account-name"><?= html_escape($admin_username) ?></div><div class="account-email"><?= html_escape($adminEmail) ?></div></div>
    <span class="account-badge">Admin</span>
  </div>
  <div class="sidebar-menu-title">Main</div>
  <ul class="sidebar-links">
    <li><a data-label="Dashboard" class="<?= $this->uri->segment(2)==='' || $this->uri->segment(2)===FALSE ? 'active':'' ?>" href="<?= site_url('admin') ?>"><i class="fa-solid fa-house"></i><span>Dashboard</span></a></li>
    <li><a data-label="Books & Products" class="<?= $this->uri->segment(2)==='products' ? 'active':'' ?>" href="<?= site_url('admin/products') ?>"><i class="fa-solid fa-book-open"></i><span>Books &amp; Products</span></a></li>
    <li><a data-label="Digital Library" class="<?= $this->uri->segment(2)==='ebooks' ? 'active':'' ?>" href="<?= site_url('admin/ebooks') ?>"><i class="fa-solid fa-file-lines"></i><span>Digital Library</span></a></li>
    <li><a data-label="Orders" class="<?= $this->uri->segment(2)==='orders' ? 'active':'' ?>" href="<?= site_url('admin/orders') ?>"><i class="fa-solid fa-receipt"></i><span>Orders</span></a></li>
  </ul>
  <div class="sidebar-menu-title">Manage</div>
  <ul class="sidebar-links">
    <li><a data-label="Reports" class="<?= $this->uri->segment(2)==='reports' ? 'active':'' ?>" href="<?= site_url('admin/reports') ?>"><i class="fa-solid fa-chart-column"></i><span>Reports</span></a></li>
    <li><a data-label="Customers" class="<?= $this->uri->segment(2)==='users' ? 'active':'' ?>" href="<?= site_url('admin/users') ?>"><i class="fa-solid fa-users"></i><span>Customers</span></a></li>
    <li><a data-label="Messages" class="<?= $this->uri->segment(2)==='messages' ? 'active':'' ?>" href="<?= site_url('admin/messages') ?>"><i class="fa-solid fa-envelope"></i><span>Messages</span></a></li>
  </ul>
  <div class="sidebar-menu-title">Account</div>
  <ul class="sidebar-links">
    <li><a data-label="My Profile" class="<?= $this->uri->segment(2)==='profile' ? 'active':'' ?>" href="<?= site_url('admin/profile') ?>"><i class="fa-regular fa-id-card"></i><span>My Profile</span></a></li>
  </ul>
  <div class="sidebar-spacer"></div>
</aside>
<div class="main">
<header class="topbar">
  <div class="topbar-left">
    <button class="sidebar-toggle" id="sidebarToggle" type="button" aria-label="Open sidebar" title="Open sidebar"><i class="fa-solid fa-bars"></i></button>
    <div class="top-title"><?= html_escape(isset($title) ? $title : 'Admin Dashboard') ?></div>
  </div>
  <div class="topbar-tools">
    <div class="position-relative">
      <button class="tool-btn" id="noticeBtn" type="button" aria-label="Notifications" title="Notifications"><i class="fa-regular fa-bell"></i></button>
      <div class="notice-menu" id="noticeMenu">
        <div class="menu-title">Notifications</div>
        <div class="notice-item"><span class="notice-dot"></span><div><strong>Store is ready</strong><span>Your admin workspace is active.</span></div></div>
        <div class="notice-item"><span class="notice-dot" style="background:var(--warning)"></span><div><strong>Inventory review</strong><span>Check low-stock books from the dashboard.</span></div></div>
      </div>
    </div>
    <div class="position-relative">
      <button class="theme-toggle" id="themeToggle" type="button" aria-label="Switch to dark mode" title="Switch to dark mode"><i class="fa-solid fa-moon"></i><span class="theme-toggle-label">Dark</span></button>
div>
    </div>
    <div class="admin-account">
      <button class="admin-user-btn" id="adminUserBtn" type="button">
        <span class="hello-text">Hello, <?= html_escape($admin_username) ?></span>
        <span class="admin-avatar"><?php if($adminImage): ?><img id="adminNavImage" src="<?= profile_image_url($adminImage, TRUE) ?>" alt="Admin profile" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/profile-placeholder.svg'); ?>';"><?php else: ?><i class="fa-solid fa-user"></i><?php endif; ?></span>
        <i class="fa-solid fa-chevron-down small text-muted"></i>
      </button>
      <div class="admin-user-menu" id="adminUserMenu">
        <div class="d-flex align-items-center gap-2 px-2 py-2 border-bottom">
          <span class="admin-avatar" style="width:34px;height:34px;flex:0 0 34px"><?php if($adminImage): ?><img id="adminMenuImage" src="<?= profile_image_url($adminImage, TRUE) ?>" alt="Admin" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/profile-placeholder.svg'); ?>';"><?php else: ?><i class="fa-solid fa-user"></i><?php endif; ?></span>
          <div style="min-width:0"><div class="fw-semibold small" id="adminMenuName"><?= html_escape($admin_username) ?></div><div class="text-muted" style="font-size:11px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:145px"><?= html_escape($adminEmail) ?></div></div>
        </div>
        <a href="<?= site_url('admin/profile') ?>"><i class="fa-regular fa-id-card"></i> My Profile</a>
        <a href="<?= site_url('admin/logout') ?>" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
      </div>
    </div>
  </div>
</header>
<div class="content">
