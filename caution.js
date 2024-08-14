document.addEventListener('DOMContentLoaded', () => {
    const infoButton = document.getElementById('info-button');
    const infoPopup = document.getElementById('info-popup');

    infoButton.addEventListener('click', () => {
        // Toggle das Popup ein- und ausblenden
        if (infoPopup.style.display === 'block') {
            infoPopup.style.display = 'none';
        } else {
            infoPopup.style.display = 'block';
        }
    });

    // Optional: Schließe das Popup, wenn außerhalb geklickt wird
    document.addEventListener('click', (event) => {
        if (!infoButton.contains(event.target) && !infoPopup.contains(event.target)) {
            infoPopup.style.display = 'none';
        }
    });
});
