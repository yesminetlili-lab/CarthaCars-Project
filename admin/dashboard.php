<?php
require_once '../includes/auth.php';
require_once '../config/database.php';
requireAdmin(); // Sécurité : seul l'admin passe

// Statistiques
$nbCars = $pdo->query("SELECT COUNT(*) FROM cars")->fetchColumn();
$nbResa = $pdo->query("SELECT COUNT(*) FROM reservations")->fetchColumn();

// Récupérer les 5 dernières réservations
$lastResas = $pdo->query("SELECT r.*, u.name, c.brand, c.model 
                          FROM reservations r 
                          JOIN users u ON r.user_id = u.id 
                          JOIN cars c ON r.car_id = c.id 
                          ORDER BY r.reservation_date DESC LIMIT 5")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <h1>Tableau de bord Admin</h1>
    <nav>
        <a href="cars.php">Gérer les voitures</a> | 
        <a href="../index.php">Retour au site</a>
    </nav>

    <div class="stats">
        <p>Voitures en stock : <strong><?= $nbCars ?></strong></p>
        <p>Réservations totales : <strong><?= $nbResa ?></strong></p>
    </div>

    <h3>Dernières réservations :</h3>
    <table border="1">
        <tr>
            <th>Client</th>
            <th>Voiture</th>
            <th>Date</th>
        </tr>
        <?php foreach($lastResas as $r): ?>
        <tr>
            <td><?= htmlspecialchars($r['name']) ?></td>
            <td><?= htmlspecialchars($r['brand'] . " " . $r['model']) ?></td>
            <td><?= $r['reservation_date'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>