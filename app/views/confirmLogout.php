<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookify | Register New Account</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <header class="header-container">
        <div class="navbar-top">
            <div class="logo">
                <a href="index.php">Book<span>ify</span></a>
            </div>
            <nav class="navbar-inline">
                <a href="#" class="nav-item"><i class="fa-solid fa-hotel"></i> All Hotels</a>
                <a href="#" class="nav-item"><i class="fa-solid fa-building"></i> Apartments</a>
                <a href="#" class="nav-item"><i class="fa-solid fa-umbrella-beach"></i> Resorts</a>
                <a href="#" class="nav-item"><i class="fa-solid fa-house-chimney-window"></i> Villas & Cabins</a>
            </nav>
            <div class="auth-buttons">
                <a href="index.php?action=home" class="btn-auth btn-register">Home</a>
            </div>
        </div>
</header>
<main class="logout-page-container">
    <div class="logout-card">
        <div class="logout-icon-box">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
        </div>
        <h2>Are u sure u want to log out?</h2>        
        <div class="logout-buttons-group">
            <a href="index.php?action=logout" class="btn-logout btn-confirm-yes">
                <i class="fa-solid fa-check"></i> Logout
            </a>
            <a href="index.php?action=home" class="btn-logout btn-confirm-no">
                No
            </a>
        </div>
    </div>
</main>
<footer class="footer">
  <div class="footer-logo">
    <a href="index.php">Book<span>ify</span></a>
  </div>
  <p class="footer-copy">© 2024 Bookify. All rights reserved.</p>
  <nav class="footer-links">
    <a href="#">Privacy Policy</a>
    <a href="#">Terms of Use</a>
    <a href="#">Support</a>
  </nav>
</footer>
</body>
</html>