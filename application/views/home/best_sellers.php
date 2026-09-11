<style>
.bs-book-section{padding:42px 0;background:#fff}
.bs-book-section.alt{background:#fafbfe}
.bs-book-wrap{max-width:1360px;margin:0 auto;padding:0 28px}
.bs-book-head{display:flex;align-items:end;justify-content:space-between;gap:16px;margin-bottom:18px}
.bs-book-title{margin:0;color:#161b2d;font-size:28px;font-weight:800;letter-spacing:-.02em}
.bs-view-all{color:#f15a24;text-decoration:none;font-size:15px;font-weight:800;white-space:nowrap}
.bs-view-all:hover{text-decoration:underline}
.bs-carousel{position:relative}
.bs-track{display:flex;gap:28px;overflow-x:auto;scroll-behavior:smooth;scrollbar-width:none;padding:2px 2px 18px}
.bs-track::-webkit-scrollbar{display:none}
.bs-card{flex:0 0 250px;min-width:250px;text-decoration:none;color:inherit;position:relative}
.bs-card-box{height:372px;border:1px solid #e1e3e8;border-radius:9px;background:#fff;padding:15px;position:relative;box-shadow:0 2px 8px rgba(31,41,55,.025);transition:transform .2s ease,box-shadow .2s ease}
.bs-card:hover .bs-card-box{transform:translateY(-3px);box-shadow:0 10px 24px rgba(31,41,55,.08)}
.bs-card-image{height:100%;width:100%;object-fit:cover;border-radius:3px;background:#f2f4f8;display:block}
.bs-heart{position:absolute;right:10px;top:10px;width:40px;height:40px;border-radius:50%;display:grid;place-items:center;background:#fff;color:#555;border:1px solid #e5e7eb;box-shadow:0 2px 8px rgba(0,0,0,.08);font-size:20px;z-index:2}
.bs-card-name{margin:13px 0 0;font-size:18px;font-weight:700;color:#161616;line-height:1.3;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.bs-card-meta{margin-top:7px;font-size:14px;color:#777;white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.bs-price-row{display:flex;align-items:baseline;gap:10px;margin-top:15px}
.bs-price{font-size:21px;font-weight:800;color:#171717}
.bs-cart-form{margin-top:12px}
.bs-cart-btn{width:100%;border:0;border-radius:8px;padding:10px 12px;background:#ff5b2e;color:#fff;font-size:13px;font-weight:750;cursor:pointer}
.bs-cart-btn:disabled{background:#e6e7eb;color:#74777e;cursor:not-allowed}
.bs-nav{position:absolute;top:150px;width:52px;height:120px;border:0;border-radius:4px;background:#fff;box-shadow:0 6px 22px rgba(0,0,0,.12);display:grid;place-items:center;z-index:5;color:#444;font-size:28px;cursor:pointer}
.bs-nav.left{left:-7px}.bs-nav.right{right:-7px}
.bs-book-section.expanded .bs-track{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));overflow:visible;gap:30px 24px;padding-bottom:8px}
.bs-book-section.expanded .bs-card{min-width:0;flex:auto}
.bs-book-section.expanded .bs-nav{display:none}
@media(max-width:1200px){.bs-book-section.expanded .bs-track{grid-template-columns:repeat(3,minmax(0,1fr))}.bs-card{flex-basis:230px;min-width:230px}.bs-card-box{height:350px}}
@media(max-width:800px){.bs-book-wrap{padding:0 18px}.bs-book-title{font-size:24px}.bs-track{gap:18px}.bs-card{flex-basis:205px;min-width:205px}.bs-card-box{height:315px}.bs-nav{width:42px;height:86px;top:130px}.bs-book-section.expanded .bs-track{grid-template-columns:repeat(2,minmax(0,1fr));gap:20px 14px}}
@media(max-width:480px){.bs-book-title{font-size:22px}.bs-card{flex-basis:174px;min-width:174px}.bs-card-box{height:270px;padding:10px}.bs-card-name{font-size:15px}.bs-card-meta{font-size:12px}.bs-price{font-size:18px}.bs-heart{width:34px;height:34px;font-size:17px}.bs-nav{display:none}.bs-book-section.expanded .bs-track{grid-template-columns:1fr 1fr;gap:18px 10px}}
</style>

<section class="bs-book-section alt" id="best-sellers-section">
    <div class="bs-book-wrap">
        <div class="bs-book-head">
            <h2 class="bs-book-title">Best Sellers</h2>
            <a href="#" class="bs-view-all" data-section="best-sellers-section">View All</a>
        </div>
        <div class="bs-carousel">
            <button class="bs-nav left" type="button" aria-label="Previous best sellers" data-target="best-sellers-track">‹</button>
            <div class="bs-track" id="best-sellers-track">
                <?php foreach ($bestsellers as $product): ?>
                    <article class="bs-card">
                        <div class="bs-card-box">
                            <span style="position:absolute;left:15px;top:15px;background:#ef3f22;color:#fff;border-radius:0 16px 16px 0;padding:5px 10px;font-size:10px;font-weight:800;z-index:2">TOP PICK</span>
                            <button class="bs-heart" type="button" aria-label="Add to wishlist"><i class="fa-regular fa-heart"></i></button>
                            <a href="<?= site_url('product/details/' . $product['id']); ?>" class="bs-card-link">
                                <img class="bs-card-image" src="<?= html_escape(product_image_url($product['image'])); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/placeholder-book.svg'); ?>';" alt="<?= html_escape($product['pr_name']); ?>" onerror="this.onerror=null;this.src='<?= base_url('assets/uploads/placeholder-book.svg'); ?>';">
                            </a>
                        </div>
                        <a href="<?= site_url('product/details/' . $product['id']); ?>" class="bs-card-link" style="text-decoration:none;color:inherit">
                            <div class="bs-card-name"><?= html_escape($product['pr_name']); ?></div>
                            <div class="bs-card-meta">by <?= html_escape($product['pr_author_name']); ?></div>
                        </a>
                        <div class="bs-price-row"><span class="bs-price">₹ <?= html_escape($product['pr_price']); ?></span></div>
                        <?php if (!empty($cartStatusBestsellers[$product['id']])): ?>
                            <button class="bs-cart-btn" type="button" disabled><i class="fa-solid fa-check"></i> Added to Cart</button>
                        <?php else: ?>
                            <form class="add-to-cart-form bs-cart-form" method="POST">
                                <input type="hidden" name="product_id" value="<?= html_escape($product['id']); ?>">
                                <input type="hidden" name="product_name" value="<?= html_escape($product['pr_name']); ?>">
                                <input type="hidden" name="product_image" value="<?= html_escape($product['image']); ?>">
                                <input type="hidden" name="product_price" value="<?= html_escape($product['pr_price']); ?>">
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="bs-cart-btn"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>
                            </form>
                        <?php endif; ?>
                    </article>
                <?php endforeach; ?>
            </div>
            <button class="bs-nav right" type="button" aria-label="Next best sellers" data-target="best-sellers-track">›</button>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('.bs-nav').forEach(function(btn){
        btn.addEventListener('click', function(){
            const track=document.getElementById(this.dataset.target);
            if(!track) return;
            const amount=Math.max(track.clientWidth*.82, 260);
            track.scrollBy({left:this.classList.contains('left')?-amount:amount,behavior:'smooth'});
        });
    });
    document.querySelectorAll('.bs-view-all').forEach(function(link){
        link.addEventListener('click', function(e){
            e.preventDefault();
            const section=document.getElementById(this.dataset.section);
            if(!section) return;
            section.classList.toggle('expanded');
            this.textContent=section.classList.contains('expanded')?'Show Less':'View All';
        });
    });
});
</script>
