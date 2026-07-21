<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookify | About Us</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header class="header-container">
    <div class="navbar-top">
        <div class="logo">
            <a href="index.php?action=home">Book<span>ify</span></a>
        </div>
        <div class="auth-buttons">
    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="index.php?action=admin" class="btn-auth" style="background-color: #d9534f; color: white;">
            <i class="fa-solid fa-user-gear"></i> Admin Panel
        </a>
    <?php endif; ?>

    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === 'manager')): ?>
        <a href="index.php?action=manager" class="btn-auth" style="background-color: #f0ad4e; color: white;">
            <i class="fa-solid fa-chart-line"></i> Manager Panel
        </a>
    <?php endif; ?>
</div>
        <nav class="navbar-inline">
            <a href="index.php?action=home" class="nav-item active"><i class="fa-solid fa-hotel"></i> Home</a>
            <a href="index.php?action=about" class="nav-item"><i class="fa-solid fa-building"></i> About us</a>
            <a href="index.php?action=terms" class="nav-item"><i class="fa-solid fa-umbrella-beach"></i> Terms of use</a>
            <a href="index.php?action=privacy" class="nav-item"><i class="fa-solid fa-house-chimney-window"></i>Privacy policy</a>
        </nav>
        <?php if (isset($_SESSION['id'])): ?>
            <div class="auth-buttons">
                <a href="index.php?action=logoutConfirm" class="btn-auth btn-register">Logout</a>
            </div>
        <?php else: ?>
            <div class="auth-buttons">
                <a href="index.php?action=register" class="btn-auth btn-login">Register</a>
                <a href="index.php?action=login" class="btn-auth btn-register">Sign In</a>
            </div>
        <?php endif; ?>
    </div>
</header>

<div class="page-content">

    <div class="breadcrumb">
        <a href="index.php?action=home">Home</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span>About Us</span>
    </div>

    <div class="section-header">
        <div>
            <div class="section-title">About Bookify</div>
            <div class="section-sub">Making travel simple, one stay at a time</div>
        </div>
    </div>

    <div class="hotel-info-card" style="margin-bottom: 24px; padding: 24px;">
        <p class="booking-desc">
            Bookify was built to make finding and reserving a place to stay as
            straightforward as possible. Whether you're after a quiet villa,
            a downtown apartment, or a resort by the sea, we connect you with
            hotels and hosts across the world so you can book with confidence
            and get on with planning the trip itself.
        </p>
    </div>

    <hr class="booking-divider">

    <p class="booking-section-label">What we offer</p>
    <div class="rooms-grid" style="margin-bottom: 24px;">

        <div class="room-card">
            <div class="room-body">
                <div class="hotel-avatar" style="margin-bottom: 12px;">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </div>
                <h3 class="room-name">Easy search</h3>
                <p class="booking-desc" style="font-size: 13px;">
                    Filter by city, dates, and room type to find exactly what
                    fits your trip in seconds.
                </p>
            </div>
        </div>

        <div class="room-card">
            <div class="room-body">
                <div class="hotel-avatar" style="margin-bottom: 12px;">
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <h3 class="room-name">Secure booking</h3>
                <p class="booking-desc" style="font-size: 13px;">
                    Every reservation is confirmed instantly, with your
                    details kept safe from start to finish.
                </p>
            </div>
        </div>

        <div class="room-card">
            <div class="room-body">
                <div class="hotel-avatar" style="margin-bottom: 12px;">
                    <i class="fa-solid fa-tags"></i>
                </div>
                <h3 class="room-name">Transparent pricing</h3>
                <p class="booking-desc" style="font-size: 13px;">
                    The price you see is the price you pay — no hidden fees
                    added at checkout.
                </p>
            </div>
        </div>

        <div class="room-card">
            <div class="room-body">
                <div class="hotel-avatar" style="margin-bottom: 12px;">
                    <i class="fa-solid fa-headset"></i>
                </div>
                <h3 class="room-name">Support that helps</h3>
                <p class="booking-desc" style="font-size: 13px;">
                    Questions before, during, or after your stay? Our team
                    is on hand to help sort it out.
                </p>
            </div>
        </div>

    </div>

    <hr class="booking-divider">

    <p class="booking-section-label">Our story</p>
    <p class="booking-desc" style="margin-bottom: 24px;">
        Bookify started as a simple idea: booking a room shouldn't feel like
        a chore. What began as a small project has grown into a platform
        that lists hotels, apartments, resorts, and villas across multiple
        countries — built with travelers in mind at every step.
    </p>

    <div class="hotel-info-card" style="text-align:center; padding: 32px;">
        <p class="booking-desc" style="margin-bottom: 16px;">
            Ready to find your next stay?
        </p>
        <a href="index.php?action=home" class="booking-confirm-btn" style="display:inline-block; width:auto; text-decoration:none; padding: 12px 32px;">
            Start searching
        </a>
    </div>

</div>

<footer class="footer footer-visible">
    <div class="footer-logo"><a href="index.php">Book<span>ify</span></a></div>
    <p class="footer-copy">© 2026 Bookify. All rights reserved.</p>
    <nav class="footer-links">
        <a href="index.php?action=privacy">Privacy Policy</a>
    <a href="index.php?action=terms">Terms of Use</a>
    <a href="index.php?action=about">About us</a>
    </nav>
</footer>

</body>
</html>