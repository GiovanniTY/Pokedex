<?php
include('./login-register/config.php'); // Include il file di connessione al database

$per_page = 20; // Numero di risultati per pagina
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Pagina corrente
$offset = ($page - 1) * $per_page; // Calcolo dell'offset per la query

try {
    // Query per contare il numero totale di risultati (senza LIMIT e OFFSET)
    $countStmt = $pdo->prepare('SELECT COUNT(*) FROM Pokemon');
    $countStmt->execute();
    $total_count = $countStmt->fetchColumn();
    
    // Query per selezionare i Pokémon con paginazione
    $stmt = $pdo->prepare('SELECT * FROM Pokemon LIMIT :per_page OFFSET :offset');
    $stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $pokemonList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<script>alert("Errore: ' . $e->getMessage() . '");</script>';
    exit;
}

// Calcolo del numero totale di pagine
$total_pages = ceil($total_count / $per_page);
?>