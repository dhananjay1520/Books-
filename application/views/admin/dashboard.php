<style id="bookspot-human-admin-final">.dashboard-hero{background:linear-gradient(135deg,#fff 0%,#f4f5ff 100%)!important;border:1px solid #e7e9f1!important;box-shadow:0 12px 30px rgba(31,45,73,.05)!important}.ops-card{border:1px solid #e5e8f0!important;box-shadow:0 8px 22px rgba(31,45,73,.055)!important;transition:transform .2s,box-shadow .2s!important}.ops-card:hover{transform:translateY(-3px);box-shadow:0 15px 30px rgba(31,45,73,.09)!important}.ops-icon{width:56px!important;height:56px!important;border-radius:16px!important}.panel{border:1px solid #e4e8f0!important;box-shadow:0 8px 22px rgba(31,45,73,.045)!important}.list-avatar,.book-cover{width:48px!important;height:48px!important;border-radius:13px!important}.sidebar-links a{height:48px!important}.tool-btn,.sidebar-toggle{width:46px!important;height:46px!important}.theme-toggle{min-height:46px!important}.admin-user-btn{min-height:46px!important}.priority-card{border-radius:20px!important}</style>
<?php
$inv = $inventory_summary ?? ['total_stock_units'=>0,'low_stock'=>0,'out_of_stock'=>0,'total_ebooks'=>0];
$stats = $stats ?? [];
$lowStock = $low_stock_products ?? [];
$recentUsers = $recent_users ?? [];
$recentMessages = $recent_messages ?? [];
?>
<style>
.dashboard-hero{display:flex;justify-content:space-between;align-items:flex-end;gap:20px;margin-bottom:24px}.dashboard-hero h1{font-size:28px;font-weight:800;letter-spacing:-.03em;margin:0}.dashboard-hero p{margin:6px 0 0;color:var(--muted);font-size:13px}.hero-date{display:inline-flex;align-items:center;gap:7px;padding:10px 13px;border-radius:12px;background:var(--card);border:1px solid var(--border);font-size:12px;color:var(--muted);box-shadow:0 6px 20px rgba(25,34,52,.04)}
.ops-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:16px}.ops-card{position:relative;overflow:hidden;padding:19px;border-radius:16px;background:var(--card);border:1px solid var(--border);box-shadow:0 7px 24px rgba(25,34,52,.045)}.ops-card:after{content:"";position:absolute;width:72px;height:72px;border-radius:50%;right:-22px;bottom:-28px;background:linear-gradient(135deg,rgba(67,97,238,.12),rgba(124,58,237,.12))}.ops-top{display:flex;justify-content:space-between;align-items:center}.ops-icon{width:42px;height:42px;border-radius:12px;display:grid;place-items:center}.ops-icon.blue{color:#4361ee;background:#eef2ff}.ops-icon.cyan{color:#0e9fc0;background:#eafaff}.ops-icon.green{color:#0b9a6b;background:#e9fbf4}.ops-icon.amber{color:#c98500;background:#fff7df}.ops-label{font-size:12px;color:var(--muted);font-weight:650}.ops-value{font-size:26px;font-weight:800;margin-top:7px;letter-spacing:-.04em}.ops-note{font-size:11px;color:var(--muted);margin-top:4px}
.dashboard-panels{display:grid;grid-template-columns:1fr 1fr;gap:18px;margin-top:20px}.panel{background:var(--card);border:1px solid var(--border);border-radius:17px;box-shadow:0 7px 24px rgba(25,34,52,.045);overflow:hidden}.panel-head{display:flex;align-items:center;justify-content:space-between;padding:17px 19px;border-bottom:1px solid var(--border)}.panel-title{font-weight:780;font-size:15px}.panel-sub{font-size:11px;color:var(--muted);margin-top:2px}.panel-body{padding:8px}.list-row{display:flex;align-items:center;justify-content:space-between;gap:12px;padding:12px 10px;border-bottom:1px solid var(--border)}.list-row:last-child{border-bottom:0}.list-left{display:flex;align-items:center;gap:11px;min-width:0}.list-avatar,.book-cover{width:40px;height:40px;border-radius:10px;display:grid;place-items:center;flex:0 0 auto;background:#eef2ff;color:#4361ee;overflow:hidden}.list-avatar img,.book-cover img{width:100%;height:100%;object-fit:cover}.list-name{font-size:12.5px;font-weight:700;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.list-meta{font-size:10.5px;color:var(--muted);margin-top:2px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}.stock-pill{font-size:10px;font-weight:750;border-radius:999px;padding:5px 8px;white-space:nowrap}.stock-low{background:#fff4d8;color:#b87600}.stock-out{background:#feecee;color:#c53d5b}.stock-ok{background:#e8faf2;color:#16845d}.message-copy{max-width:250px}.empty-state{padding:26px 12px;text-align:center;color:var(--muted);font-size:12px}.empty-state i{font-size:22px;margin-bottom:7px;opacity:.55}.priority-card{margin-top:18px;padding:18px;border-radius:17px;background:linear-gradient(135deg,#111827,#1b2540);color:#f7f9ff;box-shadow:0 12px 30px rgba(17,24,39,.18)}.priority-wrap{display:flex;justify-content:space-between;align-items:center;gap:18px}.priority-title{font-size:14px;font-weight:750}.priority-copy{font-size:11px;color:#b8c2d6;margin-top:4px}.priority-items{display:flex;gap:9px;flex-wrap:wrap;justify-content:flex-end}.priority-chip{display:inline-flex;align-items:center;gap:7px;padding:8px 10px;border:1px solid rgba(255,255,255,.1);border-radius:10px;background:rgba(255,255,255,.05);font-size:10.5px;color:#e9edf7}.priority-chip strong{color:#fff}
.theme-dark .hero-date{box-shadow:none}.theme-dark .ops-card,.theme-dark .panel{box-shadow:none}.theme-dark .priority-card{background:linear-gradient(135deg,#0d1524,#172238)}
@media(max-width:1100px){.ops-grid{grid-template-columns:repeat(2,1fr)}}
@media(max-width:800px){.dashboard-panels{grid-template-columns:1fr}.priority-wrap{flex-direction:column;align-items:flex-start}.priority-items{justify-content:flex-start}}
@media(max-width:600px){.dashboard-hero{align-items:flex-start;flex-direction:column}.ops-grid{grid-template-columns:1fr 1fr;gap:12px}.ops-card{padding:15px}.ops-value{font-size:22px}}
@media(max-width:430px){.ops-grid{grid-template-columns:1fr}.priority-items{display:grid;grid-template-columns:1fr;width:100%}}
</style>

<div class="dashboard-hero">
    <div>
        <h1>Admin dashboard</h1>
        <p>Monitor the store at a glance and focus on the work that needs attention.</p>
    </div>
    <div class="hero-date"><i class="fa-regular fa-calendar"></i><?= date('d M Y') ?></div>
</div>

<div class="ops-grid">
    <div class="ops-card"><div class="ops-top"><span class="ops-label">Catalog titles</span><span class="ops-icon blue"><i class="fa-solid fa-book-open"></i></span></div><div class="ops-value"><?= (int)($stats['total_products'] ?? 0) ?></div><div class="ops-note">Books currently listed</div></div>
    <div class="ops-card"><div class="ops-top"><span class="ops-label">Stock units</span><span class="ops-icon cyan"><i class="fa-solid fa-cubes-stacked"></i></span></div><div class="ops-value"><?= (int)$inv['total_stock_units'] ?></div><div class="ops-note">Units available in catalog</div></div>
    <div class="ops-card"><div class="ops-top"><span class="ops-label">Low stock</span><span class="ops-icon amber"><i class="fa-solid fa-triangle-exclamation"></i></span></div><div class="ops-value"><?= (int)$inv['low_stock'] ?></div><div class="ops-note"><?= (int)$inv['out_of_stock'] ?> out of stock</div></div>
    <div class="ops-card"><div class="ops-top"><span class="ops-label">Customer accounts</span><span class="ops-icon green"><i class="fa-solid fa-user-group"></i></span></div><div class="ops-value"><?= (int)($stats['total_users'] ?? 0) ?></div><div class="ops-note">Registered customers</div></div>
</div>

<div class="dashboard-panels">
    <section class="panel">
        <div class="panel-head"><div><div class="panel-title">Inventory watch</div><div class="panel-sub">Books that need stock attention</div></div><i class="fa-solid fa-boxes-stacked text-muted"></i></div>
        <div class="panel-body">
        <?php if ($lowStock): foreach ($lowStock as $book): ?>
            <div class="list-row">
                <div class="list-left">
                    <span class="book-cover"><?php if(!empty($book->image)): ?><img src="<?= product_image_url($book->image) ?>" alt="Book cover" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/placeholder-book.svg') ?>';"><?php else: ?><i class="fa-solid fa-book"></i><?php endif; ?></span>
                    <div><div class="list-name"><?= html_escape($book->pr_name) ?></div><div class="list-meta"><?= html_escape($book->pr_cate ?: 'Uncategorized') ?></div></div>
                </div>
                <span class="stock-pill <?= ((int)$book->pr_qty <= 0) ? 'stock-out' : 'stock-low' ?>"><?= ((int)$book->pr_qty <= 0) ? 'Out of stock' : ((int)$book->pr_qty . ' left') ?></span>
            </div>
        <?php endforeach; else: ?><div class="empty-state"><i class="fa-regular fa-circle-check d-block"></i>No low-stock books right now.</div><?php endif; ?>
        </div>
    </section>

    <section class="panel">
        <div class="panel-head"><div><div class="panel-title">Recent customers</div><div class="panel-sub">Latest customer accounts added</div></div><i class="fa-solid fa-user-plus text-muted"></i></div>
        <div class="panel-body">
        <?php if ($recentUsers): foreach ($recentUsers as $u): ?>
            <div class="list-row">
                <div class="list-left">
                    <span class="list-avatar"><?php if(!empty($u->image)): ?><img src="<?= profile_image_url($u->image) ?>" alt="Customer" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/profile-placeholder.svg') ?>';"><?php else: ?><i class="fa-solid fa-user"></i><?php endif; ?></span>
                    <div><div class="list-name"><?= html_escape($u->name) ?></div><div class="list-meta"><?= html_escape($u->email) ?></div></div>
                </div>
                <span class="text-muted" style="font-size:10px">#<?= (int)$u->id ?></span>
            </div>
        <?php endforeach; else: ?><div class="empty-state"><i class="fa-regular fa-user d-block"></i>No customer accounts found.</div><?php endif; ?>
        </div>
    </section>

    <section class="panel">
        <div class="panel-head"><div><div class="panel-title">Message queue</div><div class="panel-sub">Latest customer enquiries</div></div><i class="fa-regular fa-envelope text-muted"></i></div>
        <div class="panel-body">
        <?php if ($recentMessages): foreach ($recentMessages as $m): ?>
            <div class="list-row">
                <div class="list-left">
                    <span class="list-avatar"><i class="fa-regular fa-message"></i></span>
                    <div class="message-copy"><div class="list-name"><?= html_escape($m->name ?? 'Customer') ?></div><div class="list-meta"><?= html_escape($m->email ?? ($m->phone ?? 'New enquiry')) ?></div></div>
                </div>
                <span class="text-muted" style="font-size:10px">#<?= (int)($m->id ?? 0) ?></span>
            </div>
        <?php endforeach; else: ?><div class="empty-state"><i class="fa-regular fa-envelope-open d-block"></i>No messages to review.</div><?php endif; ?>
        </div>
    </section>

    <section class="panel">
        <div class="panel-head"><div><div class="panel-title">Store snapshot</div><div class="panel-sub">Current content mix</div></div><i class="fa-solid fa-chart-simple text-muted"></i></div>
        <div class="panel-body p-3">
            <div class="row g-3">
                <div class="col-6"><div class="border rounded-3 p-3 h-100"><div class="text-muted" style="font-size:10px;text-transform:uppercase;letter-spacing:.05em">eBooks</div><div class="fw-bold fs-5 mt-1"><?= (int)$inv['total_ebooks'] ?></div></div></div>
                <div class="col-6"><div class="border rounded-3 p-3 h-100"><div class="text-muted" style="font-size:10px;text-transform:uppercase;letter-spacing:.05em">Categories</div><div class="fw-bold fs-5 mt-1"><?= (int)($categories_count ?? 0) ?></div></div></div>
                <div class="col-6"><div class="border rounded-3 p-3 h-100"><div class="text-muted" style="font-size:10px;text-transform:uppercase;letter-spacing:.05em">Orders</div><div class="fw-bold fs-5 mt-1"><?= (int)($stats['total_orders'] ?? 0) ?></div></div></div>
                <div class="col-6"><div class="border rounded-3 p-3 h-100"><div class="text-muted" style="font-size:10px;text-transform:uppercase;letter-spacing:.05em">Pending</div><div class="fw-bold fs-5 mt-1">₹<?= number_format((float)($stats['total_pending'] ?? 0),2) ?></div></div></div>
            </div>
        </div>
    </section>
</div>

<div class="priority-card">
    <div class="priority-wrap">
        <div><div class="priority-title">Today’s admin focus</div><div class="priority-copy">Keep the storefront healthy by checking the items that require action first.</div></div>
        <div class="priority-items">
            <span class="priority-chip"><i class="fa-solid fa-triangle-exclamation"></i><strong><?= (int)$inv['low_stock'] ?></strong> low stock</span>
            <span class="priority-chip"><i class="fa-solid fa-circle-xmark"></i><strong><?= (int)$inv['out_of_stock'] ?></strong> out of stock</span>
            <span class="priority-chip"><i class="fa-solid fa-file-lines"></i><strong><?= (int)$inv['total_ebooks'] ?></strong> eBooks</span>
        </div>
    </div>
</div>
