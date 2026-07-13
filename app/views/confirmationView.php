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
        <nav class="navbar-inline">
            <a href="#" class="nav-item"><i class="fa-solid fa-hotel"></i> All Hotels</a>
            <a href="#" class="nav-item"><i class="fa-solid fa-building"></i> Apartments</a>
            <a href="#" class="nav-item"><i class="fa-solid fa-umbrella-beach"></i> Resorts</a>
            <a href="#" class="nav-item"><i class="fa-solid fa-house-chimney-window"></i> Villas & Cabins</a>
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
                    <span class="confirm-detail-value"><?= htmlspecialchars($result['days']) ?></span>
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
        <a href="#">Privacy Policy</a>
        <a href="#">Terms of Use</a>
        <a href="#">Support</a>
    </nav>
</footer>

</body>
</html>