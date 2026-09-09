

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>BookSpot - Home</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="<?= base_url('assets/css/style.css'); ?>">
<style>
.btn-rent {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 8px 12px;
    background-color: rgb(24, 65, 215);
    color: white;
    border: none;
    border-radius: 5px;
    font-size: 14px;
    cursor: pointer;
    z-index: 10;
    text-decoration: none;
}
.btn-rent:hover { background-color: #FF4500; }

.rating { font-size: 16px; color: #FFD700; }

.popup-container {
    display: flex;
    justify-content: center;
    align-items: center;
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: 9999;
}
.popup-box {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    width: 380px;
    text-align: center;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    position: relative;
    z-index: 10000;
    margin-left: 30%;
    margin-top: 13%;
}
h2 { margin-bottom: 15px; color: #333; }
label { display: block; margin: 10px 0 5px; font-weight: bold; text-align: left; }
input[type="date"] {
    width: 100%; padding: 8px; margin-bottom: 10px;
    border: 1px solid #ccc; border-radius: 5px;
}
.rent-details { display: flex; justify-content: space-between; align-items: center; font-size: 16px; margin: 10px 0; }
.rent-details p { margin: 0; }
.terms-button-container { display: flex; justify-content: space-between; align-items: center; margin-top: 15px; }
.terms-label { display: flex; align-items: center; font-size: 14px; }
.terms-label input { margin-right: 5px; }
.confirm-btn {
    background: #28a745; color: #fff; padding: 10px 15px; border: none;
    cursor: pointer; border-radius: 5px; font-size: 16px; flex: 1; margin-left: 10px;
}
.confirm-btn:hover { background: #218838; }
.close-btn {
    background: #dc3545; color: white; padding: 10px 15px; border: none;
    cursor: pointer; border-radius: 5px; font-size: 16px; margin-top: 15px; width: 100%;
}
.close-btn:hover { background: #c82333; }

.promo-section {
    padding: 40px 20px;
    background-color: #f4f6f9;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.line-separator {
    width: 100%;
    max-width: 1200px;
    height: 3px;
    margin: 30px 0;
    background: linear-gradient(to right, transparent, #d1d5db, transparent);
    border-radius: 50%;
}
.banner-container {
    max-width: 1200px;
    width: 100%;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
    cursor: pointer;
}
.img { width: 100%; height: auto; display: block; transition: transform 0.5s ease; }
.banner-container:hover .img { transform: scale(1.03); }

@media (max-width: 768px) {
    .line-separator { margin: 20px 0; }
    .banner-container { border-radius: 12px; }
}
</style>

<?php $this->load->view('home/slider'); ?>

<div class="line-separator"></div>

<?php $this->load->view('home/categories'); ?>



<!-- Rent Pop-up Modal -->
<div id="rentPopup" class="popup-container" style="display: none;">
    <div class="popup-box">
        <h2>Rent a Book</h2>

        <form method="POST" id="rentForm" action="<?= site_url('rent'); ?>">
            <input type="hidden" id="hiddenUserId" name="user_id" value="<?php echo htmlspecialchars($user_id); ?>">
            <input type="hidden" id="hiddenProductId" name="product_id">
            <input type="hidden" id="hiddenProductName" name="product_name">
            <input type="hidden" id="hiddenProductImage" name="product_image">

            <label>Start Date:</label>
            <input type="date" id="startDate" name="start_date" required onchange="calculateRent()">

            <label>End Date:</label>
            <input type="date" id="endDate" name="end_date" required onchange="calculateRent()">

            <div class="rent-details">
                <p>Daily Rent: <b>₹19</b></p>
                <p>Total Rent Cost: <b>₹<span id="totalRent">0</span></b></p>
            </div>

            <input type="hidden" id="hiddenTotalRent" name="total_rent">

            <div class="terms-button-container">
                <label class="terms-label">
                    <input type="checkbox" id="terms" required>
                    I agree to the
                    <a href="<?= base_url('assets/docs/520_B.I_ASSIGNMENT.pdf'); ?>" download>Terms & Conditions</a>
                </label>
                <button type="submit" name="submit_rent" class="confirm-btn">Confirm Rent</button>
            </div>
        </form>

        <button class="close-btn" onclick="closePopup()">Close</button>
    </div>
</div>

<div class="line-separator"></div>

<?php $this->load->view('home/new_arrivals'); ?>

<section class="promo-section">
    <div class="line-separator"></div>
    <div class="banner-container">
        <img src="<?= base_url('assets/uploads/Event_AllAges_GenericBookSale-2023.jpg'); ?>" class="img" alt="Book Sale Event">
    </div>
    <div class="line-separator"></div>
</section>

<?php $this->load->view('home/best_sellers'); ?>

<br><br>

<?php if (file_exists(APPPATH . 'views/about_contact.php')) { $this->load->view('about_contact'); } ?>

<br><br>

<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="<?= base_url('assets/js/script.js'); ?>"></script>

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

                    setTimeout(function() {
                        $('#successPopup').fadeOut();
                    }, 2000);
                } else {
                    alert('Error adding product to cart. Please try again.');
                }
            },
            error: function() {
                alert('There was an error processing your request.');
            }
        });
    });
});
</script>

<script>
function openRentPopup(productId, productName, productImage) {
    document.getElementById("hiddenProductId").value = productId;
    document.getElementById("hiddenProductName").value = productName;
    document.getElementById("hiddenProductImage").value = productImage;
    document.getElementById("rentPopup").style.display = "block";
}

function closePopup() {
    document.getElementById("rentPopup").style.display = "none";
}

function calculateRent() {
    let startDate = document.getElementById("startDate").value;
    let endDate = document.getElementById("endDate").value;

    if (startDate && endDate) {
        let start = new Date(startDate);
        let end = new Date(endDate);
        let diff = Math.ceil((end - start) / (1000 * 60 * 60 * 24));

        if (diff > 0) {
            let totalRent = diff * 19;
            document.getElementById("totalRent").innerText = totalRent;
            document.getElementById("hiddenTotalRent").value = totalRent;
        } else {
            alert("End date must be after start date!");
            document.getElementById("endDate").value = "";
        }
    }
}
</script>
