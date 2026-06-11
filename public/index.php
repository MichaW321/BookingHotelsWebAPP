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

<?php
require_once '../config/connection.php';
$db = Connection::connect();
?>

    <header class="header-container">
        <div class="navbar-top">
            <div class="logo">
                <a href="#">Book<span>ify</span></a>
            </div>
            <nav class="navbar-inline">
            <a href="#" class="nav-item active"><i class="fa-solid fa-hotel"></i> All Hotels</a>
            <a href="#" class="nav-item"><i class="fa-solid fa-building"></i> Apartments</a>
            <a href="#" class="nav-item"><i class="fa-solid fa-umbrella-beach"></i> Resorts</a>
            <a href="#" class="nav-item"><i class="fa-solid fa-house-chimney-window"></i> Villas & Cabins</a>
        </nav>
            <div class="auth-buttons">
                <a href="#" class="btn-auth btn-login">Register</a>
                .<a href="#" class="btn-auth btn-register">Sign In</a
            </div>
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
        </main>

</body>
</html>