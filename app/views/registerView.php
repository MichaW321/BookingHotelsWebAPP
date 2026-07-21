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
                <a href="index.php?action=home" class="nav-item active"><i class="fa-solid fa-hotel"></i> Home</a>
            <a href="index.php?action=about" class="nav-item"><i class="fa-solid fa-building"></i> About us</a>
            <a href="index.php?action=terms" class="nav-item"><i class="fa-solid fa-umbrella-beach"></i> Terms of use</a>
            <a href="index.php?action=privacy" class="nav-item"><i class="fa-solid fa-house-chimney-window"></i>Privacy policy</a>
            </nav>
            <div class="auth-buttons">
                <a href="index.php?action=login" class="btn-auth btn-register">Login</a>
            </div>
        </div>
    </header>

    <main class="page-content auth-page-wrapper">
        
        <div class="auth-card">
            <div class="auth-card-header">
                <h2>Create an account</h2>
                <p>Join Bookify today and find your next perfect stay.</p>
            </div>
            <form action="index.php?action=register" method="POST" class="auth-form">
                <span class="registerError">
                <?php if (!empty($error)): ?>
                        <span class="registerError"><?php echo htmlspecialchars($error); ?></span>
                <?php endif; ?>
                </span>
                <div class="input-group auth-input">
                    <label for="username"><i class="fa-solid fa-user"></i></label>
                    <input type="text" id="username" name="username" placeholder="Username" required autocomplete="username">
                </div>

                <div class="input-group auth-input">
                    <label for="first-name"><i class="fa-solid fa-user"></i></label>
                    <input type="text" id="first-name" name="first-name" placeholder="First name" required autocomplete="fist-name">
                </div>

                <div class="input-group auth-input">
                    <label for="last-name"><i class="fa-solid fa-user"></i></label>
                    <input type="text" id="last-name" name="last-name" placeholder="Last name" required autocomplete="last-name">
                </div>

                <div class="input-group auth-input">
                    <label for="email"><i class="fa-solid fa-envelope"></i></label>
                    <input type="email" id="email" name="email" placeholder="Email address" required autocomplete="email">
                </div>

                <div class="input-group auth-input">
                    <label for="password"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" id="password" name="password" placeholder="Password" required autocomplete="new-password">
                </div>

                <div class="input-group auth-input">
                    <label for="confirm-password"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" id="confirm-password" name="confirm-password" placeholder="Confirm password" required autocomplete="confirm-password">
                </div>

                <button type="submit" name="submit_register" class="search-btn auth-btn">
                    Register
                </button>
            </form>

            <div class="auth-card-footer">
                <p>Already have an account? <a href="index.php?action=login">Sign In</a></p>
            </div>
        </div>

    </main>
<footer class="footer">
  <div class="footer-logo">
    <a href="index.php">Book<span>ify</span></a>
  </div>
  <p class="footer-copy">© 2024 Bookify. All rights reserved.</p>
  <nav class="footer-links">
    <a href="index.php?action=privacy">Privacy Policy</a>
    <a href="index.php?action=terms">Terms of Use</a>
    <a href="index.php?action=about">About us</a>
  </nav>
</footer>
</body>
</html>