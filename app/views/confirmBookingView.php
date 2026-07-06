<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookify | Confirm Your Booking</title>
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
        <div class="auth-card" style="max-width: 560px;">

            <div class="auth-card-header">
                <h2>Confirm your booking</h2>
                <p>Review the details below before you confirm.</p>
            </div>

            <!-- Room summary -->
            <div class="confirm-room-card">
                <img 
                src="<?=$hotelImage[0]['hotel_path']?>" 
                alt="<?=$hotelImage[0]['hotel_image']?>" 
                class="confirm-room-thumb">
                <div>
                    <span class="room-badge">
                        <i class="fa-solid fa-hotel"></i>
                         <?=htmlspecialchars($roomAndHotel['hotel_name'])?></span>
                    <h3 class="confirm-room-title"><?=htmlspecialchars($roomAndHotel['room_type'])?></h3>
                    <div class="room-location">
                        <i class="fa-solid fa-location-dot"></i>
                        Hotel Address / City
                    </div>
                </div>
            </div>

            <div class="confirm-detail-row">
                <div>
                    <span class="confirm-detail-label">Check-in</span>
                    <span class="confirm-detail-value"><?= htmlspecialchars($check_in)?></span>
                </div>
                <i class="fa-solid fa-arrow-right confirm-arrow"></i>
                <div>
                    <span class="confirm-detail-label">Check-out</span>
                    <span class="confirm-detail-value"><?= htmlspecialchars($check_out)?></span>
                </div>
                <div>
                    <span class="confirm-detail-label">Guests</span>
                    <?php if ($roomAndHotel['room_beds']==1): ?>
                    <span class="confirm-detail-value">1 guest</span>
                    <?php else : ?>
                    <span class="confirm-detail-value"><?=htmlspecialchars($roomAndHotel['room_beds'])?> guests</span>
                    <?php endif; ?>

                </div>
            </div>
            <hr class="booking-divider">

            <!-- Guest details -->
            <p class="booking-section-label">Your details</p>
            <div class="confirm-detail-row" style="gap: 24px 0;">
                <div style="flex:1;">
                    <span class="confirm-detail-label">First name</span>
                    <span class="confirm-detail-value"><?=htmlspecialchars($user['first_name'])?></span>
                </div>
                <div style="flex:1;">
                    <span class="confirm-detail-label">Last name</span>
                    <span class="confirm-detail-value"><?=htmlspecialchars($user['last_name'])?></span>
                </div>
            </div>
            <div style="margin-top:14px;">
                <span class="confirm-detail-label">Email</span>
                <span class="confirm-detail-value"><?=htmlspecialchars($user['email'])?></span>
            </div>

            <hr class="booking-divider">

            <!-- Price breakdown -->
            <p class="booking-section-label">Price summary</p>
            <div class="confirm-price-line">
                <span>$75 x 1 night</span>
                <span>$75</span>
            </div>
            <div class="confirm-price-line confirm-price-total">
                <span>Total</span>
                <span>$75</span>
            </div>

            <div class="confirm-policy-box">
                <i class="fa-solid fa-circle-info"></i>
                <span>Free cancellation is available up until 48 hours before check-in. After that, the first night is non-refundable.</span>
            </div>

            <!-- Final confirm action -->
            <form action="index.php" method="POST" class="confirm-form">
                <input type="hidden" name="action" value="finalizeBooking">
                <input type="hidden" name="room" value="<?=$id?>">

                <label class="confirm-terms">
                    <input type="checkbox" name="terms" required>
                    <span>I agree to Bookify's <a href="index.php?action=terms">Terms of Use</a> and <a href="index.php?action=privacy">Privacy Policy</a>.</span>
                </label>

                <button type="submit" class="booking-confirm-btn">Confirm booking</button>
            </form>

            <a href="#" class="confirm-cancel-link">Cancel and go back</a>

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
