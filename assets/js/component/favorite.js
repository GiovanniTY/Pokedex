export function favorite() {
    const favoriteElements = document.querySelectorAll(".favoriteSpan");
    let favoriteArray = Get("favorite") || [];

    favoriteElements.forEach(element => {
        if (favoriteArray.includes(element.parentElement.children[3].innerText)) {
            element.parentElement.classList.add("favorite");
        }
    });

    for (const element of favoriteElements) {
        element.addEventListener("click", (e) => {
            e.stopPropagation();
            e.preventDefault();
            element.parentElement.classList.toggle("favorite");
            const pokemonName = element.parentElement.children[3].innerText;

            if (element.parentElement.classList.contains("favorite")) {
                if (!favoriteArray.includes(pokemonName)) {
                    favoriteArray.push(pokemonName);
                }
            } else {
                const index = favoriteArray.indexOf(pokemonName);
                if (index !== -1) {
                    favoriteArray.splice(index, 1);
                }
            }
            Set("favorite", favoriteArray);
        });
    }
}

export function Get(key) {
    return JSON.parse(localStorage.getItem(key));
}

export function Set(key, value) {
    localStorage.setItem(key, JSON.stringify(value));
}