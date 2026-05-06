<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contact - Luxury Cars</title>
    <link rel="stylesheet" href="../style.css"> 
</head>
<body>

    <header>
        <nav>
            <a href="../index.php">Accueil</a>
            <a href="luxury.php">Luxury Cars</a>
            <a href="contact.php" class="active">Contact</a>
        </nav>
    </header>

    <section class="contact-section">
        <h1>Contactez-nous</h1>
        <p>Une question ? Une réservation ? Notre équipe est à votre écoute.</p>

        <form action="contact_process.php" method="POST" class="contact-form">
            <div class="form-group">
                <label>Nom Complet</label>
                <input type="text" name="nom" required placeholder="Votre nom...">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required placeholder="votre@email.com">
            </div>
            <div class="form-group">
                <label>Message</label>
                <textarea name="message" rows="5" required placeholder="Comment pouvons-nous vous aider ?"></textarea>
            </div>
            <button type="submit" class="btn-submit">Envoyer le message</button>
        </form>
    </section>

    <script src="../script.js"></script>
</body>
</html>