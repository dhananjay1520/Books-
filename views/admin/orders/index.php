<style>
.orders-hero{display:flex;justify-content:space-between;align-items:flex-end;gap:18px;margin-bottom:20px}.orders-title{font-size:27px;font-weight:800;letter-spacing:-.03em;margin:0}.orders-sub{margin:6px 0 0;color:var(--muted);font-size:13px}.orders-badge{display:inline-flex;align-items:center;gap:7px;padding:8px 12px;border:1px solid var(--border);border-radius:999px;background:var(--card);font-size:11px;font-weight:700;color:#5f6b7d}.order-kpis{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:18px}.order-kpi{padding:17px;border:1px solid var(--border);border-radius:16px;background:var(--card);box-shadow:0 8px 24px rgba(25,34,52,.04)}.order-kpi .kpi-label{font-size:11px;color:var(--muted);text-transform:uppercase;letter-spacing:.06em}.order-kpi .kpi-value{font-size:24px;font-weight:800;margin-top:4px}.order-kpi .kpi-icon{width:34px;height:34px;border-radius:10px;display:grid;place-items:center;float:right;font-size:14px}.orders-note{border:1px solid #dce4f2;background:linear-gradient(135deg,#f7faff,#eef4ff);border-radius:16px;padding:18px}.orders-note h5{margin:0 0 5px;font-weight:800}.orders-note p{margin:0;color:#66738a;font-size:13px}.orders-empty{padding:34px 18px;text-align:center}.orders-empty .empty-icon{width:58px;height:58px;margin:0 auto 12px;border-radius:16px;display:grid;place-items:center;background:#eef3ff;color:var(--indigo);font-size:22px}.theme-dark .orders-note{background:#172238;border-color:#2c3850}.theme-dark .orders-note p{color:#a9b4c8}
@media(max-width:900px){.order-kpis{grid-template-columns:repeat(2,1fr)}}@media(max-width:600px){.orders-hero{align-items:flex-start;flex-direction:column}.order-kpis{grid-template-columns:1fr}}
</style>
<div class="orders-hero">
  <div><h1 class="orders-title">Orders</h1><p class="orders-sub">Track customer purchases, order values and payment progress.</p></div>
  <span class="orders-badge"><i class="fa-solid fa-basket-shopping"></i> Store operations</span>
</div>
<?php if (!$orders_available): ?>
  <div class="order-kpis">
    <div class="order-kpi"><span class="kpi-icon" style="background:#edf3ff;color:#4361ee"><i class="fa-solid fa-cart-shopping"></i></span><div class="kpi-label">Orders</div><div class="kpi-value">0</div></div>
    <div class="order-kpi"><span class="kpi-icon" style="background:#eafaf3;color:#159267"><i class="fa-solid fa-circle-check"></i></span><div class="kpi-label">Completed</div><div class="kpi-value">₹0.00</div></div>
    <div class="order-kpi"><span class="kpi-icon" style="background:#fff5dc;color:#b97b00"><i class="fa-solid fa-clock"></i></span><div class="kpi-label">Pending</div><div class="kpi-value">₹0.00</div></div>
    <div class="order-kpi"><span class="kpi-icon" style="background:#f5edff;color:#7c3aed"><i class="fa-solid fa-user-group"></i></span><div class="kpi-label">Customers</div><div class="kpi-value"><?= (int)($stats['total_users'] ?? 0) ?></div></div>
  </div>
  <div class="orders-note">
    <div class="orders-empty">
      <div class="empty-icon"><i class="fa-solid fa-receipt"></i></div>
      <h5>Order management is ready</h5>
      <p>Your current <code>project</code> database does not have an <code>orders</code> table yet. Once order data is available, this page will automatically show searchable orders with sorting, filters and exports.</p>
    </div>
  </div>
<?php else: ?>
  <?php
    $orderCount=count($orders);
    $completed=0; $pending=0;
    foreach($orders as $o){ $status=strtolower((string)($o->payment_status ?? '')); if($status==='completed') $completed++; elseif($status==='pending') $pending++; }
  ?>
  <div class="order-kpis">
    <div class="order-kpi"><span class="kpi-icon" style="background:#edf3ff;color:#4361ee"><i class="fa-solid fa-cart-shopping"></i></span><div class="kpi-label">Total orders</div><div class="kpi-value"><?= $orderCount ?></div></div>
    <div class="order-kpi"><span class="kpi-icon" style="background:#eafaf3;color:#159267"><i class="fa-solid fa-circle-check"></i></span><div class="kpi-label">Completed</div><div class="kpi-value"><?= $completed ?></div></div>
    <div class="order-kpi"><span class="kpi-icon" style="background:#fff5dc;color:#b97b00"><i class="fa-solid fa-clock"></i></span><div class="kpi-label">Pending</div><div class="kpi-value"><?= $pending ?></div></div>
    <div class="order-kpi"><span class="kpi-icon" style="background:#f5edff;color:#7c3aed"><i class="fa-solid fa-user-group"></i></span><div class="kpi-label">Customers</div><div class="kpi-value"><?= (int)($stats['total_users'] ?? 0) ?></div></div>
  </div>
  <div class="card table-card"><div class="table-responsive"><table class="table table-hover align-middle mb-0 admin-table"><thead><tr><?php if(!empty($orders)): foreach(array_keys((array)$orders[0]) as $col): ?><th><?= html_escape(ucwords(str_replace('_',' ',$col))) ?></th><?php endforeach; endif; ?></tr></thead><tbody><?php foreach($orders as $order): ?><tr><?php foreach((array)$order as $val): ?><td><?= html_escape((string)$val) ?></td><?php endforeach; ?></tr><?php endforeach; ?></tbody></table></div></div>
<?php endif; ?>