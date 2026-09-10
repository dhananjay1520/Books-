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
    <span class="account-avatar"><?php if($adminImage): ?><img id="sidebarAdminImage" src="<?= base_url($adminImage) ?>" alt="Admin profile"><?php else: ?><i class="fa-solid fa-user"></i><?php endif; ?></span>
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
      <button class="tool-btn" id="themePaletteBtn" type="button" aria-label="Choose theme color" title="Choose theme color"><i class="fa-solid fa-palette"></i></button>
      <div class="theme-menu" id="themeMenu">
        <div class="menu-title">Theme</div>
        <div class="theme-options">
          <button class="theme-option" data-theme="indigo"><span class="theme-dot dot-indigo"></span>Indigo</button>
          <button class="theme-option" data-theme="emerald"><span class="theme-dot dot-emerald"></span>Emerald</button>
          <button class="theme-option" data-theme="ocean"><span class="theme-dot dot-ocean"></span>Ocean</button>
          <button class="theme-option" data-theme="rose"><span class="theme-dot dot-rose"></span>Rose</button>
          <button class="theme-option" data-theme="violet"><span class="theme-dot dot-violet"></span>Violet</button>
          <button class="theme-option" data-theme="amber"><span class="theme-dot dot-amber"></span>Amber</button>
        </div>
      </div>
    </div>
    <div class="admin-account">
      <button class="admin-user-btn" id="adminUserBtn" type="button">
        <span class="hello-text">Hello, <?= html_escape($admin_username) ?></span>
        <span class="admin-avatar"><?php if($adminImage): ?><img id="adminNavImage" src="<?= base_url($adminImage) ?>" alt="Admin profile"><?php else: ?><i class="fa-solid fa-user"></i><?php endif; ?></span>
        <i class="fa-solid fa-chevron-down small text-muted"></i>
      </button>
      <div class="admin-user-menu" id="adminUserMenu">
        <div class="d-flex align-items-center gap-2 px-2 py-2 border-bottom">
          <span class="admin-avatar" style="width:34px;height:34px;flex:0 0 34px"><?php if($adminImage): ?><img id="adminMenuImage" src="<?= base_url($adminImage) ?>" alt="Admin"><?php else: ?><i class="fa-solid fa-user"></i><?php endif; ?></span>
          <div style="min-width:0"><div class="fw-semibold small" id="adminMenuName"><?= html_escape($admin_username) ?></div><div class="text-muted" style="font-size:11px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:145px"><?= html_escape($adminEmail) ?></div></div>
        </div>
        <a href="<?= site_url('admin/profile') ?>"><i class="fa-regular fa-id-card"></i> My Profile</a>
        <a href="<?= site_url('admin/logout') ?>" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
      </div>
    </div>
  </div>
</header>
<div class="content">
