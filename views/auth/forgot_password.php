<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/signup.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/auth-theme.css'); ?>">
</head>
<body>
<div class="form forgot_form">
    <form method="post" action="<?= site_url('auth/process_reset'); ?>" id="form">
        <h1>Reset password</h1>
        <p class="subtitle">Enter your email and choose a new password</p>

        <?php if ($this->session->flashdata('message')): ?>
            <div class="flash-message success"><?= $this->session->flashdata('message'); ?></div>
        <?php endif; ?>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="flash-message error"><?= $this->session->flashdata('error'); ?></div>
        <?php endif; ?>

        <div class="input_box">
            <label for="email">Email</label>
            <input type="email" placeholder="you@example.com" name="email" id="email" required>
        </div>

        <div class="input_box">
            <label for="password">New password</label>
            <input type="password" placeholder="At least 8 characters" name="password" id="password" required onkeyup="checkPasswordRules(); checkPasswordMatch();">
            <i class="uil uil-eye-slash toggle-password" data-target="password"></i>

            <div id="password-rules" class="password-rules">
                <span id="rule-length" class="invalid">✗ 8 chars</span>
                <span id="rule-capital" class="invalid">✗ 1 Uppercase</span>
                <span id="rule-special" class="invalid">✗ 1 Special Char</span>
            </div>
        </div>

        <div class="input_box" id="confirm-box">
            <label for="cpassword">Confirm new password</label>
            <input type="password" placeholder="Re-enter new password" name="cpassword" id="cpassword" required onkeyup="checkPasswordMatch()">
            <i class="uil uil-eye-slash toggle-password" data-target="cpassword"></i>

            <div id="password-match-error" class="error-message" style="display: none;">Passwords do not match</div>
        </div>

        <button type="submit" class="button" id="submit-btn">Update password</button>

        <div class="login_signup">
            <a href="<?= site_url('auth/login'); ?>">Back to login</a>
        </div>
    </form>
</div>

<script src="<?= base_url('assets/js/auth-theme.js'); ?>"></script>

<script>
function checkPasswordRules() {
    var pw = document.getElementById("password").value;

    var lengthRule = document.getElementById("rule-length");
    var capitalRule = document.getElementById("rule-capital");
    var specialRule = document.getElementById("rule-special");

    if (pw.length >= 8) {
        lengthRule.className = "valid";
        lengthRule.innerHTML = "✓ 8 chars";
    } else {
        lengthRule.className = "invalid";
        lengthRule.innerHTML = "✗ 8 chars";
    }

    if (/[A-Z]/.test(pw)) {
        capitalRule.className = "valid";
        capitalRule.innerHTML = "✓ 1 Uppercase";
    } else {
        capitalRule.className = "invalid";
        capitalRule.innerHTML = "✗ 1 Uppercase";
    }

    if (/[!@#$%^&*(),.?":{}|<>]/.test(pw)) {
        specialRule.className = "valid";
        specialRule.innerHTML = "✓ 1 Special Char";
    } else {
        specialRule.className = "invalid";
        specialRule.innerHTML = "✗ 1 Special Char";
    }
}

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
