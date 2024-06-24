<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: ./login-register/login.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <nav>
        <a href="../login-register/login.php">Login</a>
        <a href="../login-register/logout.php">Logout</a>
        <a href="../login-register/register.php">Register</a>
    </nav>
    <main>
        <img id="logo" src="assets/img/logo.png" alt="">
        <button id="dark-mode-toggle">Toggle Dark Mode</button>
        <div class="pokedex-container">
            <?php
            include('function.php');

            foreach ($pokemonList as $pokemon) : ?>
                <div class="pokemon-card">
                    <img src="<?php echo $pokemon['image']; ?>" alt="<?php echo $pokemon['name']; ?>">
                    <h2><?php echo $pokemon['name']; ?></h2>
                    <p>ID: <?php echo $pokemon['pokedexId']; ?></p>
                    <p>Type: <?php echo $pokemon['type1']; ?><?php if (!empty($pokemon['type2'])) echo ', ' . $pokemon['type2']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <script src="assets/js/script.js"></script>
</body>

</html>