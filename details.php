<?php
session_start();
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
                <script defer src="./assets/component/progressbar.js"></script>
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
                <section>
                    <div class="details-container">
                        <div class="pokemon-card">
                            <div class="detail__header">
                                <h1><?php echo htmlspecialchars($pokemon['name']); ?></h1>
                                <button class="compare" data-id="<?php echo $pokemon['id']; ?>">Ajouter au comparateur</button>
                            </div>
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
                            <div class="stat-bar-container" data-hp="<?php echo htmlspecialchars($pokemon['hp']); ?>">
                                <div class="stat-bar hp" id="hpBar"></div>
                            </div>
                            <p>Attaque</p>
                            <div class="stat-bar-container" data-attack="<?php echo htmlspecialchars($pokemon['attack']); ?>">
                                <div class="stat-bar attack" id="attackBar"></div>
                            </div>
                            <p>Défense</p>
                            <div class="stat-bar-container" data-defense="<?php echo htmlspecialchars($pokemon['defense']); ?>">
                                <div class="stat-bar defense" id="defenseBar"></div>
                            </div>
                            <p>Special Attaque</p>
                            <div class="stat-bar-container" data-attackSpecial="<?php echo htmlspecialchars($pokemon['special_attack']); ?>">
                                <div class="stat-bar special-attack" id="attackSpecialBar"></div>
                            </div>
                            <p>Special Defense</p>
                            <div class="stat-bar-container" data-defenseSpecial="<?php echo htmlspecialchars($pokemon['special_defense']); ?>">
                                <div class="stat-bar special-defense" id="defenseSpecialBar"></div>
                            </div>
                            <p>Vitesse</p>
                            <div class="stat-bar-container" data-speed="<?php echo htmlspecialchars($pokemon['speed']); ?>">
                                <div class="stat-bar speed" id="speedBar"></div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="pokemon">
                        <p data-heading="Frozen" contenteditable class="pokedex-id">
                            <?php 
                                if ($pokemon['pokedexId'] < 10) {
                                    echo '#000' . $pokemon['pokedexId'];
                                } else if ($pokemon['pokedexId'] < 100) {
                                    echo '#00' . $pokemon['pokedexId'];
                                } else if($pokemon['pokedexId']<1000){
                                    echo '#0'. $pokemon['pokedexId'];
                                }
                            ?>
                        
		
		<span class="animation" aria-hidden="true">
        <?php 
                                if ($pokemon['pokedexId'] < 10) {
                                    echo '#000' . $pokemon['pokedexId'];
                                } else if ($pokemon['pokedexId'] < 100) {
                                    echo '#00' . $pokemon['pokedexId'];
                                } else if($pokemon['pokedexId']<1000){
                                    echo '#0'. $pokemon['pokedexId'];
                                }
                            ?>
        </span> 
                            </p>





                        <img src="<?php echo $pokemon['image']; ?>" alt="<?php echo $pokemon['name']; ?>" class="pokemon-img">
                    </div>


                    <div class="container-evolution">
                    <div class="evolution">
                    <img src="<?php echo $pokemon['image']; ?>" alt="<?php echo $pokemon['name']; ?>" class="pokemon-img">
                    <img src="<?php echo $pokemon['evolution_image1']; ?>" alt="<?php echo $pokemon['name']; ?>" class="pokemon-img">
                    <img src="<?php echo $pokemon['evolution_image2']; ?>">
                    </div>
                </div>


                </section>

              

            </main>
            <script type="module" src="./assets/js/script.js"></script>
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