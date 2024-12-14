<?php
namespace App\Controllers;

use App\Models\CaseModel;
use App\Models\CompleteCasesModel;

class ConfigController extends BaseController
{
    public function edit($id)
    {
        $caseModel = new CaseModel();
        $case = $caseModel->select('id, offense_type, description, severity, progress, user_id')->find($id);

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
        $case = $caseModel->find($id);

        if (!$case) {
            return redirect()->to('/dashboard')->with('error', 'Case not found.');
        }

        // Get form data
        $data = [
            'offense_type'  => $this->request->getPost('offense_type'),
            'description'   => $this->request->getPost('description'),
            'severity'      => $this->request->getPost('severity'),
            'progress'      => $this->request->getPost('progress'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // Update the offense in the database
        if ($caseModel->update($id, $data)) {
            // If the case is marked as 'Complete', move it to the complete table
            if ($data['progress'] === 'Complete') {
                $this->moveCompletedCases($case);
            }

            return redirect()->to('/dashboard')->with('success', 'Case updated successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to update the case.');
        }
    }

    public function moveCompletedCases($case)
    {
        $completeModel = new CompleteCasesModel();

        // Check if the case already exists in the complete table
        $exists = $completeModel->where('case_id', $case['id'])->first();

        if (!$exists) {
            // Insert into the `complete` table
            $completeModel->insert([
                'user_id' => $case['user_id'], // Ensure `user_id` is correct
                'case_id' => $case['id'],
            ]);

            log_message('debug', 'Moved case ID ' . $case['id'] . ' to the complete table.');
        } else {
            log_message('debug', 'Case ID ' . $case['id'] . ' already exists in the complete table.');
        }
    }
}
