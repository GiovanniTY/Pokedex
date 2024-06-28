export function navDetails() {
    const arrowLeft = document.querySelector(".arrow--left")
    const arrowRight = document.querySelector(".arrow--right")
    
    function getIdFromUrl() {
        const urlParams = new URLSearchParams(window.location.search);
        const id = urlParams.get('id');
        return id;
    }

    const id = getIdFromUrl()

    if(arrowLeft!= null){
        arrowLeft.addEventListener("click", () => {
            window.location.href = `./details.php?id=${parseInt(id)-1}`;  
        })
    }

    if(arrowRight!= null){
        arrowRight.addEventListener("click", () => {
            window.location.href = `./details.php?id=${parseInt(id)+1}`;
        })
    }
}