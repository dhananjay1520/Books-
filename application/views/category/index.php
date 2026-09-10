<!--
    Category listing view.
    Controller (Category.php) $products, $cartStatus, $category_slug, $min_price,
    $max_price, $cartCount, $loggedIn, $name bhejta hai. Koi DB call yahan nahi hai.
-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Category - <?php echo htmlspecialchars($category_slug ?: 'All Books'); ?></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

<!-- Simple filter form: category filter partial (filter.php) original code me tha,
     par upload nahi hui thi, isliye ek chhota inline filter bana diya -->
<div class="line-separator" style="margin: 20px 40px;"></div>
<form method="GET" action="<?= site_url('category'); ?>" style="display:flex; gap:15px; align-items:center; padding: 0 40px 20px; flex-wrap: wrap;">
    <input type="text" name="category_slug" placeholder="Category slug" value="<?php echo htmlspecialchars($category_slug); ?>" style="padding:8px 12px; border:1px solid #ccc; border-radius:5px;">
    <input type="number" name="min_price" placeholder="Min price" value="<?php echo htmlspecialchars($min_price); ?>" style="padding:8px 12px; border:1px solid #ccc; border-radius:5px; width:120px;">
    <input type="number" name="max_price" placeholder="Max price" value="<?php echo htmlspecialchars($max_price); ?>" style="padding:8px 12px; border:1px solid #ccc; border-radius:5px; width:120px;">
    <button type="submit" class="btn-view-more">Apply Filter</button>
    <a href="<?= site_url('category'); ?>" class="btn-view-more" style="text-decoration:none; display:inline-block;">Clear</a>
</form>

<section class="new-arrivals">
    <div class="main-content">
        <?php foreach ($products as $product): ?>
            <div class="product-card" data-id="<?php echo htmlspecialchars($product['id']); ?>">
                <a href="<?= site_url('product/details/' . $product['id']); ?>" class="product-link">
                    <img src="<?php echo htmlspecialchars(product_image_url($product['image'])); ?>" alt="<?php echo htmlspecialchars($product['pr_name']); ?>" class="product-image">
                    <div class="product-info">
                        <div class="product-name"><?php echo htmlspecialchars($product['pr_name']); ?></div>
                        <div class="product-author">by <?php echo htmlspecialchars($product['pr_author_name']); ?></div>
                        <div class="rating">
                            <?php
                            $rating = 4;
                            for ($i = 0; $i < 5; $i++):
                                echo $i < $rating ? '<i class="fa fa-star"></i>' : '<i class="fa fa-star-o"></i>';
                            endfor;
                            ?>
                        </div>
                    </div>
                </a>
                <div class="price-add-container">
                    <?php if (!empty($cartStatus[$product['id']])): ?>
                        <button class="btn-add" disabled>
                            <i class="fa fa-shopping-bag"></i>&nbsp;Added to Cart
                        </button>
                    <?php else: ?>
                        <form class="add-to-cart-form" data-id="<?php echo htmlspecialchars($product['id']); ?>" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['pr_name']); ?>">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars(product_image_url($product['image'])); ?>">
                            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['pr_price']); ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn-add">
                                <i class="fa fa-shopping-bag"></i>&nbsp;Add to Cart
                            </button>
                        </form>
                    <?php endif; ?>
                    <div class="product-price">₹<?php echo htmlspecialchars($product['pr_price']); ?></div>
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (empty($products)): ?>
            <p style="text-align:center; width:100%; padding: 40px 0; color:#777;">No products found for this filter.</p>
        <?php endif; ?>
    </div>
</section>

<div id="successPopup" class="popup-modal">
    <div class="popup-content">
        <div class="popup-icon">
            <i class="fa fa-check-circle"></i>
        </div>
        <h2>Product Added to Cart Successfully!</h2>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('.add-to-cart-form').on('submit', function(event) {
        event.preventDefault();

        var form = $(this);
        var formData = form.serialize();

        $.ajax({
            url: '<?= site_url("cart/add"); ?>',
            type: 'POST',
            data: formData,
            success: function(response) {
                var data = JSON.parse(response);

                if (data.success) {
                    $('#successPopup').fadeIn();
                    form.find('button').text('Added to Cart').prop('disabled', true);

                    setTimeout(function() {
                        $('#successPopup').fadeOut();
                    }, 2000);
                } else {
                    alert('Error adding product to cart.');
                }
            },
            error: function() {
                alert('There was an error processing your request.');
            }
        });
    });
});
</script>
