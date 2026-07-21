<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bookify | Manager Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header class="header-container">
        <div class="navbar-top">
            <div class="logo"><a href="index.php?action=home">Book<span>ify</span> Manager</a></div>
            <div class="auth-buttons">
                <a href="index.php?action=logoutConfirm" class="btn-auth btn-register">Logout</a>
            </div>
        </div>
    </header>

    <main class="page-content" style="padding: 20px;">
        <div class="section-header" style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h2>Manager Panel - Upravljanje Rezervacijama</h2>
        </div>

        <div class="auth-card" style="max-width: 100%;">
            <!-- Forma za Pretragu -->
            <form action="index.php" method="GET" style="display:flex; gap:10px; margin-bottom:20px;">
                <input type="hidden" name="action" value="manager">
                <input type="text" name="search" value="<?= htmlspecialchars($search) ?>" placeholder="Pretraži po korisniku ili tipu sobe..." style="padding:8px; width:300px;" class="auth-input">
                <button type="submit" class="search-btn" style="width:auto; padding:8px 15px;">Pretraži</button>
                <?php if (!empty($search)): ?>
                    <a href="index.php?action=manager" class="btn-auth" style="padding:8px 12px; text-decoration:none;">Očisti</a>
                <?php endif; ?>
            </form>

            <!-- Tabela Rezervacija -->
            <table style="width:100%; text-align:left; border-collapse:collapse;">
                <thead>
                    <tr style="border-bottom:2px solid #ccc;">
                        <th style="padding:10px;">ID</th>
                        <th>Korisnik</th>
                        <th>Email</th>
                        <th>Tip Sobe</th>
                        <th>Check In</th>
                        <th>Check Out</th>
                        <th>Ukupna Cena</th>
                        <th>Akcija</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($reservations)): ?>
                        <?php foreach ($reservations as $r): ?>
                        <tr style="border-bottom:1px solid #eee;">
                            <td style="padding:10px;"><?= htmlspecialchars($r['id']) ?></td>
                            <td><?= htmlspecialchars($r['username']) ?></td>
                            <td><?= htmlspecialchars($r['email'] ?? 'N/A') ?></td>
                            <td><?= htmlspecialchars($r['room_type']) ?></td>
                            <td><?= htmlspecialchars($r['check_in']) ?></td>
                            <td><?= htmlspecialchars($r['check_out']) ?></td>
                            <td>$<?= htmlspecialchars($r['total_price']) ?></td>
                            <td>
                                <a href="index.php?action=managerDeleteReservation&id=<?= $r['id'] ?>" 
                                   onclick="return confirm('Da li ste sigurni da želite da otkažete/obrišete ovu rezervaciju?')" 
                                   style="color:red; text-decoration:none;">
                                   <i class="fa-solid fa-trash"></i> Otkaži
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" style="padding:15px; text-align:center; color:gray;">Nema pronađenih rezervacija.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>

            <!-- Paginacija -->
            <?php if ($totalPages > 1): ?>
            <div style="margin-top:20px; display:flex; gap:5px; justify-content:center;">
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="index.php?action=manager&page=<?= $i ?>&search=<?= urlencode($search) ?>" 
                       style="padding:6px 12px; border:1px solid #ccc; text-decoration:none; border-radius:4px; <?= $i === $page ? 'background:#007bff; color:#fff;' : 'background:#f8f9fa; color:#333;' ?>">
                       <?= $i ?>
                    </a>
                <?php endfor; ?>
            </div>
            <?php endif; ?>
        </div>
    </main>
</body>
</html>