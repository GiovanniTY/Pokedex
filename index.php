<?php

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
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
    <nav>
        <img id="pokemon" src="assets/img/pokemon.png" alt="pokemon">
        <?php
        if (!isset($_SESSION["user"])) {
        ?>

            <a href="./login-register/login.php">Login</a>
        <?php
        }
        if (isset($_SESSION["user"])) {
        ?>
            <a href="./login-register/logout.php">Logout</a>
        <?php   }
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
                <input type="text" name="search" id="search-bar" 
                placeholder="Rechercher des Pokémon par leur nom...">
                <button id="search"  type="submit">
                    <img id="pikachu"src="assets/img/pikachu.png"alt="pikachu">
                </button>
            </form>
        </div>
        
        <div class="pokedex-container">
            <?php
            include('function.php');
            include('search.php');

            foreach ($pokemonList as $pokemon) : ?>
                <div class="pokemon-card">
                    <span class="material-symbols-outlined">favorite</span>
                    <img src="<?php echo $pokemon['image']; ?>" alt="<?php echo $pokemon['name']; ?>">
                    <p class="pokedex-id"><?php if ($pokemon['pokedexId'] < 10) {
                        echo '#000' . $pokemon['pokedexId'];
                    } else if ($pokemon['pokedexId'] < 100) {
                        echo '#00' . $pokemon['pokedexId'];
                    } else if($pokemon['pokedexId']<200){
                        echo '#0'. $pokemon['pokedexId'];
                    }?></p>
                    <h2><?php echo $pokemon['name']; ?></h2>
                    <div class="type">
                        <span class="<?php echo strtolower($pokemon['type1']); ?>"><?php echo $pokemon['type1']; ?></span>
                        <?php if (!empty($pokemon['type2'])) : ?>
                        <span class="<?php echo strtolower($pokemon['type2']); ?>"><?php echo $pokemon['type2']; ?></span>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <script type="module"src="assets/js/script.js"></script>
</body>

</html>