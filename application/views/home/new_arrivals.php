<!--
    New Arrivals partial.
    Controller (Home.php) $new_arrivals aur $cartStatusNewArrivals bhejta hai.
    Yahan koi $pdo query nahi hai. Popup (rentPopup) home/index.php me already hai,
    isliye Rent button seedha usi popup ko openRentPopup() se call karta hai.
-->
<style>
    .new-arrivals-section { padding: 60px 0; }

    .new-arrivals-section .category-heading {
        text-align: center;
        color: #1a1a1a;
        font-size: 34px;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 45px;
        position: relative;
    }

    .new-arrivals-section .category-heading::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background-color: #2b1b9a;
        border-radius: 2px;
    }

    .new-arrivals-section .main-content {
        display: flex;
        justify-content: center;
        align-items: stretch;
        gap: 25px;
        padding: 0 40px;
        flex-wrap: wrap;
        max-width: 1200px;
        margin: 0 auto;
    }

    .new-arrivals-section .product-card {
        background-color: #ffffff;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
        width: 220px;
        padding: 16px;
        position: relative;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
    }

    .new-arrivals-section .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        border-color: #e2e2e2;
    }

    .new-arrivals-section .product-link { text-decoration: none; color: inherit; flex-grow: 1; }

    .new-arrivals-section .btn-rent {
        position: absolute;
        top: 25px;
        left: 25px;
        background: linear-gradient(135deg, #4b3ebc, #2b1b9a);
        color: white;
        text-decoration: none;
        font-size: 11px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 20px;
        z-index: 10;
        box-shadow: 0 4px 10px rgba(43, 27, 154, 0.3);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: transform 0.2s, background 0.3s;
        border: none;
        cursor: pointer;
    }

    .new-arrivals-section .btn-rent:hover {
        background: linear-gradient(135deg, #3a2ea6, #1e1273);
        transform: scale(1.05);
    }

    .new-arrivals-section .product-image-wrapper {
        position: relative;
        width: 100%;
        height: 240px;
        margin-bottom: 16px;
        border-radius: 8px;
        overflow: hidden;
        background-color: #f9f9f9;
    }

    .new-arrivals-section .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .new-arrivals-section .product-card:hover .product-image { transform: scale(1.06); }

    .new-arrivals-section .product-info { margin-bottom: 20px; }

    .new-arrivals-section .product-name {
        font-size: 16px;
        font-weight: 600;
        color: #222;
        line-height: 1.4;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .new-arrivals-section .product-author {
        font-size: 13px;
        color: #777;
        margin-top: 5px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .new-arrivals-section .price-add-container { display: flex; flex-direction: column; margin-top: auto; }

    .new-arrivals-section .product-price {
        font-size: 18px;
        font-weight: 700;
        color: #111;
        text-align: left;
        margin-bottom: 15px;
    }

    .new-arrivals-section .add-to-cart-form { width: 100%; }

    .new-arrivals-section .btn-add {
        width: 100%;
        background-color: #f05a28;
        color: white;
        border: none;
        padding: 12px 0;
        font-size: 14px;
        font-weight: 600;
        border-radius: 8px;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s, transform 0.1s;
    }

    .new-arrivals-section .btn-add:hover { background-color: #d1481c; }
    .new-arrivals-section .btn-add:active { transform: scale(0.97); }
    .new-arrivals-section .btn-add:disabled { background-color: #e0e0e0; color: #888; cursor: not-allowed; }

    @media (max-width: 900px) {
        .new-arrivals-section .main-content { gap: 15px; padding: 0 20px; }
        .new-arrivals-section .product-card { width: calc(33.333% - 15px); }
    }
    @media (max-width: 768px) {
        .new-arrivals-section .product-card { width: calc(50% - 15px); }
    }
    @media (max-width: 480px) {
        .new-arrivals-section .product-card { width: 100%; max-width: 280px; margin: 0 auto; }
        .new-arrivals-section .btn-rent { top: 20px; left: 20px; }
    }
</style>

<section class="new-arrivals-section">
    <h2 class="category-heading">New Arrivals</h2>
    <div class="main-content">
        <?php foreach ($new_arrivals as $product): ?>
            <div class="product-card" data-id="<?php echo htmlspecialchars($product['id']); ?>">

                <!-- Rent button reuses the same #rentPopup modal defined in home/index.php -->
                <button type="button" class="btn-rent" onclick="openRentPopup(
                    '<?php echo htmlspecialchars($product['id']); ?>',
                    '<?php echo htmlspecialchars($product['pr_name']); ?>',
                    '<?php echo htmlspecialchars($product['image']); ?>'
                )">Rent</button>

                <a href="<?= site_url('product/details/' . $product['id']); ?>" class="product-link">
                    <div class="product-image-wrapper">
                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['pr_name']); ?>" class="product-image">
                    </div>
                    <div class="product-info">
                        <div class="product-name"><?php echo htmlspecialchars($product['pr_name']); ?></div>
                        <div class="product-author">by <?php echo htmlspecialchars($product['pr_author_name']); ?></div>
                    </div>
                </a>

                <div class="price-add-container">
                    <div class="product-price">₹<?php echo htmlspecialchars($product['pr_price']); ?></div>

                    <?php if (!empty($cartStatusNewArrivals[$product['id']])): ?>
                        <button class="btn-add" disabled>
                            <i class="fa fa-check-circle"></i>&nbsp;Added to Cart
                        </button>
                    <?php else: ?>
                        <form class="add-to-cart-form" data-id="<?php echo htmlspecialchars($product['id']); ?>" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['pr_name']); ?>">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($product['image']); ?>">
                            <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($product['pr_price']); ?>">
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" class="btn-add">
                                <i class="fa-solid fa-cart-shopping"></i>&nbsp;Add to Cart
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
