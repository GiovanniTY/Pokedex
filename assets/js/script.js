function toggleDarkMode() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;
    const main = document.querySelector('main');
    const nav = document.querySelector('nav')
    const pokeballImage = document.getElementById('pokeball');
    
    const darkModeImageSrc = 'assets/img/pokeball2.png'; 
    const lightModeImageSrc = 'assets/img/pokeball.png'; 

    darkModeToggle.addEventListener('click', function() {
        const isDarkMode = body.classList.toggle('dark');
        main.classList.toggle('dark');
        nav.classList.toggle('dark');
        
        if (isDarkMode) {
            pokeballImage.src = darkModeImageSrc;
        } else {
            pokeballImage.src = lightModeImageSrc;
        }
    });
}

document.addEventListener('DOMContentLoaded', function() {
    toggleDarkMode();
});

const pokemonImage = document.getElementById('pokemon');
let rotation = 0;
let rotateInterval;

function rotateImage() {
    rotation += 90;
    pokemonImage.style.transform = `rotate(${rotation}deg)`;

    
    if (rotation >= 90) {
        clearInterval(rotateInterval);
        rotation = 0; 
        setTimeout(() => {
            pokemonImage.style.transform = 'rotate(0deg)';
            startRotation(); 
        }, 5000); 
}

function startRotation() {
    rotateInterval = setInterval(rotateImage, 5000); 
}

startRotation();
};

document.addEventListener('DOMContentLoaded', function() {
    toggleDarkMode();

    const searchBar = document.getElementById('search-bar');
    const pokedexContainer = document.getElementById('pokedex-container');

    searchBar.addEventListener('input', function() {
        const query = searchBar.value;
        fetch(`search.php?search=${query}`)
            .then(response => response.json())
            .then(data => {
                pokedexContainer.innerTextHTML = '';
                data.forEach(pokemon => {
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
            });
    });
});
