// search.js
export function setupSearch() {
    const searchBar = document.getElementById('search-bar');
    const pokedexContainer = document.getElementById('pokedex-container');

    if (searchBar != null) {
        searchBar.addEventListener('input', function() {
            const searchTerm = searchBar.value;
            fetch(`search.php?search=${encodeURIComponent(searchTerm)}`)
                .then(response => response.json())
                .then(pokemonList => {
                    pokedexContainer.innerHTML = ''; 
                    pokemonList.forEach(pokemon => {
                        const pokemonCard = document.createElement('div');
                        pokemonCard.classList.add('pokemon-card');
                        pokemonCard.innerHTML = `
                            <img src="${pokemon.image}" alt="${pokemon.name}">
                            <h2>${pokemon.name}</h2>
                            <p>ID: ${pokemon.pokedexId}</p>
                            <p>Tipo: ${pokemon.type1}${pokemon.type2 ? ', ' + pokemon.type2 : ''}</p>
                        `;
                        pokedexContainer.appendChild(pokemonCard);
                    });
                })
                .catch(error => console.error('Errore durante il fetch:', error));
        });
    }
}
