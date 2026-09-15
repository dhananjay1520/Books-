<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/signup.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/auth-theme.css'); ?>">
</head>
<body>
<div class="form signup_form">
<form method="post" action="<?= site_url('auth/signup'); ?>" id="form">
    <h1>Create account</h1>
    <p class="subtitle">A few details to get you set up</p>

    <div class="input_box">
        <label for="name">Name</label>
        <input type="text" placeholder="Your full name" name="name" id="name" required>
    </div>

    <div class="input_box <?= !empty($signupshowerror) ? 'error-email' : ''; ?>">
        <label for="email">Email</label>
        <input type="email" placeholder="you@example.com" name="email" id="email" required>
        <?php if (!empty($signupshowerror)): ?>
            <div class="error-message">Email already exists!</div>
        <?php endif; ?>
    </div>

    <div class="input_box">
        <label for="password">Password</label>
        <input type="password" placeholder="At least 6 characters" name="password" id="password" required>
        <i class="uil uil-eye-slash toggle-password" data-target="password"></i>
        <div id="password-rules" class="password-rules">
            <span id="rule-length" class="invalid">✗ 8 characters</span>
            <span id="rule-capital" class="invalid">✗ 1 Uppercase</span>
            <span id="rule-special" class="invalid">✗ 1 Special Char</span>
        </div>
    </div>

    <div class="input_box <?= !empty($signuppassworderror) ? 'error-password-confirm' : ''; ?>" id="confirm-box">
        <label for="cpassword">Confirm password</label>
        <input type="password" placeholder="Re-enter your password" name="cpassword" id="cpassword" required onkeyup="checkPasswordMatch()">
        <i class="uil uil-eye-slash toggle-password" data-target="cpassword"></i>

        <?php if (!empty($signuppassworderror)): ?>
            <div class="error-message">Passwords don't match</div>
        <?php endif; ?>

        <div id="password-match-error" class="error-message" style="display: none;">Passwords do not match</div>
    </div>

    <button type="submit" class="button" id="submit-btn">Register</button>

    <div class="login_signup">
        Already have an account? <a href="<?= site_url('auth/login'); ?>">Login</a>
    </div>
</form>
</div>

<script src="<?= base_url('assets/js/auth-theme.js'); ?>"></script>
<script>
function checkPasswordMatch() {
    var password = document.getElementById("password").value;
    var confirmPassword = document.getElementById("cpassword").value;
    var errorMsg = document.getElementById("password-match-error");
    var confirmBox = document.getElementById("confirm-box");

    if (password !== confirmPassword && confirmPassword !== "") {
        errorMsg.style.display = "block";
        confirmBox.classList.add("error-password-confirm");
    } else {
        errorMsg.style.display = "none";
        confirmBox.classList.remove("error-password-confirm");
    }
}
</script>
</body>
</html>
