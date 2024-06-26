export function toggleDarkMode() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;
    const main = document.querySelector('main');
    const nav = document.querySelector('nav');
    const pokeballImage = document.getElementById('pokeball');
    const cards = document.querySelectorAll('.pokemon-card');
    
    const darkModeImageSrc = 'assets/img/pokeball2.png'; 
    const lightModeImageSrc = 'assets/img/pokeball.png'; 

    function setDarkModeFromLocalStorage() {
        const isDarkMode = localStorage.getItem('darkMode') === 'true';
        if (isDarkMode) {
            body.classList.add('dark');
            main.classList.add('dark');
            nav.classList.add('dark');
            cards.forEach(card => card.classList.add('dark'));
            pokeballImage.src = darkModeImageSrc;
        } else {
            body.classList.remove('dark');
            main.classList.remove('dark');
            nav.classList.remove('dark');
            cards.forEach(card => card.classList.remove('dark'));
            pokeballImage.src = lightModeImageSrc;
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        setDarkModeFromLocalStorage();
    });

    darkModeToggle.addEventListener('click', function() {
        const isDarkMode = body.classList.toggle('dark');
        main.classList.toggle('dark');
        nav.classList.toggle('dark');
        cards.forEach(card => card.classList.toggle('dark'));

        localStorage.setItem('darkMode', isDarkMode);

        if (isDarkMode) {
            pokeballImage.src = darkModeImageSrc;
        } else {
            pokeballImage.src = lightModeImageSrc;
        }
    });
}
