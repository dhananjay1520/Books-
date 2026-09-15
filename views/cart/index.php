<div class="store-page bs-cart-page bs-cart-page-v2">
  <div class="bs-cart-shell">
    <div class="bs-cart-breadcrumb">
      <a href="<?= site_url('home') ?>">Home</a>
      <span>/</span>
      <span>Shopping Cart</span>
    </div>

    <div class="bs2-cart-heading">
      <div>
        <h1>Shopping Cart</h1>
        <p><?= (int)$count ?> item<?= $count == 1 ? '' : 's' ?> in your cart</p>
      </div>
      <a class="bs2-continue" href="<?= site_url('category') ?>">Continue Shopping</a>
    </div>

    <?php if (empty($items)): ?>
      <section class="bs2-empty">
        <div class="bs2-empty-icon"><i class="fa-solid fa-bag-shopping"></i></div>
        <h2>Your cart is empty</h2>
        <p>Looks like you have not added any books yet.</p>
        <a class="bs2-primary" href="<?= site_url('category') ?>">Browse Books</a>
      </section>
    <?php else: ?>
      <div class="bs2-layout">
        <section class="bs2-items-card">
          <div class="bs2-items-head">
            <strong>Your Items</strong>
            <span><?= (int)$count ?> item<?= $count == 1 ? '' : 's' ?></span>
          </div>

          <?php foreach ($items as $item): ?>
            <article class="bs2-item">
              <a class="bs2-cover" href="<?= $item['item_type'] === 'rent' ? site_url('cart') : site_url('product/details/'.(int)$item['product_id']) ?>">
                <img src="<?= book_image_url($item['image']) ?>" alt="<?= html_escape($item['name']) ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/placeholder-book.svg') ?>';">
              </a>

              <div class="bs2-info">
                <span class="bs2-type"><?= $item['item_type'] === 'rent' ? 'RENTAL' : 'BOOK' ?></span>
                <h2><?= html_escape($item['name']) ?></h2>
                <?php if (!empty($item['start_date']) && !empty($item['end_date'])): ?>
                  <p class="bs2-meta"><i class="fa-regular fa-calendar"></i> <?= html_escape($item['start_date']) ?> – <?= html_escape($item['end_date']) ?></p>
                <?php endif; ?>
                <div class="bs2-price-mobile">₹<?= number_format((float)$item['price'], 2) ?></div>
                <a class="bs2-remove" href="<?= site_url('cart/remove/'.$item['id'].'/'.$item['item_type']) ?>" onclick="return confirm('Remove this book from your cart?');">
                  <i class="fa-regular fa-trash-can"></i> Remove
                </a>
              </div>

              <div class="bs2-unit-price">₹<?= number_format((float)$item['price'], 2) ?></div>

              <?php if ($item['item_type'] === 'rent'): ?>
                <div class="bs2-qty-wrap">
                  <span class="bs2-qty-label">Qty</span>
                  <span class="bs2-fixed-qty">1</span>
                </div>
              <?php else: ?>
                <form class="bs2-qty-form" action="<?= site_url('cart/update') ?>" method="post">
                  <span class="bs2-qty-label">Qty</span>
                  <div class="bs2-qty-control">
                    <button type="button" class="bs2-qty-btn" data-step="-1" aria-label="Decrease quantity">−</button>
                    <input class="bs2-qty-input" type="number" name="quantity" min="1" value="<?= (int)$item['quantity'] ?>" aria-label="Quantity">
                    <button type="button" class="bs2-qty-btn" data-step="1" aria-label="Increase quantity">+</button>
                  </div>
                  <input type="hidden" name="id" value="<?= (int)$item['id'] ?>">
                  <button class="bs2-update" type="submit">Update</button>
                </form>
              <?php endif; ?>

              <strong class="bs2-line-total">₹<?= number_format((float)$item['line_total'], 2) ?></strong>
            </article>
          <?php endforeach; ?>

          <div class="bs2-items-foot">
            <a class="bs2-back" href="<?= site_url('category') ?>"><i class="fa-solid fa-arrow-left"></i> Continue Shopping</a>
            <form action="<?= site_url('cart/clear') ?>" method="post" onsubmit="return confirm('Remove all items from your cart?');">
              <button type="submit" class="bs2-clear"><i class="fa-regular fa-trash-can"></i> Clear Cart</button>
            </form>
          </div>
        </section>

        <aside class="bs2-summary">
          <div class="bs2-summary-head">
            <h2>Order Summary</h2>
            <span><?= (int)$count ?> item<?= $count == 1 ? '' : 's' ?></span>
          </div>
          <div class="bs2-summary-row"><span>Subtotal</span><strong>₹<?= number_format($total, 2) ?></strong></div>
          <div class="bs2-summary-row"><span>Delivery</span><strong class="free">FREE</strong></div>
          <div class="bs2-rule"></div>
          <div class="bs2-total"><span>Total</span><strong>₹<?= number_format($total, 2) ?></strong></div>
          <a class="bs2-checkout" href="<?= site_url('checkout') ?>">Proceed to Checkout <i class="fa-solid fa-arrow-right"></i></a>
          <div class="bs2-benefits">
            <div><i class="fa-solid fa-shield-halved"></i><span>Secure checkout</span></div>
            <div><i class="fa-solid fa-truck-fast"></i><span>Fast delivery</span></div>
          </div>
        </aside>
      </div>
    <?php endif; ?>
  </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function () {
  document.querySelectorAll('.bs2-qty-btn').forEach(function (btn) {
    btn.addEventListener('click', function () {
      var form = btn.closest('.bs2-qty-form');
      var input = form ? form.querySelector('.bs2-qty-input') : null;
      if (!input) return;
      var value = parseInt(input.value || '1', 10) + parseInt(btn.dataset.step || '0', 10);
      input.value = Math.max(1, value);
    });
  });
});
</script>
