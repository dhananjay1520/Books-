<?php


$success_msg = "";
$error_msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize user inputs
    $name = $conn->real_escape_string(trim($_POST['name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $message = $conn->real_escape_string(trim($_POST['message']));

    if (!empty($name) && !empty($email) && !empty($message)) {
        // Insert query
        $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
        
        if ($conn->query($sql) === TRUE) {
            $success_msg = "Your message has been sent successfully!";
        } else {
            $error_msg = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $error_msg = "Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About & Contact - BookSpot</title>
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
      
        
        .container {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        /* Main Shadow Box Design */
        .shadow-box {
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
        
        .shadow-box:hover {
            transform: translateY(-5px); /* Slight lift effect on hover */
        }

        /* --- About Us Specifics --- */
        .about-text {
            flex: 1;
        }
        .section-title {
            font-size: 36px;
            color: #1a1a1a;
            margin-top: 0;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .about-text p {
            color: #555;
            line-height: 1.8;
            font-size: 16px;
            margin-bottom: 0;
        }
        .about-image {
            flex: 1;
        }
        .about-image img {
            width: 100%;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            display: block;
            object-fit: cover;
        }

        /* --- Contact Us Specifics --- */
        .contact-form-wrapper {
            flex: 1;
            background: #f9f9fb; /* Very subtle inner background */
            padding: 30px;
            border-radius: 12px;
            border: 1px solid #eee;
        }
        .contact-form-wrapper h3 {
            font-size: 24px;
            margin-top: 0;
            margin-bottom: 25px;
            color: #222;
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            box-sizing: border-box;
            background: #fff;
            transition: border-color 0.3s;
        }
        .form-group input:focus, .form-group textarea:focus {
            outline: none;
            border-color: #f05a28;
        }
        .form-group textarea {
            height: 130px;
            resize: vertical;
        }
        .submit-btn {
            background-color: #f05a28;
            color: #fff;
            border: none;
            padding: 16px;
            width: 100%;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s, transform 0.2s;
        }
        .submit-btn:hover {
            background-color: #d1481c;
            transform: scale(1.02);
        }

        .contact-info {
            flex: 1;
        }
        .contact-info p {
            color: #555;
            line-height: 1.8;
            font-size: 16px;
            margin-bottom: 35px;
        }
        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            font-size: 16px;
        }
        .info-icon {
            background: #fdf0ec;
            color: #f05a28;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            font-size: 18px;
        }
        .info-text .label {
            display: block;
            color: #888;
            font-size: 13px;
            margin-bottom: 2px;
        }
        .info-text .value {
            color: #222;
            font-weight: 600;
            text-decoration: none;
            font-size: 15px;
        }
        .info-text a.value:hover {
            color: #f05a28;
        }

        /* Alerts */
        .alert { padding: 15px; margin-bottom: 20px; border-radius: 8px; font-size: 14px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

        /* Responsive Design */
        @media(max-width: 900px) {
            .shadow-box {
                flex-direction: column;
                padding: 30px 20px;
                gap: 30px;
            }
            .about-image img {
                max-height: 300px;
            }
            .contact-form-wrapper, .contact-info {
                width: 100%;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        
        <!-- About Us Shadow Box -->
        <div class="shadow-box">
            <div class="about-text">
                <h2 class="section-title">About Us</h2>
                <p>We are committed to providing the best quality books for all book lovers. Our platform offers a wide range of books for purchase, rent, and eBooks for instant access. Join us in our journey of spreading knowledge and love for reading.</p>
            </div>
            <div class="about-image">
                <!-- Ensure you have an image named 'books-image.jpg' in the same folder -->
                <img src="360_F_619598670_r3J7JKkXw4xy7CMN6RLdAOZrcXXautfk.jpg" alt="Stack of Books">
            </div>
        </div>

        <!-- Contact Us Shadow Box -->
        <div class="shadow-box" style="flex-direction: row-reverse;"> <!-- Reversed so text is on left, form on right -->
            
            <div class="contact-info">
                <h2 class="section-title">Contact Us</h2>
                <p>At <strong>BookSpot</strong>, we believe books open the doors to endless possibilities. Whether you're looking for a rare edition, selling pre-loved books, or have inquiries, we're here to help. Connect with us and be part of our reading community.</p>
                
                <div class="info-item">
                    <div class="info-icon"><i class="fas fa-phone-alt"></i></div>
                    <div class="info-text">
                        <span class="label">Phone Number</span>
                        <a href="tel:8369663915" class="value">83696 15205</a>
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
                
                <?php if(!empty($success_msg)): ?>
                    <div class="alert alert-success"><?php echo $success_msg; ?></div>
                <?php endif; ?>
                
                <?php if(!empty($error_msg)): ?>
                    <div class="alert alert-error"><?php echo $error_msg; ?></div>
                <?php endif; ?>

                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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

</body>
</html>