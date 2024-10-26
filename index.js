var canvas = document.getElementById("canvas")


// Create a drawing context
var context = canvas.getContext("2d")

// Set the canvas background color

let x = 20;
let dx = 2;

let goBack = false;

function draw() {
    // draw

    context.clearRect(0, 0, canvas.width, canvas.height);
    context.beginPath();
    context.fillStyle = "white";
    context.arc(x, canvas.clientHeight/2, 10, 0, 2*Math.PI);
    context.fill();
    context.closePath();
    

    if (x >= 300) {
        goBack = true;
    }

    if (x <= 20) {
        goBack = false;
    }

    if (goBack) {
        x -= dx;
    } else {
        x += dx;
    }
}

setInterval(draw, 10);
