<?php
try {
    // Connexion database
    $bdd = new PDO('mysql:host=localhost;dbname=pokedex;charset=utf8', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données: " . $e->getMessage();
    exit;
}
