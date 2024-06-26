import {favorite} from './component/favorite.js';
import { filter } from "./component/filter.js";
import { toggleDarkMode} from "./darkmode.js";




toggleDarkMode();

favorite()
filter()
document.addEventListener('DOMContentLoaded', function() {
    const searchBar = document.getElementById('search-bar');
    const pokedexContainer = document.getElementById('pokedex-container');

    searchBar.addEventListener('input', function() {
        const searchTerm = searchBar.value;
        fetch(`?search=${encodeURIComponent(searchTerm)}`)
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
            .catch(error => console.error('Erreur pendant le fetch:', error));
    });
});