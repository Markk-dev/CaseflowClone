<?php

namespace App\Controllers;

use App\Models\CaseModel;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\navbar;

class StatisticsController extends BaseController
{
    public function index()
    {
        $navbar = new Navbar(); 

        
        return view('statistics', ['navbar' => $navbar]);
    }

    public function getOffenseData()
    {
        $caseModel = new CaseModel();
        $timeRange = $this->request->getGet('timeRange') ?? '3 Days'; 
        $timePeriod = $this->getTimePeriod($timeRange);

        
        $totalOffenses = $caseModel->where('created_at >=', $timePeriod['start'])
                                   ->where('created_at <=', $timePeriod['end'])
                                   ->countAllResults();

        
        $highOffenses = $caseModel->where('severity', '3rd') 
                                  ->where('created_at >=', $timePeriod['start'])
                                  ->where('created_at <=', $timePeriod['end'])
                                  ->countAllResults();

        
        $offensesByDate = $this->getOffensesByDate($caseModel, $timePeriod['start'], $timePeriod['end'], $timeRange);

        
        $horizontalLabels = $this->generateHorizontalLabels($timeRange);

        return $this->response->setJSON([
            'totalOffenses' => $totalOffenses,
            'highOffenses' => $highOffenses,
            'offensesByDate' => $offensesByDate,
            'horizontalLabels' => $horizontalLabels
        ]);
    }

    private function getOffensesByDate($caseModel, $startDate, $endDate, $timeRange)
    {
        $offensesByDate = [];

        if ($timeRange == 'Older') {
            
            $offenses = $caseModel->select('MONTH(created_at) as month, COUNT(*) as count')
                                  ->where('created_at >=', $startDate)
                                  ->where('created_at <=', $endDate)
                                  ->groupBy('MONTH(created_at)')
                                  ->orderBy('month', 'ASC')
                                  ->findAll();

            
            foreach ($offenses as $offense) {
                $offensesByDate[] = [
                    'date' => date('M', mktime(0, 0, 0, $offense['month'], 10)), 
                    'count' => $offense['count']
                ];
            }
        } else {
            
            $offenses = $caseModel->select('DATE(created_at) as date, COUNT(*) as count')
                                  ->where('created_at >=', $startDate)
                                  ->where('created_at <=', $endDate)
                                  ->groupBy('DATE(created_at)')
                                  ->orderBy('date', 'ASC')
                                  ->findAll();

            foreach ($offenses as $offense) {
                $offensesByDate[] = [
                    'date' => $offense['date'],
                    'count' => $offense['count']
                ];
            }
        }

        return $offensesByDate;
    }

    private function generateHorizontalLabels($timeRange)
    {
        $labels = [];

        switch ($timeRange) {
            case '3 Days':
                $labels = [1, 2, 3];
                break;
            case '7 Days':
                $labels = [1, 2, 3, 4, 5, 6, 7];
                break;
            case '1 Month':
                $labels = range(1, 30   ); 
                break;
            case 'Older':
                $labels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']; 
                break;
            default:
                $labels = [1, 2, 3]; 
        }

        return $labels;
    }

    private function getTimePeriod($timeRange)
    {
        $currentDate = date('Y-m-d H:i:s');
        switch ($timeRange) {
            case '3 Days':
                $start = date('Y-m-d H:i:s', strtotime('-3 days'));
                break;
            case '7 Days':
                $start = date('Y-m-d H:i:s', strtotime('-7 days'));
                break;
            case '1 Month':
                $start = date('Y-m-d H:i:s', strtotime('-1 month'));
                break;
            case 'Older':
                $start = date('Y-m-d H:i:s', strtotime('-1 year')); 
                break;
            default:
                $start = date('Y-m-d H:i:s', strtotime('-3 days')); 
        }

        return [
            'start' => $start,
            'end' => $currentDate
        ];
    }
}
