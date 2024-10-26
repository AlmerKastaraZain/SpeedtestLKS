let timer = "00:00"
let miliseconds = 0
let seconds = 0

const timerDisplayElement = document.getElementById("timer-display")

const startButton = document.getElementById("start")
const pauseButton = document.getElementById("stop")
const resetButton = document.getElementById("reset")
var timerInterval;

var timerRunning = false;

startButton.addEventListener("click", () => {
    if (timerRunning === true) {
        alert("Timer is already running!")
        return
    }
    timerRunning = true
    timerInterval = setInterval(UpdateTimer, 1)
})


function UpdateTimer() {
    miliseconds++

    if (miliseconds === 60) {
        miliseconds = 0
        seconds++
    }

    if (seconds < 10) {
        timer = "0" + seconds.toString() + ":"
    } else {
        timer = seconds.toString() + ":"
    }

    if (miliseconds < 10) {
        timer += "0" + miliseconds.toString()
    } else {
        timer += miliseconds.toString()
    }


    timerDisplayElement.textContent = timer.toString()
    if (timer === "999:59") {
        alert("Timer has overflowed")
        StopTimer()
    }

    if (timer === "00:00") {
        clearInterval(updateTimer)
        alert("Time's up!")
    }

    console.log(timer)
}

pauseButton.addEventListener("click", () => {
    StopTimer()
})

function StopTimer() {
    timerRunning = false
    clearInterval(timerInterval)
    alert("Timer stopped!")
    console.log("Timer stopped!")

}

resetButton.addEventListener("click", () => {
    StopTimer()
    ResetTimer()
})

function ResetTimer() {
    timer = "00:00"
    miliseconds = 0
    seconds = 0
    timerDisplayElement.textContent = timer.toString()
    console.log("Timer reset!")
}