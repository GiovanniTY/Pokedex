<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokédex</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <nav>
        <a href="./login-register/login.php">Login</a>
        <a href="./login-register/logout.php">Logout</a>
        <a href="./login-register/register.php">Register</a>
    </nav>
    <main>
        <img id="logo" src="assets/img/logo.png" alt="">
        <button id="dark-mode-toggle">Toggle Dark Mode</button>
        <div class="pokedex-container">
            <?php
            include('function.php'); 

            foreach ($pokemonList as $pokemon): ?>
                <div class="pokemon-card">
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
    <script src="assets/js/script.js"></script>
</body>
</html>
