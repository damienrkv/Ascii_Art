// resize-ascii-art.js
function resizeAsciiArt() {
    const container = document.getElementById('ascii-art-display');
    const asciiArt = container.querySelector('pre'); // Nimmt an, dass dein ASCII-Art im <pre> Tag ist

    let fontSize = 16; // Ausgangsgröße
    asciiArt.style.fontSize = fontSize + 'px';

    // Reduziere die Schriftgröße, bis das ASCII-Art in den Container passt
    while (asciiArt.scrollWidth > container.clientWidth || asciiArt.scrollHeight > container.clientHeight) {
        fontSize -= 1;
        asciiArt.style.fontSize = fontSize + 'px';
        if (fontSize <= 5) break; // Mindestgröße, um Überanpassung zu vermeiden
    }
}

// Ruft die Funktion beim Laden und beim Ändern der Fenstergröße auf
window.addEventListener('load', resizeAsciiArt);
window.addEventListener('resize', resizeAsciiArt);
