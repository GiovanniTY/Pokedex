<?php 

include('./login-register/config.php'); 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Dashboard</title>
</head>
<body class="body-backend">
    <nav>
    <a href="./index.php">Return to homepage</a>
    </nav>
<h1>Add a pokemon</h1>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" class="form-backend">
        <label for="pokedexId">Pokedex Id</label>
        <input type="text" id="pokedexId" name="pokedexId"><br>
        
        <label for="name">Name</label>
        <input type="text" id="name" name="name"><br>
        
        <label for="image">Image</label>
        <input type="text" id="image" name="image"><br>
     
        
        <label for="hp">HP</label>
        <input type="text" id="hp" name="hp"><br>
        
        <label for="attack">Attack</label>
        <input type="text" id="attack" name="attack"><br>
        
        <label for="defense">Defense</label>
        <input type="text" id="defense" name="defense"><br>
        
        <label for="special_attack">Special Attack</label>
        <input type="text" id="special_attack" name="special_attack"><br>
        
        <label for="special_defense">Special Defense</label>
        <input type="text" id="special_defense" name="special_defense"><br>
        
        <label for="speed">Speed</label>
        <input type="text" id="speed" name="speed"><br>

        <label for="generation">Generation</label>
        <select name="generation" id="generation">
            <option value="null">Pick a generation</option>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
            <option value="6">6</option>
            <option value="7">7</option>
            <option value="8">8</option>
        </select><br>

        <label for="type1">Type 1</label>
        <select name="type1" id="type1">
            <option value="null">Pick a type</option>
            <option value="Plante">Plante</option>
            <option value="Feu">Feu</option>
            <option value="Eau">Eau</option>
            <option value="Insecte">Insecte</option>
            <option value="Spectre">Spectre</option>
            <option value="Normal">Normal</option>
            <option value="Électrik">Electrique</option>
            <option value="Poison">Poison</option>
            <option value="Vol">Vol</option>
            <option value="Sol">Sol</option>
            <option value="Fée">Fée</option>
            <option value="Combat">Combat</option>
            <option value="Psy">Psy</option>
            <option value="Roche">Roche</option>
            <option value="Acier">Acier</option>
            <option value="Glace">Glace</option>
            <option value="Dragon">Dragon</option>
            <option value="Ténèbres">Ténèbres</option>
        </select><br>

        <label for="type1_image">Type 1 image</label>
        <input type="text" id="type1_image" name="type1_image"><br>

        <label for="type2">Type 2</label>
        <select name="type2" id="type2">
            <option value="null">Pick a type</option>
            <option value="Plante">Plante</option>
            <option value="Feu">Feu</option>
            <option value="Eau">Eau</option>
            <option value="Insecte">Insecte</option>
            <option value="Spectre">Spectre</option>
            <option value="Normal">Normal</option>
            <option value="Électrik">Electrique</option>
            <option value="Poison">Poison</option>
            <option value="Vol">Vol</option>
            <option value="Sol">Sol</option>
            <option value="Fée">Fée</option>
            <option value="Combat">Combat</option>
            <option value="Psy">Psy</option>
            <option value="Roche">Roche</option>
            <option value="Acier">Acier</option>
            <option value="Glace">Glace</option>
            <option value="Dragon">Dragon</option>
            <option value="Ténèbres">Ténèbres</option>
        </select><br>

        
        <label for="type2_image">Type 2 image</label>
        <input type="text" id="type2_image" name="type2_image"><br>

        <label for="pre_evolution_name">Pre-evolution</label>
        <input type="text" name="pre_evolution_name"><br>

        <label for="evolution_name">Evolution name</label>
        <input type="text" name="evotuion_name"><br>
        
        <button type="submit" name="addd a pokemon">Add a pokemon</button>
    </form>
    
</body>
</html>