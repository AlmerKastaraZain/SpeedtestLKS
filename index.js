let image = new Image();
let logo = new Image();
let imageLoaded = false;
let logoLoaded = false;

function loadImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            image.src = e.target.result;
            image.onload = () => {
                imageLoaded = true;
                drawCanvas();
            };
        };
        reader.readAsDataURL(file);
    }
}

function loadLogo(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            logo.src = e.target.result;
            logo.onload = () => {
                logoLoaded = true;
                drawCanvas();
            };
        };
        reader.readAsDataURL(file);
    }
}

function drawCanvas() {
    const canvas = document.getElementById('canvas');
    const ctx = canvas.getContext('2d');

    // Clear canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw main image if loaded
    if (imageLoaded) {
        // Scale the image to fit the canvas
        const scale = Math.min(canvas.width / image.width, canvas.height / image.height);
        const x = (canvas.width / 2) - (image.width / 2) * scale;
        const y = (canvas.height / 2) - (image.height / 2) * scale;
        const imgWidth = image.width * scale;
        const imgHeight = image.height * scale;
        ctx.drawImage(image, x, y, imgWidth, imgHeight);

        // Draw logo as watermark in the top right if loaded
        if (logoLoaded) {
            const logoWidth = imgWidth * 0.2;  // Adjust watermark size relative to main image
            const logoHeight = (logo.height / logo.width) * logoWidth;
            const logoX = x + imgWidth - logoWidth - 10; // Position 10px from the right
            const logoY = y + 10; // Position 10px from the top
            ctx.drawImage(logo, logoX, logoY, logoWidth, logoHeight);
        }
    }
}

function downloadImage() {
    const canvas = document.getElementById('canvas');
    const link = document.createElement('a');
    link.href = canvas.toDataURL('image/png');
    link.download = 'watermarked_image.png';
    link.click();
}
