const xInputElement = document.getElementById("x-input")
const yInputElement = document.getElementById("y-input")
const splitButtonElement = document.getElementById("split-button")
const imageElement = document.getElementById("img")
const containerElement = document.getElementById("container")

splitButtonElement.addEventListener("click", () => {
    containerElement.innerHTML = ""

    
    let x = parseInt(xInputElement.value)
    let y = parseInt(yInputElement.value)
    console.log(x, y)
    if ((x <= 0 && y <= 0)) return;

    console.log(containerElement)
    containerElement.style.gridTemplateRows = "repeat(" + y + ", 1fr)"
    containerElement.style.gridTemplateColumns = "repeat(" + x + ", 1fr)"
    containerElement.style.gap = "2px"

    newWidth =  "calc(600px / " + x + ")"
    newHeight = "calc(332px / " + y + ")"


    // Add element
    for (let yIndex = 0; yIndex < y; yIndex++) {        
        for (let xIndex = 0; xIndex < x; xIndex++) {
            // Create div container for Image
            let divImg = document.createElement('div')
            divImg.classList.add('img-container')
            divImg.style.width = newWidth
            divImg.style.height = newHeight
            containerElement.append(divImg)
            
            console.log(332 / xIndex);
            // Create a new Img Element
            let newImage = document.createElement("img");
            newImage.src = imageElement.src
            newImage.classList.add("img")
            newImage.style.left = ((-600 / x) * xIndex) + "px";
            newImage.style.top = ((-332 / y) * yIndex) + "px";
            divImg.append(newImage)
        }
    }


    let images = document.querySelectorAll(".img-container")
    images.forEach(image => {
        image.addEventListener("click", () => {
            image.classList.add('begone-img')
        })

        image.addEventListener("animationend", () => {
            image.classList.remove('begone-img')
            image.classList.add('hidden')
        })
    })
})



