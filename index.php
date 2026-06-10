<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookify | Find Your Stay</title>
    <link rel="stylesheet" href="style.css">
    <!-- Icons via FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Navigation Bar -->
    <header class="navbar">
        <div class="logo">
            <a href="#">Book<span>ify</span></a>
        </div>
        <nav class="nav-links">
            <a href="#" class="active">Home</a>
            <a href="#">Hotels</a>
            <a href="#">Deals</a>
            <div class="auth-buttons">
                <a href="#" class="link-login">Sign In</a>
                <a href="#" class="btn-register">Register</a>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <h1>Find the Perfect Stay for Your Next Adventure</h1>
            <p>Exclusive hotels, incredible locations, and prices tailored just for you.</p>
        </div>

        <!-- Search / Booking Form -->
        <div class="search-container">
            <form class="search-form">
                <div class="input-group">
                    <label><i class="fa-solid fa-location-dot"></i> Destination</label>
                    <input type="text" placeholder="Where are you going?" required>
                </div>
                
                <div class="input-group">
                    <label><i class="fa-solid fa-calendar-days"></i> Check-in</label>
                    <input type="date" required>
                </div>

                <div class="input-group">
                    <label><i class="fa-solid fa-calendar-days"></i> Check-out</label>
                    <input type="date" required>
                </div>

                <div class="input-group">
                    <label><i class="fa-solid fa-user"></i> Guests</label>
                    <select>
                        <option>1 Guest</option>
                        <option selected>2 Guests</option>
                        <option>3 Guests</option>
                        <option>4+ Guests</option>
                    </select>
                </div>

                <button type="submit" class="search-btn">
                    <i class="fa-solid fa-magnifying-glass"></i> Search
                </button>
            </form>
        </div>
    </section>

    <!-- Minimalist Footer -->
    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2026 Bookify. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Contact</a>
            </div>
        </div>
    </footer>

</body>
</html>