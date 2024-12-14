let typingTimer;
const typingDelay = 500; // Delay in milliseconds (wait time after typing stops)

document.getElementById('locationSearch').addEventListener('input', function () {
    const query = this.value.trim();

    // Clear previous timer
    clearTimeout(typingTimer);

    // Clear suggestions if the input is empty
    if (query.length < 3) {
        const suggestionsElement = document.getElementById('locationSuggestions');
        suggestionsElement.innerHTML = '';
        suggestionsElement.classList.remove('show');
        return;
    }

    // Set a new timer to fetch results only if typing stops
    typingTimer = setTimeout(() => {
        fetch(`https://nominatim.openstreetmap.org/search?format=json&limit=5&q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                // Map data to dropdown items
                const suggestions = data.map(loc => {
                    return `<div class="dropdown-item" onclick="selectLocation('${loc.display_name}')">${loc.display_name}</div>`;
                }).join('');

                // Display suggestions
                const suggestionsElement = document.getElementById('locationSuggestions');
                suggestionsElement.innerHTML = suggestions;
                suggestionsElement.classList.add('show');
            })
            .catch(err => console.error('Error fetching location data:', err));
    }, typingDelay);
});

// Function to select a location from suggestions
function selectLocation(location) {
    document.getElementById('locationSearch').value = location;
    document.getElementById('locationSuggestions').classList.remove('show');
}
