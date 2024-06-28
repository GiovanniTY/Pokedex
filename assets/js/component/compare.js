import { Get, Set} from './favorite.js'
import * as DOM from './generateElement.js'


export function compare() {
    const compare = document.querySelector(".compare")
    let compareArray = Get("compare") || []
    if(compare!=null) {
        compare.addEventListener("click", () => {
            if (compareArray.length < 2) {
                const pokemon = {
                    name: document.querySelector("h1").innerText,
                    image: document.querySelector(".pokemon-img").src,
                    id: document.querySelector("#pokedexId").innerText,
                    type : [document.querySelector(".type").children[0].innerText, (document.querySelector(".type").children[1]!=null)? document.querySelector(".type").children[1].innerText:""],
                    hp : document.querySelector(".hp").style.width,
                    attack : document.querySelector(".attack").style.width,
                    defense : document.querySelector(".defense").style.width,
                    specialAttack : document.querySelector(".special-attack").style.width,
                    specialDefense : document.querySelector(".special-defense").style.width,
                    speed : document.querySelector(".speed").style.width
                }
                compareArray.push(pokemon)
                console.log(compareArray)
                Set("compare", compareArray)
                checkAndApplyOpacity()
            }
            else{
                alert("You can't compare more than 2 pokemons")
            }
        })      
    }
    const compareContainer = document.querySelector("#compare__container")
    const zoneFight = document.querySelector("#zone__fight")
    const zoneFightLeft = document.querySelector(".plateforme--left")
    const zoneFightRight = document.querySelector(".plateforme--right")

    
    if(compareContainer!=null && zoneFight!=null) {
        DOM.generateImg("assets/img/bg-fight.png", "plateforme", zoneFight, "bg-fight")
        compareArray = Get("compare") || []
        for (let i = 0; i < compareArray.length; i++) {
            const pokemon = compareArray[i];
            if (i==0) {
                let img = DOM.generateImg(pokemon.image, pokemon.name, zoneFightLeft, "fight-img")
                img.classList.add("first__img")
                generateColumn(document.querySelector("#compare__left"),pokemon)
                generateBtn(document.querySelector("#compare__left"), cleanId(pokemon.id))
            } else {
                let img = DOM.generateImg(pokemon.image, pokemon.name, zoneFightRight, "fight-img")
                img.classList.add("second__img")
                generateColumn(document.querySelector("#compare__right"),pokemon)
                generateBtn(document.querySelector("#compare__right"), cleanId(pokemon.id))
            }
        }
        checkAndApplyOpacity()
    }
}

function generateColumn(section, pokemon) {
    const info = DOM.createDiv(section, "info")
    const stat = DOM.createDiv(section, "stat")
    DOM.generateElement("p", pokemon.id,info,"compare-id")
    DOM.generateElement("p", pokemon.name,info,"compare-name")
    const type = DOM.createDiv(info, "type")
    pokemon.type.forEach(element => {
        console.log(element);
        if(element!=""){
            DOM.generateElement("span",element,type,element.trim().toLowerCase())
        }
    });

    createStatBar(stat, "hp", "HP", pokemon.hp);
    createStatBar(stat, "attack", "Attack", pokemon.attack);
    createStatBar(stat, "defense", "Defense", pokemon.defense);
    createStatBar(stat, "special-attack", "Special Attack", pokemon.specialAttack);
    createStatBar(stat, "special-defense", "Special Defense", pokemon.specialDefense);
    createStatBar(stat, "speed", "Speed", pokemon.speed);

}

function createStatBar(stat, className, label, value) {
    const barContainer = DOM.createDiv(stat, "stat-bar-container");
    const bar = DOM.createDiv(barContainer, className);
    bar.classList.add("stat-bar");
    bar.style.width = value;
    bar.innerText = `${label} : ${value}`;
}

function generateBtn(section, id) {
    const divBtn = DOM.createDiv(section, "btn__container")
    const detailsBtn = DOM.generateElement("button", "Détails", divBtn, "btn--details")
    const deleteBtn = DOM.generateElement("button", "Supprimer", divBtn, "btn--delete")
    
    detailsBtn.addEventListener('click', () => {
        window.location.href = `./details.php?id=${id}`;
    });

    deleteBtn.addEventListener('click', () => {
        removePokemon(id)
    });
}

function cleanId(id) {
    return id.replace(/^#0*/, '')
}

function removePokemon(id) {
    let compareArray = Get("compare") || [];
    compareArray = compareArray.filter(pokemon => cleanId(pokemon.id) !== id);
    Set("compare", compareArray);

    const fightImg = document.querySelector(`.fight-img[src*="${id}"]`)
    const compareLeft = document.querySelector("#compare__left .compare-id")
    const compareRight = document.querySelector("#compare__right .compare-id")

    if (fightImg) {
        fightImg.parentElement.removeChild(fightImg)
    }

    if (compareLeft && cleanId(compareLeft.innerText) === id) {
        compareLeft.parentElement.parentElement.innerHTML = ''
    }

    if (compareRight && cleanId(compareRight.innerText) === id) {
        compareRight.parentElement.parentElement.innerHTML = ''
    }

    location.reload()
    checkAndApplyOpacity()
}

function checkAndApplyOpacity() {
    const compareLeft = document.querySelector("#compare__left");
    const compareRight = document.querySelector("#compare__right");

    if (compareLeft.innerHTML.trim() === '') {
        compareLeft.style.opacity = '0';
    } else {
        compareLeft.style.opacity = '1';
    }

    if (compareRight.innerHTML.trim() === '') {
        compareRight.style.opacity = '0';
    } else {
        compareRight.style.opacity = '1';
    }
}