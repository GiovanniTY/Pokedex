<?php
include('./login-register/config.php'); 

$per_page = 20; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1; 
$offset = ($page - 1) * $per_page; 

// Check if a search term exists
$searchTerm = isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '';

try {
   // Query to count the total number of results (without LIMIT and OFFSET)
    $countStmt = $pdo->prepare('SELECT COUNT(*) FROM Pokemon WHERE name LIKE :name');
    $countStmt->bindValue(':name', $searchTerm . '%', PDO::PARAM_STR);
    $countStmt->execute();
    $total_count = $countStmt->fetchColumn();
    
    // Query to select Pokémon with pagination
    $stmt = $pdo->prepare('SELECT * FROM Pokemon WHERE name LIKE :name LIMIT :per_page OFFSET :offset');
    $stmt->bindValue(':name', $searchTerm . '%', PDO::PARAM_STR);
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