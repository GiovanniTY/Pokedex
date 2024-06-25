<?php
include('./login-register/config.php'); 

// Number of results per page
$per_page = 20; 
// Current page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
$offset = ($page - 1) * $per_page; 

try {
    // Query to count the total number of results (without LIMIT and OFFSET)
    $countStmt = $pdo->prepare('SELECT COUNT(*) FROM Pokemon');
    $countStmt->execute();
    $total_count = $countStmt->fetchColumn();
    
   // Query to select Pokémon with pagination
    $stmt = $pdo->prepare('SELECT * FROM Pokemon LIMIT :per_page OFFSET :offset');
    $stmt->bindValue(':per_page', $per_page, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $pokemonList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<script>alert("Errore: ' . $e->getMessage() . '");</script>';
    exit;
}

// Calculating the total number of pages
$total_pages = ceil($total_count / $per_page);
?>