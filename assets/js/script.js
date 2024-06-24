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

    // Fermare l'intervallo dopo una rotazione completa (360 gradi)
    if (rotation >= 90) {
        clearInterval(rotateInterval);
        rotation = 0; // Ripristinare l'angolo di rotazione per future rotazioni
        setTimeout(() => {
            pokemonImage.style.transform = 'rotate(0deg)';
            startRotation(); // Riprendere la rotazione dopo un breve ritardo
        }, 5000); // Attendere 2 secondi prima di riavviare la rotazione
    }
}

function startRotation() {
    rotateInterval = setInterval(rotateImage, 5000); // Esegui la rotazione ogni 5 secondi
}

// Avvia la rotazione iniziale
startRotation();

