<?php

require_once '../config/database.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Methode non autorisee.']);
    exit;
}

$orderType = trim($_POST['order_type'] ?? 'purchase');
$source = trim($_POST['source'] ?? '');
$carName = trim($_POST['car_name'] ?? '');
$basePrice = (float) ($_POST['base_price'] ?? 0);
$totalPrice = (float) ($_POST['total_price'] ?? 0);
$color = trim($_POST['color'] ?? '');
$interior = trim($_POST['interior'] ?? '');
$wheels = trim($_POST['wheels'] ?? '');
$audio = trim($_POST['audio'] ?? '');
$options = trim($_POST['options'] ?? '');
$nom = trim($_POST['nom'] ?? '');
$prenom = trim($_POST['prenom'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$email = trim($_POST['email'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!in_array($orderType, ['quote', 'purchase'], true)) {
    $orderType = 'purchase';
}

if ($carName === '' || $nom === '' || $prenom === '' || $telephone === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(422);
    echo json_encode(['success' => false, 'message' => 'Veuillez remplir nom, prenom, telephone et email.']);
    exit;
}

try {
    $stmt = $pdo->prepare("
        INSERT INTO orders
            (order_type, source, car_name, base_price, total_price, color, interior, wheels, audio, options, nom, prenom, telephone, email, message)
        VALUES
            (:order_type, :source, :car_name, :base_price, :total_price, :color, :interior, :wheels, :audio, :options, :nom, :prenom, :telephone, :email, :message)
    ");

    $stmt->execute([
        'order_type' => $orderType,
        'source' => $source,
        'car_name' => $carName,
        'base_price' => $basePrice,
        'total_price' => $totalPrice,
        'color' => $color,
        'interior' => $interior,
        'wheels' => $wheels,
        'audio' => $audio,
        'options' => $options,
        'nom' => $nom,
        'prenom' => $prenom,
        'telephone' => $telephone,
        'email' => $email,
        'message' => $message !== '' ? $message : null,
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Commande enregistree.',
        'order_id' => $pdo->lastInsertId(),
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Erreur lors de l enregistrement de la commande.']);
}
