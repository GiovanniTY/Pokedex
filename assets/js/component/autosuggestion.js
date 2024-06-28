// JavaScript pour gérer l'autocomplete
export function setupAutocomplete() {
    const searchBar = document.getElementById('search-bar');
    const suggestionsDiv = document.getElementById('suggestions');

    // Récupère les noms des Pokémon du serveur PHP
    fetch('array.php')
        .then(response => response.json())
        .then(pokemonNames => {
            searchBar.addEventListener('input', function() {
                const searchTerm = searchBar.value.trim().toLowerCase();
                suggestionsDiv.innerText = ''; // Vider les suggestions précédentes

                if (searchTerm.length === 0) {
                    suggestionsDiv.style.display = 'none';
                    return;
                }

                const matchingPokemons = pokemonNames.filter(pokemon =>
                    pokemon.toLowerCase().startsWith(searchTerm)
                );

                if (matchingPokemons.length > 0) {
                    matchingPokemons.forEach(pokemon => {
                        const suggestion = document.createElement('div');
                        suggestion.textContent = pokemon;
                        suggestion.addEventListener('click', function() {
                            searchBar.value = pokemon;
                            suggestionsDiv.style.display = 'none';
                        });
                        suggestionsDiv.appendChild(suggestion);
                    });
                    suggestionsDiv.style.display = 'block';
                } else {
                    suggestionsDiv.style.display = 'none';
                }
            });
        })
        .catch(error => console.error('Erreur lors du fetch des noms des Pokémon:', error));
}

// Appelle la fonction pour initialiser l'autocomplete
setupAutocomplete();
