<!--
    Navbar partial.
    Controller (Home.php / Product.php) $data array bhejta hai:
    $loggedIn, $name, $cartCount — is view me koi session/DB call nahi hai.
-->
<style>
    :root {
        --bg-color: #f8f9fa;
        --top-nav-bg: #0085a6;
        --top-nav-text: #ffffff;
        --bottom-nav-bg: #ffffff;
        --bottom-nav-text: #444444;
        --bottom-nav-border: #e0e0e0;
        --dropdown-bg: #ffffff;
        --dropdown-text: #333333;
        --dropdown-hover: #f1f1f1;
        --dropdown-border: #eeeeee;
        --search-bg: #ffffff;
        --search-text: #333333;
        --search-placeholder: #888888;
        --accent-color: #0085a6;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body { font-family: 'Poppins', sans-serif; background-color: var(--bg-color); }

    .navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background-color: var(--top-nav-bg);
        padding: 15px 40px;
    }

    .logo {
        color: var(--top-nav-text);
        font-size: 28px;
        font-weight: 700;
        text-decoration: none;
        font-family: 'Playfair Display', serif;
        transition: opacity 0.3s;
    }
    .logo:hover { opacity: 0.9; }

    .nav-right { display: flex; align-items: center; gap: 30px; }

    .search-container { display: flex; align-items: center; width: 320px; position: relative; }
    .search-container input[type="text"] {
        width: 100%;
        padding: 10px 15px 10px 40px;
        border: none;
        border-radius: 20px;
        font-size: 14px;
        font-family: 'Poppins', sans-serif;
        background-color: var(--search-bg);
        color: var(--search-text);
        outline: none;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        transition: box-shadow 0.3s;
    }
    .search-container input[type="text"]::placeholder { color: var(--search-placeholder); }
    .search-container input[type="text"]:focus { box-shadow: 0 2px 12px rgba(0,0,0,0.2); }

    .search-icon-inside { position: absolute; left: 15px; color: var(--search-placeholder); font-size: 14px; }

    .icons { display: flex; align-items: center; gap: 22px; }
    .icons a, .dropbtn {
        color: var(--top-nav-text);
        text-decoration: none;
        font-size: 22px;
        position: relative;
        background: none;
        border: none;
        cursor: pointer;
        transition: color 0.3s;
    }
    .icons a:hover, .dropbtn:hover { color: #d1f2fb; }

    .cart-icon { position: relative; display: inline-block; }
    .cart-count {
        position: absolute;
        top: -8px;
        right: -12px;
        background-color: #ff4757;
        color: white;
        font-size: 11px;
        font-weight: 600;
        padding: 2px 6px;
        border-radius: 20px;
        border: 2px solid var(--top-nav-bg);
    }

    .dropdown { position: relative; display: inline-block; }
    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        top: 45px;
        background-color: var(--dropdown-bg);
        min-width: 180px;
        box-shadow: 0px 10px 20px rgba(0,0,0,0.15);
        border-radius: 10px;
        overflow: hidden;
        z-index: 100;
        border: 1px solid var(--dropdown-border);
    }
    .dropdown-content.show { display: block; animation: fadeIn 0.2s ease-in-out; }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dropdown-content a {
        color: var(--dropdown-text);
        padding: 12px 20px;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 14px;
        transition: background-color 0.2s, color 0.2s;
    }
    .dropdown-content a:hover { background-color: var(--dropdown-hover); color: var(--accent-color); }

    .dropdown-header {
        display: block;
        padding: 14px 20px;
        font-size: 14px;
        font-weight: 600;
        color: var(--dropdown-text);
        background-color: var(--dropdown-hover);
        border-bottom: 1px solid var(--dropdown-border);
        cursor: default;
    }

    .logout-btn { color: #d9534f !important; border-top: 1px solid var(--dropdown-border); }
    .logout-btn:hover { background-color: #fff5f5 !important; }

    .nav-links-container {
        display: flex;
        justify-content: flex-start;
        background-color: var(--bottom-nav-bg);
        padding: 16px 40px;
        border-bottom: 1px solid var(--bottom-nav-border);
        box-shadow: 0 2px 4px rgba(0,0,0,0.02);
    }
    .nav-links { display: flex; gap: 30px; }
    .nav-links a {
        color: var(--bottom-nav-text);
        text-decoration: none;
        font-size: 15px;
        font-weight: 500;
        transition: color 0.3s;
        position: relative;
    }
    .nav-links a::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: -4px;
        left: 0;
        background-color: var(--accent-color);
        transition: width 0.3s;
    }
    .nav-links a:hover { color: var(--accent-color); }
    .nav-links a:hover::after { width: 100%; }

    @media (max-width: 768px) {
        .navbar { flex-direction: column; padding: 15px 20px; gap: 15px; }
        .nav-right { flex-direction: column; width: 100%; gap: 20px; }
        .search-container { width: 100%; }
        .nav-links-container { padding: 15px 20px; overflow-x: auto; white-space: nowrap; }
        .nav-links { gap: 20px; }
    }
</style>

<header>
    <div class="navbar">
        <a href="<?= site_url('home'); ?>" class="logo">BookSpot</a>

        <div class="nav-right">
            <form action="<?= site_url('product/search'); ?>" method="GET" class="search-container">
                <i class="fa-solid fa-magnifying-glass search-icon-inside"></i>
                <input type="text" name="query" id="search" placeholder="Search for books, authors..." required aria-label="Search books">
                <button type="submit" style="display: none;"></button>
            </form>

            <div class="icons">
                <a href="<?= site_url('cart'); ?>" class="cart-icon" aria-label="Shopping Cart">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span id="cartCount" class="cart-count">
                        <?php echo isset($cartCount) ? htmlspecialchars($cartCount) : '0'; ?>
                    </span>
                </a>

                <div class="dropdown">
                    <button onclick="toggleUserMenu()" class="dropbtn" aria-label="User Menu">
                        <i class="fa-solid fa-circle-user"></i>
                    </button>

                    <div id="userDropdown" class="dropdown-content">
                        <?php if (!empty($loggedIn)): ?>
                            <span class="dropdown-header">Hi, <?php echo htmlspecialchars($name); ?></span>
                            <a href="<?= site_url('profile'); ?>"><i class="fa-regular fa-address-card"></i> My Profile</a>
                            <a href="<?= site_url('orders'); ?>"><i class="fa-solid fa-box-open"></i> My Orders</a>
                            <a href="<?= site_url('auth/logout'); ?>" class="logout-btn"><i class="fa-solid fa-arrow-right-from-bracket"></i> Logout</a>
                        <?php else: ?>
                            <a href="<?= site_url('auth/login'); ?>"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
                            <a href="<?= site_url('auth/signup'); ?>"><i class="fa-solid fa-user-plus"></i> Sign Up</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <nav class="nav-links-container" aria-label="Main Navigation">
        <div class="nav-links">
            <a href="<?= site_url('home'); ?>">Home</a>
            <a href="<?= site_url('category'); ?>">Category</a>
            <a href="<?= site_url('myebook'); ?>">Ebook</a>
            <a href="<?= site_url('about'); ?>">About Us</a>
            <a href="<?= site_url('contact'); ?>">Contact</a>
        </div>
    </nav>
</header>

<script>
    function toggleUserMenu() {
        document.getElementById("userDropdown").classList.toggle("show");
    }

    window.onclick = function(event) {
        if (!event.target.closest('.dropbtn')) {
            let dropdowns = document.getElementsByClassName("dropdown-content");
            for (let i = 0; i < dropdowns.length; i++) {
                let openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }
</script>
