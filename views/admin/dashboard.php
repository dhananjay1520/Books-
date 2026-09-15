<?php
$stats = $stats ?? [];
$inv = $inventory_summary ?? [];
$lowStock = $low_stock_products ?? [];
$categories = $categories ?? [];
$recentUsers = $recent_users ?? [];
$recentMessages = $recent_messages ?? [];
$maxCategory = 1;
foreach ($categories as $c) { $maxCategory = max($maxCategory, (int)($c->total_books ?? 0)); }
$chart = [
    ['label'=>'Books','value'=>max(0,(int)($stats['total_products'] ?? 0))],
    ['label'=>'Customers','value'=>max(0,(int)($stats['total_users'] ?? 0))],
    ['label'=>'Orders','value'=>max(0,(int)($stats['total_orders'] ?? 0))],
    ['label'=>'eBooks','value'=>max(0,(int)($inv['total_ebooks'] ?? 0))],
    ['label'=>'Messages','value'=>max(0,(int)($stats['total_messages'] ?? 0))],
    ['label'=>'Pending','value'=>max(0,(int)($stats['total_pending'] ?? 0))],
    ['label'=>'Completed','value'=>max(0,(int)($stats['total_completed'] ?? 0))],
];
$maxChart = 1; foreach ($chart as $c) { $maxChart = max($maxChart, $c['value']); }
?>
<div class="admin-hero">
  <div>
    <div class="page-heading">Dashboard</div>
    <div class="page-subtitle">A clean overview of your bookstore, stock and customer activity.</div>
  </div>
  <div class="admin-hero-actions">
    <span class="admin-hero-badge"><i class="fa-regular fa-calendar"></i><?= date('d M Y') ?></span>
    <a class="btn btn-primary btn-sm px-3" href="<?= site_url('admin/products/add') ?>"><i class="fa-solid fa-plus me-1"></i> Add book</a>
  </div>
</div>

<div class="admin-kpi-grid">
  <div class="admin-kpi"><div class="admin-kpi-top"><div class="admin-kpi-label">Total books</div><div class="admin-kpi-icon"><i class="fa-solid fa-book-open"></i></div></div><div class="admin-kpi-value"><?= (int)($stats['total_products'] ?? 0) ?></div><div class="admin-kpi-meta">Products in storefront</div></div>
  <div class="admin-kpi"><div class="admin-kpi-top"><div class="admin-kpi-label">Customers</div><div class="admin-kpi-icon"><i class="fa-solid fa-users"></i></div></div><div class="admin-kpi-value"><?= (int)($stats['total_users'] ?? 0) ?></div><div class="admin-kpi-meta">Registered accounts</div></div>
  <div class="admin-kpi"><div class="admin-kpi-top"><div class="admin-kpi-label">Orders</div><div class="admin-kpi-icon"><i class="fa-solid fa-receipt"></i></div></div><div class="admin-kpi-value"><?= (int)($stats['total_orders'] ?? 0) ?></div><div class="admin-kpi-meta">Total orders recorded</div></div>
  <div class="admin-kpi"><div class="admin-kpi-top"><div class="admin-kpi-label">Low stock</div><div class="admin-kpi-icon"><i class="fa-solid fa-triangle-exclamation"></i></div></div><div class="admin-kpi-value"><?= (int)($inv['low_stock'] ?? 0) ?></div><div class="admin-kpi-meta"><?= (int)($inv['out_of_stock'] ?? 0) ?> currently out of stock</div></div>
</div>

<div class="admin-dashboard-grid">
  <section class="admin-panel">
    <div class="admin-panel-head"><div><div class="admin-panel-title">Store overview</div><div class="admin-panel-sub">A compact view of your main bookstore metrics.</div></div><span class="admin-hero-badge"><i class="fa-solid fa-chart-column"></i> Overview</span></div>
    <div class="admin-chart" aria-label="Store overview chart">
      <?php foreach ($chart as $c): $h = max(12, (int)round(($c['value'] / $maxChart) * 155)); ?>
        <div class="admin-bar-wrap"><div class="admin-bar" style="height:<?= $h ?>px" title="<?= html_escape($c['label']) ?>: <?= (int)$c['value'] ?>"></div><div class="admin-bar-label"><?= html_escape($c['label']) ?></div></div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="admin-panel">
    <div class="admin-panel-head"><div><div class="admin-panel-title">Category mix</div><div class="admin-panel-sub">Books grouped by category.</div></div><i class="fa-solid fa-layer-group text-muted"></i></div>
    <div class="admin-summary-list">
      <?php if ($categories): foreach (array_slice($categories, 0, 6) as $c): $count=(int)($c->total_books ?? 0); $width=max(6,min(100,round(($count/$maxCategory)*100))); ?>
        <div class="admin-summary-row"><div><div class="admin-summary-name"><?= html_escape($c->pr_cate) ?></div><div class="admin-summary-track"><div class="admin-summary-fill" style="width:<?= $width ?>%"></div></div></div><div class="admin-summary-value"><?= $count ?></div></div>
      <?php endforeach; else: ?><div class="empty-state">No categories are available yet.</div><?php endif; ?>
    </div>
  </section>
</div>

<div class="admin-dashboard-grid">
  <section class="admin-panel">
    <div class="admin-panel-head"><div><div class="admin-panel-title">Inventory attention</div><div class="admin-panel-sub">Books that should be reviewed first.</div></div><a href="<?= site_url('admin/products') ?>" class="small text-success fw-semibold">View books</a></div>
    <?php if ($lowStock): foreach ($lowStock as $book): ?>
      <div class="list-row px-0"><div class="list-left"><span class="book-cover"><?php if(!empty($book->image)): ?><img src="<?= product_image_url($book->image) ?>" alt="Book cover" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/placeholder-book.svg') ?>';"><?php else: ?><i class="fa-solid fa-book"></i><?php endif; ?></span><div><div class="list-name"><?= html_escape($book->pr_name) ?></div><div class="list-meta"><?= html_escape($book->pr_cate ?: 'Uncategorized') ?></div></div></div><span class="stock-pill <?= ((int)$book->pr_qty <= 0) ? 'stock-out':'stock-low' ?>"><?= ((int)$book->pr_qty <= 0) ? 'Out of stock' : ((int)$book->pr_qty).' left' ?></span></div>
    <?php endforeach; else: ?><div class="empty-state">No stock warnings at the moment.</div><?php endif; ?>
  </section>

  <section class="admin-panel">
    <div class="admin-panel-head"><div><div class="admin-panel-title">Recent customers</div><div class="admin-panel-sub">Newest accounts added to your store.</div></div><a href="<?= site_url('admin/users') ?>" class="small text-success fw-semibold">View all</a></div>
    <?php if ($recentUsers): foreach ($recentUsers as $u): ?>
      <div class="list-row px-0"><div class="list-left"><span class="list-avatar"><?php if(!empty($u->image)): ?><img src="<?= profile_image_url($u->image) ?>" alt="Customer" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/profile-placeholder.svg') ?>';"><?php else: ?><i class="fa-solid fa-user"></i><?php endif; ?></span><div><div class="list-name"><?= html_escape($u->name) ?></div><div class="list-meta"><?= html_escape($u->email) ?></div></div></div><span class="text-muted small">#<?= (int)$u->id ?></span></div>
    <?php endforeach; else: ?><div class="empty-state">No customers found.</div><?php endif; ?>
  </section>
</div>

<div class="admin-panel mb-3">
  <div class="admin-panel-head"><div><div class="admin-panel-title">Quick actions</div><div class="admin-panel-sub">Jump directly to the areas you use most.</div></div><i class="fa-solid fa-compass text-muted"></i></div>
  <div class="admin-quick-grid">
    <a class="admin-quick-link" href="<?= site_url('admin/products') ?>"><span class="admin-quick-icon"><i class="fa-solid fa-book-open"></i></span><span><span class="admin-quick-title">Manage books</span><span class="admin-quick-sub">Add, edit or delete</span></span></a>
    <a class="admin-quick-link" href="<?= site_url('admin/orders') ?>"><span class="admin-quick-icon"><i class="fa-solid fa-receipt"></i></span><span><span class="admin-quick-title">Orders</span><span class="admin-quick-sub">Review purchases</span></span></a>
    <a class="admin-quick-link" href="<?= site_url('admin/users') ?>"><span class="admin-quick-icon"><i class="fa-solid fa-users"></i></span><span><span class="admin-quick-title">Customers</span><span class="admin-quick-sub">Manage accounts</span></span></a>
    <a class="admin-quick-link" href="<?= site_url('admin/messages') ?>"><span class="admin-quick-icon"><i class="fa-solid fa-envelope"></i></span><span><span class="admin-quick-title">Messages</span><span class="admin-quick-sub">Read enquiries</span></span></a>
  </div>
</div>
