
  document.addEventListener('DOMContentLoaded', () => {

        const topLocationsData = document.getElementById('top-locations-data');
        if (!topLocationsData) return;

    const topLocations = JSON.parse(topLocationsData.textContent);

    if (topLocations.length >= 2) {
        // Chart for the location with the highest cases
        const highest = topLocations[0];
        new Chart(document.getElementById('location-chart-highest'), {
            type: 'doughnut',
            data: {
                labels: [highest.location, 'Other Locations'],
                datasets: [{
                    data: [highest.occurrence, 100 - highest.occurrence],
                    backgroundColor: ['#28a745', '#e0e0e0']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                }
            }
        });

        // Chart for the location with the lowest cases
        const lowest = topLocations[topLocations.length - 1];
        new Chart(document.getElementById('location-chart-lowest'), {
            type: 'doughnut',
            data: {
                labels: [lowest.location, 'Other Locations'],
                datasets: [{
                    data: [lowest.occurrence, 100 - lowest.occurrence],
                    backgroundColor: ['#ff6347', '#e0e0e0']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true }
                }
            }
        });
    }
});


  