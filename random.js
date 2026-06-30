document.addEventListener("DOMContentLoaded", function() {
    function fetchRandomArt() {
        fetch('random_art.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Netzwerkantwort war nicht ok');
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Logge die Antwort, um sicherzustellen, dass sie korrekt ist
                var asciiArtDisplay = document.getElementById('ascii-art-display');
                if (asciiArtDisplay && data.ascii_art) {
                    asciiArtDisplay.innerHTML = '<pre>' + data.ascii_art + '</pre>'; // Verwende ein <pre>-Tag für die Formatierung
                }
            })
            .catch(error => console.error('Fehler beim Abrufen der zufälligen Kunst:', error));
    }

    // Initial fetch
    fetchRandomArt();

    // Fetch new art every 5 seconds
    setInterval(fetchRandomArt, 5000);
});