<?php
require_once '../includes/auth.php';
require_once '../config/database.php';
requireAdmin();

$cars = $pdo->query("SELECT * FROM cars")->fetchAll();
?>
<!DOCTYPE html>
<html>
<body>
    <h1>Gestion du garage</h1>
    <a href="add_car.php"> + Ajouter une voiture</a>
    <table border="1">
        <tr>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
        <?php foreach($cars as $car): ?>
        <tr>
            <td><?= $car['brand'] ?></td>
            <td><?= $car['model'] ?></td>
            <td><?= $car['price'] ?> €</td>
            <td>
                <a href="edit_car.php?id=<?= $car['id'] ?>">Modifier</a> | 
                <a href="delete_car.php?id=<?= $car['id'] ?>" onclick="return confirm('Supprimer ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>