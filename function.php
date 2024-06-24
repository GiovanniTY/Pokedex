<?php
include('engine.php'); // Include il file di connessione al database

try {
    // Query per selezionare i dati dei Pokémon
    $stmt = $bdd->prepare('SELECT * FROM Pokemon');
    $stmt->execute();
    $pokemonList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<script>alert("Errore: ' . $e->getMessage() . '");</script>';
    exit;
}
?>
