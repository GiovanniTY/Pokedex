import { compare } from './component/compare.js';
import {favorite} from './component/favorite.js';
import { filter } from "./component/filter.js";
import {popup} from './component/popup.js';
import { navDetails } from "./component/nav.js";
import { toggleDarkMode } from './component/darkmode.js';
 import { setupAutocomplete } from './component/autosuggestion.js'; 





toggleDarkMode();


document.addEventListener('DOMContentLoaded', function() {
    const pokemonImage = document.getElementById('pokemon');
    let rotation = 0;
    let rotateInterval;

    function rotateImage() {
        rotation += 90;
        pokemonImage.style.transform = `rotate(${rotation}deg)`;

        if (rotation >= 90) { 
            clearInterval(rotateInterval);
            setTimeout(() => {
                pokemonImage.style.transform = 'rotate(0deg)'; 
                startRotation(); 
            }, 5000); 
        }
    }

    function startRotation() {
        rotateInterval = setInterval(rotateImage, 5000); 
    }

    startRotation(); 
});

favorite()
filter()
compare()
popup()
navDetails()

document.addEventListener('DOMContentLoaded', function() {
    const searchBar = document.getElementById('search-bar');
    const pokedexContainer = document.getElementById('pokedex-container');
    if (searchBar!=null) {
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
    }
});
