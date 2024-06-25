<?php
// try {
//     $bdd = new PDO('mysql:host=localhost;dbname=pokedex;charset=utf8', 'root', 'root');
//     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     echo "Errore di connessione al database: " . $e->getMessage();
//     exit;
// }
include('./login-register/config.php');
<<<<<<< HEAD
=======

>>>>>>> giovanni

if (isset($_GET['search'])) {
    $searchTerm = htmlspecialchars($_GET['search']);
    $stmt = $pdo->prepare('SELECT * FROM Pokemon WHERE name LIKE :name');
    $stmt->execute(['name' => $searchTerm . '%']);
    $pokemonList = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
   
}
?>
