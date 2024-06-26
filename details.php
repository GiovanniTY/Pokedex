<?php
include('./login-register/config.php'); 

// Vérifier si l'ID est passé dans l'URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $pokemonId = $_GET['id'];

    try {

        $stmt = $pdo->prepare('SELECT * FROM Pokemon WHERE id = :id');
        $stmt->bindParam(':id', $pokemonId, PDO::PARAM_INT);
        $stmt->execute();
        $pokemon = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($pokemon) {

            ?>
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <title>Détails de <?php echo htmlspecialchars($pokemon['name']); ?></title>
                <link rel="stylesheet" href="./assets/css/style.css">
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
                <section>
                <div class="details-container">
                <div class="pokemon-card">
                <h1><?php echo htmlspecialchars($pokemon['name']); ?></h1>
                <div class="type">
                <span class="<?php echo strtolower($pokemon['type1']); ?>">
              <img src="<?php echo $pokemon['type1_image']; ?>" alt="<?php echo $pokemon['name']; ?>">
              <?php echo $pokemon['type1']; ?>
              </span>

            <?php if (!empty($pokemon['type2'])) : ?>
             <span class="<?php echo strtolower($pokemon['type2']); ?>">
              <img src="<?php echo $pokemon['type2_image']; ?>" alt="<?php echo $pokemon['name']; ?>">
              <?php echo $pokemon['type2']; ?>
              </span>
                        <?php endif; ?>
                    </div>

                    <p>HP</p>
                    <div class="stat-bar-container">
                        <div class="stat-bar hp" style="width: <?php echo htmlspecialchars($pokemon['hp']); ?>%;">
                        </div>
                    </div>



                    <p>Attaque</p>
                    <div class="stat-bar-container">
                        <div class="stat-bar attack" style="width: <?php echo htmlspecialchars($pokemon['attack']); ?>%;">
                        </div>
                    </div>


                    <p>Défense</p>
                    <div class="stat-bar-container">
                        <div class="stat-bar defense" style="width: <?php echo htmlspecialchars($pokemon['defense']); ?>%;">
                        </div>
                    </div>


                    <p>Special Attaque</p>
                    <div class="stat-bar-container">
                        <div class="stat-bar special-attack" style="width: <?php echo htmlspecialchars($pokemon['special_attack']); ?>%;">
                        </div>
                    </div>

                    <p>Special Defense</p>
                    <div class="stat-bar-container">
                        <div class="stat-bar special-defense" style="width: <?php echo htmlspecialchars($pokemon['special_defense']); ?>%;">
                        </div>
                    </div>

                    <p>Vitesse</p>
                    <div class="stat-bar-container">
                        <div class="stat-bar speed" style="width: <?php echo htmlspecialchars($pokemon['speed']); ?>%;">
                        </div>
                    </div>
                </div>
                </div>

                <div class="pokemon">
                <p class="pokedex-id"><?php if ($pokemon['pokedexId'] < 10) {
                        echo '#000' . $pokemon['pokedexId'];
                    } else if ($pokemon['pokedexId'] < 100) {
                        echo '#00' . $pokemon['pokedexId'];
                    } else if($pokemon['pokedexId']<250){
                        echo '#0'. $pokemon['pokedexId'];
                    }?></p>
                <img src="<?php echo $pokemon['image']; ?>" alt="<?php echo $pokemon['name']; ?>">
                <a href="index.php">Retour à la liste</a>
                </div>

                </section>
                </main>
            </body>
            </html>
            <?php
        } else {
            echo '<script>alert("Pokémon non trouvé.");</script>';
            echo '<a href="index.php">Retour à la liste</a>';
        }
    } catch (PDOException $e) {
        echo '<script>alert("Erreur: ' . $e->getMessage() . '");</script>';
        exit;
    }
} else {
    echo '<script>alert("ID de Pokémon invalide.");</script>';
    echo '<a href="index.php">Retour à la liste</a>';
}
?>