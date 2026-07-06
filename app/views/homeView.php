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
            <nav class="navbar-inline">
            <a href="#" class="nav-item active"><i class="fa-solid fa-hotel"></i> All Hotels</a>
            <a href="#" class="nav-item"><i class="fa-solid fa-building"></i> Apartments</a>
            <a href="#" class="nav-item"><i class="fa-solid fa-umbrella-beach"></i> Resorts</a>
            <a href="#" class="nav-item"><i class="fa-solid fa-house-chimney-window"></i> Villas & Cabins</a>
        </nav>
        <?php if(isset($_SESSION['id'])): ?>
            <div class="auth-buttons">
                <a href="index.php?action=logoutConfirm" class="btn-auth btn-register">Logout</a
            </div>
        <?php else: ?>
            <div class="auth-buttons">
                <a href="index.php?action=register" class="btn-auth btn-login">Register</a>
                <a href="index.php?action=login" class="btn-auth btn-register">Sign In</a
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
                <form class="search-form" action="" method="GET">
                    <div class="input-group">
                        <label><i class="fa-solid fa-bed"></i></label>
                        <input type="text" name="destination" placeholder="Where are you going?" required>
                    </div>
                    
                    <div class="input-group">
                        <label><i class="fa-solid fa-calendar-days"></i></label>
                        <input type="text" name="check_in" placeholder="Check-in Date" onfocus="(this.type='date')" required>
                    </div>
                    <div class="input-group">
                        <label><i class="fa-solid fa-calendar-days"></i></label>
                        <input id= type="text" name="check_in" placeholder="Check-out Date" onfocus="(this.type='date')" required>

                    </div>
                    <div class="input-group">
                        <label><i class="fa-solid fa-user"></i></label>
                        <select name="guests">
                            <option value="1">1 guest</option>
                            <option value="2" selected>2 guests</option>
                            <option value="3">3 guests</option>
                            <option value="4">4+ guests</option>
                        </select>
                    </div>

                    <button type="submit" name="submit_search" class="search-btn">
                        Search
                    </button>
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
            <img src="<?=$room['room_path']?>" alt="<?=$room['room_image']?>">
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
              <a href="index.php?action=book&room=<?= $room['id'] ?>&room_price=<?= $room['pricePerNight'] ?>" class="search-btn" style="padding: 8px 16px; font-size: 13px; border-radius: 6px; text-decoration: none;">
                Book now
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
    <a href="#">Privacy Policy</a>
    <a href="#">Terms of Use</a>
    <a href="#">Support</a>
  </nav>
</footer>

</body>
</html>