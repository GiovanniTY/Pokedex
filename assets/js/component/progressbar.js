// Définir la fonction animateProgressBar comme export
export function animateProgressBar(barId, value) {
    const bar = document.getElementById(barId);
    if (bar) {
        // Animer la largeur de la barre progressivement
        let width = 0;
        let interval = 20; // Interval de mise à jour de la largeur (en ms)
        let step = value / (2000 / interval); // Calcul du pas en fonction de la durée (2s)

        const timer = setInterval(function() {
            width += step;
            if (width >= value) {
                clearInterval(timer);
                width = value;
            }
            bar.style.width = width + '%';
        }, interval);
    }
}

// Code pour l'animation des barres de statistiques
document.addEventListener('DOMContentLoaded', function() {
    const hpBarContainer = document.querySelector('.stat-bar-container[data-hp]');
    const attackBarContainer = document.querySelector('.stat-bar-container[data-attack]');
    const defenseBarContainer = document.querySelector('.stat-bar-container[data-defense]');
    const specialAttackBarContainer = document.querySelector('.stat-bar-container[data-attackSpecial]'); 
    const specialDefenseBarContainer = document.querySelector(".stat-bar-container[data-defenseSpecial]");
    const speedBarContainer = document.querySelector(".stat-bar-container[data-speed]");

    if (hpBarContainer) {
        const hpValue = parseInt(hpBarContainer.getAttribute('data-hp'));
        animateProgressBar('hpBar', hpValue);
    }

    if (attackBarContainer) {
        const attackValue = parseInt(attackBarContainer.getAttribute('data-attack'));
        animateProgressBar('attackBar', attackValue);
    }

    if (defenseBarContainer) {
        const defenseValue = parseInt(defenseBarContainer.getAttribute('data-defense'));
        animateProgressBar('defenseBar', defenseValue);
    }

    if (specialAttackBarContainer) {
        const specialAttackValue = parseInt(specialAttackBarContainer.getAttribute('data-attackSpecial'));
        animateProgressBar('attackSpecialBar', specialAttackValue);
    }

    if (specialDefenseBarContainer) {
        const specialDefenseValue = parseInt(specialDefenseBarContainer.getAttribute('data-defenseSpecial'));
        animateProgressBar('defenseSpecialBar', specialDefenseValue);
    }

    if (speedBarContainer) {
        const speedValue = parseInt(speedBarContainer.getAttribute('data-speed'));
        animateProgressBar('speedBar', speedValue);
    }
});
