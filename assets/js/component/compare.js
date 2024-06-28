import { Get, Set } from "./favorite.js";
import * as DOM from "./generateElement.js";

export function compare() {
  const compare = document.querySelector(".compare");
  let compareArray = Get("compare") || [];
  if (compare != null) {
    compare.addEventListener("click", () => {
      if (compareArray.length < 2) {
        const pokemon = {
          name: document.querySelector("h1").innerText,
          image: document.querySelector(".pokemon-img").src,
          id: document.querySelector(".pokedex-id").innerText,
          type: [
            document.querySelector(".type").children[0].innerText,
            document.querySelector(".type").children[1] != null
              ? document.querySelector(".type").children[1].innerText
              : "",
          ],
          hp: document.querySelector(".hp").style.width,
          attack: document.querySelector(".attack").style.width,
          defense: document.querySelector(".defense").style.width,
          specialAttack: document.querySelector(".special-attack").style.width,
          specialDefense:
            document.querySelector(".special-defense").style.width,
          speed: document.querySelector(".speed").style.width,
        };
        compareArray.push(pokemon);
        Set("compare", compareArray);
        checkAndApplyOpacity();
      } else {
        alert("You can't compare more than 2 pokemons");
      }
    });
  }
  const compareContainer = document.querySelector("#compare__container");
  const zoneFight = document.querySelector("#zone__fight");
  const zoneFightLeft = document.querySelector(".plateforme--left");
  const zoneFightRight = document.querySelector(".plateforme--right");
  if (compareContainer != null && zoneFight != null) {
    compareArray = Get("compare") || [];
    for (let i = 0; i < compareArray.length; i++) {
      const pokemon = compareArray[i];
      if (i == 0) {
        let img = DOM.generateImg(
          pokemon.image,
          pokemon.name,
          zoneFightLeft,
          "fight-img"
        );
        img.classList.add("first__img");
        generateColumn(document.querySelector("#compare__left"), pokemon);
        generateBtn(
          document.querySelector("#compare__left"),
          cleanId(pokemon.id)
        );
      } else {
        let img = DOM.generateImg(
          pokemon.image,
          pokemon.name,
          zoneFightRight,
          "fight-img"
        );
        img.classList.add("second__img");
        generateColumn(document.querySelector("#compare__right"), pokemon);
        generateBtn(
          document.querySelector("#compare__right"),
          cleanId(pokemon.id)
        );
      }
    }
    checkAndApplyOpacity();
  }
}

function generateColumn(section, pokemon) {
  const info = DOM.createDiv(section, "info");
  const stat = DOM.createDiv(section, "stat");
  DOM.generateElement("p", pokemon.id, info, "compare-id");
  DOM.generateElement("p", pokemon.name, info, "compare-name");
  const type = DOM.createDiv(info, "type");
  pokemon.type.forEach((element) => {
    console.log(element);
    DOM.generateElement("span", element, type, element.trim().toLowerCase());
  });

  const barHP = DOM.createDiv(stat, "stat-bar-container");
  const hp = DOM.createDiv(barHP, "hp");
  hp.classList.add("stat-bar");
  hp.style.width = pokemon.hp;

  const barAttack = DOM.createDiv(stat, "stat-bar-container");
  const attack = DOM.createDiv(barAttack, "attack");
  attack.classList.add("stat-bar");
  attack.style.width = pokemon.attack;

  const barDefense = DOM.createDiv(stat, "stat-bar-container");
  const defense = DOM.createDiv(barDefense, "defense");
  defense.classList.add("stat-bar");
  defense.style.width = pokemon.defense;

  const barSpecialAttack = DOM.createDiv(stat, "stat-bar-container");
  const specialAttack = DOM.createDiv(barSpecialAttack, "special-attack");
  specialAttack.classList.add("stat-bar");
  specialAttack.style.width = pokemon.specialAttack;

  const barSpecialDefense = DOM.createDiv(stat, "stat-bar-container");
  const specialDefense = DOM.createDiv(barSpecialDefense, "special-defense");
  specialDefense.classList.add("stat-bar");
  specialDefense.style.width = pokemon.specialDefense;

  const barSpeed = DOM.createDiv(stat, "stat-bar-container");
  const speed = DOM.createDiv(barSpeed, "speed");
  speed.classList.add("stat-bar");
  speed.style.width = pokemon.speed;
}

function generateBtn(section, id) {
  const divBtn = DOM.createDiv(section, "btn__container");
  const detailsBtn = DOM.generateElement(
    "button",
    "Détails",
    divBtn,
    "btn--details"
  );
  const deleteBtn = DOM.generateElement(
    "button",
    "Supprimer",
    divBtn,
    "btn--delete"
  );

  detailsBtn.addEventListener("click", () => {
    window.location.href = `./details.php?id=${id}`;
  });

  deleteBtn.addEventListener("click", () => {
    removePokemon(id);
  });
}

function cleanId(id) {
  return id.replace(/^#0*/, "");
}

function removePokemon(id) {
  let compareArray = Get("compare") || [];
  compareArray = compareArray.filter((pokemon) => cleanId(pokemon.id) !== id);
  Set("compare", compareArray);

  const fightImg = document.querySelector(`.fight-img[src*="${id}"]`);
  const compareLeft = document.querySelector("#compare__left .compare-id");
  const compareRight = document.querySelector("#compare__right .compare-id");

  if (fightImg) {
    fightImg.parentElement.removeChild(fightImg);
  }

  if (compareLeft && cleanId(compareLeft.innerText) === id) {
    compareLeft.parentElement.parentElement.innerHTML = "";
  }

  if (compareRight && cleanId(compareRight.innerText) === id) {
    compareRight.parentElement.parentElement.innerHTML = "";
  }

  location.reload();
  checkAndApplyOpacity();
}

function checkAndApplyOpacity() {
  const compareLeft = document.querySelector("#compare__left");
  const compareRight = document.querySelector("#compare__right");

  if (compareLeft.innerHTML.trim() === "") {
    compareLeft.style.opacity = "0";
  } else {
    compareLeft.style.opacity = "1";
  }

  if (compareRight.innerHTML.trim() === "") {
    compareRight.style.opacity = "0";
  } else {
    compareRight.style.opacity = "1";
  }
}
