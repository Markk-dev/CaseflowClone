<?php

namespace App\Controllers;

use App\Models\CaseModel;
use App\Libraries\navbar;
use App\Libraries\MetricChart;

class StatisticsController extends BaseController
{
    public function index()
    {
        $caseModel = new CaseModel();
        $metricChart = new MetricChart();
        
        // Fetch case counts
        $totalCasesData = $this->getCaseCounts();
        $highPriorityCasesData = $this->getHighPriorityCaseCounts();
        $topLocations = $metricChart->getTopLocations();

        $data = [
            'totalCasesData' => $totalCasesData,
            'highPriorityCasesData' => $highPriorityCasesData,
            'navbar' => new Navbar(),
            'topLocations' => $topLocations,
            'locationChartsHTML' => $metricChart->renderLocationCharts($topLocations)
        ];

        return view('statistics', $data);
    }

    public function getCaseData()
    {
        $caseModel = new CaseModel();
        $timeRange = $this->request->getGet('timeRange') ?? '3 Days'; // Default to 3 Days
        $timeLabels = [];
        $totalCases = [];
        $highCases = [];
    
        if (in_array($timeRange, ['3 Days', '7 Days', '1 Month'])) {
            $days = $timeRange === '3 Days' ? 3 : ($timeRange === '7 Days' ? 7 : 30);
    
            for ($i = 0; $i < $days; $i++) {
                $dateStart = date('Y-m-d H:i:s', strtotime("-$i day"));
                $dateEnd = date('Y-m-d H:i:s', strtotime("-" . ($i - 1) . " day"));
    
                $timeLabels[] = "Day " . ($i + 1);
    
                $totalCases[] = $caseModel->where('created_at >=', $dateStart)->where('created_at <', $dateEnd)->countAllResults();
                $highCases[] = $caseModel->where('created_at >=', $dateStart)
                                         ->where('created_at <', $dateEnd)
                                         ->where('case_priority', 'High')->countAllResults();
            }
        } else {
            // Group by months for "Older" range
            $months = $caseModel->select("DATE_FORMAT(created_at, '%Y-%m') as month, COUNT(*) as total")
                                ->groupBy('month')
                                ->orderBy('month', 'ASC')
                                ->findAll();
    
            foreach ($months as $month) {
                $timeLabels[] = date('F Y', strtotime($month['month'] . '-01'));
                $totalCases[] = $month['total'];
                $highCases[] = $caseModel->where('case_priority', 'High')
                                         ->where('created_at >=', $month['month'] . '-01')
                                         ->where('created_at <', date('Y-m-d H:i:s', strtotime($month['month'] . '-01 +1 month')))
                                         ->countAllResults();
            }
        }
    
        return $this->response->setJSON([
            'timeLabels' => array_reverse($timeLabels), 
            'totalCases' => $totalCases,
            'highCases' => $highCases,
        ]);
    }


    private function getCaseCounts()
    {
        $caseModel = new CaseModel();
        return [
            'today' => $caseModel->where('created_at >=', date('Y-m-d 00:00:00'))->countAllResults(),
            '3days' => $caseModel->where('created_at >=', date('Y-m-d H:i:s', strtotime('-3 days')))->countAllResults(),
            '7days' => $caseModel->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')))->countAllResults(),
            '1month' => $caseModel->where('created_at >=', date('Y-m-d H:i:s', strtotime('-1 month')))->countAllResults(),
        ];
    }

    private function getHighPriorityCaseCounts()
    {
        $caseModel = new CaseModel();
        return [
            'today' => $caseModel->where('created_at >=', date('Y-m-d 00:00:00'))->where('case_priority', 'High')->countAllResults(),
            '3days' => $caseModel->where('created_at >=', date('Y-m-d H:i:s', strtotime('-3 days')))->where('case_priority', 'High')->countAllResults(),
            '7days' => $caseModel->where('created_at >=', date('Y-m-d H:i:s', strtotime('-7 days')))->where('case_priority', 'High')->countAllResults(),
            '1month' => $caseModel->where('created_at >=', date('Y-m-d H:i:s', strtotime('-1 month')))->where('case_priority', 'High')->countAllResults(),
        ];
    }
}
