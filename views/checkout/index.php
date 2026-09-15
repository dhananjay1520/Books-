<div class="store-page">
<section class="page-heading">
  <div>
    <span class="eyebrow">SECURE CHECKOUT</span>
    <h1>Complete your order</h1>
    <p>Review your books and continue to secure payment.</p>
  </div>
</section>

<?php if (empty($items)): ?>
<section class="empty-state card">
  <div class="empty-icon"><i class="fa-solid fa-bag-shopping"></i></div>
  <h2>Your checkout is empty</h2>
  <p>Add a book or rental to your cart before continuing to payment.</p>
  <a class="primary-btn" href="<?= base_url('category') ?>">Browse Books</a>
</section>
<?php else: ?>
<div class="checkout-layout">
  <section class="card checkout-card">
    <div class="checkout-step"><span>1</span><div><h2>Order items</h2><p class="muted">Your selected books</p></div></div>
    <?php foreach ($items as $item): ?>
      <div class="checkout-item">
        <img src="<?= book_image_url($item['image']) ?>" alt="<?= html_escape($item['name']) ?>">
        <div><strong><?= html_escape($item['name']) ?></strong><small>Qty: <?= (int)$item['quantity'] ?></small></div>
        <strong>₹<?= number_format((float)$item['price'] * (int)$item['quantity'], 2) ?></strong>
      </div>
    <?php endforeach; ?>
  </section>

  <aside class="card summary-card">
    <span class="eyebrow">PAYMENT</span>
    <h2>Order Total</h2>
    <div class="summary-total"><span>Total</span><strong>₹<?= number_format($total, 2) ?></strong></div>
    <div id="paypal-button-container" class="paypal-box"></div>
    <div class="secure-note"><i class="fa-solid fa-lock"></i> Protected by PayPal</div>
  </aside>
</div>
<?php endif; ?>

<?php if (!empty($items)): ?>
<script src="https://www.paypal.com/sdk/js?client-id=<?= urlencode($paypal_client_id) ?>&currency=<?= urlencode($currency) ?>"></script>
<script>
paypal.Buttons({
  createOrder: function(data, actions) {
    return actions.order.create({
      purchase_units: [{ amount: { value: '<?= number_format($total, 2, '.', '') ?>', currency_code: '<?= html_escape($currency) ?>' } }]
    });
  },
  onApprove: function(data, actions) {
    return actions.order.capture().then(function(details) {
      window.location.href = '<?= base_url('payment/success') ?>?paymentId=' + encodeURIComponent(data.orderID);
    });
  },
  onError: function(err) {
    console.error(err);
    alert('Payment could not be completed. Please try again.');
  }
}).render('#paypal-button-container');
</script>
<?php endif; ?>

</div>