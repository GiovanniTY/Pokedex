// JavaScript per gestire l'autocomplete utilizzando i dati dal server PHP
 export function setupAutocomplete() {
    const searchBar = document.getElementById('search-bar');
    const suggestionsDiv = document.getElementById('suggestions');

    // Richiesta AJAX per recuperare i nomi dei Pokémon dal server PHP
    fetch('array.php')
        .then(response => response.json())
        .then(pokemonNames => {
            searchBar.addEventListener('input', function() {
                const searchTerm = searchBar.value.trim().toLowerCase();
                suggestionsDiv.innerHTML = '';

                if (searchTerm.length === 0) {
                    suggestionsDiv.style.display = 'none';
                    return;
                }

                const matchingPokemons = pokemonNames.filter(pokemon =>
                    pokemon.toLowerCase().includes(searchTerm)
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
        .catch(error => console.error('Errore durante il fetch dei nomi dei Pokémon:', error));
}

// Richiama la funzione per inizializzare l'autocomplete
setupAutocomplete();
