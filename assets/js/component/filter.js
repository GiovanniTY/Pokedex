export function filter() {
    const select = document.querySelector('select');
    
    select.addEventListener('change', () => {
        const value = select.value;
        switch (value) {
            case "favoris":
                filterByfavoris()
                break;
            case "numero":
                filterById()
                break;
            case "nom":
                filterByName()
                break;
            case "type":
                filterByType()
                break;
        
            default:
                displayAll()
                break;
        }
    })
}

const pokeCard = document.querySelectorAll('.pokemon-card');
function filterByfavoris() {
    pokeCard.forEach((card) => {
        if (card.classList.contains('favorite')) {
            card.style.display = 'flex'; 
        } else {
            card.style.display = 'none';
        }
    }) 
}

function filterById() {
    const cards = Array.from(document.querySelectorAll(".pokemon-card"));
    const sortedCards = cards.sort((a, b) => {
        const idA = parseInt(a.querySelector(".pokedex-id").innerText.replace('#', ''), 10);
        const idB = parseInt(b.querySelector(".pokedex-id").innerText.replace('#', ''), 10);
        return idA - idB;
    });

    const container = document.querySelector(".pokedex-container");
    container.innerHTML = ""; 
    sortedCards.forEach(card => container.appendChild(card));
}



function filterByName() {
    const cards = Array.from(document.querySelectorAll(".pokemon-card"));
    const sortedCards = cards.sort((a, b) => {
        const nameA = a.querySelector("h2").innerText;
        const nameB = b.querySelector("h2").innerText;
        return nameA.localeCompare(nameB);
    });

    const container = document.querySelector(".pokedex-container");
    container.innerHTML = ""; 
    sortedCards.forEach(card => container.appendChild(card));
}

function filterByType() {
    const cards = Array.from(document.querySelectorAll(".pokemon-card"));
    const sortedCards = cards.sort((a, b) => {
        const typeA = a.querySelector(".type").children[0].innerText;
        const typeB = b.querySelector(".type").children[0].innerText;
        return typeA.localeCompare(typeB);
    });

    const container = document.querySelector(".pokedex-container");
    container.innerHTML = ""; 
    sortedCards.forEach(card => container.appendChild(card));
}

function displayAll() {
    pokeCard.forEach((card) => {
        card.style.display = 'flex';
    })
}