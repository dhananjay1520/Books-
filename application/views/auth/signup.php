<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register</title>

    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet"
          href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <link rel="stylesheet"
          href="<?= base_url('assets/css/signup.css'); ?>">

</head>

<body>

<div class="form signup_form">

    <form method="post"
          action="<?= site_url('auth/signup'); ?>"
          id="form">

        <h1>Register</h1>

        <div class="input_box">

            <input
                type="text"
                placeholder="Enter your name"
                name="name"
                id="name"
                required
            >

        </div>


        <div class="input_box <?= !empty($signupshowerror) ? 'error-email' : ''; ?>">

            <input
                type="email"
                placeholder="Enter your email"
                name="email"
                id="email"
                required
            >

            <?php if (!empty($signupshowerror)): ?>

                <div class="error-message">
                    Email already exists!
                </div>

            <?php endif; ?>

        </div>


        <div class="input_box">

            <input
                type="password"
                placeholder="Create password"
                name="password"
                id="password"
                required
            >

        </div>


        <div class="input_box <?= !empty($signuppassworderror) ? 'error-password-confirm' : ''; ?>">

            <input
                type="password"
                placeholder="Confirm password"
                name="cpassword"
                id="cpassword"
                required
            >

            <?php if (!empty($signuppassworderror)): ?>

                <div class="error-message">
                    Passwords don't match
                </div>

            <?php endif; ?>

        </div>


        <button type="submit" class="button">
            Register
        </button>


        <div class="login_signup">

            Already have an account?

            <a href="<?= site_url('auth/login'); ?>">
                Login
            </a>

        </div>

    </form>

</div>

</body>
</html>