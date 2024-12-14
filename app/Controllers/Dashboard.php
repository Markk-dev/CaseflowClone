<?php

namespace App\Controllers;

use App\Models\CaseModel;
use App\Models\UserModel;
use App\Libraries\navbar;

class Dashboard extends BaseController
{
    public function index()
    {
        $caseModel = new CaseModel();
        $userId = session()->get('user_id');

        
        $activeOffenses = $caseModel
            ->where('progress !=', 'Complete')
            ->orderBy('FIELD(severity, "1st", "2nd", "3rd")')  
            ->paginate(10); 

        $pager = \Config\Services::pager(); 

        
        $totalOffenses = $caseModel->countAllResults();
        $highPriorityOffenses = $caseModel->where('severity', '1st')->countAllResults();  
        $completedCases = $caseModel->where('progress', 'Complete')->countAllResults();

        
        $data = [
            'offenses' => $activeOffenses,
            'totalOffenses' => $totalOffenses,
            'highPriorityOffenses' => $highPriorityOffenses,
            'completedCases' => $completedCases,
            'pager' => $pager,  
            'navbar' => new navbar(),  
        ];

        return view('dashboard', $data);
    }

    public function createOffensePage()
    {
        return view('cases/create_offense');
    }

    public function createOffense()
    {
        $caseModel = new CaseModel();
        $userId = session()->get('user_id');

        if (!$userId) {
            return redirect()->back()->with('error', 'User not logged in.');
        }

        // Retrieve form data
        $data = [
            'offense_type'  => $this->request->getPost('offense_type'),
            'name'          => $this->request->getPost('name'),
            'description'   => $this->request->getPost('description'),
            'severity'      => $this->request->getPost('severity'),
            'progress'      => 'Incomplete', // Default value
            'user_id'       => $userId,
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // Debugging: Log the data being inserted
        log_message('debug', 'Offense data: ' . print_r($data, true));

        // Insert the offense into the database
        if ($caseModel->insert($data)) {
            return redirect()->to('/dashboard')->with('success', 'Offense created successfully.');
        } else {
            return redirect()->back()->with('error', 'Failed to create offense.');
        }
    }

    public function deleteOffense($id)
    {
        $caseModel = new CaseModel();
    
        // Check if the offense exists
        if (!$caseModel->find($id)) {
            return redirect()->back()->with('error', 'Offense not found.');
        }
    
        try {
            // Try to delete the offense
            if ($caseModel->delete($id)) {
                return redirect()->to('/dashboard')->with('success', 'Offense deleted successfully.');
            } else {
                return redirect()->back()->with('error', 'Failed to delete the offense.');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
    

    public function editOffense($id)
    {
        log_message('debug', 'Attempting to edit offense with ID: ' . $id);
        $caseModel = new CaseModel();
        $userId = session()->get('user_id');

        // Check if the user is authorized to edit the offense
        if (!$this->isUserAuthorized($id, $userId)) {
            return redirect()->back()->with('error', 'You do not have permission to edit this offense.');
        }

        // Prepare data to update the offense
        $data = [
            'offense_type'  => $this->request->getPost('offense_type'),
            'name'          => $this->request->getPost('name'),
            'description'   => $this->request->getPost('description'),
            'severity'      => $this->request->getPost('severity'),
            'progress'      => $this->request->getPost('progress'),
            'updated_at'    => date('Y-m-d H:i:s'),
        ];

        // Update the offense in the database
        if (!$caseModel->update($id, $data)) {
            return redirect()->back()->with('error', 'Failed to update the offense.');
        } else {
            return redirect()->to('/dashboard')->with('success', 'Offense updated successfully.');
        }
    }

    public function editOffensePage($id)
    {
        $caseModel = new CaseModel();
        $userModel = new UserModel();

        
        $offense = $caseModel->getOffenseWithCreator($id);
        if (!$offense) {
            return redirect()->back()->with('error', 'Offense not found.');
        }

        $userId = session()->get('user_id');

        
        if (!$this->isUserAuthorized($id, $userId)) {
            return redirect()->back()->with('error', 'You do not have permission to edit this offense.');
        }

        
        $data = [
            'offense' => $offense,
        ];

        return view('edit_offense', $data);
    }

    private function isUserAuthorized($offenseId, $userId)
    {
        $caseModel = new CaseModel();
        return $caseModel->isCreator($offenseId, $userId);
    }

}
