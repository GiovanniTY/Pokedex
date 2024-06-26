<?php
include('./login-register/config.php'); 

try {
    // Query per selezionare i dati dei Pokémon
    $stmt = $pdo->prepare('SELECT * FROM Pokemon');
    $stmt->execute();
    $pokemonList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<script>alert("Errore: ' . $e->getMessage() . '");</script>';
    exit;
}
?>