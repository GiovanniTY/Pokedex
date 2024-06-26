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
                    id: document.querySelector(".pokedex-id").innerText,
                    type : [document.querySelector(".type").children[0].innerText, (document.querySelector(".type").children[1]!=null)? document.querySelector(".type").children[1].innerText:""],
                    hp : document.querySelector(".hp").style.width,
                    attack : document.querySelector(".attack").style.width,
                    defense : document.querySelector(".defense").style.width,
                    specialAttack : document.querySelector(".special-attack").style.width,
                    specialDefense : document.querySelector(".special-defense").style.width,
                    speed : document.querySelector(".speed").style.width
                }
                compareArray.push(pokemon)
                Set("compare", compareArray)
            }
            else{
                alert("You can't compare more than 2 pokemons")
            }
        })      
    }
    const compareContainer = document.querySelector("#compare__container")
    const zoneFight = document.querySelector("#zone__fight")
    if(compareContainer!=null && zoneFight!=null) {
        compareArray = Get("compare") || []
        for (let i = 0; i < compareArray.length; i++) {
            const pokemon = compareArray[i];
            let img = DOM.generateImg(pokemon.image, pokemon.name, zoneFight, "fight-img")
            if (i==0) {
                img.classList.add("first__img")
            } else img.classList.add("second__img")
            
        }

    }
}

function translateImg() {
    
}
