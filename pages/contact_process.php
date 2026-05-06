<?php

require_once '../config/database.php';

header('Content-Type: application/json; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Methode non autorisee.',
    ]);
    exit;
}

$nom = trim($_POST['nom'] ?? '');
$prenom = trim($_POST['prenom'] ?? '');
$email = trim($_POST['email'] ?? '');
$telephone = trim($_POST['telephone'] ?? '');
$voiture = trim($_POST['voiture'] ?? '');
$message = trim($_POST['message'] ?? '');

if (strlen($nom) < 2 || !filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($message) < 10) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Veuillez verifier les champs du formulaire.',
    ]);
    exit;
}

try {
    $nomComplet = trim($nom . ' ' . $prenom);
    $messageComplet = $message;

    if ($voiture !== '') {
        $messageComplet = "Voiture souhaitee : " . $voiture . "\n\n" . $messageComplet;
    }

    $stmt = $pdo->prepare("
        INSERT INTO messages (nom, email, telephone, message)
        VALUES (:nom, :email, :telephone, :message)
    ");

    $stmt->execute([
        'nom' => $nomComplet,
        'email' => $email,
        'telephone' => $telephone !== '' ? $telephone : null,
        'message' => $messageComplet,
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Message envoye avec succes.',
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Erreur lors de l enregistrement du message.',
    ]);
}
