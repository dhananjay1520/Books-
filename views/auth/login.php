<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="<?= base_url('assets/css/signup.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/auth-theme.css'); ?>">
</head>
<body>
<div class="form login_form">
    <form method="post" action="<?= site_url('auth/process_login'); ?>" id="form">
        <h1>Sign in</h1>
        <p class="subtitle">Welcome back — enter your details</p>

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
            <label for="password">Password</label>
            <input type="password" placeholder="Your password" name="password" id="password" required>
            <i class="uil uil-eye-slash toggle-password" data-target="password"></i>
        </div>

        <div style="text-align: right; margin: -10px 0 18px 0;">
            <a href="<?= site_url('auth/forgot_password'); ?>" class="forgot_pw">Forgot password?</a>
        </div>

        <button type="submit" class="button">Sign in</button>

        <div class="login_signup">
            Don't have an account? <a href="<?= site_url('auth/signup'); ?>">Register</a>
        </div>
    </form>
</div>

<script src="<?= base_url('assets/js/auth-theme.js'); ?>"></script>
</body>
</html>
