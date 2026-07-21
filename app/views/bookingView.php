<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookify | <?= htmlspecialchars($roomAndHotel['room_type']) ?> - <?= htmlspecialchars($roomAndHotel['hotel_name']) ?></title>
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
        <?php if(isset($_SESSION['id'])): ?>
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

<div class="page-content booking-detail-page">

    <div class="breadcrumb">
        <a href="index.php?action=home">Home</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span><?= htmlspecialchars($roomAndHotel['hotel_name']) ?> — <?= htmlspecialchars($roomAndHotel['room_type']) ?></span>
    </div>

    <div class="booking-layout">

        <!-- LEFT SIDE -->
        <div class="booking-left">

            <!-- Gallery -->
            <div class="booking-gallery">
                <?php if (!empty($roomImages)): ?>
                    <div class="gallery-main">
                        <img src="<?= htmlspecialchars($roomImages[0]['room_path']) ?>" alt="<?= htmlspecialchars($roomImages[0]['room_image']) ?>">
                    </div>
                <?php endif; ?>
                <div class="gallery-side">
                    <?php foreach ($hotelImages as $img): ?>
                        <div class="gallery-side-img">
                            <img src="<?= htmlspecialchars($img['hotel_path']) ?>" alt="<?= htmlspecialchars($img['hotel_image']) ?>">
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Room Header -->
            <div class="booking-room-header">
                <span class="room-badge"><i class="fa-solid fa-hotel"></i> <?= htmlspecialchars($roomAndHotel['hotel_name']) ?></span>
                <h1 class="booking-room-title"><?= htmlspecialchars($roomAndHotel['room_type']) ?></h1>
                <div class="room-location">
                    <i class="fa-solid fa-location-dot"></i>
                    <?= htmlspecialchars($roomAndHotel['hotel_name']) ?>
                </div>
                <div class="room-stars">★★★★★</div>
            </div>

            <hr class="booking-divider">

            <!-- Description -->
            <p class="booking-section-label">About this room</p>
            <p class="booking-desc"><?= htmlspecialchars($roomAndHotel['room_description']) ?></p>

            <hr class="booking-divider">

            <!-- Hotel Info -->
            <p class="booking-section-label">Hotel information</p>
            <div class="hotel-info-card">
                <div class="hotel-info-header">
                    <div class="hotel-avatar">
                        <i class="fa-solid fa-building-columns"></i>
                    </div>
                    <div>
                        <div class="hotel-info-name"><?= htmlspecialchars($roomAndHotel['hotel_name']) ?></div>
                        <div class="hotel-info-type"><?= htmlspecialchars($roomAndHotel['hotel.type']) ?></div>
                    </div>
                </div>
                <div class="hotel-contacts">
                    <div class="contact-item"><i class="fa-solid fa-envelope"></i> <?= htmlspecialchars($roomAndHotel['hotel.email']) ?></div>
                    <div class="contact-item"><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($roomAndHotel['hotel.phone']) ?></div>
                </div>
            </div>

        </div>

        <!-- RIGHT SIDE - Booking Card -->
        <div class="booking-sidebar">
            <div class="booking-card">
                <div class="booking-price-row">
                    <span class="booking-price-big">$<?= htmlspecialchars($roomAndHotel['room_price']) ?></span>
                    <span class="booking-price-night">/ night</span>
                </div>

                <span class="badge-available"><i class="fa-solid fa-circle-check"></i> Available</span>

                <form action="index.php?action=confirmBooking" method="POST">
                    <input type="hidden" name="price" value="<?= htmlspecialchars($roomAndHotel['room_price']) ?>">
                    <input type="hidden" name="room_id" value="<?= htmlspecialchars($_GET['room']) ?>">
                    <div class="booking-date-row">
                        <div class="booking-form-group">
                            <label class="booking-form-label">Check-in</label>
                            <input type="date" name="check_in" class="booking-form-input" required>
                        </div>
                        <div class="booking-form-group">
                            <label class="booking-form-label">Check-out</label>
                            <input type="date" name="check_out" class="booking-form-input" required>
                        </div>
                    </div>

                    <button type="submit" class="booking-confirm-btn">Confirm booking</button>
                </form>
            </div>
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