<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <link rel="stylesheet" href="assets/css/style.css" type="text/css">
</head>
<body>
<nav>
        <a href="./login-register/login.php">Login</a>
        <a href="./login-register/logout.php">Logout</a>
        <a href="./login-register/register.php">Register</a>
</nav>
    <main>
    <img id="logo"src="assets/img/logo.png" alt="">
    <button id="dark-mode-toggle">Toggle Dark Mode</button>

    <?php
    // Include the file with the function to get Pokémon data
    include('function.php');

    // Pagination configuration
    $limit = 10; 
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Calculate total number of Pokémon (there are 898 known Pokémon)
    $totalPokemon = 898;
    $totalPages = ceil($totalPokemon / $limit);

    echo '<div class="pokemon-list">';

    for ($i = $offset + 1; $i <= $offset + $limit && $i <= $totalPokemon; $i++) {
        $pokemon = getPokemonDataById($i);

        if ($pokemon) {
            echo '<div class="pokemon-item">';
            echo '<a href="details.php?id=' . htmlspecialchars($pokemon['id']) . '">';
            echo '<img src="' . htmlspecialchars($pokemon['sprites']['front_default']) . '" alt="' . htmlspecialchars($pokemon['name']) . '">';
            echo '<p>' . htmlspecialchars(ucfirst($pokemon['name'])) . '</p>';
            echo '</a>';
            echo '</div>';
        }
    }

    echo '</div>';
    ?>
     </main>
<footer>
    <div class="pagination">
        <?php if ($page > 1): ?>
            <a href="index.php?page=<?php echo $page - 1; ?>">&laquo; Previous</a>
        <?php endif; ?>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
        <?php if ($page < $totalPages): ?>
            <a href="index.php?page=<?php echo $page + 1; ?>">Next &raquo;</a>
        <?php endif; ?>
    </div>
   
    </footer>
    <script src="assets/js/script.js" type="text/javascript"></script>
</body>
</html>
