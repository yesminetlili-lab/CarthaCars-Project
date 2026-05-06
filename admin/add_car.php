<?php
require_once '../includes/auth.php';
require_once '../config/database.php';
requireAdmin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO cars (brand, model, price, image, description, category) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['brand'],
        $_POST['model'],
        $_POST['price'],
        $_POST['image'], // Ici on mettra le chemin ex: assets/images/porsche.jpg
        $_POST['description'],
        $_POST['category']
    ]);
    header('Location: cars.php');
}
?>
<form method="POST">
    <input type="text" name="brand" placeholder="Marque" required>
    <input type="text" name="model" placeholder="Modèle" required>
    <input type="number" name="price" placeholder="Prix" required>
    <input type="text" name="image" placeholder="Chemin image (assets/images/...)">
    <textarea name="description" placeholder="Description"></textarea>
    <select name="category">
        <option value="luxury">Luxury</option>
        <option value="standard">Standard</option>
    </select>
    <button type="submit">Ajouter</button>
</form>