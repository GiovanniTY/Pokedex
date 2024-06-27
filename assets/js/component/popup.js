export function popup() {
    const popup = document.querySelector("#add__popup");
    const btnAdd = document.querySelectorAll(".compare");
    let interval = null;

    for (const element of btnAdd) {
        element.addEventListener("click", () => {

            if (interval) {
                clearInterval(interval);
                interval = null;
            }

            popup.style.opacity = 1;
            popup.style.display = "block";

            setTimeout(() => {
                interval = setInterval(() => {
                    popup.style.opacity -= 0.025;
                    if (popup.style.opacity <= 0) {
                        clearInterval(interval);
                        interval = null;
                        popup.style.display = "none";
                    }
                }, 125);
            }, 2000);
        });
    }
}

