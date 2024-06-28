<div?php

session_start();
// if (!isset($_SESSION['user'])) {
//     header("Location: ./login-register/login.php");
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <nav>
        <a href="index.php">Home</a>
        <a href="compare.php">Comparateur</a>
        <?php
        if (!isset($_SESSION["user"])) {
        ?>

            <a href="./login-register/login.php">Login</a>
        <?php
        }
        if (isset($_SESSION["user"])) {
        ?>
            <a href="./login-register/logout.php">Logout</a>
            <?php
            if ($_SESSION['user']['role'] === 'admin') {
            ?>
                <a href="dashboard.php">Dashboard</a>
            <?php   } ?>
            <a href="./login-register/profile.php"><img class="avatar-img" src="<?php echo $_SESSION['user']['avatar'] ?>" alt="avatar"></a>
        <?php
        }
        if (!isset($_SESSION["user"])) {

        ?>
            <a href="./login-register/register.php">Register</a>
        <?php } ?>

    </nav>
    <main>
        <img id="logo" src="assets/img/logo.png" alt="logo">
        <button id="dark-mode-toggle">
            <img id="pokeball" src="assets/img/pokeball2.png" alt="pokeball">
        </button>
        <div class="search-container">
            <form method="GET" action="">
                <input type="text" name="search" id="search-bar" placeholder="Rechercher des Pokémon par leur nom..." autocomplete="off">
                <div id="suggestions" size="5" style="display: none;"></div>
                
                <button id="search" type="submit">
                    <img id="pikachu" src="assets/img/pikachu.png" alt="pikachu">
                </button>
                
            </form>
            <select name="tri" id="tri">
                <option value="default">Tout afficher</option>
                <option value="favoris">Favoris</option>
                <option value="numero">Numéro</option>
                <option value="nom">Nom</option>
                <option value="type">Type</option>
            </select>
        </div>
        <div id="card-container" class="pokedex-container">
            <?php
            include('function.php');
            include('search.php');

            foreach ($pokemonList as $pokemon) : ?>
                <a href="details.php?id=<?php echo $pokemon['id']; ?>">
                    <div class="pokemon-card">
                        <span class="material-symbols-outlined favoriteSpan">favorite</span>
                        <img src="<?php echo $pokemon['image']; ?>" alt="<?php echo $pokemon['name']; ?>">
                        <p class="pokedex-id"><?php if ($pokemon['pokedexId'] < 10) {
                                                    echo '#000' . $pokemon['pokedexId'];
                                                } else if ($pokemon['pokedexId'] < 100) {
                                                    echo '#00' . $pokemon['pokedexId'];
                                                } else if ($pokemon['pokedexId'] < 1000) {
                                                    echo '#0' . $pokemon['pokedexId'];
                                                } ?></p>
                        <h2><?php echo $pokemon['name']; ?></h2>
                        <div class="type">
                            <span class="<?php echo strtolower($pokemon['type1']); ?>"><?php echo $pokemon['type1']; ?></span>
                            <?php if (!empty($pokemon['type2'])) : ?>
                                <span class="<?php echo strtolower($pokemon['type2']); ?>"><?php echo $pokemon['type2']; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </main>
    <footer>
        <div class="pagination">
    <?php if ($page > 1): ?>
        <a href="?page=<?php echo ($page - 1); ?>">&laquo; Précédent</a> <!-- Lien vers la page précédente -->
    <?php endif; ?>
    
    <?php
    // Nombre maximum de pages visibles simultanément
    $maxVisiblePages = 20;
    
    // Calcul de la plage de pages à afficher
    $start = max(1, $page - floor($maxVisiblePages / 2));
    $end = min($total_pages, $start + $maxVisiblePages - 1);
    
    for ($i = $start; $i <= $end; $i++):
    ?>
        <a href="?page=<?php echo $i; ?>" <?php if ($i == $page) echo 'class="active"'; ?>>
            <?php echo $i; ?>
        </a>
    <?php endfor; ?>
    
    <?php if ($page < $total_pages): ?>
        <a href="?page=<?php echo ($page + 1); ?>">Suivant &raquo;</a> <!-- Lien vers la page suivante -->
    <?php endif; ?>
</div>

    </footer>
    <script type="module" src="./assets/js/script.js"></script>
</body>

</html>