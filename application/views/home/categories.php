<!--
    Categories partial. Fully static (no DB), so links are just updated
    to point at the Category controller instead of category.php.
-->
<style>
    .categories-section { padding: 60px 0; }

    .categories-section .category-heading {
        text-align: center;
        color: #1a1a1a;
        font-size: 34px;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 45px;
        position: relative;
    }

    .categories-section .category-heading::after {
        content: '';
        position: absolute;
        bottom: -12px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 4px;
        background-color: #f05a28;
        border-radius: 2px;
    }

    .categories-container {
        display: flex;
        align-items: stretch;
        gap: 25px;
        padding: 20px 40px;
        max-width: 1200px;
        margin: 0 auto;
        flex-wrap: nowrap;
        overflow-x: auto;
        scroll-behavior: smooth;
        -webkit-overflow-scrolling: touch;
    }

    @media (min-width: 1200px) {
        .categories-container { justify-content: center; overflow-x: visible; }
    }

    .categories-container::-webkit-scrollbar { height: 6px; }
    .categories-container::-webkit-scrollbar-track { background: #e9ecef; border-radius: 10px; }
    .categories-container::-webkit-scrollbar-thumb { background: #c1c1c1; border-radius: 10px; }
    .categories-container::-webkit-scrollbar-thumb:hover { background: #a8a8a8; }

    .categories-container a { text-decoration: none; color: inherit; display: block; outline: none; }

    .category-card {
        background-color: #ffffff;
        border-radius: 12px;
        border: 1px solid #f0f0f0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        flex: 0 0 auto;
        width: 220px;
        display: flex;
        flex-direction: column;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .category-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        border-color: #e2e2e2;
    }

    .category-image-wrapper { width: 100%; height: 160px; overflow: hidden; }

    .category-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .category-card:hover .category-image-wrapper img { transform: scale(1.08); }

    .category-info {
        padding: 18px 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: #fff;
    }

    .category-name { font-size: 16px; font-weight: 600; color: #222; }

    .category-icon { color: #f05a28; font-size: 14px; transition: transform 0.3s ease; }

    .category-card:hover .category-icon { transform: translateX(4px); }

    @media (max-width: 768px) {
        .categories-container { padding: 15px 20px; gap: 15px; }
        .category-card { width: 180px; }
        .categories-section .category-heading { font-size: 28px; }
    }
</style>

<section class="categories-section">
    <h2 class="category-heading">Explore Categories</h2>

    <div class="categories-container">

        <a href="<?= site_url('category'); ?>?category_slug=historical-fiction">
            <div class="category-card">
                <div class="category-image-wrapper">
                    <img src="https://celadonbooks.com/wp-content/uploads/2020/03/Historical-Fiction-scaled.jpg" alt="Historical Fiction">
                </div>
                <div class="category-info">
                    <span class="category-name">Historical</span>
                    <i class="fas fa-chevron-right category-icon"></i>
                </div>
            </div>
        </a>

        <a href="<?= site_url('category'); ?>?category_slug=biography">
            <div class="category-card">
                <div class="category-image-wrapper">
                    <img src="<?= base_url('assets/uploads/Biography/bio.jpeg'); ?>" alt="Biography">
                </div>
                <div class="category-info">
                    <span class="category-name">Biography</span>
                    <i class="fas fa-chevron-right category-icon"></i>
                </div>
            </div>
        </a>

        <a href="<?= site_url('category'); ?>?category_slug=self-help">
            <div class="category-card">
                <div class="category-image-wrapper">
                    <img src="<?= base_url('assets/uploads/self-help.jpeg'); ?>" alt="Self-help">
                </div>
                <div class="category-info">
                    <span class="category-name">Self-Help</span>
                    <i class="fas fa-chevron-right category-icon"></i>
                </div>
            </div>
        </a>

        <a href="<?= site_url('category'); ?>?category_slug=business">
            <div class="category-card">
                <div class="category-image-wrapper">
                    <img src="<?= base_url('assets/uploads/business.jpeg'); ?>" alt="Business">
                </div>
                <div class="category-info">
                    <span class="category-name">Business</span>
                    <i class="fas fa-chevron-right category-icon"></i>
                </div>
            </div>
        </a>

        <a href="<?= site_url('category'); ?>?category_slug=fantasy">
            <div class="category-card">
                <div class="category-image-wrapper">
                    <img src="<?= base_url('assets/uploads/fantasy.jpeg'); ?>" alt="Fantasy">
                </div>
                <div class="category-info">
                    <span class="category-name">Fantasy</span>
                    <i class="fas fa-chevron-right category-icon"></i>
                </div>
            </div>
        </a>

    </div>
</section>
