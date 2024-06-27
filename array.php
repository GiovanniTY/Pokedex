<?php
include('./login-register/config.php');

try {
    // Query pour selectioner les noms des pokemons
    $stmt = $pdo->query('SELECT name FROM Pokemon');
    $pokemonNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
} catch (PDOException $e) {
    echo '<script>alert("Errore: ' . $e->getMessage() . '");</script>';
    exit;
}


header('Content-Type: application/json');
echo json_encode($pokemonNames);
?>
