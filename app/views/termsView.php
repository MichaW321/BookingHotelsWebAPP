<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookify | Terms of Use</title>
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

<div class="page-content">
    <div class="auth-card" style="max-width: 780px; margin: 0 auto;">

        <div class="auth-card-header">
            <span class="room-badge"><i class="fa-solid fa-file-contract"></i> Legal</span>
            <h2 style="margin-top: 10px;">Terms of Use</h2>
            <p>Last updated: July 6, 2026</p>
        </div>

        <p class="booking-desc" style="margin-bottom: 20px;">
            These Terms of Use ("Terms") govern your access to and use of Bookify's website,
            mobile application, and related services (collectively, the "Service"). By creating
            an account, making a booking, or otherwise using the Service, you agree to be bound
            by these Terms.
        </p>

        <hr class="booking-divider">

        <p class="booking-section-label">1. Eligibility</p>
        <p class="booking-desc">
            You must be at least 18 years old and capable of forming a legally binding contract
            to use Bookify. By using the Service, you confirm that you meet these requirements.
        </p>

        <hr class="booking-divider">

        <p class="booking-section-label">2. Account responsibilities</p>
        <ul class="booking-desc" style="margin: 10px 0 6px 20px; line-height: 1.8;">
            <li>You are responsible for maintaining the confidentiality of your account credentials.</li>
            <li>You agree to provide accurate, current, and complete information when registering or booking.</li>
            <li>You are responsible for all activity that occurs under your account.</li>
            <li>Bookify reserves the right to suspend or terminate accounts that violate these Terms.</li>
        </ul>

        <hr class="booking-divider">

        <p class="booking-section-label">3. Bookings and payments</p>
        <ul class="booking-desc" style="margin: 0 0 6px 20px; line-height: 1.8;">
            <li>All bookings are subject to availability and confirmation by the relevant hotel or venue partner.</li>
            <li>Prices displayed at the time of booking are final unless otherwise stated.</li>
            <li>Payment is processed securely at the time of booking confirmation.</li>
            <li>Bookify acts as an intermediary between you and the accommodation provider; the provider is responsible for delivering the service booked.</li>
        </ul>

        <hr class="booking-divider">

        <p class="booking-section-label">4. Cancellations and refunds</p>
        <p class="booking-desc">
            Cancellation policies vary by listing and are displayed at the time of booking.
            Unless otherwise stated, free cancellation is available up until 48 hours before
            check-in. After that period, the first night may be non-refundable.
        </p>

        <div class="confirm-policy-box">
            <i class="fa-solid fa-circle-info"></i>
            <span>Always review the specific cancellation policy shown on the booking confirmation page before completing your reservation.</span>
        </div>

        <hr class="booking-divider">

        <p class="booking-section-label">5. Acceptable use</p>
        <p class="booking-desc" style="margin-bottom: 8px;">When using Bookify, you agree not to:</p>
        <ul class="booking-desc" style="margin: 0 0 6px 20px; line-height: 1.8;">
            <li>Use the Service for any unlawful purpose or in violation of these Terms.</li>
            <li>Attempt to gain unauthorized access to any part of the Service or its systems.</li>
            <li>Submit false, misleading, or fraudulent booking information.</li>
            <li>Interfere with or disrupt the integrity or performance of the Service.</li>
        </ul>

        <hr class="booking-divider">

        <p class="booking-section-label">6. Intellectual property</p>
        <p class="booking-desc">
            All content on Bookify, including text, graphics, logos, and software, is the
            property of Bookify or its licensors and is protected by applicable intellectual
            property laws. You may not reproduce, distribute, or create derivative works without
            our prior written consent.
        </p>

        <hr class="booking-divider">

        <p class="booking-section-label">7. Limitation of liability</p>
        <p class="booking-desc">
            Bookify is not liable for any indirect, incidental, or consequential damages arising
            from your use of the Service, including issues related to the accommodations
            themselves, which are the responsibility of the respective hotel or venue partner.
        </p>

        <hr class="booking-divider">

        <p class="booking-section-label">8. Termination</p>
        <p class="booking-desc">
            Bookify may suspend or terminate your access to the Service at any time, with or
            without notice, if we believe you have violated these Terms.
        </p>

        <hr class="booking-divider">

        <p class="booking-section-label">9. Changes to these terms</p>
        <p class="booking-desc">
            We may update these Terms from time to time. Continued use of the Service after
            changes are posted constitutes your acceptance of the revised Terms.
        </p>

        <hr class="booking-divider">

        <p class="booking-section-label">10. Contact us</p>
        <p class="booking-desc">
            If you have any questions about these Terms of Use, please contact us at:
        </p>
        <div class="hotel-info-card" style="margin-top: 12px;">
            <div class="hotel-info-header" style="margin-bottom: 0;">
                <div class="hotel-avatar"><i class="fa-solid fa-envelope"></i></div>
                <div>
                    <div class="hotel-info-name">Bookify Support</div>
                    <div class="hotel-info-type">support@bookify-example.com</div>
                </div>
            </div>
        </div>

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