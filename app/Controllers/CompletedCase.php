<?php
namespace App\Controllers;

use App\Models\CaseModel;
use App\Libraries\CaseItem; 

class CompletedCase extends BaseController
{
    public function completedCases()
{
    $caseModel = new CaseModel();
    $completedCases = $caseModel->where('progress', 'Complete')->findAll();
    
    // Check if there are no cases
    if (empty($completedCases)) {
        $caseRows = '<tr><td colspan="5" class="text-center">No cases found</td></tr>';
    } else {
        // Instantiate the CaseItem class from Libraries
        $caseItem = new CaseItem();
        
        // Render the component for each case
        $caseRows = '';
        $counter = 1;
        foreach ($completedCases as $case) {
            $caseRows .= $caseItem->render($case, $counter); // Concatenate the rendered rows
        }
    }

    // Pass the rendered rows to the view
    return view('completed', [
        'caseRows' => $caseRows,
    ]);
}

}
