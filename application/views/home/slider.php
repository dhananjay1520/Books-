<!-- Slider partial - no DB, no session, pure display -->
<style>
    .slider-section {
        width: 100%;
        background-color: #f4f6f9;
        padding: 30px 2%;
        box-sizing: border-box;
        display: flex;
        justify-content: center;
    }

    .slider-wrapper {
        width: 100%;
        max-width: 1600px;
        position: relative;
        border-radius: 20px;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        overflow: hidden;
    }

    swiper-container {
        width: 100%;
        height: 450px;
        --swiper-theme-color: #ffffff;
        --swiper-navigation-color: #ffffff;
        --swiper-navigation-size: 20px;
    }

    swiper-slide {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #72bdd1;
    }

    swiper-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    swiper-container::part(button-prev),
    swiper-container::part(button-next) {
        background-color: rgba(0, 0, 0, 0.4);
        width: 45px;
        height: 45px;
        border-radius: 50%;
        backdrop-filter: blur(5px);
        transition: background-color 0.3s ease, transform 0.2s ease;
        margin: 0 15px;
    }

    swiper-container::part(button-prev):hover,
    swiper-container::part(button-next):hover {
        background-color: rgba(0, 0, 0, 0.7);
        transform: scale(1.05);
    }

    swiper-container::part(pagination) { bottom: 20px; }

    swiper-container::part(bullet) {
        width: 10px;
        height: 10px;
        background-color: #ffffff;
        opacity: 0.6;
        border-radius: 50%;
        transition: all 0.3s ease;
        margin: 0 6px !important;
    }

    swiper-container::part(bullet-active) {
        background-color: #007da0;
        opacity: 1;
        width: 28px;
        border-radius: 10px;
    }

    @media (max-width: 1024px) {
        swiper-container { height: 350px; }
    }

    @media (max-width: 768px) {
        .slider-section { padding: 15px 0; }
        .slider-wrapper { border-radius: 0; }
        swiper-container { height: 220px; }
        swiper-container::part(button-prev),
        swiper-container::part(button-next) {
            width: 35px;
            height: 35px;
            margin: 0 5px;
        }
    }
</style>

<section class="slider-section">
    <div class="slider-wrapper">
        <swiper-container class="mySwiper"
            pagination="true"
            pagination-clickable="true"
            navigation="true"
            autoplay-delay="4000"
            autoplay-disable-on-interaction="false"
            loop="true">

            <swiper-slide>
                <img src="<?= base_url('assets/uploads/vector-illustration-stack-books-promo-260nw-2196683163.jpg'); ?>" alt="Weekend Book Sale">
            </swiper-slide>

            <swiper-slide>
                <img src="<?= base_url('assets/uploads/online-discount-book-sale-landing-260nw-1573527619.jpg'); ?>" alt="Online Discount">
            </swiper-slide>

            <swiper-slide>
                <img src="<?= base_url('assets/uploads/360_F_619598670_r3J7JKkXw4xy7CMN6RLdAOZrcXXautfk.jpg'); ?>" alt="Promo Banner">
            </swiper-slide>

        </swiper-container>
    </div>
</section>
