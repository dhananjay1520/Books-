<style>
    .footer {
        background-color: #24262b;
        padding: 60px 0 30px;
    }

    .footer .container {
        max-width: 1170px;
        margin: auto;
        padding: 0 15px;
    }

    .footer .row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }

    .footer ul { list-style: none; }

    .footer-col { width: 30%; padding: 0 15px; }

    .footer-col h4 {
        font-size: 18px;
        color: #ffffff;
        font-weight: 500;
        margin-bottom: 30px;
        position: relative;
    }

    .footer-col h4::before {
        content: '';
        position: absolute;
        left: 0;
        bottom: -8px;
        background-color: #d81b60;
        height: 2px;
        width: 35px;
    }

    .footer-col ul li:not(:last-child) { margin-bottom: 15px; }

    .footer-col ul li a {
        font-size: 15px;
        color: #bbbbbb;
        text-decoration: none;
        font-weight: 300;
        display: block;
        transition: all 0.3s ease;
    }
    .footer-col ul li a:hover { color: #ffffff; padding-left: 8px; }

    .footer-col .social-links a {
        display: inline-block;
        height: 40px;
        width: 40px;
        background-color: rgba(255, 255, 255, 0.2);
        margin: 0 8px 10px 0;
        text-align: center;
        line-height: 40px;
        border-radius: 50%;
        color: #ffffff;
        transition: all 0.3s ease;
    }
    .footer-col .social-links a:hover { color: #24262b; background-color: #ffffff; }

    .copyright-area { text-align: center; margin-top: 50px; }
    .copyright-area p { color: #bbbbbb; font-size: 13px; }

    @media(max-width: 767px){
        .footer-col { width: 50%; margin-bottom: 30px; }
    }
    @media(max-width: 574px){
        .footer-col { width: 100%; }
    }
</style>

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col">
                <h4>Book Spot</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Our Services</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Affiliate Program</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Get Help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Shipping</a></li>
                    <li><a href="#">Contact Support</a></li>
                </ul>
            </div>

            <div class="footer-col">
                <h4>Follow Us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>

        <div class="copyright-area">
            <p>&copy; 2024 Book Spot. All rights reserved.</p>
        </div>
    </div>
</footer>
