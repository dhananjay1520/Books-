<!--
    About + Contact section, embedded inside the Home page (see
    application/views/home/index.php). Yeh ab ek clean partial hai -
    pehle isme apna alag <!DOCTYPE><html><head><body> tha jo beech
    page mein aakar poora DOM tod deta tha (isi wajah se site par
    kayi jagah icons/layout tuta hua dikh raha tha). Contact form ab
    AJAX se Contact::send() par jaata hai, jo CI ke $this->db se
    safely 'contact_messages' table mein insert karta hai.
-->
<section id="about" class="about-contact-section">
<style>
    .about-contact-section .container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .about-contact-section .shadow-box {
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        padding: 50px;
        margin-bottom: 50px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 50px;
        transition: transform 0.3s ease;
    }
    .about-contact-section .shadow-box:hover { transform: translateY(-5px); }

    .about-contact-section .about-text { flex: 1; }
    .about-contact-section .section-title {
        font-size: 36px; color: #1a1a1a; margin-top: 0; margin-bottom: 20px; font-weight: 700;
    }
    .about-contact-section .about-text p { color: #555; line-height: 1.8; font-size: 16px; margin-bottom: 0; }
    .about-contact-section .about-image { flex: 1; }
    .about-contact-section .about-image img {
        width: 100%; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); display: block; object-fit: cover;
    }

    .about-contact-section .contact-form-wrapper {
        flex: 1; background: #f9f9fb; padding: 30px; border-radius: 12px; border: 1px solid #eee;
    }
    .about-contact-section .contact-form-wrapper h3 { font-size: 24px; margin-top: 0; margin-bottom: 25px; color: #222; }
    .about-contact-section .form-group { margin-bottom: 18px; }
    .about-contact-section .form-group input,
    .about-contact-section .form-group textarea {
        width: 100%; padding: 14px 16px; border: 1px solid #ddd; border-radius: 8px;
        font-family: 'Poppins', sans-serif; font-size: 14px; box-sizing: border-box;
        background: #fff; transition: border-color 0.3s;
    }
    .about-contact-section .form-group input:focus,
    .about-contact-section .form-group textarea:focus { outline: none; border-color: #f05a28; }
    .about-contact-section .form-group textarea { height: 130px; resize: vertical; }
    .about-contact-section .submit-btn {
        background-color: #f05a28; color: #fff; border: none; padding: 16px; width: 100%;
        border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer;
        transition: background 0.3s, transform 0.2s;
    }
    .about-contact-section .submit-btn:hover { background-color: #d1481c; transform: scale(1.02); }
    .about-contact-section .submit-btn:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }

    .about-contact-section .contact-info { flex: 1; }
    .about-contact-section .contact-info p { color: #555; line-height: 1.8; font-size: 16px; margin-bottom: 35px; }
    .about-contact-section .info-item { display: flex; align-items: center; margin-bottom: 20px; font-size: 16px; }
    .about-contact-section .info-icon {
        background: #fdf0ec; color: #f05a28; width: 45px; height: 45px; flex-shrink: 0;
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        margin-right: 15px; font-size: 18px;
    }
    .about-contact-section .info-text .label { display: block; color: #888; font-size: 13px; margin-bottom: 2px; }
    .about-contact-section .info-text .value { color: #222; font-weight: 600; text-decoration: none; font-size: 15px; }
    .about-contact-section .info-text a.value:hover { color: #f05a28; }

    .about-contact-section .alert { padding: 15px; margin-bottom: 20px; border-radius: 8px; font-size: 14px; }
    .about-contact-section .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .about-contact-section .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

    @media(max-width: 900px) {
        .about-contact-section .shadow-box { flex-direction: column !important; padding: 30px 20px; gap: 30px; }
        .about-contact-section .about-image img { max-height: 300px; }
        .about-contact-section .contact-form-wrapper, .about-contact-section .contact-info { width: 100%; }
    }
</style>

    <div class="container">

        <!-- About Us Shadow Box -->
        <div class="shadow-box">
            <div class="about-text">
                <h2 class="section-title">About Us</h2>
                <p>We are committed to providing the best quality books for all book lovers. Our platform offers a wide range of books for purchase, rent, and eBooks for instant access. Join us in our journey of spreading knowledge and love for reading.</p>
            </div>
            <div class="about-image">
                <img src="https://images.unsplash.com/photo-1521587760476-6c12a4b040da?w=800&q=80" alt="Stack of Books">
            </div>
        </div>

        <!-- Contact Us Shadow Box -->
        <div class="shadow-box" id="contact" style="flex-direction: row-reverse;">

            <div class="contact-info">
                <h2 class="section-title">Contact Us</h2>
                <p>At <strong>BookSpot</strong>, we believe books open the doors to endless possibilities. Whether you're looking for a rare edition, selling pre-loved books, or have inquiries, we're here to help. Connect with us and be part of our reading community.</p>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="info-text">
                        <span class="label">Phone Number</span>
                        <a href="tel:+918369663915" class="value">83696 63915</a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-envelope"></i></div>
                    <div class="info-text">
                        <span class="label">Email</span>
                        <a href="mailto:cs@bookspot.com" class="value">cs@bookspot.com</a>
                    </div>
                </div>

                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div class="info-text">
                        <span class="label">Our Location</span>
                        <span class="value">Mumbai, Maharashtra</span>
                    </div>
                </div>
            </div>

            <div class="contact-form-wrapper">
                <h3>Send a Message</h3>

                <div id="contactAlert"></div>

                <form id="contactForm">
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Your Name" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Your Email" required>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Write your message..." required></textarea>
                    </div>
                    <button type="submit" class="submit-btn">SEND MESSAGE</button>
                </form>
            </div>

        </div>

    </div>

<script>
(function() {
    var form = document.getElementById('contactForm');
    if (!form) return;

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        var alertBox = document.getElementById('contactAlert');
        var btn = form.querySelector('.submit-btn');
        var originalText = btn.textContent;

        alertBox.innerHTML = '';
        btn.disabled = true;
        btn.textContent = 'SENDING...';

        var formData = new FormData(form);

        fetch('<?= site_url('contact/send'); ?>', {
            method: 'POST',
            body: formData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            if (data.status === 'success') {
                alertBox.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
                form.reset();
            } else {
                alertBox.innerHTML = '<div class="alert alert-error">' + data.message + '</div>';
            }
        })
        .catch(function() {
            alertBox.innerHTML = '<div class="alert alert-error">Something went wrong. Please try again in a moment.</div>';
        })
        .finally(function() {
            btn.disabled = false;
            btn.textContent = originalText;
        });
    });
})();
</script>
</section>
