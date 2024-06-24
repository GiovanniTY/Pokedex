
function toggleDarkMode() {
    const darkModeToggle = document.getElementById('dark-mode-toggle');
    const body = document.body;
    const main = document.querySelector('main');

    darkModeToggle.addEventListener('click', function() {
        body.classList.toggle('dark');
        main.classList.toggle('dark');
    });
}


export { toggleDarkMode };
