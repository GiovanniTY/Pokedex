<?php
include('./login-register/config.php'); 

session_start();

try {
    // Query per selezionare i dati dei Pokémon
    $stmt = $pdo->prepare('SELECT * FROM Pokemon');
    $stmt->execute();
    $pokemonList = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo '<script>alert("Errore: ' . $e->getMessage() . '");</script>';
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Comparateur</title>
</head>
<body>
<nav>
        
        <?php
        if (!isset($_SESSION["user"])) {
        ?>

            <a href="./login-register/login.php">Login</a>
        <?php
        }
        if (isset($_SESSION["user"])) {
        ?>
            <a href="../login-register/logout.php">Logout</a>
            <a href="../login-register/profile.php"><img class="avatar-img"src="<?php echo $_SESSION['user']['avatar']?>" alt="avatar"></a>
        <?php   }
        if (!isset($_SESSION["user"])) {

        ?>
            <a href="./login-register/register.php">Register</a>
        <?php } ?>
        <a href="./index.php">Return to homepage</a>
    </nav>
    <main>
        <img id="logo" src="assets/img/logo.png" alt="logo">
        <button id="dark-mode-toggle">
            <img id="pokeball" src="assets/img/pokeball2.png" alt="pokeball">
        </button>
        <h1>Compare tes Pokemons</h1>
        <div id="zone__fight">
            <div class="plateforme plateforme--left"></div>
            <div class="plateforme plateforme--right"></div>
        </div>
        <div id="compare__container">
            <div id="compare__left"></div>
            <div id="compare__right"></div>
        </div>
    </main>
    <script type="module" src="./assets/js/script.js"></script>
</body>
</html>