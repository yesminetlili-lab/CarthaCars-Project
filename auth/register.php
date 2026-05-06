<?php
require_once '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // On crypte le mot de passe !

    try {
        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, 'client')");
        $stmt->execute([$name, $email, $password]);
        header('Location: login.php'); // Inscription réussie -> Go connexion
    } catch (PDOException $e) {
        $error = "Erreur : L'email est peut-être déjà utilisé.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription - Luxury Cars</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
    <div class="auth-container">
        <h2>Créer un compte</h2>
        <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
        <form method="POST">
            <input type="text" name="name" placeholder="Nom complet" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Mot de passe" required><br>
            <button type="submit">S'inscrire</button>
        </form>
        <p>Déjà un compte ? <a href="login.php">Connectez-vous</a></p>
    </div>
</body>
</html>