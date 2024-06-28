document.addEventListener('DOMContentLoaded', () => {
    setupAutocomplete();
});

export function setupAutocomplete() {
    const searchBar = document.getElementById('search-bar');
    const suggestionsSelect = document.getElementById('suggestions');

    if (!searchBar || !suggestionsSelect) {
        console.error('Element not found');
        return;
    }

    fetch('array.php')
        .then(response => response.json())
        .then(pokemonNames => {
            searchBar.addEventListener('input', function() {
                const searchTerm = searchBar.value.trim().toLowerCase();
                suggestionsSelect.innerHTML = '';

                if (searchTerm.length === 0) {
                    suggestionsSelect.style.display = 'none';
                    return;
                }

                const matchingPokemons = pokemonNames.filter(pokemon =>
                    pokemon.toLowerCase().startsWith(searchTerm)
                );

                if (matchingPokemons.length > 0) {
                    matchingPokemons.forEach(pokemon => {
                        const option = document.createElement('option');
                        option.value = pokemon;
                        option.textContent = pokemon;
                        suggestionsSelect.appendChild(option);
                    });
                    suggestionsSelect.style.display = 'block';
                } else {
                    suggestionsSelect.style.display = 'none';
                }
            });

            suggestionsSelect.addEventListener('change', function() {
                searchBar.value = suggestionsSelect.value;
                suggestionsSelect.style.display = 'none';
            });
        })
        .catch(error => console.error('Erreur lors du fetch des noms des Pokémon:', error));
}
