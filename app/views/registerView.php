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
                <a href="index.php?action=login" class="btn-auth btn-register">Sign In</a>
            </div>
        </div>
    </header>

    <main class="page-content auth-page-wrapper">
        
        <div class="auth-card">
            <div class="auth-card-header">
                <h2>Create an account</h2>
                <p>Join Bookify today and find your next perfect stay.</p>
            </div>

            <?php if (isset($error) && !empty($error)): ?>
                <div class="auth-error-msg">
                    <i class="fa-solid fa-circle-exclamation"></i> <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form action="index.php?action=register" method="POST" class="auth-form">
                
                <div class="input-group auth-input">
                    <label for="username"><i class="fa-solid fa-user"></i></label>
                    <input type="text" id="username" name="username" placeholder="Username" required autocomplete="username">
                </div>

                <div class="input-group auth-input">
                    <label for="email"><i class="fa-solid fa-envelope"></i></label>
                    <input type="email" id="email" name="email" placeholder="Email address" required autocomplete="email">
                </div>

                <div class="input-group auth-input">
                    <label for="password"><i class="fa-solid fa-lock"></i></label>
                    <input type="password" id="password" name="password" placeholder="Password" required autocomplete="new-password">
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

</body>
</html>