<?php
session_start();
session_destroy(); // On détruit toutes les données de session
header('Location: ../index.php'); // Retour à l'accueil
exit;