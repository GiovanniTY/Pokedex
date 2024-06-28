// JavaScript pour gérer l'autocomplete
 export function setupAutocomplete() {
    const searchBar = document.getElementById('search-bar');
    const suggestionsList = document.getElementById('suggestions');

    // Récupère les noms des Pokémon du serveur PHP
    fetch('array.php')
        .then(response => response.json())
        .then(pokemonNames => {
            searchBar.addEventListener('input', function() {
                const searchTerm = searchBar.value.trim().toLowerCase();
                suggestionsList.innerHTML = ''; // Vider les suggestions précédentes

                if (searchTerm.length === 0) {
                    return;
                }

                const matchingPokemons = pokemonNames.filter(pokemon =>
                    pokemon.toLowerCase().startsWith(searchTerm)
                );

                if (matchingPokemons.length > 0) {
                    matchingPokemons.forEach(pokemon => {
                        const option = document.createElement('option');
                        option.value = pokemon;
                        suggestionsList.appendChild(option);
                    });
                }
            });
        })
        .catch(error => console.error('Erreur lors du fetch des noms des Pokémon:', error));
}

// Appelle la fonction pour initialiser l'autocomplete
setupAutocomplete();
