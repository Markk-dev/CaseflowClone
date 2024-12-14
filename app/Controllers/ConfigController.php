<?php

namespace App\Controllers;
use App\Models\CaseModel;
use App\Models\CompleteCasesModel;

class ConfigController extends BaseController
{
    public function edit($id)
    {
        $caseModel = new \App\Models\CaseModel();
        $case = $caseModel->select('id, case_type, description, case_priority, progress, user_id')->find($id);

        if (!$case) {
            return redirect()->to('/dashboard')->with('error', 'Case not found.');
        }
        
        $currentUserId = session()->get('user_id');
        if ($case['user_id'] !== $currentUserId) {
            return redirect()->to('/dashboard')->with('error', 'You cannot edit this case as it belongs to another user.');
        }

        return view('edit_case', ['case' => $case]);
    }

    public function update($id)
    {
        $caseModel = new CaseModel();
        $completeCasesModel = new CompleteCasesModel();
        
        $case = $caseModel->find($id);
    
        if (!$case) {
            return redirect()->to('/dashboard')->with('error', 'Case not found.');
        }
    
        $data = $this->request->getPost();
    
        $data = [
            'progress' => 'Complete',
            'completed_at' => date('Y-m-d H:i:s'),
        ];
        $caseModel->update($id, $data);
    
        $this->moveCompletedCases();
    
        return redirect()->to('/dashboard')->with('success', 'Case updated successfully.');
    }
    
    public function moveCompletedCases()
    {
        $caseModel = new CaseModel();
        $completeModel = new CompleteCasesModel();
    

        $completedCases = $caseModel->where('progress', 'Complete')->findAll();
    
        foreach ($completedCases as $case) {
            try {
                // Check if the case already exists in the complete table
                $exists = $completeModel->where('case_id', $case['id'])->first();
    
                if (!$exists) {
                    // Insert into the `complete` table (remove `completed_at`)
                    $completeModel->insert([
                        'user_id' => $case['user_id'], // Ensure `user_id` is correct
                        'case_id' => $case['id'],
                    ]);
    
                    log_message('debug', 'Moved case ID ' . $case['id'] . ' to the complete table.');
                } else {
                    log_message('debug', 'Case ID ' . $case['id'] . ' already exists in the complete table.');
                }
            } catch (\Exception $e) {
                log_message('error', 'Error moving case ID ' . $case['id'] . ': ' . $e->getMessage());
            }
        }
    }
    
    
    
    
}
