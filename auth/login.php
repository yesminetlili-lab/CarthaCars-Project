<?php
require_once '../includes/auth.php'; // Pour session_start()
require_once '../config/database.php';

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // On vérifie si l'utilisateur existe ET si le mot de passe est correct
    if ($user && password_verify($password, $user['password'])) {
        // On enregistre les infos de l'utilisateur dans la SESSION
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'role' => $user['role']
        ];
        
        header('Location: ../index.php'); // Redirection vers l'accueil
        exit;
    } else {
        $error = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Luxury Cars</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div style="max-width: 400px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px;">
        <h2>Connexion</h2>
        
        <?php if($error): ?>
            <p style="color:red"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
            <div style="margin-bottom: 10px;">
                <label>Email</label><br>
                <input type="email" name="email" required style="width: 100%;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>Mot de passe</label><br>
                <input type="password" name="password" required style="width: 100%;">
            </div>
            <button type="submit" style="width: 100%; padding: 10px; background: #007bff; color: white; border: none; cursor: pointer;">
                Se connecter
            </button>
        </form>
        <p style="margin-top: 15px;">Pas encore de compte ? <a href="register.php">S'inscrire</a></p>
    </div>
</body>
</html>