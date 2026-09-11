<div class="store-page">
<section class="page-heading">
  <div>
    <span class="eyebrow">YOUR BOOKS</span>
    <h1>Shopping Cart</h1>
    <p><?= (int)$count ?> item<?= $count == 1 ? '' : 's' ?> ready for checkout.</p>
  </div>
  <div class="cart-head-actions"><a class="outline-btn" href="<?= site_url('category') ?>"><i class="fa-solid fa-arrow-left"></i> Continue Shopping</a><form action="<?= site_url('cart/clear') ?>" method="post" onsubmit="return confirm('Remove all items from your cart?');"><button class="outline-btn danger-outline" type="submit"><i class="fa-solid fa-trash-can"></i> Clear Cart</button></form></div>
</section>

<?php if (empty($items)): ?>
<div class="empty-state">
  <div class="empty-icon"><i class="fa-solid fa-bag-shopping"></i></div>
  <h2>Your cart is empty</h2>
  <p>Find a book that deserves a place on your shelf.</p>
  <a class="primary-btn" href="<?= site_url('category') ?>">Browse Books</a>
</div>
<?php else: ?>
<div class="two-column">
  <section class="card cart-card">
    <?php foreach ($items as $item): ?>
    <article class="cart-row">
      <div class="cover-wrap">
        <img src="<?= book_image_url($item['image']) ?>" alt="<?= html_escape($item['name']) ?>">
      </div>
      <div class="book-info">
        <span class="type-pill"><?= $item['item_type'] === 'rent' ? 'Rental' : 'Book' ?></span>
        <h3><?= html_escape($item['name']) ?></h3>
        <p class="muted">₹<?= number_format((float)$item['price'], 2) ?> each</p>

        <?php if (!empty($item['start_date']) && !empty($item['end_date'])): ?>
          <p class="rental"><i class="fa-regular fa-calendar"></i>
            <?= html_escape($item['start_date']) ?> — <?= html_escape($item['end_date']) ?>
          </p>
        <?php else: ?>
          <form class="qty-form" action="<?= site_url('cart/update') ?>" method="post">
            <input type="hidden" name="id" value="<?= (int)$item['id'] ?>">
            <label>Qty</label>
            <input type="number" name="quantity" min="1" value="<?= (int)$item['quantity'] ?>">
            <button class="mini-btn" type="submit"><i class="fa-solid fa-check"></i> Update</button>
          </form>
        <?php endif; ?>
      </div>
      <div class="row-end">
        <strong>₹<?= number_format((float)$item['line_total'], 2) ?></strong>
        <a class="remove-link" href="<?= site_url('cart/remove/'.$item['id'].'/'.$item['item_type']) ?>">
          <i class="fa-regular fa-trash-can"></i> Remove
        </a>
      </div>
    </article>
    <?php endforeach; ?>
  </section>

  <aside class="card summary-card">
    <span class="eyebrow">ORDER SUMMARY</span>
    <h2>Summary</h2>
    <div class="summary-line"><span>Items</span><strong><?= (int)$count ?></strong></div>
    <div class="summary-line"><span>Subtotal</span><strong>₹<?= number_format($total, 2) ?></strong></div>
    <div class="summary-line"><span>Delivery</span><strong>Free</strong></div>
    <div class="summary-total"><span>Total</span><strong>₹<?= number_format($total, 2) ?></strong></div>
    <a class="primary-btn full" href="<?= site_url('checkout') ?>">Proceed to Checkout <i class="fa-solid fa-arrow-right"></i></a>
    <div class="secure-note"><i class="fa-solid fa-shield-halved"></i> Secure checkout</div>
  </aside>
</div>
<?php endif; ?>

</div>