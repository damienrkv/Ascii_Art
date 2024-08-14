document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('dark-mode-toggle');
    const body = document.body;

    // Überprüfe, ob der Dark Mode bereits aktiviert ist
    if (localStorage.getItem('dark-mode') === 'enabled') {
        body.classList.add('dark-mode');
    }

    toggleButton.addEventListener('click', () => {
        body.classList.toggle('dark-mode');
        
        // Speichere die Einstellung
        if (body.classList.contains('dark-mode')) {
            localStorage.setItem('dark-mode', 'enabled');
        } else {
            localStorage.setItem('dark-mode', 'disabled');
        }
    });
});
