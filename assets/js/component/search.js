

import { fetchPokemonData, getPokemonArray } from './pokemonData.js';

export function setupSearch() {
    const searchBar = document.getElementById('search-bar');
    const pokedexContainer = document.getElementById('pokedex-container');

    if (searchBar != null) {
        searchBar.addEventListener('input', function() {
            const searchTerm = searchBar.value;

            // Fetch dei dati solo la prima volta o se l'array è vuoto
            if (getPokemonArray().length === 0) {
                fetchPokemonData(searchTerm)
                    .then(() => {
                        updatePokedex(searchTerm);
                    })
                    .catch(error => console.error('Errore durante il fetch dei dati dei Pokémon:', error));
            } else {
                updatePokedex(searchTerm);
            }
        });
    }

    function updatePokedex(searchTerm) {
        const filteredPokemon = getPokemonArray().filter(pokemon =>
            pokemon.name.toLowerCase().includes(searchTerm.toLowerCase())
        );

        pokedexContainer.innerHTML = '';
        filteredPokemon.forEach(pokemon => {
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
    }
}
