import {favorite} from './component/favorite.js';

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
