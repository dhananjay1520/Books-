<!--
    Product details view.
    Controller (Product.php -> details()) $product, $cartCount, $loggedIn, $name bhejta hai.
    Koi DB call yahan nahi hai.
-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo htmlspecialchars($product['pr_name']); ?> - Product Details</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
    .product-page-wrapper {
        padding: 60px 20px;
        min-height: calc(100vh - 200px);
        font-family: 'Poppins', sans-serif;
        background-color: #f4f6f9;
    }

    .product-details-card {
        display: flex;
        background: #ffffff;
        max-width: 1000px;
        margin: 0 auto;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        overflow: hidden;
    }

    .product-image-container {
        flex: 0 0 40%;
        background-color: #f9f9f9;
        padding: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .product-details-card .product-image {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s ease;
    }

    .product-details-card .product-image:hover { transform: scale(1.03); }

    .product-info-panel {
        flex: 0 0 60%;
        padding: 50px 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .product-info-panel .product-name {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        line-height: 1.2;
        margin-bottom: 8px;
    }

    .product-info-panel .product-author {
        font-size: 16px;
        color: #6c757d;
        font-weight: 500;
        margin-bottom: 25px;
    }

    .product-info-panel .product-author span { color: #f05a28; font-weight: 600; }

    .product-info-panel .product-price {
        font-size: 28px;
        font-weight: 700;
        color: #28a745;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
    }

    .description-wrapper {
        margin-bottom: 35px;
        background: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        border-left: 4px solid #007bff;
    }

    .product-description {
        font-size: 15px;
        color: #555;
        line-height: 1.7;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 4;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .read-more {
        color: #007bff;
        font-weight: 600;
        font-size: 14px;
        cursor: pointer;
        margin-top: 10px;
        display: inline-block;
        transition: color 0.2s;
    }

    .read-more:hover { color: #0056b3; text-decoration: underline; }

    .button-container { display: flex; gap: 15px; margin-top: auto; }

    .button-container .button {
        flex: 1;
        padding: 14px 20px;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        text-decoration: none !important;
    }

    .button-container .button i { margin-right: 8px; font-size: 18px; }

    .btn-add-cart { background-color: #ff4757; color: white; box-shadow: 0 4px 10px rgba(255, 71, 87, 0.3); }
    .btn-add-cart:hover { background-color: #ff2e43; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(255, 71, 87, 0.4); }

    .btn-buy-now { background-color: #2ed573; color: white; box-shadow: 0 4px 10px rgba(46, 213, 115, 0.3); }
    .btn-buy-now:hover { background-color: #26b962; transform: translateY(-2px); box-shadow: 0 6px 15px rgba(46, 213, 115, 0.4); }

    @media (max-width: 768px) {
        .product-details-card { flex-direction: column; }
        .product-image-container { padding: 30px 20px; }
        .product-info-panel { padding: 30px 20px; }
        .product-info-panel .product-name { font-size: 26px; }
        .button-container { flex-direction: column; }
        .button-container .button { width: 100%; }
    }
</style>

<div class="product-page-wrapper">
    <div class="product-details-card">

        <div class="product-image-container">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['pr_name']); ?>" class="product-image">
        </div>

        <div class="product-info-panel">
            <h1 class="product-name"><?php echo htmlspecialchars($product['pr_name']); ?></h1>
            <div class="product-author">by <span><?php echo htmlspecialchars($product['pr_author_name']); ?></span></div>

            <div class="product-price">₹<?php echo htmlspecialchars($product['pr_price']); ?></div>

            <div class="description-wrapper">
                <div class="product-description" id="description">
                    <?php echo nl2br(htmlspecialchars($product['pr_desc'])); ?>
                </div>
                <span class="read-more" id="read-more">Read More <i class="fas fa-chevron-down" style="font-size:12px;"></i></span>
            </div>

            <div class="button-container">
                <button class="button btn-add-cart" data-id="<?php echo htmlspecialchars($product['id']); ?>">
                    <i class="fas fa-shopping-cart"></i> Add to Cart
                </button>
                <a href="<?= site_url('payment/gateway/' . $product['id']); ?>" class="button btn-buy-now">
                    <i class="fas fa-bolt"></i> Buy Now
                </a>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var description = document.getElementById("description");
    var readMore = document.getElementById("read-more");

    if (description.scrollHeight > description.clientHeight) {
        readMore.style.display = "inline-block";
    } else {
        readMore.style.display = "none";
    }

    readMore.addEventListener("click", function() {
        if (description.style.webkitLineClamp === "none") {
            description.style.webkitLineClamp = "4";
            readMore.innerHTML = 'Read More <i class="fas fa-chevron-down" style="font-size:12px;"></i>';
        } else {
            description.style.webkitLineClamp = "none";
            readMore.innerHTML = 'Show Less <i class="fas fa-chevron-up" style="font-size:12px;"></i>';
        }
    });
});
</script>
