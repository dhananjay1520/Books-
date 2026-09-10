<!--
    Best Sellers partial.
    Controller (Home.php) $bestsellers aur $cartStatusBestsellers bhejta hai.
    Yahan koi $pdo query nahi hai.
-->
<style>
    .best-seller-section {
        background-color: #f8f9fa;
        padding: 50px 0;
        font-family: 'Poppins', sans-serif;
    }

    .best-seller-section .category-heading {
        text-align: center;
        color: #1a1a1a;
        font-size: 32px;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 40px;
        position: relative;
    }

    .best-seller-section .category-heading::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background-color: #f05a28;
        border-radius: 2px;
    }

    .best-seller-section .main-content {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        align-items: stretch;
        gap: 22px;
        padding: 0 40px;
        max-width: 1300px;
        margin: 0 auto;
    }

    .best-seller-section .product-card {
        background-color: #ffffff;
        border-radius: 14px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        width: 100%;
        padding: 15px;
        position: relative;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .best-seller-section .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 16px 30px rgba(0, 0, 0, 0.12);
        border-color: #e8e8e8;
    }

    .best-seller-section .product-badge {
        position: absolute;
        top: 25px;
        left: 10px;
        background-color: #d81b60;
        color: #fff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 0 20px 20px 0;
        text-transform: uppercase;
        z-index: 2;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 5px rgba(216, 27, 96, 0.3);
    }

    .best-seller-section .product-link { text-decoration: none; color: inherit; flex-grow: 1; }

    .best-seller-section .product-image-wrapper {
        position: relative;
        width: 100%;
        aspect-ratio: 3 / 4;
        margin-bottom: 15px;
        border-radius: 10px;
        overflow: hidden;
        background-color: #f4f4f4;
    }

    .best-seller-section .product-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    .best-seller-section .product-card:hover .product-image { transform: scale(1.05); }

    .best-seller-section .product-info { margin-bottom: 15px; }

    .best-seller-section .product-name {
        font-size: 16px;
        font-weight: 600;
        color: #222;
        line-height: 1.3;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .best-seller-section .product-author {
        font-size: 13px;
        color: #777;
        margin-top: 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .best-seller-section .rating { margin-top: 8px; font-size: 13px; color: #ffc107; }

    .best-seller-section .price-add-container { display: flex; flex-direction: column; margin-top: auto; }

    .best-seller-section .product-price { font-size: 18px; font-weight: 700; color: #111; margin-bottom: 12px; }

    .best-seller-section .add-to-cart-form { width: 100%; }

    .best-seller-section .btn-add {
        width: 100%;
        background: linear-gradient(135deg, #0e05b9, #0836bf);
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
        transition: background 0.3s, transform 0.1s;
    }

    .best-seller-section .btn-add:hover { background: linear-gradient(135deg, #e34c1b, #bf3f17); }
    .best-seller-section .btn-add:active { transform: scale(0.97); }
    .best-seller-section .btn-add:disabled { background: #e0e0e0; color: #888; cursor: not-allowed; box-shadow: none; }

    @media (max-width: 1150px) {
        .best-seller-section .main-content { grid-template-columns: repeat(4, 1fr); }
    }
    @media (max-width: 900px) {
        .best-seller-section .main-content { grid-template-columns: repeat(3, 1fr); gap: 15px; padding: 0 20px; }
    }
    @media (max-width: 640px) {
        .best-seller-section .main-content { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 420px) {
        .best-seller-section .main-content { grid-template-columns: 1fr; max-width: 280px; }
    }
</style>

<section class="best-seller-section">
    <h2 class="category-heading">Best Sellers</h2>
    <div class="main-content">
        <?php foreach ($bestsellers as $product): ?>
            <div class="product-card" data-id="<?php echo htmlspecialchars($product['id']); ?>">
                <div class="product-badge">Top Pick</div>

                <a href="<?= site_url('product/details/' . $product['id']); ?>" class="product-link">
                    <div class="product-image-wrapper">
                        <img src="<?php echo htmlspecialchars(product_image_url($product['image'])); ?>" alt="<?php echo htmlspecialchars($product['pr_name']); ?>" class="product-image" loading="lazy"
                             onerror="this.onerror=null;this.src='https://placehold.co/400x600/f4f4f4/999999?text=No+Image';">
                    </div>

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

                    <?php if (!empty($cartStatusBestsellers[$product['id']])): ?>
                        <button class="btn-add" disabled>
                            <i class="fa fa-check-circle"></i>&nbsp;Added to Cart
                        </button>
                    <?php else: ?>
                        <form class="add-to-cart-form" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($product['id']); ?>">
                            <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product['pr_name']); ?>">
                            <input type="hidden" name="product_image" value="<?php echo htmlspecialchars(product_image_url($product['image'])); ?>">
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
