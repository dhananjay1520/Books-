<!--
    Category listing view.
    Controller (Category.php) bhejta hai: $products, $cartStatus, $categories,
    $category_slug, $min_price, $max_price, $cartCount, $loggedIn, $name.
    Koi DB call yahan nahi hai.

    NOTE: Pehle is page mein koi CSS hi nahi thi (.product-card, .main-content,
    .btn-add, .popup-modal - sab classes undefined thi), isliye cards, images
    aur filter sab plain unstyled links ki tarah dikh rahe the. Ab poora
    scoped CSS is file ke andar hi hai.
-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Category - <?php echo htmlspecialchars($category_slug ?: 'All Books'); ?></title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">

<style>
    :root { --brand: #0085a6; --brand-dark: #006480; }

    .category-page { background-color: #f8f9fa; padding: 30px 0 60px; font-family: 'Poppins', sans-serif; }
    .category-page .page-title-bar { max-width: 1300px; margin: 0 auto 22px; padding: 0 40px; }
    .category-page .page-title-bar h2 { font-size: 26px; font-weight: 700; color: #1a1a1a; margin: 0 0 4px; }
    .category-page .page-title-bar p { color: #888; font-size: 14px; margin: 0; }

    /* --- Filter bar --- */
    .category-page .filter-bar {
        max-width: 1300px; margin: 0 auto 30px; padding: 18px 24px;
        background: #fff; border-radius: 14px; box-shadow: 0 4px 16px rgba(0,0,0,0.06);
        display: flex; gap: 14px; align-items: flex-end; flex-wrap: wrap;
    }
    .category-page .filter-field { display: flex; flex-direction: column; gap: 6px; }
    .category-page .filter-field label { font-size: 12px; font-weight: 600; color: #777; text-transform: uppercase; letter-spacing: 0.03em; }
    .category-page .filter-field select,
    .category-page .filter-field input {
        padding: 10px 14px; border: 1px solid #e1e5ea; border-radius: 8px;
        font-size: 14px; font-family: 'Poppins', sans-serif; min-width: 170px;
        background: #fbfbfd; color: #333; transition: border-color 0.2s, box-shadow 0.2s;
    }
    .category-page .filter-field select { min-width: 200px; cursor: pointer; }
    .category-page .filter-field input[type="number"] { min-width: 120px; }
    .category-page .filter-field select:focus,
    .category-page .filter-field input:focus {
        outline: none; border-color: var(--brand); box-shadow: 0 0 0 3px rgba(0,133,166,0.12); background: #fff;
    }
    .category-page .filter-actions { display: flex; gap: 10px; }
    .category-page .btn-apply, .category-page .btn-clear {
        padding: 10px 22px; border-radius: 8px; font-size: 14px; font-weight: 600;
        cursor: pointer; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
        transition: all 0.2s; border: 1px solid transparent; white-space: nowrap;
    }
    .category-page .btn-apply { background: var(--brand); color: #fff; border: none; }
    .category-page .btn-apply:hover { background: var(--brand-dark); }
    .category-page .btn-clear { background: #fff; color: #666; border-color: #e1e5ea; }
    .category-page .btn-clear:hover { background: #f1f1f1; color: #333; }

    @media (max-width: 700px) {
        .category-page .filter-bar { flex-direction: column; align-items: stretch; }
        .category-page .filter-field select,
        .category-page .filter-field input { min-width: 100%; }
        .category-page .filter-actions { width: 100%; }
        .category-page .btn-apply, .category-page .btn-clear { flex: 1; justify-content: center; }
    }

    /* --- Product grid (1 row = 5 cards on desktop, like Best Sellers) --- */
    .category-page .main-content {
        display: grid; grid-template-columns: repeat(5, 1fr); gap: 22px;
        max-width: 1300px; margin: 0 auto; padding: 0 40px;
    }
    .category-page .product-card {
        background: #fff; border-radius: 14px; border: 1px solid #f0f0f0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05); padding: 15px;
        display: flex; flex-direction: column; overflow: hidden; transition: all 0.3s ease;
    }
    .category-page .product-card:hover {
        transform: translateY(-8px); box-shadow: 0 16px 30px rgba(0,0,0,0.12); border-color: #e8e8e8;
    }
    .category-page .product-link { text-decoration: none; color: inherit; display: block; }
    .category-page .product-card img.product-image {
        width: 100%; aspect-ratio: 3 / 4; object-fit: cover; display: block;
        border-radius: 10px; margin-bottom: 12px; background: #f4f4f4;
    }
    .category-page .product-info { padding: 0 2px; }
    .category-page .product-name {
        font-size: 14.5px; font-weight: 600; color: #1a1a1a; line-height: 1.35;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; min-height: 38px;
    }
    .category-page .product-author { font-size: 12.5px; color: #888; margin: 4px 0 6px; }
    .category-page .rating { font-size: 13px; color: #ffb400; }
    .category-page .price-add-container { margin-top: 12px; display: flex; flex-direction: column; gap: 8px; }
    .category-page .product-price { font-size: 16px; font-weight: 700; color: #1a1a1a; }
    .category-page .btn-add {
        background: var(--brand); color: #fff; border: none; padding: 9px 12px;
        border-radius: 8px; font-size: 13.5px; font-weight: 600; cursor: pointer;
        display: flex; align-items: center; justify-content: center; gap: 6px; transition: background 0.2s;
    }
    .category-page .btn-add:hover { background: var(--brand-dark); }
    .category-page .btn-add:disabled { background: #9fd6e3; cursor: not-allowed; }

    @media (max-width: 1150px) { .category-page .main-content { grid-template-columns: repeat(4, 1fr); } }
    @media (max-width: 900px)  { .category-page .main-content { grid-template-columns: repeat(3, 1fr); gap: 15px; padding: 0 20px; }
                                   .category-page .filter-bar { margin-left: 20px; margin-right: 20px; } }
    @media (max-width: 640px)  { .category-page .main-content { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 420px)  { .category-page .main-content { grid-template-columns: 1fr; max-width: 280px; } }

    /* --- Success popup --- */
    .category-page .popup-modal {
        display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.45);
        z-index: 9999; align-items: center; justify-content: center;
    }
    .category-page .popup-content {
        background: #fff; padding: 40px 30px; border-radius: 16px; text-align: center;
        max-width: 340px; box-shadow: 0 15px 40px rgba(0,0,0,0.2);
    }
    .category-page .popup-icon { font-size: 48px; color: #28a745; margin-bottom: 14px; }
    .category-page .popup-content h2 { font-size: 17px; font-weight: 600; color: #1a1a1a; margin: 0; }
</style>

<div class="category-page">

    <div class="page-title-bar">
        <h2><?php echo $category_slug ? ucwords(str_replace('-', ' ', $category_slug)) : 'All Books'; ?></h2>
        <p><?php echo count($products); ?> book<?php echo count($products) == 1 ? '' : 's'; ?> found</p>
    </div>

    <!-- Filter bar with a real category dropdown -->
    <form method="GET" action="<?= site_url('category'); ?>" class="filter-bar">
        <div class="filter-field">
            <label for="filterCategory">Category</label>
            <select name="category_slug" id="filterCategory">
                <option value="">All Categories</option>
                <?php foreach ($categories as $cat): ?>
                    <?php $slug = $cat['pr_cate']; ?>
                    <option value="<?= htmlspecialchars($slug) ?>" <?= ($category_slug === $slug) ? 'selected' : '' ?>>
                        <?= htmlspecialchars(ucwords(str_replace('-', ' ', $slug))) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="filter-field">
            <label for="filterMinPrice">Min Price</label>
            <input type="number" name="min_price" id="filterMinPrice" placeholder="&#8377; 0" value="<?php echo htmlspecialchars($min_price); ?>">
        </div>
        <div class="filter-field">
            <label for="filterMaxPrice">Max Price</label>
            <input type="number" name="max_price" id="filterMaxPrice" placeholder="&#8377; 5000" value="<?php echo htmlspecialchars($max_price); ?>">
        </div>
        <div class="filter-actions">
            <button type="submit" class="btn-apply"><i class="fa-solid fa-filter"></i> Apply Filter</button>
            <a href="<?= site_url('category'); ?>" class="btn-clear"><i class="fa-solid fa-xmark"></i> Clear</a>
        </div>
    </form>

    <div class="main-content">
        <?php foreach ($products as $product): ?>
            <div class="product-card" data-id="<?php echo htmlspecialchars($product['id']); ?>">
                <a href="<?= site_url('product/details/' . $product['id']); ?>" class="product-link">
                    <img src="<?php echo htmlspecialchars(product_image_url($product['image'])); ?>" alt="<?php echo htmlspecialchars($product['pr_name']); ?>" class="product-image" loading="lazy"
                         onerror="this.onerror=null;this.src='https://placehold.co/400x600/f4f4f4/999999?text=No+Image';">
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
                    <div class="product-price">₹<?php echo htmlspecialchars($product['pr_price']); ?></div>
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
                </div>
            </div>
        <?php endforeach; ?>

        <?php if (empty($products)): ?>
            <p style="text-align:center; grid-column: 1 / -1; padding: 60px 0; color:#999; font-size: 15px;">
                <i class="fa-solid fa-book-open" style="font-size: 32px; display:block; margin-bottom: 12px; color:#ccc;"></i>
                No products found for this filter.
            </p>
        <?php endif; ?>
    </div>
</div>

<div id="successPopup" class="popup-modal">
    <div class="popup-content">
        <div class="popup-icon"><i class="fa-solid fa-circle-check"></i></div>
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
                    $('#successPopup').css('display', 'flex');
                    form.find('button').html('<i class="fa fa-shopping-bag"></i>&nbsp;Added to Cart').prop('disabled', true);

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
