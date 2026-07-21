<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookify | Booking Confirmed</title>
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
        <div class="auth-buttons">
            <a href="index.php?action=logoutConfirm" class="btn-auth btn-register">Logout</a>
        </div>
    </div>
</header>

<div class="page-content booking-detail-page">
    <div class="auth-page-wrapper" style="padding-top:0; align-items:flex-start;">
        <div class="auth-card" style="max-width: 560px; text-align:center;">

            <i class="fa-solid fa-circle-check" style="font-size:48px; color:#2ecc71; margin-bottom:16px;"></i>

            <div class="auth-card-header">
                <h2>Thanks for your reservation!</h2>
                <p>A confirmation has been booked under reservation #<?= htmlspecialchars($result['reservation_id']) ?>.</p>
            </div>

            <hr class="booking-divider">

            <div class="confirm-detail-row" style="text-align:left; gap: 12px 0; flex-direction:column;">
                <div>
                    <span class="confirm-detail-label">Room type</span>
                    <span class="confirm-detail-value"><?= htmlspecialchars($result['type']) ?></span>
                </div>
                <div>
                    <span class="confirm-detail-label">Check-in</span>
                    <span class="confirm-detail-value"><?= htmlspecialchars($result['check_in']) ?></span>
                </div>
                <div>
                    <span class="confirm-detail-label">Check-out</span>
                    <span class="confirm-detail-value"><?= htmlspecialchars($result['check_out']) ?></span>
                </div>
                <div>
                    <span class="confirm-detail-label">Nights</span>
                    <span class="confirm-detail-value"><?= $result['days'] ?></span>
                </div>
                <div>
                    <span class="confirm-detail-label">Total paid</span>
                    <span class="confirm-detail-value">$<?= htmlspecialchars(number_format($result['price'], 2)) ?></span>
                </div>
            </div>

            <hr class="booking-divider">

            <a href="index.php?action=home" class="booking-confirm-btn" style="display:inline-block; text-decoration:none; margin-top: 12px;">Back to home</a>

        </div>
    </div>
</div>

<footer class="footer">
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