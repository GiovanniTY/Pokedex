-- Création de la table Pokemon
DROP TABLE IF EXISTS Pokemon;
CREATE TABLE IF NOT EXISTS Pokemon (
    id INTEGER PRIMARY KEY AUTO_INCREMENT,
    pokedexId INTEGER,
    name TEXT,
    image TEXT,
    sprite TEXT,
    slug TEXT,
    hp INTEGER,
    attack INTEGER,
    defense INTEGER,
    special_attack INTEGER,
    special_defense INTEGER,
    speed INTEGER,
    generation INTEGER,
    type1 TEXT,
    type1_image TEXT,
    type2 TEXT,
    type2_image TEXT,
    pre_evolution_name TEXT,
    pre_evolution_pokedex_id INTEGER,
    evolution_name TEXT,
    evolution_pokedex_id INTEGER
);

-- Insertion des données des Pokémon
INSERT INTO Pokemon (id, pokedexId, name, image, sprite, slug, hp, attack, defense, special_attack, special_defense, speed, generation, type1, type2, pre_evolution_name, pre_evolution_pokedex_id, evolution_name, evolution_pokedex_id)
VALUES
(1, 1, 'Bulbizarre', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/1.png', 'Bulbizarre', 45, 49, 49, 65, 65, 45, 1, 'Poison', 'Plante', NULL, NULL, 'Herbizarre', 2),
(2, 2, 'Herbizarre', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/2.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/2.png', 'Herbizarre', 60, 62, 63, 80, 80, 60, 1, 'Poison', 'Plante', 'Bulbizarre', 1, 'Florizarre', 3),
(3, 3, 'Florizarre', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/3.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/3.png', 'Florizarre', 80, 82, 83, 100, 100, 80, 1, 'Poison', 'Plante', 'Herbizarre', 2, NULL, NULL),
(4, 4, 'Salamèche', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/4.png', 'https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/4.png', 'Salameche', 39, 52, 43, 60, 50, 65, 1, 'Feu', NULL, NULL, NULL, 'Reptincel', 5);