<?php

namespace App\Libraries;

use App\Models\CaseModel;

class MetricChart
{
    public function getTopLocations($limit = 3)
    {
        $caseModel = new CaseModel();

        // Fetch the top locations with the most cases
        return $caseModel->select('location, COUNT(location) as occurrence')
            ->groupBy('location')
            ->orderBy('occurrence', 'DESC')
            ->limit($limit)
            ->findAll();
    }

    public function renderLocationCharts($topLocations)
    {
        if (count($topLocations) < 2) {
            return '<p>No data available to display charts.</p>';
        }

        $highest = $topLocations[0];
        $lowest = end($topLocations);

        return '
        <div class="metric-container d-flex justify-content-between">
            <div class="chart-item">
            <h3 class="metric-title" style="font-weight: 650;">Highest Crime <span style="font-weight: 300;">Rate</span></h3>
                <p class="metric-location">' . esc($highest['location']) . '</p>
                <canvas id="location-chart-highest" class="chartMetric"></canvas>
            </div>

            <div class="chart-item">
              <h3 class="metric-title" style="font-weight: 650;">Lowest Crime <span style="font-weight: 300;">Rate</span></h3>
              <p class="metric-location">' . esc($lowest['location']) . '</p>
                <canvas id="location-chart-lowest" class="chartMetric"></canvas>
            </div>
        </div>';
    }
}
