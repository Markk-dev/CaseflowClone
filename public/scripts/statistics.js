document.addEventListener('DOMContentLoaded', () => {
    const timeRangeDropdown = document.getElementById('timeRangeDropdown');
    if (!timeRangeDropdown) return;

    // Fetch offense data based on the selected time range
    timeRangeDropdown.addEventListener('change', () => {
        const timeRange = timeRangeDropdown.value;
        fetchOffenseData(timeRange);
    });

    function fetchOffenseData(timeRange) {
        fetch(`/statistics/getOffenseData?timeRange=${timeRange}`)
            .then(response => response.json())
            .then(data => {
                // Render the charts with the new data
                renderCharts(data.totalOffenses, data.highOffenses, data.offensesByDate, data.horizontalLabels);
            })
            .catch(error => console.error('Error fetching offense data:', error));
    }

    // Declare the chart variables globally
    let totalOffensesChart = null;
    let highOffensesChart = null;

    // Render the charts with new data
    function renderCharts(totalOffenses, highOffenses, offensesByDate, horizontalLabels) {
        // Destroy old charts if they exist
        if (totalOffensesChart) {
            totalOffensesChart.destroy();
        }
        if (highOffensesChart) {
            highOffensesChart.destroy();
        }

        // Create a new chart for Total Offenses
        totalOffensesChart = new Chart(document.getElementById('total-offenses-chart'), {
            type: 'line', // Line graph
            data: {
                labels: horizontalLabels, // Dynamic horizontal labels
                datasets: [{
                    label: 'Total Offenses',
                    data: offensesByDate.map(offense => offense.count), // Map offenses data
                    backgroundColor: 'rgba(28, 170, 45, 0.2)', // Light green
                    borderColor: 'rgba(28, 170, 45, 1)', // Dark green
                    borderWidth: 2,
                    fill: false // No fill for line chart
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Days/Months' // X-axis label
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Offenses' // Y-axis label
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: { display: true }
                }
            }
        });

        // Create a new chart for High Severity Offenses
        highOffensesChart = new Chart(document.getElementById('high-offenses-chart'), {
            type: 'line', // Line graph
            data: {
                labels: horizontalLabels, // Dynamic horizontal labels
                datasets: [{
                    label: 'High Severity Offenses',
                    data: offensesByDate.map(offense => offense.count), // Map offenses data
                    backgroundColor: 'rgba(255, 99, 71, 0.2)', // Light red
                    borderColor: 'rgba(255, 99, 71, 1)', // Dark red
                    borderWidth: 2,
                    fill: false // No fill for line chart
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Days/Months' // X-axis label
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Number of Offenses' // Y-axis label
                        },
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: { display: true }
                }
            }
        });
    }

    // Initial fetch for the default time range
    fetchOffenseData(timeRangeDropdown.value);
});
