<?php
require_once '../includes/auth.php';
require_once '../config/database.php';
requireAdmin();

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM cars WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}
header('Location: cars.php');
exit;