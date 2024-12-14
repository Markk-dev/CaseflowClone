async function fetchCaseData(timeRange = null) {
    const url = timeRange 
        ? `/api/case-data?timeRange=${encodeURIComponent(timeRange)}`
        : `/api/case-data`;
    const response = await fetch(url);
    return await response.json();
}

async function initializeCharts(timeRange = '3 Days') {
    const data = await fetchCaseData(timeRange);

    // Total Cases Chart
    const totalCasesChartData = {
        labels: data.timeLabels.reverse(), 
        datasets: [
            {
                label: 'Total Cases',
                data: data.totalCases,
                borderColor: 'rgba(54, 162, 235, 0.8)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
            },
        ]
    };

    // High Priority Cases Chart
    const highCasesChartData = {
        labels: data.timeLabels, 
        datasets: [
            {
                label: 'High Priority Cases',
                data: data.highCases,
                borderColor: 'rgba(255, 99, 132, 0.8)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
            },

          
        ]
    };

    const chartOptions = {
        responsive: true,
        scales: {
            x: {
                title: { display: true, text: 'Days' },
            },
            y: {
                beginAtZero: true,
                title: { display: true, text: 'Number of Cases' },
            },
        },
    };

    // Render Total Cases Chart
    const totalCasesCtx = document.getElementById('total-cases-chart').getContext('2d');
    if (window.totalCasesChart) {
        window.totalCasesChart.destroy(); // Destroy previous instance
    }
    window.totalCasesChart = new Chart(totalCasesCtx, {
        type: 'line',
        data: totalCasesChartData,
        options: chartOptions,
    });

    // Render High Priority Cases Chart
    const highCasesCtx = document.getElementById('high-cases-chart').getContext('2d');
    if (window.highCasesChart) {
        window.highCasesChart.destroy(); // Destroy previous instance
    }
    window.highCasesChart = new Chart(highCasesCtx, {
        type: 'line',
        data: highCasesChartData,
        options: chartOptions,
    });
}

// Handle dropdown selection
document.getElementById('timeRangeDropdown').addEventListener('change', async (event) => {
    const selectedRange = event.target.value;
    await initializeCharts(selectedRange); // Update both charts
});

// Initialize with default range
initializeCharts();
