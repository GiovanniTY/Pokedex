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

        <label for="sprite">Sprite</label>
        <input type="text" id="sprite" name="sprite"><br>

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
            <option value="Acier">Acier</option>
            <option value="Combat">Combat</option>
            <option value="Dragon">Dragon</option>
            <option value="Eau">Eau</option>
            <option value="Électrik">Electrique</option>
            <option value="Fée">Fée</option>
            <option value="Feu">Feu</option>
            <option value="Glace">Glace</option>
            <option value="Insecte">Insecte</option>
            <option value="Normal">Normal</option>
            <option value="Plante">Plante</option>
            <option value="Poison">Poison</option>
            <option value="Psy">Psy</option>
            <option value="Roche">Roche</option>
            <option value="Sol">Sol</option>
            <option value="Spectre">Spectre</option>
            <option value="Ténèbres">Ténèbres</option>
            <option value="Vol">Vol</option>
          
        </select><br>

        <label for="type1_image">Type 1 image</label>
        <input type="text" id="type1_image" name="type1_image"><br>

        <label for="type2">Type 2</label>
        <select name="type2" id="type2">
        <option value="null">Pick a type</option>
            <option value="Acier">Acier</option>
            <option value="Combat">Combat</option>
            <option value="Dragon">Dragon</option>
            <option value="Eau">Eau</option>
            <option value="Électrik">Electrique</option>
            <option value="Fée">Fée</option>
            <option value="Feu">Feu</option>
            <option value="Glace">Glace</option>
            <option value="Insecte">Insecte</option>
            <option value="Normal">Normal</option>
            <option value="Plante">Plante</option>
            <option value="Poison">Poison</option>
            <option value="Psy">Psy</option>
            <option value="Roche">Roche</option>
            <option value="Sol">Sol</option>
            <option value="Spectre">Spectre</option>
            <option value="Ténèbres">Ténèbres</option>
            <option value="Vol">Vol</option>
        </select><br>

        <label for="type2_image">Type 2 image</label>
        <input type="text" id="type2_image" name="type2_image"><br>

        <label for="pre_evolution_name">Pre-evolution</label>
        <input type="text" name="pre_evolution_name"><br>

        <label for="evolution_name">Evolution name</label>
        <input type="text" name="evotuion_name"><br>

        <button type="submit" name="addd a pokemon">Add a pokemon</button>
    </form>
    <script>
    const pokemonIdInput = document.getElementById('pokedexId');
    const type1Input = document.getElementById('type1');
    const type1ImageInput = document.getElementById('type1_image');
    const type2Input = document.getElementById('type2');
    const type2ImageInput = document.getElementById('type2_image');


    async function fetchImages(url) {
        try {
            const response = await fetch(url);
            const data = await response.json();

            if (response.ok) {  // Vérifie si la réponse est correcte
                console.log(data.sprites.other);
                const imageInput = document.getElementById('image');
                imageInput.value = data.sprites.other['official-artwork'].front_default;  // Met à jour l'input de l'image avec l'URL de l'image du Pokémon
                const spriteInput = document.getElementById('sprite');
                spriteInput.value = data.sprites.front_default;
            } else {
                console.error('Error fetching data');
            }
        } catch (error) {
            console.error(error);
        }
    }

    pokemonIdInput.addEventListener('change', () => {
        const pokemonId = pokemonIdInput.value;
        const url = `https://pokeapi.co/api/v2/pokemon/${pokemonId}`;
        fetchImages(url);
    });

    type1Input.addEventListener('change', () => {
        switch (type1Input.value) {
            case 'Acier': 
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/c/c9/Steel.png';
                break;
            case 'Combat': 
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/3/30/Fighting.png';
                break;

            case 'Dragon':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/c/c7/Dragon.png';
                break;

            case 'Eau':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/9/9d/Water.png';
                break;
            
            case 'Électrik':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/2/2f/Electric.png';
                break;

            case 'Fée':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/4/43/Fairy.png';
                break;

            case 'Feu':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/3/30/Fire.png';
                break;

            case 'Glace':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/7/77/Ice.png';
                break;
            case 'Insecte':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/7/7d/Bug.png';
                break;

            case 'Normal':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/f/fb/Normal.png';
                break;

            case 'Plante':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/c/c5/Grass.png';
                break;

             case 'Poison':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/0/05/Poison.png';
                break;

            case 'Psy':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/2/21/Psychic.png';
                break;

            case 'Roche':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/0/0b/Rock.png';
                break;

            case 'Sol':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/8/8f/Ground.png';
                break;

            case 'Spectre':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/a/ab/Ghost.png';
                break;

            case 'Ténèbres':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/0/0e/Dark.png';
                break;

            case 'Vol':
                type1ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/7/7f/Flying.png';
                break;
        }
    })

    type2Input.addEventListener('change', () => {
        switch (type2Input.value) {
            case 'Acier': 
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/c/c9/Steel.png';
                break;
            case 'Combat': 
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/3/30/Fighting.png';
                break;

            case 'Dragon':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/c/c7/Dragon.png';
                break;

            case 'Eau':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/9/9d/Water.png';
                break;
            
            case 'Électrik':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/2/2f/Electric.png';
                break;

            case 'Fée':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/4/43/Fairy.png';
                break;

            case 'Feu':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/3/30/Fire.png';
                break;

            case 'Glace':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/7/77/Ice.png';
                break;
            case 'Insecte':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/7/7d/Bug.png';
                break;

            case 'Normal':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/f/fb/Normal.png';
                break;

            case 'Plante':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/c/c5/Grass.png';
                break;

             case 'Poison':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/0/05/Poison.png';
                break;

            case 'Psy':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/2/21/Psychic.png';
                break;

            case 'Roche':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/0/0b/Rock.png';
                break;

            case 'Sol':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/8/8f/Ground.png';
                break;

            case 'Spectre':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/a/ab/Ghost.png';
                break;

            case 'Ténèbres':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/0/0e/Dark.png';
                break;

            case 'Vol':
                type2ImageInput.value = 'https://static.wikia.nocookie.net/pokemongo/images/7/7f/Flying.png';
                break;
        }
    })


</script>

</body>

</html>