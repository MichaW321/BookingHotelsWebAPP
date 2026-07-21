<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookify | Find Hotels & Accommodations</title>
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

    <section class="hero-block">
        <div class="hero-wrapper">
            <div class="hero-text">
                <h1>Find your next stay</h1>
                <p>Search deals on hotels, homes, and much more...</p>
            </div>

            <div class="search-container">
                <form class="search-form" action="index.php" method="GET">
    <input type="hidden" name="action" value="search">

    <div class="input-group">
        <label for="city"><i class="fa-solid fa-location-dot"></i></label>
        <input type="text" id="city" name="city" placeholder="Where are you going?" required>
    </div>

    <div class="input-group">
        <label for="check_in"><i class="fa-solid fa-calendar-days"></i></label>
        <input type="date" id="check_in" name="check_in" required>
    </div>

    <div class="input-group">
        <label for="check_out"><i class="fa-solid fa-calendar-days"></i></label>
        <input type="date" id="check_out" name="check_out" required>
    </div>

    <button type="submit" class="search-btn">Search</button>
</form>
            </div>
        </div>
    </section>

<main class="page-content">
  <?php if (!empty($rooms)): ?>
    <div class="section-header">
      <h2 class="section-title">Most visited rooms</h2>
      <span class="section-sub">Trending this week</span>
    </div>
    <div class="rooms-grid">
      <?php foreach ($rooms as $room): ?>
        <div class="room-card">
          <div class="room-img-placeholder">
            <img src="<?= htmlspecialchars($room['room_path']) ?>" alt="<?= htmlspecialchars($room['room_image']) ?>">
          </div>
          <div class="room-body">
            <span class="room-badge">
              <i class="fa-solid fa-hotel"></i>
            </span>
            <p class="room-name"><?= htmlspecialchars($room['type']) ?></p>
            <div class="room-location">
              <i class="fa-solid fa-location-dot"></i>
                  <?= htmlspecialchars($room['nameCo']) ?>
                  <?php echo", "?>
                  <?= htmlspecialchars($room['nameCi']) ?>
            </div>

            <div class="room-stars">★★★★★</div>
            <div class="room-meta">
              <span><i class="fa-solid fa-bed"></i> <?= htmlspecialchars($room['beds']) ?> beds</span>
              <?php if ($room['balcony']): ?>
                <span><i class="fa-solid fa-door-open"></i> Balcony</span>
              <?php else: ?>
                <span><i class="fa-solid fa-xmark"></i> No balcony</span>
              <?php endif; ?>
            </div>
            <div class="room-footer">
              <div class="room-price">
                $<?= htmlspecialchars($room['pricePerNight']) ?>
                <small>/ night</small>
              </div>
              <a href="index.php?action=book&room=<?= urlencode($room['id']) ?>"
                 class="booking-confirm-btn" style="width:auto; padding:8px 18px;">
                View
              </a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</main>

<footer class="footer">
  <div class="footer-logo">
    <a href="index.php">Book<span>ify</span></a>
  </div>
  <p class="footer-copy">© 2026 Bookify. All rights reserved.</p>
  <nav class="footer-links">
    <a href="index.php?action=privacy">Privacy Policy</a>
    <a href="index.php?action=terms">Terms of Use</a>
    <a href="index.php?action=about">About us</a>
  </nav>
</footer>

</body>
</html>