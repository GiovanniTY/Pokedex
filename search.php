<?php
include('./login-register/config.php');

if (isset($_GET['search'])) {
    $searchTerm = htmlspecialchars($_GET['search']);
    $stmt = $bdd->prepare('SELECT * FROM Pokemon WHERE name LIKE :name');
    $stmt->execute(['name' => $searchTerm . '%']);
    $pokemonList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
   
}
?>
