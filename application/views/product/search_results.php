<!--
    Search results view.
    Controller (Product.php) ye data bhejta hai:
    $products, $searchQuery, $cartStatus, $cartCount, $loggedIn, $name.
    Koi session_start(), PDO query yahan nahi hai.
-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Search Results</title>
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
<style>
p.p {
    text-align: center;
    color: red;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
</style>

<div class="search-results-container">
    <h2>Search Results for "<?php echo htmlspecialchars($searchQuery); ?>"</h2>

    <?php if (empty($products)): ?>
        <p class="p">No products found matching your search.</p>
    <?php else: ?>
        <section class="new-arrivals">
            <div class="main-content">
                <?php foreach ($products as $product): ?>
                    <div class="product-card" data-id="<?php echo htmlspecialchars($product['id']); ?>">
                        <a href="<?= site_url('product/details/' . $product['id']); ?>" class="product-link">
                            <img src="<?php echo html_escape(product_image_url($product['image'])); ?>" alt="<?php echo htmlspecialchars($product['pr_name']); ?>" class="product-image">
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
                                    <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['image']); ?>">
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
            </div>
        </section>
    <?php endif; ?>
</div>

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
                    var cartCount = document.getElementById('cartCount');
                    if (cartCount && data.cart_count !== undefined) cartCount.textContent = data.cart_count;

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
