<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookify | Admin Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header-container">
        <div class="navbar-top">
            <div class="logo"><a href="index.php?action=home">Book<span>ify</span> Admin</a></div>
            <div class="auth-buttons">
                <a href="index.php?action=logoutConfirm" class="btn-auth btn-register">Logout</a>
            </div>
        </div>
    </header>

    <main class="page-content" style="padding: 20px;">
        <!-- ZAGLAVLJE SA DUGMADIMA ZA IZVEŠTAJE -->
        <div class="section-header" style="display:flex; justify-section:space-between; align-items:center; margin-bottom:20px;">
            <h2>Admin Control Panel</h2>
            <div>
                <a href="index.php?action=adminExportPdf" class="search-btn" style="text-decoration:none; padding:8px 12px; margin-right:5px; background:#007bff; color:#fff; border-radius:4px;">
                    <i class="fa-solid fa-file-pdf"></i> Izveštaj PDF
                </a>
                <a href="index.php?action=adminExportExcel" class="search-btn" style="text-decoration:none; padding:8px 12px; background:#1D6F42; color:#fff; border-radius:4px;">
                    <i class="fa-solid fa-file-excel"></i> Izveštaj Excel
                </a>
            </div>
        </div>

        <!-- 2. SOBE (ROOM CRUD) -->
        <div class="auth-card" style="max-width: 100%; margin-bottom:30px;">
            <!-- SEKCIJA: Kreiranje novog korisnika -->
<div class="auth-card" style="max-width: 100%; margin-bottom:30px;">
    <h3>Kreiraj Novog Korisnika / Zaposlenog</h3>
    <form action="index.php?action=adminAddUser" method="POST" style="display:flex; flex-wrap:wrap; gap:10px; margin:15px 0;">
        <input type="text" name="username" placeholder="Korisničko ime" required style="padding:8px;" class="auth-input">
        <input type="text" name="first_name" placeholder="Ime" required style="padding:8px;" class="auth-input">
        <input type="text" name="last_name" placeholder="Prezime" required style="padding:8px;" class="auth-input">
        <input type="email" name="email" placeholder="Email adresa" required style="padding:8px;" class="auth-input">
        <input type="password" name="password" placeholder="Lozinka" required style="padding:8px;" class="auth-input">
        
        <select name="role" required style="padding:8px;" class="auth-input">
            <option value="user">User</option>
            <option value="manager">Manager</option>
            <option value="admin">Admin</option>
        </select>

        <button type="submit" class="search-btn" style="width:auto; padding:8px 15px;">Kreiraj Korisnika</button>
    </form>

    <h3 style="margin-top:20px;">Svi Korisnici u Sistemu</h3>
    <table style="width:100%; text-align:left; border-collapse:collapse; margin-top:15px;">
        <thead>
            <tr style="border-bottom:2px solid #ccc;">
                <th style="padding:10px;">ID</th>
                <th>Korisnik</th>
                <th>Ime i Prezime</th>
                <th>Email</th>
                <th>Uloga</th>
                <th>Akcije</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
            <tr style="border-bottom:1px solid #eee;">
                <td style="padding:10px;"><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars(($u['first_name'] ?? '') . ' ' . ($u['last_name'] ?? '')) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td>
                    <form action="index.php?action=adminUpdateRole" method="POST" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                        <select name="role" onchange="this.form.submit()" style="padding:4px;">
                            <option value="user" <?= $u['role'] === 'user' ? 'selected' : '' ?>>User</option>
                            <option value="manager" <?= $u['role'] === 'manager' ? 'selected' : '' ?>>Manager</option>
                            <option value="admin" <?= $u['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </form>
                </td>
                <td>
                    <?php if ($u['id'] !== $_SESSION['id']): ?>
                        <a href="index.php?action=adminDeleteUser&id=<?= $u['id'] ?>" 
                           onclick="return confirm('Da li ste sigurni da želite obrisati korisnika?')"
                           style="color:red; text-decoration:none;">Obriši</a>
                    <?php else: ?>
                        <span style="color:gray;">(Ti)</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

            <h3 style="margin-top:20px;">Postojeće Sobe</h3>
            <table style="width:100%; text-align:left; border-collapse:collapse; margin-top:15px;">
                <thead>
                    <tr style="border-bottom:2px solid #ccc;">
                        <th style="padding:10px;">ID</th>
                        <th>Tip Sobe</th>
                        <th>Cena</th>
                        <th>Kapacitet</th>
                        <th>Akcija</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($rooms)): ?>
                        <?php foreach ($rooms as $room): ?>
                        <tr style="border-bottom:1px solid #eee;">
                            <td style="padding:10px;"><?= $room['id'] ?></td>
                            <td><?= htmlspecialchars($room['type']) ?></td>
                            <td>$<?= htmlspecialchars($room['pricePerNight']) ?></td>
                            <td><?= htmlspecialchars($room['beds'] ?? 'N/A') ?></td>
                            <td>
                                <a href="index.php?action=adminDeleteRoom&id=<?= $room['id'] ?>" 
                                   onclick="return confirm('Da li ste sigurni da želite obrisati ovu sobu?')"
                                   style="color:red; text-decoration:none;">Obriši</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- 3. PREGLED REZERVACIJA -->
        <div class="auth-card" style="max-width: 100%;">
            <h3>Sve Rezervacije u Sistemu</h3>
            <table style="width:100%; text-align:left; border-collapse:collapse; margin-top:15px;">
                <thead>
                    <tr style="border-bottom:2px solid #ccc;">
                        <th style="padding:10px;">ID</th>
                        <th>Korisnik</th>
                        <th>Tip Sobe</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Cena</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservations as $r): ?>
                    <tr style="border-bottom:1px solid #eee;">
                        <td style="padding:10px;"><?= htmlspecialchars($r['id']) ?></td>
                        <td><?= htmlspecialchars($r['username']) ?></td>
                        <td><?= htmlspecialchars($r['room_type']) ?></td>
                        <td><?= htmlspecialchars($r['check_in']) ?></td>
                        <td><?= htmlspecialchars($r['check_out']) ?></td>
                        <td>$<?= htmlspecialchars($r['total_price']) ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>