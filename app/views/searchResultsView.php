<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookify | Search Results</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header class="header-container">
    <div class="navbar-top">
        <div class="brand-and-nav">
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
        </div>
        <div class="auth-buttons">
            <?php if (isset($_SESSION['id'])): ?>
                <a href="index.php?action=logoutConfirm" class="btn-auth btn-register">Logout</a>
            <?php else: ?>
                <a href="index.php?action=login" class="btn-auth btn-login">Login</a>
                <a href="index.php?action=register" class="btn-auth btn-register">Register</a>
            <?php endif; ?>
        </div>
    </div>
</header>

<div class="page-content">

    <div class="breadcrumb">
        <a href="index.php?action=home">Home</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span>Search Results</span>
    </div>

    <div class="section-header">
        <div>
            <div class="section-title">
                <?= !empty($rooms) ? count($rooms) . ' room(s) found' : 'No rooms found' ?>
                <?= !empty($city) ? ' in ' . htmlspecialchars($city) : '' ?>
            </div>
            <?php if (!empty($check_in) && !empty($check_out)): ?>
                <div class="section-sub">
                    <?= htmlspecialchars($check_in) ?> &ndash; <?= htmlspecialchars($check_out) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (empty($rooms)): ?>

        <div class="auth-page-wrapper" style="padding-top:0;">
            <div class="auth-card" style="max-width: 480px; text-align:center;">
                <p>No rooms match your search. Try different dates or a different city.</p>
                <a href="index.php?action=home" class="booking-confirm-btn" style="display:inline-block; text-decoration:none; margin-top:12px;">Back to home</a>
            </div>
        </div>

    <?php else: ?>

        <div class="rooms-grid">
            <?php foreach ($rooms as $room): ?>
                <div class="room-card">
                    <img src="<?= htmlspecialchars($room['room_path'] ?? 'https://placehold.co/400x180') ?>"
                         alt="<?= htmlspecialchars($room['room_type']) ?>">

                    <div class="room-body">
                        <span class="room-badge">
                            <i class="fa-solid fa-hotel"></i>
                            <?= htmlspecialchars($room['hotel_name']) ?>
                        </span>

                        <h3 class="room-name"><?= htmlspecialchars($room['room_type']) ?></h3>

                        <div class="room-location">
                            <i class="fa-solid fa-location-dot"></i>
                            <?= htmlspecialchars($room['city_name']) ?>, <?= htmlspecialchars($room['country_name']) ?>
                        </div>

                        <div class="room-meta">
                            <span><i class="fa-solid fa-bed"></i> <?= htmlspecialchars($room['room_beds']) ?> beds</span>
                            <?php if (!empty($room['room_balcony'])): ?>
                                <span><i class="fa-solid fa-door-open"></i> Balcony</span>
                            <?php endif; ?>
                        </div>

                        <div class="room-footer">
                            <div class="room-price">
                                $<?= htmlspecialchars(number_format($room['room_price'], 2)) ?>
                                <small>/ night</small>
                            </div>
                            <a href="index.php?action=book&room=<?= urlencode($room['room_id']) ?>"
                               class="booking-confirm-btn"
                               style="width:auto; padding:8px 18px;">
                                View
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

    <?php endif; ?>

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